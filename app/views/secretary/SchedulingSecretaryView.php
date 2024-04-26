<?php

use app\database\SchedulingSecretaryModel;

class SchedulingSecretaryController{
    // public function showAddScheduleForm($params){
        
    //     return[ 
    //         "view" => "secretary/SchedulingSecretaryView.php",
    //         "data" => ["title" => "agenda"]
    //     ];
    // }
    public function showSchedule(){
        $page = 1;

        if(isset($_GET["pagina"])){
            $page = filter_input(INPUT_GET, "pagina" ,FILTER_VALIDATE_INT);
        }
        if (isset($_GET['edit']) && $_GET['edit'] === 'success') {
            echo "<p>Edição realizada com sucesso!</p>";
        }
        if (isset($_GET['delete']) && $_GET['delete'] === 'success') {
            echo "<p>deletado  com sucesso!</p>";
        }

        if (!$page) {
            $page = 1;
        }

        $limite = 4;
        $inicio = ($page * $limite) - $limite;
        
        $SchedulingSecretaryModel = new SchedulingSecretaryModel;
        $dados = $SchedulingSecretaryModel->getTimeTables($inicio , $limite);
        
        $amount = $SchedulingSecretaryModel->numberOfLines();
        $pages = ceil((int)$amount[0]["count"]/ $limite); ;
        $SchedulingSecretaryModel->closeConnection();
        return[
            "view" => "secretary/SchedulingSecretaryView.php",
            "data" => ["title" => "agenda" ,"dados" => $dados ,"page" => $page , "pages"=>$pages]
        ];
    }

    public function dayOfTheWeek($date){
        $dayOfTheWeek = null;
        
        $formatoData = 'Y-m-d'; 
        

        if(!empty($date)){
            $dateTime = \DateTime::createFromFormat($formatoData, $date);
        }else{
            echo "data não enviada";
            return null;
        }
        
        if ($dateTime && $dateTime->format($formatoData) === $date) {
            
            $daysOfTheWeek = [
                1 => 'Segunda-feira',
                2 => 'Terça-feira',
                3 => 'Quarta-feira',
                4 => 'Quinta-feira',
                5 => 'Sexta-feira',
                6 => 'Sábado',
                7 => 'Domingo'
            ];
            $dayOfTheWeek = $daysOfTheWeek[$dateTime->format('N')];
        } else {
            echo "A data $date não é válida.";
            return null;
        }
        return $dayOfTheWeek;
    }

    public function AddScheduleForm(){
        $date = $_POST['data'];
        $times = isset($_POST['times']) ? $_POST['times'] : [];
        $formatoTime = 'H:i';
        
        
        $dayOfTheWeek = $this->dayOfTheWeek($date);

        if($dayOfTheWeek === null){
            return;
        }

        $SchedulingSecretaryModel = new SchedulingSecretaryModel;
        foreach($times as $time){
            $dateTime = \DateTime::createFromFormat($formatoTime, $time);
            if (!$dateTime   ||  $dateTime->format($formatoTime) !== $time) {
                echo "A hora $time não é válida.";
                return;
            }
            $SchedulingSecretaryModel->add($dayOfTheWeek , $date , $time);
        }

        $SchedulingSecretaryModel->closeConnection();
        
        return  $this->showSchedule();
    }
    
    // public function deleteSchedule($params){
    //     $id = isset($params["delete_id"]) ? $params["delete_id"] : null;
    public function deleteSchedule($id){
        if (!$id) {
            echo "ID inválido.";
            return;
        }
        $SchedulingSecretaryModel = new SchedulingSecretaryModel;
        $SchedulingSecretaryModel->deleteRecord($id);
        $SchedulingSecretaryModel->closeConnection();

        $this->showSchedule();
        header("Location: http://localhost/agenda?delete=success");
        exit();
    }

    // public function putSchedule($params){
        
    //     $id = isset($params["put_id"]) ? $params["put_id"] : null;
    //     $date = $_POST['data'];
    //     $time  = $_POST['hora'];
    public function putSchedule($id , $date , $time){
        $formatoTime = 'H:i';


        $dateTime = \DateTime::createFromFormat($formatoTime, $time);
            if (!$dateTime   ||  $dateTime->format($formatoTime) !== $time) {
                echo "A hora $time não é válida.";
                return;
        }
        
        if (!$id) {
            echo "ID inválido.";
            return;
        }

        $dayOfTheWeek = $this->dayOfTheWeek($date);
        
        
        $SchedulingSecretaryModel = new SchedulingSecretaryModel;
        $SchedulingSecretaryModel->putRecord($id , $dayOfTheWeek ,$date ,$time);
        $SchedulingSecretaryModel->closeConnection();
        
        $this->showSchedule();
        
    }
    
}

?>

<!-- -----------------------------------------------------------    -->
<!-- -----------------------------------------------------------    -->
<!-- -----------------------------------------------------------    -->
<!-- -----------------------------------------------------------    -->
<!-- -----------------------------------------------------------    -->

<?php $SchedulingSecretaryController = new SchedulingSecretaryController;?>

<?php 
$showSchedule = $SchedulingSecretaryController->showSchedule();
$dados = $showSchedule["data"]["dados"]; 
$page = $showSchedule["data"]["page"];
$pages = $showSchedule["data"]["pages"];


