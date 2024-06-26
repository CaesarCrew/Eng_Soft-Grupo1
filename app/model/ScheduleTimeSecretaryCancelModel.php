<?php

namespace app\model;

use PDO;
use Connect;
use PDOException;

class ScheduleTimeSecretaryCancelModel extends Connect
{
    private $pdo;

    public function __construct()
    {
        $this->pdo = $this->getConnection();

        if (!$this->pdo) {
            throw new PDOException();
        }
    }

    public function getAppointments()
    {
    $sql = "SELECT consulta.id, horario_disponivel.data, horario_disponivel.hora, consulta.tipo_criador, consulta.status
            FROM consulta
            INNER JOIN horario_disponivel ON consulta.id_horario_disponivel = horario_disponivel.id
            ORDER BY horario_disponivel.data, horario_disponivel.hora";
    $stmt = $this->pdo->query($sql);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function cancelSchedule($id)
    {
        $this->pdo->beginTransaction();
        
        try {
            // Primeiro, obter o id_horario_disponivel relacionado
            $stmt = $this->pdo->prepare("SELECT id_horario_disponivel FROM consulta WHERE id = :id");
            $stmt->bindValue(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
            $id_horario = $stmt->fetchColumn();

            // Excluir a consulta
            $stmt = $this->pdo->prepare("DELETE FROM consulta WHERE id = :id");
            $stmt->bindValue(':id', $id, PDO::PARAM_INT);
            $stmt->execute();

            // Tornar o horário disponível novamente
            $this->makeAvailable($id_horario);

            $this->pdo->commit();
            return true;
        } catch (PDOException $e) {
            $this->pdo->rollBack();
            return false;
        }
    }

    private function makeAvailable($id_horario)
    {
        $sql = "UPDATE horario_disponivel SET disponivel = 1 WHERE id = :id_horario";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':id_horario', $id_horario, PDO::PARAM_INT);

        try {
            $stmt->execute();
            return true; // Horário tornou-se disponível com sucesso!
        } catch (PDOException $e) {
            return false; // Erro ao tornar horário disponível
        }
    }

    public function listInfomation($id_consulta){
        $id_usuario = $this->getId($id_consulta);
        if($id_usuario){
            $sql = "SELECT *FROM usuario WHERE id = :id_usuario";
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindParam(":id_usuario", $id_usuario, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
        echo "Erro ao listar";
        return null;
    }

    private function getId($id_consulta){
        $sql = "SELECT id_criador_usuario FROM consulta WHERE id = :id_consulta";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':id_consulta', $id_consulta, PDO::PARAM_INT);

        try {
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($result) { 
                return $result['id_criador_usuario']; // Retorna o ID do paciente
            } else {
                return false; // Paciente não encontrado
            }
        } catch (PDOException $e) {
            return false; // Erro ao executar a consulta
        }
    }
    public function getStatus($id_consulta)
    {
        $sql = "SELECT status FROM consulta WHERE id = :id_consulta";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':id_consulta', $id_consulta, PDO::PARAM_INT);

        try {
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($result) { 
                return $result['status']; // Retorna o status da consulta
            } else {
                return 'N/A'; // Status não encontrado
            }
        } catch (PDOException $e) {
            return 'N/A'; // Erro ao executar a consulta
        }
    }
    public function updateStatus($id, $status)
    {
        // Mapeamento dos status recebidos para os valores da tabela
        $statusMapping = [
            'cancelada' => 'cancelado',
            'concluida' => 'concluído',
            'nao_compareceu' => 'não compareceu',
            'pendente' => 'pendente' // Adicionando 'pendente' ao mapeamento
        ];

    // Verifica se o status recebido está mapeado; se não, retorna falso
    if (!array_key_exists($status, $statusMapping)) {
        return false;
    }

    // Obtém o valor correto do mapeamento
    $statusTabela = $statusMapping[$status];

    // Atualiza o status na tabela consulta
    $sql = "UPDATE consulta SET status = :status WHERE id = :id";
    $stmt = $this->pdo->prepare($sql);
    $stmt->bindParam(':status', $statusTabela, PDO::PARAM_STR);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);

    try {
        $stmt->execute();
        return true;
    } catch (PDOException $e) {
        return false;
    }
}
}
?>