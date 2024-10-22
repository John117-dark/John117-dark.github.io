document.getElementById('loginForm').addEventListener('submit', function(event) {
    event.preventDefault();
    const email = document.getElementById('email').value;
    const password = document.getElementById('password').value;

    if (email && password) {
        console.log("Email:", email);
        console.log("Password:", password);
    } else {
        alert("Por favor, completa ambos campos.");
    }
});
