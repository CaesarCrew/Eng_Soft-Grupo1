<?php
// use app\database\AuthUserModel;

// class authUserController{
//     public  function validarCPF($cpf) {
        
//         $soma = 0;

//         if (!preg_match('/^[0-9]+$/', $cpf)){
//             return false;
//         }
        
//         if (strlen($cpf) != 11) {
            
//             return false;
//         }
    
//         if (preg_match('/(\d)\1{10}/', $cpf)) {
            
//             return false;
//         }
        
//         $soma = 0;
//         for ($i = 0; $i < 9; $i++) {
//             $soma += ((10 - $i) * $cpf[$i]);
//         }
//         $dv1 = 11 - ($soma % 11);
//         if ($dv1 == 10 || $dv1 == 11) {
//             $dv1 = 0;
//         }

//         $soma = 0;
//         for ($i = 0; $i < 10; $i++) {
//             $soma += ((11 - $i) * $cpf[$i]);
//         }
//         $dv2 = 11 - ($soma % 11);
//         if ($dv2 == 10 || $dv2 == 11) {
//             $dv2 = 0;
//         }

    
//         if ($dv1 == $cpf[9] && $dv2 == $cpf[10]) {
//             return true; 
//         } else {
//             return false;
//         }
//     }

//     public  function validarDataNascimento($dataNascimento) {
        
//         $dataNasc = new DateTime($dataNascimento);
        
       
//         $hoje = new DateTime();
//         $idade = $hoje->diff($dataNasc)->y;
    
        
//         if ($idade >= 18 && $idade <= 130) {
//             return true; 
//         } else {
//             return false;
//         }
//     }

//     public function validateDataUser($nome , $senha , $email , $telefone , $cpf , $genero , $data_de_nascimento){
//         $AuthUserModel = new AuthUserModel;

//         if(!preg_match('/^[a-zA-Z\s]+$/', $nome)){
//             echo "nome pode conter só letras e espaço";
//             return false;
//         }
//         if (!preg_match('/(?=.*[A-Za-z])(?=.*\d)/', $senha)) {
//             echo "A senha deve contém pelo menos uma letra e um número.";
//             return false;
//         }else{
           
//         }
        
//         if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
//             if(!$AuthUserModel->chackOutEmail($email)){
//                 echo "Email já cadastado";
//                 return false;
//             }
//         }else{
//             echo "email invalido";
//             return false;
//         }

       
//         if (preg_match('/^[0-9]+$/', $telefone)){
//             if(!$AuthUserModel->chackOutTelefone($telefone)){
//                 echo "telefone já cadastado";
//                 return false;
//             }
//         }else{
//             echo "digite apenas numero";
//             return false;
//         }

        
//         if($this->validarCPF($cpf)){
//             if(!$AuthUserModel->chackOutCpf($cpf)){
//                 echo "cpf já cadastado";
//                 return false;
//             }
//         }else{
//             echo "cpf invalido";
//             return false;
//         }

       
//         if(!$genero === "F" || !$genero === "M"){
//             echo "genero incorreto";
//             return false;
//         }

        
//         $formatoData = 'Y-m-d'; 
//         $dateTime = \DateTime::createFromFormat($formatoData, $data_de_nascimento);
//         if (!$dateTime || $dateTime->format($formatoData) !== $data_de_nascimento) {
//             echo "A data $data_de_nascimento não é válida.";
//             return  false;
//         }
//         $dateTime =  $dateTime->format('Y-m-d');
//         if (! $this->validarDataNascimento($dateTime)) {
//             echo "Data de nascimento inválida.";
//             return false;
//         }

//         return true;

//     }

//     public function signUp (){
//         $AuthUserModel = new AuthUserModel;

//         if (
//             !empty($_POST["nome"]) &&
//             !empty($_POST["senha"]) &&
//             !empty($_POST["email"]) &&
//             !empty($_POST["telefone"]) &&
//             !empty($_POST["cpf"]) &&
//             !empty($_POST["genero"]) &&
//             !empty($_POST["data_de_nascimento"])
//         ) {
//             $nome = $_POST["nome"];
//             $senha = $_POST["senha"];
//             $email = $_POST["email"];
//             $telefone = $_POST["telefone"];
//             $cpf = $_POST["cpf"];
//             $genero = $_POST["genero"];
//             $data_de_nascimento = $_POST["data_de_nascimento"];

