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
        $sql = "SELECT consulta.id, horario_disponivel.data, horario_disponivel.hora, consulta.tipo_criador
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
}
?>