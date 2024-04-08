document.addEventListener('DOMContentLoaded', function () {

    function fetchArtists() {
        fetch('http://localhost/adminApi')
            .then(response => response.json())
            .then(data => {
                // Update the table with the fetched data
                updateTable(data);
            })
            .catch(error => console.error('Error fetching artists:', error));
    }

    function updateTable(artists) {
        const tableBody = document.querySelector('tbody');
        tableBody.innerHTML = ''; // Clear the existing table rows

        artists.forEach(artist => {
            const row = document.createElement('tr');
            row.innerHTML = `
                <td>${artist.artistId}</td>
                <td>${artist.artistName}</td>
                <td>${artist.style}</td>
                <td><img class="djImg" src="${artist.img}" alt="Image"></td>
                <td>
                    <button class="btn btn-danger btn-sm mr-2 delete-artist"
                        data-artist-id="${artist.artistId}">Delete</button>
                    <button class="btn btn-primary btn-sm edit-artist"
                        data-artist-id="${artist.artistId}"
                        data-artist-name="${artist.artistName}"
                        data-artist-style="${artist.style}"
                        data-artist-img="${artist.img}">Edit</button>
                </td>
            `;
            tableBody.appendChild(row);
        });
    }


    const deleteArtistButtons = document.querySelectorAll('.delete-artist');
    deleteArtistButtons.forEach(button => {
        button.addEventListener('click', function () {
            const artistId = this.dataset.artistId;
            deleteArtist(artistId);
        });
    });

    const addArtistForm = document.getElementById('addArtistForm');
    addArtistForm.addEventListener('submit', function (event) {
        event.preventDefault(); // Prevent default form submission
        // Call the addArtist function to handle the form submission
        addArtist();
    });

    const editButtons = document.querySelectorAll('.edit-artist');
    const modal = document.getElementById("editArtistModal");
    const span = document.getElementsByClassName("close")[0];
    const editArtistForm = document.getElementById("editArtistForm");

    editButtons.forEach(function (button) {
        button.addEventListener("click", function () {
            const artistId = this.getAttribute("data-artist-id");
            const artistName = this.getAttribute("data-artist-name");
            const artistStyle = this.getAttribute("data-artist-style");

            document.getElementById("editArtistId").value = artistId;
            document.getElementById("editArtistName").value = artistName;
            document.getElementById("editArtistStyle").value = artistStyle;


            modal.style.display = "block";
        });
    });

    span.onclick = function () {
        modal.style.display = "none";
    }

    window.onclick = function (event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
    }

    editArtistForm.addEventListener('submit', function (event) {
        event.preventDefault(); // Prevent default form submission
        editArtist();
    });

    function editArtist() {
        const artistId = document.getElementById('editArtistId').value;
        const artistName = document.getElementById('editArtistName').value;
        const style = document.getElementById('editArtistStyle').value;
        const img = document.getElementById('editArtistImage').files[0];
        const formData = new FormData();
        formData.append("artistId", artistId);
        formData.append("artistName", artistName);
        formData.append("style", style);
        formData.append("img", img);
        formData.append("action", "edit-artist");

        fetch('http://localhost/adminApi', {
            method: 'POST',
            body: formData,
        })
            .then(response => response.json())
            .then(data => {
                if (data.status === 'success') {
                    const displayMessage = data.message;
                    alert(displayMessage);
                    fetchArtists();
                } else {
                    console.error('Error editing artist:', data.message);
                }
            })
            .catch(error => console.error('Error editing artist:', error));
    }

    function addArtist() {
        const artistName = document.getElementById('artistName').value;
        const style = document.getElementById('style').value;
        const img = document.getElementById('img').files[0];
        const formData = new FormData();
        formData.append("artistName", artistName);
        formData.append("style", style);
        formData.append("img", img);
        formData.append("action", "add-artist");

        fetch('http://localhost/adminApi', {
            method: 'POST',
            body: formData,
        })
            .then(response => response.json())
            .then(data => {
                if (data.status === 'success') {
                    const displayMessage = data.message;
                    alert(displayMessage);
                    fetchArtists();
                } else {
                    console.error('Error adding artist:', data.message);
                }
            })
            .catch(error => console.error('Error adding artist:', error));
    }

    function deleteArtist(artistId) {
        const formData = new FormData();
        formData.append("action", "delete-artist");
        formData.append("artistId", artistId);

        fetch('http://localhost/adminApi', {
            method: 'POST',
            body: formData,
        })
            .then(response => response.json())
            .then(data => {
                if (data.status === 'success') {
                    const displayMessage = data.message;
                    alert(displayMessage);
                    fetchArtists();
                } else {
                    console.error('Error deleting artist:', data.message);
                }
            })
            .catch(error => console.error('Error deleting artist:', error));
    }
});
