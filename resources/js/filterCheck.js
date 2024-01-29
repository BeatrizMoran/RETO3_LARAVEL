$(document).ready(function () {
    $(".categoria-checkbox").change(function () {
        var categoriasSeleccionadas = obtenerCategoriasSeleccionadas();
        actualizarClaseCategoriaFiltrada(categoriasSeleccionadas);
    });
});

function obtenerCategoriasSeleccionadas() {
    var categoriasSeleccionadas = [];
    $(".categoria-checkbox:checked").each(function () {
        categoriasSeleccionadas.push($(this).val());
    });
    return categoriasSeleccionadas;
}

function actualizarClaseCategoriaFiltrada(categoriasSeleccionadas) {
    $(".categoria-checkbox").each(function () {
        var categoriaId = $(this).val();
        var label = $(this).next("label");

        if (categoriasSeleccionadas.includes(categoriaId)) {
            label.addClass("categoria-filtrada");
        } else {
            label.removeClass("categoria-filtrada");
        }
    });
}
