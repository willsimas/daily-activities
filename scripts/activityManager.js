document.addEventListener('DOMContentLoaded', () => {
    const editButtons = document.querySelectorAll('.edit-btn');
    const saveButtons = document.querySelectorAll('.save-btn');

    // Função para alternar entre visualização e edição
    const toggleEditMode = (li) => {
        const view = li.querySelector('.activity-view');
        const edit = li.querySelector('.activity-edit');

        view.classList.toggle('hidden');
        edit.classList.toggle('hidden');
    };

    // Adicionar event listeners para o botão de edição
    editButtons.forEach(button => {
        button.addEventListener('click', function() {
            const li = this.closest('li');
            toggleEditMode(li);
        });
    });

    // Função para salvar as alterações
    const saveActivity = async (li, index) => {
        const name = li.querySelector('.activity-name-edit').value;
        const status = li.querySelector('.activity-status-edit').value;

        try {
            const response = await fetch('api/updateActivity.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({ index, name, status })
            });

            const result = await response.json();
            if (result.success) {
                // Atualize a visualização com os novos dados
                li.querySelector('.activity-name').textContent = name;
                li.querySelector('.activity-status').textContent = status;

                // Voltar ao modo visualização
                toggleEditMode(li);
            } else {
                console.error('Failed to update activity:', result.message);
            }
        } catch (error) {
            console.error('Error:', error);
        }
    };

    // Adicionar event listeners para o botão de salvar
    saveButtons.forEach(button => {
        button.addEventListener('click', function() {
            const li = this.closest('li');
            const index = li.querySelector('.edit-btn').getAttribute('data-index');
            saveActivity(li, index);
        });
    });

    // Adicionar event listener para o click fora do combo select para salvar
    document.addEventListener('click', (event) => {
        const openDropdown = document.querySelector('.status-dropdown:not(.hidden)');
        if (openDropdown && !openDropdown.contains(event.target)) {
            const li = openDropdown.closest('li');
            const saveBtn = li.querySelector('.save-btn');
            if (saveBtn) {
                const index = li.querySelector('.edit-btn').getAttribute('data-index');
                saveActivity(li, index);
            }
            toggleEditMode(li);
        }
    });
});




// // scripts/activityManager.js
// document.addEventListener('DOMContentLoaded', function() {
//     const editButtons = document.querySelectorAll('.edit-btn');
//     const deleteButtons = document.querySelectorAll('.delete-btn');
    
//     editButtons.forEach(button => {
//         button.addEventListener('click', function() {
//             const listItem = this.closest('li');
//             const dropdown = listItem.querySelector('.status-dropdown');
//             dropdown.classList.toggle('hidden');
//             dropdown.querySelector('.status-select').focus();
//         });
//     });

//     // Use focusout to handle dropdown closing
//     document.querySelectorAll('.status-select').forEach(select => {
//         select.addEventListener('focusout', function(event) {
//             // Ensure that the dropdown closes only if clicking outside of the dropdown
//             if (!event.relatedTarget || !event.relatedTarget.closest('.status-dropdown')) {
//                 const listItem = this.closest('li');
//                 const index = listItem.querySelector('.edit-btn').getAttribute('data-index');
//                 const newStatus = this.value;

//                 fetch('api/updateActivity.php', {
//                     method: 'POST',
//                     headers: { 'Content-Type': 'application/json' },
//                     body: JSON.stringify({ index, status: newStatus })
//                 }).then(response => response.json()).then(data => {
//                     if (data.success) {
//                         listItem.querySelector('.status-dropdown').classList.add('hidden');
//                         listItem.querySelector('.status-text').textContent = newStatus.charAt(0).toUpperCase() + newStatus.slice(1);
//                     }
//                 });
//             }
//         });
//     });

//     deleteButtons.forEach(button => {
//         button.addEventListener('click', function() {
//             const index = this.getAttribute('data-index');
//             if (confirm('Are you sure you want to delete this activity?')) {
//                 fetch('api/deleteActivity.php', {
//                     method: 'POST',
//                     headers: { 'Content-Type': 'application/json' },
//                     body: JSON.stringify({ index })
//                 }).then(response => response.json()).then(data => {
//                     if (data.success) {
//                         this.closest('li').remove();
//                     }
//                 });
//             }
//         });
//     });
// });
