function toggleEdit(id) {
    const editData = document.getElementById('edit-data-' + id);
    const editHora = document.getElementById('edit-hora-' + id);
    const spanData = document.getElementById('data-' + id);
    const spanHora = document.getElementById('hora-' + id);
    const confirmButton = document.querySelector(`#tabela-horarios #enviar-${id}`);

    editData.style.display = editData.style.display === 'none' ? 'inline' : 'none';
    editHora.style.display = editHora.style.display === 'none' ? 'inline' : 'none';
    spanData.style.display = spanData.style.display === 'none' ? 'inline' : 'none';
    spanHora.style.display = spanHora.style.display === 'none' ? 'inline' : 'none';
    confirmButton.style.display = confirmButton.style.display === 'none' ? 'inline' : 'none';
}






async function AddHorario(event) {
        event.preventDefault();

        const form = document.getElementById("form-horarios");
        const formData = new FormData(form);
        try{ 
            const response = await fetch("http://localhost/horarios", {
                method: "POST",
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({
                    data: formData.get('data'),
                    times: times = formData.getAll('times[]')
                })
            })
            const text = await response.text();

            const data = JSON.parse(text);
            if (data.status === 'success') {
                console.log("Horario adicionado")
                window.location.replace('http://localhost/horarios');
            
            } else {
                alert('Erro  ao cadastrar Horário , Horário pode já ter sido cadastrado');
                console.error('Erro ao deletar:', data.message);
            }
        } catch (error) {
            console.error('Erro:', error);
        }
    
    }
    async function deleteHorario(id) {
        
        if (confirm('Tem certeza que deseja deletar este horário?')) {
            try{ 
                const response = await fetch('http://localhost/horarios/delete_id/' + id, {
                method: 'DELETE',
                headers: {
                    'Content-Type': 'application/json'
                },
            })
            const text = await response.text();

            const data = JSON.parse(text);
            if (data.status === 'success') {
                
                window.location.replace('http://localhost/horarios');
            } else {
                alert('Erro ao deletar');
                console.error('Erro ao deletar:', data.message);
            }
        } catch (error) {
            console.error('Erro:', error);
        }
        }
}
async function putHorario(id) {
    const dataValue  = document.getElementById(`edit-data-${id}`).value;
    const horaValue  = document.getElementById(`edit-hora-${id}`).value;
    
    try{ 
        const response = await fetch('http://localhost/horarios/put_id/' + id, {
            method: 'PUT',
            headers: {
            'Content-Type': 'application/json'
            },
            body: JSON.stringify({
                    data: dataValue,
                    time: horaValue 
            })
        })
        const text = await response.text();
        console.log(text);
        const data = JSON.parse(text);
        if (data.status === 'success') {
            window.location.replace('http://localhost/horarios');
        } else {
            alert('Erro ao alterar');
            console.error('Erro ao alterar:', data.message);
        }
    } catch (error) {
        console.error('Erro:', error);
    }
}