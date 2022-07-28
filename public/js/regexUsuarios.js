
const password = document.querySelector('#password');
const passwordConfirm = document.querySelector('#password_confirmation');
const submit = document.querySelector('#btn-enviar');

document.addEventListener('DOMContentLoaded', () => {
    password.addEventListener('keyup', validarPassword)
    passwordConfirm.addEventListener('keyup', compararPassword)
});

// Minimo 8 caracteres
// Maximo 15
// Al menos una letra mayúscula
// Al menos una letra minucula
// Al menos un numero
// No espacios en blanco
// Al menos 1 caracter especial
function validarPassword() {
    const msgError = document.querySelector('#alert-pass');
    const newPass = password.value;
    const regex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[$@$!%*?&])[A-Za-z\d$@$!%*?&]{8,15}/;
    
    if(!regex.test(newPass)){
        msgError.classList.remove('hidden');
        msgError.classList.add('visible');
        return
    }    
    
    if (msgError.classList.contains('visible')) {
        msgError.classList.add('hidden');
    }
}

function compararPassword() { 
    const msgError = document.querySelector('#alert-passConfirm');
    const msgError2 = document.querySelector('#error-pass2');
    const newPass = password.value;
    const pass2 = passwordConfirm.value;

    if (pass2 != newPass) {
        msgError2.textContent = 'Las contraseñas no coinciden';
        msgError.classList.remove('hidden');
        msgError.classList.add('visible');
        return
    }

    if (msgError.classList.contains('visible')) {
        msgError.classList.add('hidden');
        return
    }
}