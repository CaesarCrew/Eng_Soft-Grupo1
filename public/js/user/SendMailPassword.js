document.getElementById('resetPasswordForm').addEventListener('submit', async function(event) {
    event.preventDefault();

    const email = document.getElementById('email').value;
    
    try {
        const response = await fetch('http://localhost/sendMailPassword', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({ email: email })
        });
        const text = await response.text();
        const result = JSON.parse(text);
        
        if (result.status === 'success') {
            alert(result.message);
        } else {
            alert('Erro: ' + result.message);
        }
    } catch (error) {
        console.error('Erro:', error);
        alert('Ocorreu um erro ao tentar enviar o email de redefinição de senha.');
    }
});