//             $validateDataUSer = $this->validateDataUser($nome , $senha , $email , $telefone , $cpf , $genero , $data_de_nascimento);
//             if(!$validateDataUSer){
//                 return;
//             }

//             $senhaHash = password_hash($senha, PASSWORD_DEFAULT);

//             $formatoData = 'Y-m-d'; 
//             $dateTime = \DateTime::createFromFormat($formatoData, $data_de_nascimento);
//             $dateTime =  $dateTime->format('Y-m-d');
            
//             $cep = $_POST["cep"];
//             $logradouro = $_POST["logradouro"];
//             $numero = $_POST["numero"];
//             $complemento = $_POST["complemento"];
//             $bairro = $_POST["bairro"];
//             $cidade = $_POST["cidade"];
//             $estado = $_POST["estado"];
            
//             $AuthUserModel->signUp($nome, $senhaHash, $email, $telefone, $cpf, $genero, $dateTime , $cep ,$logradouro ,$numero ,$complemento ,$bairro , $cidade , $estado);
//             echo "<script>alert('Cadastro realizado com sucesso');</script>";
//             echo "<script>setTimeout(() => { window.location.href = 'http://localhost/login'; }, 4000);</script>";
            
            
//             exit();
//         } else {
//             echo "Por favor, preencha todos os campos.";
//         }
//     }
// }
// ?>

// <?php
// if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['signUp'])) {
//     $authUserController = new authUserController;
//     $authUserController->signUp();
// }

?>
<form method="POST" action="/cadastro" style="display: flex; flex-direction: column;">
    <label for="nome">Nome</label>
    <input type="text" id="nome" name="nome" required>
    
    <label for="senha">Senha</label>
    <input type="password" id="senha" name="senha" required>

    <label for="email">E-mail</label>
    <input type="email" id="email" name="email" required>
    
    <label for="telefone">Telefone</label>
    <input type="text" id="telefone" name="telefone" required maxlength="12">
    
    <label for="cpf">CPF</label>
    <input type="text" id="cpf" name="cpf" required maxlength="12">
    

    <div>
        <label for="genero">M</label>
        <input type="checkbox" id="generoM" name="genero" value="M">
        <label for="genero">F</label>
        <input type="checkbox" id="generoF" name="genero" value="F">
    </div>

    <label for="data_de_nascimento">Data de Nascimento</label>
    <input type="date" id="data_de_nascimento" name="data_de_nascimento" required>
    
    <label for="cep">CEP</label>
    <input type="text" id="cep" name="cep" maxlength="8" required>

    <label for="logradouro">Logradouro</label>
    <input type="text" id="logradouro" name="logradouro" required>

    <label for="numero">Número</label>
    <input type="text" id="numero" name="numero" required>

    <label for="complemento">Complemento</label>
    <input type="text" id="complemento" name="complemento">

    <label for="bairro">Bairro</label>
    <input type="text" id="bairro" name="bairro" required>

    <label for="cidade">Cidade</label>
    <input type="text" id="cidade" name="cidade" required>

    <label for="estado">Estado</label>
    <input type="text" id="estado" name="estado" maxlength="2" required>

    <button type="submit" name="signUp">Enviar</button>
</form>


<script>
    document.addEventListener("DOMContentLoaded", function() {
        document.getElementById("generoM").addEventListener("click", function() {
            genero('m');
        });

        document.getElementById("generoF").addEventListener("click", function() {
            genero('f');
        });
    });

    function genero(sexo) {
        
        let selecM = document.getElementById("generoM");
        let selecF = document.getElementById("generoF");
        if (sexo === 'm') {
            selecM.checked = true;
            selecF.checked = false;
        } else if (sexo === 'f') {
            selecF.checked = true;
            selecM.checked = false;
        }
    }
</script>