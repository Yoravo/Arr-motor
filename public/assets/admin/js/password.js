function togglePasswordVisibility() {
    var password = document.getElementById('password');
    var passwordIcon = document.getElementById('passwordIcon');
    if (password.type === 'password') {
        password.type = 'text';
        passwordIcon.classList.remove('fa-eye-slash');
        passwordIcon.classList.add('fa-eye');
    } else {
        password.type = 'password';
        passwordIcon.classList.remove('fa-eye');
        passwordIcon.classList.add('fa-eye-slash');
    }
}