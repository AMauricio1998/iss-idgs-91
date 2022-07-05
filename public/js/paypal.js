document.addEventListener('DOMContentLoaded', function () { 
    const names = document.querySelector('#name').textContent;
    const surnames = document.querySelector('#surname').textContent;
    const id = document.querySelector('#user_id').textContent;

    paypal.Buttons({
        fundingSource: paypal.FUNDING.CARD,
        createOrder: function (data, actions) {
            return actions.order.create({
                application_context: {
                    shipping_preference: "NO_SHIPPING",
                },
                payer: {
                    name: {
                        given_name: names,
                        surname: surnames
                    },
                },
                address: {
                    country_code: 'MX'
                },
                purchase_units: [
                    {
                        amount: {
                            value: "1",
                        },
                    },
                ],
            });
        },
        onApprove: async function (data, actions) {
            try {
                const resultado = await fetch('/dashboard/user/paypal/process/' + data.orderID + '?user_id=' + id);
                const respuesta = await resultado.json();
                alertSuccess(respuesta);
            } catch (error) {
                console.log(error);
            }
        },
    })
    .render("#paypal-button-container");
});

function alertSuccess(respuesta) {
    console.log(respuesta)
    try {
        Swal.fire({
            icon: 'success',
            title: `${respuesta.user.name} ${respuesta.user.app} gracias por tu contribucion, sera tomada en cuenta.`,
            showConfirmButton: false,
            timer: 3000
        });   
    } catch (error) {
        console.log(error)
    }
}