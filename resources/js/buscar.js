import "bootstrap/dist/css/bootstrap.min.css";
import "bootstrap/dist/js/bootstrap.bundle.min";
document.addEventListener("DOMContentLoaded", function () {
    const searchInput = document.getElementById("searchInput");
    const resultados = document.getElementById("resultados");

    searchInput.addEventListener("input", function () {
        const searchText = searchInput.value;

        // Realiza una solicitud FETCH para buscar productos
        fetch(`/buscar-productos?nombre=${searchText}`)
            .then((response) => response.text())
            .then((data) => {
                const json = JSON.parse(data);
                const productos = json.productos;
                resultados.innerHTML = ""; // Limpiar resultados anteriores
                if (productos.length > 0) {
                    productos.forEach((producto) => {
                        const categoriasString = producto.categorias
                            .map((categoria) => categoria.nombre)
                            .join(", ");
                        // Crear elementos HTML para mostrar cada producto
                        const productoElement = document.createElement("div");
                        productoElement.classList.add(
                            "col-lg-4",
                            "col-md-6",
                            "col-sm-12",
                            "mb-4"
                        );

                        // Rellenar contenido del productoElement, por ejemplo:
                        productoElement.innerHTML = `
                            <div class="card shadow mb-4">
                                <div class="card-body">
                                <img src="storage/images/${producto.imagen}" class="card-img-top" alt="Imagen">
                                    <h5 class="card-title">${producto.nombre}</h5>
                                    <p class="card-text"><strong>Precio:</strong> ${producto.precio}</p>
                                    <p class="card-text"><strong>Formato:</strong> ${producto.formato}</p>
                                    <p class="card-text"><strong>Categorías:</strong>
                                    <em>${categoriasString}</em>
                                </div>
                            </div>
                        `;

                        resultados.appendChild(productoElement); // Agregar el producto al resultado
                    });
                } else {
                    resultados.innerHTML = `<div class="container h-100">
                    <div class="row align-items-center h-100">
                        <div class="col-12 text-center">
                            <p class="h1">No se encontraron resultados.</p>
                        </div>
                    </div>
                </div>
                `;
                }
            })
            .catch((error) => {
                console.error(error);
            });
    });
});
