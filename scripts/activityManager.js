// scripts/activityManager.js
document.addEventListener('DOMContentLoaded', function() {
    const editButtons = document.querySelectorAll('.edit-btn');
    const deleteButtons = document.querySelectorAll('.delete-btn');
    
    editButtons.forEach(button => {
        button.addEventListener('click', function() {
            const listItem = this.closest('li');
            const dropdown = listItem.querySelector('.status-dropdown');
            dropdown.classList.toggle('hidden');
        });
    });

    document.querySelectorAll('.status-select').forEach(select => {
        select.addEventListener('change', function() {
            const listItem = this.closest('li');
            const index = listItem.querySelector('.edit-btn').getAttribute('data-index');
            const newStatus = this.value;

            fetch('api/updateActivity.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({ index, status: newStatus })
            }).then(response => response.json()).then(data => {
                if (data.success) {
                    listItem.querySelector('.status-dropdown').classList.add('hidden');
                    listItem.querySelector('.text-blue-600').textContent = newStatus.charAt(0).toUpperCase() + newStatus.slice(1);
                }
            });
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
                        this.closest('li').remove();
                    }
                });
            }
        });
    });
});
