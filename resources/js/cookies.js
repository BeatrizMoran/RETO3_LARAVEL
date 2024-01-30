document.addEventListener("DOMContentLoaded", function () {
    var consent = localStorage.getItem("cookieConsent");
    if (consent === null) {
        document.getElementById("cookieConsentContainer").style.display =
            "block";
    }

    document
        .getElementById("acceptCookie")
        .addEventListener("click", function () {
            localStorage.setItem("cookieConsent", "accepted");
            document.getElementById("cookieConsentContainer").style.display =
                "none";
            window.location.href = "/"; // Redirige al backend para setear la cookie
        });

    document
        .getElementById("declineCookie")
        .addEventListener("click", function () {
            localStorage.setItem("cookieConsent", "declined");
            document.getElementById("cookieConsentContainer").style.display =
                "none";
            // Manejar el rechazo de cookies si es necesario
        });
});
