document.addEventListener('DOMContentLoaded', function() {
    const loginForm = document.getElementById('loginForm');
    const entryForm = document.getElementById('entryForm');

    // Form validation
    loginForm.addEventListener('submit', function(event) {
        if (!loginForm.username.value || !loginForm.password.value) {
            event.preventDefault();
            alert('Username and password are required.');
        }
    });

    entryForm.addEventListener('submit', function(event) {
        if (!entryForm.message.value) {
            event.preventDefault();
            alert('Message cannot be empty.');
        }
    });

    // Fetch entries without reloading the page
    const fetchEntries = () => {
        fetch('fetch_entries.php')
            .then(response => response.json())
            .then(entries => {
                const entriesContainer = document.getElementById('entries');
                entriesContainer.innerHTML = '';
                entries.forEach(entry => {
                    const entryElement = document.createElement('div');
                    entryElement.innerHTML = `
                        <h3>${entry.message}</h3>
                        <p>By: ${entry.username}</p>
                    `;
                    entriesContainer.appendChild(entryElement);
                });
            });
    };

    // Fetch entries on page load
    fetchEntries();

    // Add entry and fetch new entries
    entryForm.addEventListener('submit', function(event) {
        event.preventDefault();
        const message = entryForm.message.value;
        fetch('add_entry.php', {
            method: 'POST',
            body: JSON.stringify({ message }),
            headers: {
                'Content-Type': 'application/json'
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                fetchEntries();
                entryForm.reset();
            } else {
                alert(data.error);
            }
        });
    });
});
