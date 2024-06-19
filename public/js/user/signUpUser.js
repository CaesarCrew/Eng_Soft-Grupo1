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

document.getElementById('signupForm').addEventListener('submit', async function(event) {
event.preventDefault();

const form = document.getElementById('signupForm');
const formData = new FormData(form);

const data = {};
formData.forEach((value, key) => {
    if (key === 'genero' && formData.getAll(key).length > 1) {
        data[key] = formData.getAll(key).join(',');
    } else {
        data[key] = value;
    }
});

try {
    const response = await fetch('http://localhost/cadastro', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(data)
    });
   
    const text = await response.text();
    console.log(text)
    const result = JSON.parse(text);

    if (result.status === 'success') {
        alert('Cadastro bem-sucedido');
        window.location.href = 'http://localhost/login';
    } else {
        alert('Erro: ' + result.message);
    }
} catch (error) {
    console.error('Erro:', error);
    alert('Ocorreu um erro ao tentar se cadastrar. Verifique se os dados do formulário estão correto');
}
});
