async function updateStatus(idConsulta, novoStatus) {
    try {
        const response = await fetch('/updateStatus', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({
                id_consulta: idConsulta,
                status: novoStatus
            })
        });
        const data = await response.json();
        if (data.status === 'success') {
            console.log('Status atualizado com sucesso.');
            alert('Status da consulta atualizado com sucesso.');

            // Recarrega a página após o alerta
            location.reload();
        } else {
            console.error('Erro ao atualizar status:', data.message);
            alert('Erro ao atualizar status: ' + data.message);
        }
    } catch (error) {
        console.error('Erro ao atualizar status:', error);
        alert('Erro ao atualizar status: ' + error.message);
    }
}

function confirmStatusChange(status) {
    return confirm(`Você realmente deseja alterar o status para "${status}"?`);
}

document.addEventListener('DOMContentLoaded', function() {
    const buttons = document.querySelectorAll('.info-button');
    buttons.forEach(button => {
        button.addEventListener('click', async function(event) {
            event.preventDefault();
            const idConsulta = document.getElementById('id_consulta').value;
            const novoStatus = this.value;
            if (confirmStatusChange(novoStatus)) {
                await updateStatus(idConsulta, novoStatus);
            }
        });
    });
});
