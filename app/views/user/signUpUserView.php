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