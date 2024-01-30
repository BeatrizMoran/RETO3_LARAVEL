document.addEventListener("DOMContentLoaded", function () {
    var consent = localStorage.getItem("cookieConsent");
    if (consent === null) {
        document.getElementById("cookieConsentModal").style.display = "block";
    }

    document.getElementById("acceptCookie").addEventListener("click", function () {
        localStorage.setItem("cookieConsent", "accepted");
        closeModal();
        window.location.href = "/"; // Redirige al backend para setear la cookie
    });

    document.getElementById("declineCookie").addEventListener("click", function () {
        localStorage.setItem("cookieConsent", "declined");
        closeModal();
        // Manejar el rechazo de cookies si es necesario
    });
});

function closeModal() {
    document.getElementById("cookieConsentModal").style.display = "none";
}
