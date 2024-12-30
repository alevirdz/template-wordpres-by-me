// document.addEventListener('DOMContentLoaded', function() {
    
//     const updateCartButton = document.querySelector('button[name="update_cart"]');
//     const cartForm = document.querySelector('.woocommerce-cart-form');

//     // Función para habilitar el botón de actualizar cuando cambian las cantidades
//     const enableUpdateButton = () => {
//         let changesDetected = false;

//         // Revisamos todos los inputs de cantidad y verificamos si alguno ha cambiado
//         document.querySelectorAll('.woocommerce-cart-form input.qty').forEach(input => {
//             // Si el valor del input es diferente del valor por defecto, significa que ha cambiado
//             if (input.value != input.getAttribute('data-default-value')) {
//                 changesDetected = true;
//             }
//         });

//         // Habilitamos o deshabilitamos el botón según corresponda
//         if (changesDetected) {
//             updateCartButton.disabled = false; 
//             updateCartButton.classList.remove('disabled'); 
//         } else {
//             updateCartButton.disabled = true; 
//             updateCartButton.classList.add('disabled'); 
//         }
//     };

//     // Asigna un valor por defecto al campo de cantidad al cargar la página
//     const setDefaultValues = () => {
//         document.querySelectorAll('.woocommerce-cart-form input.qty').forEach(input => {
//             input.setAttribute('data-default-value', input.value); // Establece el valor por defecto
//         });
//     };

//     // Función para manejar el evento 'input' en los campos de cantidad
//     const handleQuantityChange = () => {
//         document.querySelectorAll('.woocommerce-cart-form input.qty').forEach(input => {
//             input.addEventListener('input', enableUpdateButton); // Usamos 'input' para detectar cambios en tiempo real
//         });
//     };

//     // Función para recolectar los datos del formulario y enviarlos por AJAX
//     const submitCartForm = () => {
//         cartForm.addEventListener('submit', function(event) {
//             event.preventDefault(); // Evita el envío tradicional del formulario

//             // Creamos un objeto FormData con los datos del formulario
//             const formData = new FormData(cartForm);

//             // Añadimos el nonce y la acción de AJAX al FormData
//             formData.append('nonce', updateCartObj.nonce);  // El nonce
//             formData.append('action', 'update_cart');  // Acción que manejará el servidor
            
//             // Añadimos las cantidades de los productos al FormData
//             document.querySelectorAll('.woocommerce-cart-form input.qty').forEach(input => {
//                 const productKey = input.name.match(/cart\[([^\]]+)\]\[qty\]/)[1]; // Extraemos el ID del producto
//                 const quantity = input.value;
                
//                 // Añadimos el ID del producto y la cantidad al FormData
//                 if (productKey && quantity) {
//                     formData.append('cart_items[' + productKey + ']', quantity);  // Usamos la estructura adecuada
//                 }
//             });

//             // Deshabilitamos el botón de actualizar mientras se procesa la solicitud
//             updateCartButton.disabled = true;
//             updateCartButton.classList.add('disabled');

//             // Enviamos la solicitud AJAX usando fetch con FormData
//             fetch(updateCartObj.ajax_url, {
//                 method: 'POST',
//                 body: formData  // Usamos FormData para manejar el contenido de los datos
//             })
//             .then(response => response.text())  // Esperamos la respuesta como texto
//             .then(data => {
//                 console.log('Respuesta recibida:', data);  // Depuración de la respuesta
//                 try {
//                     const jsonData = JSON.parse(data);  // Intentamos parsear la respuesta
//                     if (jsonData.success) {
//                         console.log('Carrito actualizado');
//                         // Aquí puedes agregar lógica para actualizar la UI si es necesario
//                     }
//                     // Llamamos a enableUpdateButton para asegurar que el botón se habilite si es necesario
//                     enableUpdateButton();
//                 } catch (error) {
//                     console.error('Error al analizar la respuesta JSON:', error);
//                 }
//             })
//             .catch(error => {
//                 console.error('Error en la solicitud AJAX:', error);
//                 // Aseguramos que el botón se habilite incluso si ocurre un error
//                 enableUpdateButton();
//             });
//         });
//     };

//     // Llamamos a las funciones necesarias para inicializar la página
//     setDefaultValues(); // Establecer los valores por defecto
//     handleQuantityChange(); // Escuchar los cambios en las cantidades
//     enableUpdateButton(); // Llamamos inicialmente para verificar el estado del botón
//     submitCartForm(); // Manejar el envío del formulario por AJAX
// });

document.addEventListener('DOMContentLoaded', function() {
    console.log(updateCartObj);  // Verifica si el objeto ahora está definido
});

document.addEventListener('DOMContentLoaded', function() {
    const updateCartButton = document.querySelector('button[name="update_cart"]');
    const cartForm = document.querySelector('.woocommerce-cart-form');

    // Función para manejar el cambio de cantidad
    const handleQuantityChange = (event) => {
        const inputElement = event.target;
        const cartItemKey = inputElement.name.match(/cart\[([^\]]+)\]\[qty\]/)[1];
        const quantity = inputElement.value;

        // Crear FormData para enviar los datos
        const formData = new FormData();
        formData.append('nonce', updateCartObj.nonce);
        formData.append('action', 'actualizar_carrito'); // La acción AJAX
        formData.append('cart_items[' + cartItemKey + ']', quantity); // Añadir la cantidad del producto

        // Enviar los datos via AJAX
        fetch(updateCartObj.ajax_url, {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                // Actualizar la UI si es necesario (carrito actualizado)
                console.log('Carrito actualizado');
                // Aquí puedes agregar lógica para actualizar los fragmentos del carrito
                document.querySelector('.woocommerce-cart-form').innerHTML = data.fragments;
            } else {
                console.error('Error al actualizar el carrito', data.message);
            }
        })
        .catch(error => {
            console.error('Error de AJAX:', error);
        });
    };

    // Escuchar los cambios de cantidad
    document.querySelectorAll('.woocommerce-cart-form input.qty').forEach(input => {
        input.addEventListener('input', handleQuantityChange); // Detectar cambios en tiempo real
    });
});

