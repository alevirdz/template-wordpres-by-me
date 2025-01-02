document.addEventListener('DOMContentLoaded', function() {
    const updateCartButton = document.querySelector('button[name="update_cart"]');
    const cartForm = document.querySelector('.woocommerce-cart-form');

    // Función para habilitar el botón de actualizar cuando cambian las cantidades
    const enableUpdateButton = () => {
        console.log("He cambiado");
        let changesDetected = false;

        // Revisamos todos los inputs de cantidad y verificamos si alguno ha cambiado
        document.querySelectorAll('.woocommerce-cart-form input.qty').forEach(input => {
            // Si el valor del input es diferente del valor por defecto, significa que ha cambiado
            if (input.value != input.getAttribute('data-default-value')) {
                changesDetected = true;
            }
        });

        // Habilitamos o deshabilitamos el botón según corresponda
        if (changesDetected) {
            updateCartButton.disabled = false;
            updateCartButton.classList.remove('disabled');
        } else {
            updateCartButton.disabled = true;
            updateCartButton.classList.add('disabled');
        }
    };

    // Asigna un valor por defecto al campo de cantidad al cargar la página
    const setDefaultValues = () => {
        document.querySelectorAll('.woocommerce-cart-form input.qty').forEach(input => {
            input.setAttribute('data-default-value', input.value); // Establece el valor por defecto
        });
    };

    // Delegar el evento 'input' en los campos de cantidad para manejar dinámicamente los elementos
    const handleQuantityChange = () => {
        // Usamos la delegación de eventos para asegurar que funcione para los elementos actuales y los futuros
        document.querySelector('.woocommerce-cart-form').addEventListener('input', function(event) {
            if (event.target && event.target.matches('input.qty')) {
                enableUpdateButton();  // Llamamos a la función para habilitar o deshabilitar el botón
            }
        });
    };

    // Función para recolectar los datos del formulario y enviarlos por AJAX
    const submitCartForm = () => {
        cartForm.addEventListener('submit', function(event) {
            event.preventDefault(); // Evita el envío tradicional del formulario

            // Creamos un objeto FormData con los datos del formulario
            const formData = new FormData(cartForm);

            // Añadimos el nonce y la acción de AJAX al FormData
            formData.append('nonce', updateCartObj.nonce);  // El nonce
            formData.append('action', 'update_cart');  // Acción que manejará el servidor
            
            // Añadimos las cantidades de los productos al FormData
            document.querySelectorAll('.woocommerce-cart-form input.qty').forEach(input => {
                const productKey = input.name.match(/cart\[([^\]]+)\]\[qty\]/)[1]; // Extraemos el ID del producto
                const quantity = input.value;
                
                // Añadimos el ID del producto y la cantidad al FormData
                if (productKey && quantity) {
                    formData.append('cart_items[' + productKey + ']', quantity);  // Usamos la estructura adecuada
                }
            });

            // Deshabilitamos el botón de actualizar mientras se procesa la solicitud
            updateCartButton.disabled = true;
            updateCartButton.classList.add('disabled');

            // Enviamos la solicitud AJAX usando fetch con FormData
            fetch(updateCartObj.ajax_url, {
                method: 'POST',
                body: formData  // Usamos FormData para manejar el contenido de los datos
            })
            .then(response => response.text())  // Esperamos la respuesta como texto
            .then(data => {
                console.log('Respuesta recibida:', data);  // Depuración de la respuesta
                try {
                    const jsonData = JSON.parse(data);  // Intentamos parsear la respuesta
                    if (jsonData.success) {
                        console.log('Carrito actualizado');
                        // Aquí puedes agregar lógica para actualizar la UI si es necesario
                    }
                    // Llamamos a enableUpdateButton para asegurar que el botón se habilite si es necesario
                    enableUpdateButton();
                } catch (error) {
                    console.error('Error al analizar la respuesta JSON:', error);
                }
            })
            .catch(error => {
                console.error('Error en la solicitud AJAX:', error);
                // Aseguramos que el botón se habilite incluso si ocurre un error
                enableUpdateButton();
            });
        });
    };

    // Llamamos a las funciones necesarias para inicializar la página
    setDefaultValues(); // Establecer los valores por defecto
    handleQuantityChange(); // Delegación de eventos para los cambios en las cantidades
    enableUpdateButton(); // Llamamos inicialmente para verificar el estado del botón
    submitCartForm(); // Manejar el envío del formulario por AJAX
});
