document.addEventListener('DOMContentLoaded', function() {
    const darkModeToggle = document.getElementById('dark-mode-toggle');

    if (darkModeToggle) {
        darkModeToggle.addEventListener('click', function() {
            document.body.classList.toggle('dark-mode');
            // Puedes enviar una solicitud al servidor para almacenar la preferencia del usuario
            // (por ejemplo, a través de una llamada AJAX)
        });
    }

    document.getElementById('btnAgregarProducto').addEventListener('click', function () {
        // Obtener el valor de productos desde el atributo data-productos
        var productosString = document.getElementById('btnAgregarProducto').getAttribute('data-productos');
        var productos = JSON.parse(productosString);

        // Llamar a la función agregarProducto con los productos como parámetro
        agregarProducto(productos);
    });

    // Delegación de eventos para el botón "Eliminar"
    document.getElementById('productosContainer').addEventListener('click', function(event) {
        if (event.target && event.target.id === 'btnEliminarProducto') {
            eliminarProducto(event.target);
        }
    });

    function agregarProducto(productos) {
        const productosContainer = document.getElementById('productosContainer');

        // Nuevo conjunto de productos y cantidades
        const newRow = document.createElement('div');
        newRow.className = 'row mb-2 producto-row';

        newRow.innerHTML = `
            <div class="col-md-6">
                <select class="form-select" name="producto[]" required>
                    <!-- Genera opciones dinámicamente desde la lista de productos -->
                    ${productos.map(producto => `<option value="${producto.id}">${producto.nombre}</option>`).join('')}
                </select>
            </div>
            <div class="col-md-4">
                <input type="number" class="form-control" name="cantidad[]" placeholder="Cantidad" required>
            </div>
            <div class="col-md-2">
                <button type="button" class="btn btn-outline-primary mb-2" id="btnEliminarProducto">Eliminar</button>
            </div>
        `;

        productosContainer.appendChild(newRow);
    }

    function eliminarProducto(btn) {
        const row = btn.closest('.producto-row');
        row.remove();
    }
});