if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['addHorario'])) {
    $SchedulingSecretaryController->AddScheduleForm();
    header("Location: http://localhost/agenda");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['put'])) {
    $id = $_POST['put'];
    $date = $_POST['data'];
    $time  = $_POST['hora'];
    $SchedulingSecretaryController->putSchedule($id , $date , $time );
    }

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete'])) {
    $id = $_POST['id'];
    $SchedulingSecretaryController->deleteSchedule($id);
}
?>


<form method="POST" action="/agenda">
    <label for="data">Data:</label>
    <input type="date" id="data" name="data" required><br><br>

    <label for="times[]">Hora:</label>

    <select name="times[]"  multiple id="timesSelect">
        <?php
        $start = strtotime('08:00');
        $end = strtotime('18:00');
        $interval = 15 * 60; 

        for ($i = $start; $i <= $end; $i += $interval) {
            $time = date('H:i', $i);
            echo "<option value='$time'>$time</option>";
        }
        ?>
    </select>

    <!-- <button type="submit">Adicionar Horário</button> -->
    <button type="submit" name="addHorario">Adicionar Horário</button>
</form>
 
<table >
    <thead>
            <tr>
                <th>dia da semana</th>
                <th>data</th>
                <th>hora</th>
            </tr>
    </thead>
    <tbody>
        
        <?php foreach($dados as $dado) { ?> 
            
            <tr>
                <td><?php echo  $dado["dia_da_semana"] ;?></td>
<<<<<<< HEAD
                <form method="POST" action="/agenda?>">
=======
                <form method="POST" action="/agenda/put_id/<?php echo $dado["id"]?>">
>>>>>>> 3eaeb9238c78d65631be2e2cf0fbdde2de0fe883

                    <td>
                        
                        <span id="data-<?php echo $dado["id"]; ?>"><?php echo $dado["data"]; ?></span>
                        <input name = "data" type="date" id="edit-data-<?php echo $dado["id"]; ?>" value="<?php echo date("Y-m-d", strtotime(str_replace("-", "/", $dado["data"]))); ?>" style="display: none;">
                    </td>
                    <td>
                        <span id="hora-<?php echo $dado["id"]; ?>"><?php echo substr($dado["hora"], 0, 5); ?></span>
                        <input name = "hora" type="time" id="edit-hora-<?php echo $dado["id"]; ?>" value="<?php echo substr($dado["hora"], 0, 5); ?>" style="display: none;">
                    </td>
                    <td>
<<<<<<< HEAD
                        <!-- <button type="submit"  id="enviar-<?php echo $dado["id"]; ?>" style="display: none;">Confirmar</button> -->
                        <button type="submit"  id="enviar-<?php echo $dado["id"]; ?>" style="display: none;" value="<?php echo $dado["id"]; ?>" name ="put">Confirmar</button>
                    </td>
                </form>
                    <td>
                            <button  onclick="toggleEdit(<?php echo $dado['id']; ?>)">Editar</button>
                    </td>
                    <td>
                        <!-- <form method="POST" action="/agenda/delete_id/<?php echo $dado["id"]?>"> -->
                        <form method="POST" action="/agenda">
                            <input type="hidden" name="id" value=<?php echo $dado["id"] ;?>>
                            <button type="submit" name ="delete">Delete</button>
=======
                        <button type="submit" id="enviar-<?php echo $dado["id"]; ?>" style="display: none;">Confirmar</button>
                    </td>
                </form>
                    <td>
                            <button onclick="toggleEdit(<?php echo $dado['id']; ?>)">Editar</button>
                    </td>
                    <td>
                        <form method="POST" action="/agenda/delete_id/<?php echo $dado["id"]?>">
                            <input type="hidden" name="id" value=<?php echo $dado["id"] ;?>>
                            <button type="submit">Delete</button>
>>>>>>> 3eaeb9238c78d65631be2e2cf0fbdde2de0fe883
                        </form>
                    </td>
                    
                <td>
</td>

            </tr>
        <?php } ?>
    </tbody>
    
</table>

<!--  paginação -->

<a href="?pagina=1">Primeira</a>
<?php if($page>1){ ?>
<a href="?pagina=<?=$page-1 ?>"><<<</a>
<?php }?>

<?php echo $page; ?>

<?php if($page<$pages){?>
<a href="?pagina=<?=$page+1?>">>>></a>
<?php }?>
<a href="?pagina=<?=$pages?>">Ultima</a>

<script>
    function toggleEdit(id) {
        const editData = document.getElementById('edit-data-' + id);
        const editHora = document.getElementById('edit-hora-' + id);
        const spanData = document.getElementById('data-' + id);
        const spanHora = document.getElementById('hora-' + id);
        const enviarHora = document.getElementById('enviar-' + id);

        if (editData.style.display === 'none') {
            editData.style.display = 'inline';
            editHora.style.display = 'inline';
            enviarHora.style.display = 'inline';
            spanData.style.display = 'none';
            spanHora.style.display = 'none';
        } else {
            editData.style.display = 'none';
            editHora.style.display = 'none';
            enviarHora.style.display = 'none';
            spanData.style.display = 'inline';
            spanHora.style.display = 'inline';
        }
    }
</script>