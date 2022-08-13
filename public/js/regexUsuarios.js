
const password = document.querySelector('#password');
const passwordConfirm = document.querySelector('#password_confirmation');
const submit = document.querySelector('#btn-enviar');
const inputEmail = document.querySelector('#email');
const inputCp = document.querySelector('#cod_postal');
const inputTel = document.querySelector('#telefono');

document.addEventListener('DOMContentLoaded', () => {
    password.addEventListener('keyup', validarPassword)
    passwordConfirm.addEventListener('keyup', compararPassword)
    inputEmail.addEventListener('keyup', validarEmail)
    inputCp.addEventListener('keyup', validarCp)
    inputTel.addEventListener('keyup', validaTel)
});

function validaTel() {
    const alerta = document.querySelector('#alert-tel')
    const msg = document.querySelector('#error-tel');
    const tel = inputTel.value
    const regex = /^[0-9]{10}$/;

    if (!regex.test(tel)) {
        alerta.classList.remove('hidden')
        alerta.classList.add('visible')
        msg.textContent = 'Telefono invalido'
        return        
    }
    if (alerta.classList.contains('visible')) {
        alerta.classList.add('hidden')
        return
    }
}

function validarCp() {
    const alerta = document.querySelector('#alert-cp')
    const msg = document.querySelector('#error-cp')
    const cp = inputCp.value;
    const regex = /^[0-9]{5}$/;

    if (!regex.test(cp)) {
        alerta.classList.remove('hidden')
        alerta.classList.add('visible')
        msg.textContent = 'Codigo postal invalido'
        return
    }
    if (alerta.classList.contains('visible')) {
        alerta.classList.add('hidden')
        return
    }
}

function validarEmail() { 
    const newEmail = inputEmail.value;
    const valmail = /^[-\w.%+]{1,64}@(?:[A-Z0-9-]{1,63}\.){1,125}[A-Z]{2,63}$/i;
    const msg = document.querySelector('#alert-email');
    const msg1 = document.querySelector('#msg-email');

    if (!valmail.test(newEmail)) {
        msg.classList.remove('hidden')
        msg.classList.add('visible')
        msg1.textContent = 'Email no valido'
        return
    }

    if (msg.classList.contains('visible')) {
        msg.classList.add('hidden')
        return
    }
}

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