function confirmCancellation(appointmentId) {
    var confirmation = confirm('Tem certeza que deseja cancelar este agendamento?');
    if (confirmation) {
        cancelAppointment(appointmentId);
    }
}

function cancelAppointment(appointmentId) {
    var form = document.getElementById('cancel-form-' + appointmentId);
    var xhr = new XMLHttpRequest();
    xhr.open('POST', form.action, true);
    xhr.onload = function() {
        if (xhr.status === 200) {
            location.reload();
        } else {
            var response = JSON.parse(xhr.responseText);
            alert(response.message); // Exibir mensagem de erro da API
        }
    };
    xhr.send(new FormData(form));
}

function submitStatusForm(appointmentId) {
    var form = document.getElementById('status-form-' + appointmentId);
        var xhr = new XMLHttpRequest();
        xhr.open('POST', form.action, true);
        xhr.onload = function() {
            if (xhr.status === 200) {
                location.reload();
            } else {
                var response = JSON.parse(xhr.responseText);
                alert(response.message); // Exibir mensagem de erro da API
            }
        };
        xhr.send(new FormData(form));
}