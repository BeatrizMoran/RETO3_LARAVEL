document.addEventListener("DOMContentLoaded", function () {
    const darkModeToggle = document.getElementById("dark-mode-toggle");
    const sidebarElement = document.querySelector(
        ".col-auto.d-flex.flex-column.min-vh-100"
    );

    if (darkModeToggle && sidebarElement) {
        darkModeToggle.addEventListener("click", function () {
            document.body.classList.toggle("dark-mode");
            sidebarElement.classList.toggle(
                "light-bg",
                !document.body.classList.contains("dark-mode")
            );
            sidebarElement.classList.toggle(
                "dark-bg",
                document.body.classList.contains("dark-mode")
            );

            // Puedes enviar una solicitud al servidor para almacenar la preferencia del usuario
            // (por ejemplo, a través de una llamada AJAX)
        });
    }
});
