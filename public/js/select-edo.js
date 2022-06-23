document.addEventListener('DOMContentLoaded', () => {
    const selectEstado = document.querySelector('#estado');
    selectEstado.addEventListener('change', estadoSeleccionado);
});

async function estadoSeleccionado() {
    try {
        const resultado = await fetch('/select-municipios');
        const respuesta = await resultado.json();
        llenarSelectMunicipios(respuesta);
    } catch (error) {
        console.log('Hubo un error');
    }
}

function llenarSelectMunicipios(respuesta) {
    const idEstado = document.querySelector('#estado').value;
    const estado = document.querySelector('.alerta');
    const optMunicipio = document.querySelector('#municipio');
    const alerta1 = document.querySelector('.mensaje');

    if (idEstado == 0) {

        if (alerta1) {
            alerta1.remove();
        }

        const alerta = document.createElement('p');
        alerta.classList.add('text-red-700', 'uppercase', 'font-bold', 'mensaje');
        alerta.textContent = 'Selecciona un estado';
        estado.appendChild(alerta);
    } else {
        if (alerta1) {
            alerta1.remove();
        }

        while (optMunicipio.firstChild) {
            optMunicipio.removeChild(optMunicipio.firstChild)
        }

        optMunicipio.innerHTML = `<option value="0">-- Selecciona tu municipios --</option>`;

        respuesta.forEach(municipios => {
            const {id, nombre, estado_id} = municipios;

            if (idEstado == estado_id) {
                const option = document.createElement('option');
                option.value = nombre;
                option.textContent = nombre;
                option.id = "municipio";
                optMunicipio.appendChild(option);
                return;
            }
        });
    }
}