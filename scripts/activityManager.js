document.addEventListener('DOMContentLoaded', () => {
    // Função para alternar entre visualização e edição
    const toggleEditMode = (li) => {
        const view = li.querySelector('.activity-view');
        const edit = li.querySelector('.activity-edit');

        view.classList.toggle('hidden');
        edit.classList.toggle('hidden');
    };

    // Adicionar event listeners para o botão de edição
    document.querySelectorAll('.edit-btn').forEach(button => {
        button.addEventListener('click', function () {
            const li = this.closest('li');
            toggleEditMode(li);
        });
    });

    // Função para salvar as alterações
    const saveActivity = async (li, id) => {
        const name = li.querySelector('.activity-name-edit').value;
        const status = li.querySelector('.activity-status-edit').value;

        try {
            const response = await fetch('api/updateActivity.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({ id, name, status })
            });

            const result = await response.json();
            if (result.success) {
                // Atualize a visualização com os novos dados
                li.querySelector('.activity-name').textContent = name;
                li.querySelector('.activity-status').textContent = status;
                toggleEditMode(li);
            } else {
                console.error('Failed to update activity:', result.message);
            }
        } catch (error) {
            console.error('Error:', error);
        }
    };

    // Adicionar event listeners para o botão de salvar
    document.querySelectorAll('.save-btn').forEach(button => {
        button.addEventListener('click', function () {
            const li = this.closest('li');
            const id = li.querySelector('.edit-btn').getAttribute('data-id');
            saveActivity(li, id);
        });
    });

    // Adicionar event listeners para o botão de cancelar
    document.querySelectorAll('.cancel-btn').forEach(button => {
        button.addEventListener('click', function () {
            const li = this.closest('li');
            toggleEditMode(li);
        });
    });

    // Adicionar event listeners para o botão de exclusão
    document.querySelectorAll('.delete-btn').forEach(button => {
        button.addEventListener('click', function () {
            const id = this.getAttribute('data-id'); // Atualize para 'data-id'

            if (confirm('Are you sure you want to delete this activity?')) {
                fetch('api/deleteActivity.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({ id })
                })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            // Remove the activity from the DOM
                            this.closest('li').remove();
                        } else {
                            alert(data.message || 'Failed to delete activity');
                        }
                    })
                    .catch(error => console.error('Error:', error));
            }
        });
    });
});

const saveActivity = async (li, id) => {
    const name = li.querySelector('.activity-name-edit').value;
    const status = li.querySelector('.activity-status-edit').value;

    try {
        const response = await fetch('api/updateActivity.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ id, name, status })
        });

        const result = await response.json();
        if (result.success) {
            // Atualize a visualização com os novos dados
            li.querySelector('.activity-name').textContent = name;
            li.querySelector('.activity-status').textContent = status;
            toggleEditMode(li);
        } else {
            console.error('Failed to update activity:', result.message);
        }
    } catch (error) {
        console.error('Error:', error);
    }
};