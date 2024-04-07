document.addEventListener('DOMContentLoaded', function () {
    function fetchVenues() {
        fetch('http://localhost/adminDanceVenueApi')
            .then(response => response.json())
            .then(data => {
                // Update the table with the fetched data
                updateTable(data);
            })
            .catch(error => console.error('Error fetching artists:', error));
    }

    function updateTable(venues) {
        const tableBody = document.querySelector('tbody');
        tableBody.innerHTML = ''; // Clear the existing table rows

        venues.forEach(venue => {
            const row = document.createElement('tr');
            row.innerHTML = `
                <td>${venue.venueId}</td>
                <td>${venue.venueName}</td>
                <td>${venue.venueAddress}</td>
                <td>
                    <button class="btn btn-danger btn-sm mr-2 delete-venue."
                        data-venue-id="${venue.venueId}">Delete</button>
                    <button class="btn btn-primary btn-sm edit-venue"
                        data-venue-id="${venue.venueId}"
                        data-venue-name="${venue.venueName}"
                        data-venue-address="${venue.venueAddress}">Edit</button>
                </td>
            `;
            tableBody.appendChild(row);
        });
    }

    const deleteVenueButtons = document.querySelectorAll('.delete-venue');
    deleteVenueButtons.forEach(button => {
        button.addEventListener('click', function () {
            const venueId = this.dataset.venueId;
            deleteVenue(venueId);
        });
    });

    function deleteVenue(venueId) {
        const formData = new FormData();
        formData.append("action", "delete-venue");
        formData.append("venueId", venueId);

        fetch('http://localhost/adminDanceVenueApi', {
            method: 'POST',
            body: formData,
        })
            .then(response => response.json())
            .then(data => {
                if (data.status === 'success') {
                    const displayMessage = data.message;
                    alert(displayMessage);
                    fetchVenues();
                } else {
                    console.error('Error deleting venue:', data.message);
                }
            })
            .catch(error => console.error('Error deleting venue:', error));
    }

    const addVenueForm = document.getElementById('addVenueForm');
    addVenueForm.addEventListener('submit', function (event) {
        event.preventDefault(); // Prevent default form submission

        addVenue();
    });

    function addVenue() {
        const venueName = document.getElementById('venueName').value;
        const venueAddress = document.getElementById('venueAddress').value;
        const formData = new FormData();
        formData.append("venueName", venueName);
        formData.append("venueAddress", venueAddress);
        formData.append("action", "add-venue");

        fetch('http://localhost/adminDanceVenueApi', {
            method: 'POST',
            body: formData,
        })
            .then(response => response.json())
            .then(data => {
                if (data.status === 'success') {
                    const displayMessage = data.message;
                    alert(displayMessage);
                    fetchVenues();
                } else {
                    console.error('Error adding venue:', data.message);
                }
            })
            .catch(error => console.error('Error adding venue:', error));
    }


    const editButtons = document.querySelectorAll('.edit-venue');
    const modal = document.getElementById("editVenueModal");
    const span = document.getElementsByClassName("close")[0];
    const editVenueForm = document.getElementById("editVenueForm");

    editButtons.forEach(function (button) {
        button.addEventListener("click", function () {
            const venueId = this.getAttribute("data-venue-id");
            const venueName = this.getAttribute("data-venue-name");
            const venueAddress = this.getAttribute("data-venue-address");

            document.getElementById("editVenueId").value = venueId;
            document.getElementById("editVenueName").value = venueName;
            document.getElementById("editVenueAddress").value = venueAddress;


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

    editVenueForm.addEventListener('submit', function (event) {
        event.preventDefault(); // Prevent default form submission
        editVenue();
    });

    function editVenue() {
        const venueId = document.getElementById('editVenueId').value;
        const venueName = document.getElementById('editVenueName').value;
        const venueAddress = document.getElementById('editVenueAddress').value;
        const formData = new FormData();
        formData.append("venueId", venueId);
        formData.append("venueName", venueName);
        formData.append("venueAddress", venueAddress);
        formData.append("action", "edit-venue");

        fetch('http://localhost/adminDanceVenueApi', {
            method: 'POST',
            body: formData,
        })
            .then(response => response.json())
            .then(data => {
                if (data.status === 'success') {
                    const displayMessage = data.message;
                    alert(displayMessage);
                    fetchVenues();
                } else {
                    console.error('Error editing venue:', data.message);
                }
            })
            .catch(error => console.error('Error editing venue:', error));
    }


});