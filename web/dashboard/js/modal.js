// Add this script in your view or a separate JavaScript file
document.addEventListener('DOMContentLoaded', function() {
    // Handle click events for buttons
    document.querySelectorAll('[data-target="#modal"]').forEach(button => {
        button.addEventListener('click', function(event) {
            event.preventDefault();
            let url = this.getAttribute('data-url');
            let method = this.getAttribute('data-method') || 'get';

            // Load the content into the modal
            if (method.toLowerCase() === 'post') {
                if (confirm(this.getAttribute('data-confirm'))) {
                    fetch(url, {
                        method: 'POST',
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest',
                            'Content-Type': 'application/x-www-form-urlencoded',
                        },
                        body: new URLSearchParams({
                            '_csrf': yii.getCsrfToken()
                        })
                    }).then(response => {
                        if (response.ok) {
                            location.reload();
                        } else {
                            alert('Error: ' + response.statusText);
                        }
                    });
                }
            } else {
                fetch(url).then(response => response.text()).then(html => {
                    document.getElementById('modalContent').innerHTML = html;
                    $('#modal').modal('show');
                });
            }
        });
    });
});
