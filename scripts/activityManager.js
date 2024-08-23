// scripts/activityManager.js
document.addEventListener('DOMContentLoaded', function() {
    const editButtons = document.querySelectorAll('.edit-btn');
    const deleteButtons = document.querySelectorAll('.delete-btn');

    editButtons.forEach(button => {
        button.addEventListener('click', function() {
            const index = this.getAttribute('data-index');
            const newStatus = prompt('Enter new status (aberto, realizando, finalizado):');
            if (newStatus) {
                fetch('api/updateActivity.php', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify({ index, status: newStatus })
                }).then(response => response.json()).then(data => {
                    if (data.success) {
                        location.reload();
                    }
                });
            }
        });
    });

    deleteButtons.forEach(button => {
        button.addEventListener('click', function() {
            const index = this.getAttribute('data-index');
            if (confirm('Are you sure you want to delete this activity?')) {
                fetch('api/deleteActivity.php', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify({ index })
                }).then(response => response.json()).then(data => {
                    if (data.success) {
                        location.reload();
                    }
                });
            }
        });
    });
});
