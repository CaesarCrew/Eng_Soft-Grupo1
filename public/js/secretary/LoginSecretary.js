

document.getElementById("form_login").addEventListener("submit", async (event) => {
    event.preventDefault();

    const loginData = {
        usuario: document.getElementById("usuario").value,
        senha: document.getElementById("senha").value
    };

    try {
        const response = await fetch('http://localhost/loginSecretaria', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(loginData)
        });
        
        const text = await response.text();

        const data = JSON.parse(text);
        
        if (data.status === 'success') {
            window.location.replace('http://localhost/homeSecretaria');
        } else {
            alert("usuario ou senha incorreto")
            console.error('Erro de login:', data.message);
        }
    } catch (error) {
        
        console.error('Erro:', error);
    }
});