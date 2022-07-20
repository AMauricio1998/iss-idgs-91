
const password = document.querySelector('#password');

document.addEventListener('DOMContentLoaded', () => {
    password.addEventListener('change', validarPassword)
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
        console.log('faltan valores')
        msgError.classList.remove('hidden');
        msgError.classList.add('visible');
        return
    }    
    
    if (msgError.classList.contains('visible')) {
        msgError.classList.add('hidden');
    }
    console.log('correcto')
} 