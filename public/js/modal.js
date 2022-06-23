
document.addEventListener('DOMContentLoaded', function() {
    let modal = document.getElementById('popup-modal');
    let btn = document.querySelectorAll("#open-btn");
    let button = document.getElementById("ok-btn");
    
    let modalPdf = document.getElementById('popup-modalPdf');
    let buttonPdf = document.getElementById("ok-btn-pdf");
    let btnPdf = document.querySelectorAll("#open-btn-pdf");

    if(btn !== null){
        const modalClick = function (event) {
            modal.style.display = "block"
        }

        button.addEventListener('click', function() {
            modal.style.display = "none";
        });

        btn.forEach( boton => {
            boton.addEventListener('click', modalClick);
        })
        
        window.onclick = function(event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }
    }

    if (btnPdf !== null) {
        const modalPdfClick = function (event) {
            modalPdf.style.display = "block"
        }
    
        buttonPdf.addEventListener('click', function() {
            modalPdf.style.display = "none";
        });
    
        btnPdf.forEach( boton => {
            boton.addEventListener('click', modalPdfClick);
        })
    
        window.onclick = function(event) {
            if (event.target == modalPdf) {
                modalPdf.style.display = "none";
            }
        }
    }

});