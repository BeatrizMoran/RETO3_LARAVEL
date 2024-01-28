import './bootstrap';

document.addEventListener('DOMContentLoaded', function() {
    const darkModeToggle = document.getElementById('dark-mode-toggle');

    if (darkModeToggle) {
        darkModeToggle.addEventListener('click', function() {
            document.body.classList.toggle('dark-mode');

            // Puedes enviar una solicitud al servidor para almacenar la preferencia del usuario (por ejemplo, a través de una llamada AJAX)
            // Ejemplo:
            // axios.post('/toggle-dark-mode').then(response => {
            //     console.log(response.data);
            // }).catch(error => {
            //     console.error(error);
            // });
        });
    }

    
});

