// userForm.js

document.getElementById("mostrarOcultarPasswd").addEventListener('click', function() {
    togglePasswordVisibility('confirmPassword', 'confirmEyeIcon');
});

document.getElementById("mostrarOcultar").addEventListener('click', function() {
    togglePasswordVisibility('password', 'eyeIcon');
});

document.getElementById("crearUsuario").addEventListener('click', validarFormulario);

function togglePasswordVisibility(inputId, eyeIconId) {
    var passwordInput = document.getElementById(inputId);
    var eyeIcon = document.getElementById(eyeIconId);

    if (passwordInput.type === 'password') {
        passwordInput.type = 'text';
        eyeIcon.classList.remove('far', 'fa-eye');
        eyeIcon.classList.add('far', 'fa-eye-slash');
    } else {
        passwordInput.type = 'password';
        eyeIcon.classList.remove('far', 'fa-eye-slash');
        eyeIcon.classList.add('far', 'fa-eye');
    }
}

// Validar coincidencia de contraseñas
function validarFormulario() {
    var password = document.getElementById('password').value;
    var confirmPassword = document.getElementById('confirmPassword').value;
    var passwordError = document.getElementById('passwordError');

    if (password !== confirmPassword) {
        document.getElementById('confirmPassword').classList.add('is-invalid');
        passwordError.textContent = 'Las contraseñas no coinciden.';
    } else {
        passwordError.textContent = '';
        document.getElementById('confirmPassword').classList.remove('is-invalid');
    }

    // Continuar con el envío del formulario si no hay errores
    if (password === confirmPassword) {
        document.getElementById('userForm').submit();
    }
}
