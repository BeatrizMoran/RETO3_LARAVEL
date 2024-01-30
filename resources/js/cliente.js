document.getElementById("generarCodigo").addEventListener("click", function () {
    var codigo =
        "KILLER-" + Math.floor(100000 + Math.random() * 900000).toString();
    document.getElementById("codigo_cliente").value = codigo;
});
