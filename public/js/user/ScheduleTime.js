document.getElementById("select-form").addEventListener("submit", async (event) => {
    event.preventDefault();

    const confirmSubmission = confirm("Deseja confirmar o agendamento?");
    if (!confirmSubmission) {
        return;
    }

    const formData = new FormData(event.target);
    const data = Object.fromEntries(formData.entries());

    // Collecting the selected schedule IDs
    data.selected_schedules = [];
    document.querySelectorAll('input[name="selected_schedules[]"]:checked').forEach((checkbox) => {
        data.selected_schedules.push(checkbox.value);
    });

    try {
        const response = await fetch(event.target.action, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(data)
        });

        const text = await response.text();
        const responseData = JSON.parse(text);

        if (responseData.status === 'success') {
            alert(responseData.messages);
        } else {
            alert(responseData.message);
        }

        // Recarregar a página após 2 segundos
        setTimeout(() => {
            location.reload();
        }, 1000);
    } catch (error) {
        alert('Erro ao enviar dados do formulário.');
        console.error('Erro:', error);
    }
});