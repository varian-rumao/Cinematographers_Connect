document.getElementById('loginForm').addEventListener('submit', function(e) {
    e.preventDefault();
    console.log('Submitting form...');

    const email = document.getElementById('email').value;
    const password = document.getElementById('password').value;

    console.log('Email:', email);
    console.log('Password:', password);

    fetch('http://localhost:8080/api/login', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify({ email, password }),
    })
    .then(response => response.json())
    .then(data => {
        console.log('Response:', data);
        if (data.success) {
            window.location.href = '/dashboard.html';
        } else {
            alert('Login failed');
        }
    })
    .catch(error => console.error('Error:', error));
});
