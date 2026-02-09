const usuario = document.getElementById('usuario');
const contrasenia = document.getElementById('contrasenia');

usuario.addEventListener('keyup', () =>{
    const valor = usuario.value;
    const formato = /^[a-zA-Z0-9]{3,16}$/;

    if(!formato.test(valor)){
        mensaje_usuario.textContent = "El formato del usuario no es valido";
        mensaje_usuario.style.color = "red";
    }else{
        mensaje_usuario.textContent = "Formato del usuario valido";
        mensaje_usuario.style.color = "green"
    }

})
contrasenia.addEventListener('keyup', () =>{
    const valor = contrasenia.value;
    const formato = /^[A-Za-z0-9]{6,20}$/;

    if(!formato.test(valor)){
        mensaje_contrasenia.textContent = "El formato de la contraseña no es valido";
        mensaje_contrasenia.style.color = "red";
    }else{
        mensaje_contrasenia.textContent = "Formato de la contraseña valido";
        mensaje_contrasenia.style.color = "green"
    }

})

