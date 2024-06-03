<?php
namespace app\model;

use PDO;
use Connect;
use PDOException;

class ScheduleTimeSecretaryModel extends Connect
{
    private $pdo;

    public function __construct()
    {
        $this->pdo = $this->getConnection();

        if (!$this->pdo) {
            throw new PDOException();
        }
    }

    public function getAvailableSchedules()
    {
        $sql = "SELECT id, data, hora, dia_da_semana, disponivel FROM horario_disponivel WHERE disponivel = 1";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function addSchedule($id_horario, $tipo_criador, $id_criador)
    {
        if (!$this->checkRegistered($id_horario)) {

            $this->makeUnavailable($id_horario);

            if ($tipo_criador == 'usuario') {
                $stmt = $this->pdo->prepare("INSERT INTO consulta (id_horario_disponivel, tipo_criador, id_criador_usuario) VALUES (:id_horario, :tipo_criador, :id_criador)");
            } elseif ($tipo_criador == 'secretaria') {
                $stmt = $this->pdo->prepare("INSERT INTO consulta (id_horario_disponivel, tipo_criador, id_criador_secretaria) VALUES (:id_horario, :tipo_criador, :id_criador)");
            } else {
                return false;
            }

            $stmt->bindParam(':id_horario', $id_horario, PDO::PARAM_INT);
            $stmt->bindParam(':tipo_criador', $tipo_criador, PDO::PARAM_STR);
            $stmt->bindParam(':id_criador', $id_criador, PDO::PARAM_INT);

            try {
                $stmt->execute();
                return true; //Inserção bem-sucedida!
            } catch (PDOException $e) {
                return false;//Erro ao inserir dados
            }
        } else {
            return false;//Horario Indisponivel
        }
    }

    public function checkRegistered($id_horario)
    {
        $stmt = $this->pdo->prepare("SELECT COUNT(*) FROM consulta WHERE id_horario_disponivel = :id_horario");
        $stmt->bindParam(':id_horario', $id_horario, PDO::PARAM_INT);
        $stmt->execute();
        $count = $stmt->fetchColumn();

        return ($count > 0);
    }

    public function makeUnavailable($id_horario)
{
    $sql = "UPDATE horario_disponivel SET disponivel = 0 WHERE id = :id_horario";
    $stmt = $this->pdo->prepare($sql);
    $stmt->bindParam(':id_horario', $id_horario, PDO::PARAM_INT);

    try {
        $stmt->execute();
        return true;//Horário tornou-se indisponível com sucesso!
    } catch (PDOException $e) {
        return false;//Erro ao tornar horário indisponível
    }
}
}
