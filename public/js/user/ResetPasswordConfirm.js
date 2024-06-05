document.getElementById('resetPasswordForm').addEventListener('submit', function(event) {
    event.preventDefault();
    
    const formData = new FormData(this);
    const data = {
        token: formData.get('token'),
        new_password: formData.get('new_password'),
        confirm_password: formData.get('confirm_password')
    };

    fetch('/resetPasswordConfirm', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(data)
    })
    .then(response => response.json())
    .then(data => {
        alert(data.message);
        if (data.status === 'success') {
            window.location.href = '/login';
        }
    })
    .catch(error => {
        console.error('Error:', error);
    });
});