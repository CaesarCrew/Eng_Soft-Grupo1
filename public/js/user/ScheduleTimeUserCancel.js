function cancelAppointment(appointmentId) {
    var form = document.getElementById('cancel-form-' + appointmentId);
    var formData = new FormData(form);
    fetch('/cancelarConsultaUsuario', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        alert(data.message);
        if (data.message === 'Consulta cancelada com sucesso') {
            location.reload();
        }
    })
    .catch(error => {
        console.error('Erro ao cancelar a consulta', error);
    });
}
