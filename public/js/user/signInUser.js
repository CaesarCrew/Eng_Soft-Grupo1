async function logarUser(){
    event.preventDefault();

    const form = document.getElementById("form_login");
    const formData = new FormData(form);

    try{ 
            const response = await fetch("http://localhost/login", {
                method: "POST",
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({
                    email: formData.get('email'),
                    senha: formData.get('senha')
                })
            })
            const text = await response.text();

            const data = JSON.parse(text);
            if (data.status === 'success') {
                console.log("login realizado com sucesso")
                window.location.replace('http://localhost/home');
            
            } else {
                alert('Erro  ao realizar login ');
                console.error('Erro ao logar:', data.message);
            }
        } catch (error) {
            console.error('Erro:', error);
        }
}