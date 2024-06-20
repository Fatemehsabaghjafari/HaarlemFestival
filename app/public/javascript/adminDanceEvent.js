document.addEventListener('DOMContentLoaded', function () {

    const editButtons = document.querySelectorAll('.edit-event');
    const modal = document.getElementById("editEventModal");
    const span = document.querySelector(".close");
    const editEventForm = document.getElementById("editEventForm");

    editButtons.forEach(function (button) {
        button.addEventListener("click", function () {
            const eventId = this.getAttribute("data-event-id");
            const dateTime = this.getAttribute("data-date-time");
            const venueName = this.getAttribute("data-venue-name");
            const session = this.getAttribute("data-session");
            const duration = this.getAttribute("data-duration");
            const ticketsAvailable = this.getAttribute("data-tickets-available");
            const price = this.getAttribute("data-price");
            const allDaysAccessPrice = this.getAttribute("data-all-days-access-price");
            const oneDayAccessPrice = this.getAttribute("data-one-day-access-price");
            const date = this.getAttribute("data-date");
            const time = this.getAttribute("data-time");

            document.getElementById("editEventId").value = eventId;
            document.getElementById("editDateTime").value = dateTime;
            document.getElementById("editVenueName").value = venueName;
            document.getElementById("editSession").value = session;
            document.getElementById("editDuration").value = duration;
            document.getElementById("editTicketsAvailable").value = ticketsAvailable;
            document.getElementById("editPrice").value = price;
            document.getElementById("editAllDaysAccessPrice").value = allDaysAccessPrice;
            document.getElementById("editOneDayAccessPrice").value = oneDayAccessPrice;
            document.getElementById("editDate").value = date;
            document.getElementById("editTime").value = time;

            modal.classList.add("show");
            modal.style.display = "block";
            modal.setAttribute("aria-hidden", "false");
            document.body.classList.add("modal-open");
        });
    });

    span.addEventListener("click", function () {
        modal.classList.remove("show");
        modal.style.display = "none";
        modal.setAttribute("aria-hidden", "true");
        document.body.classList.remove("modal-open");
    });

    window.addEventListener("click", function (event) {
        if (event.target === modal) {
            modal.classList.remove("show");
            modal.style.display = "none";
            modal.setAttribute("aria-hidden", "true");
            document.body.classList.remove("modal-open");
        }
    });

    editEventForm.addEventListener("submit", function (event) {
        event.preventDefault(); // Prevent default form submission
        editEvent();
    });

    function editEvent() {
        const eventId = document.getElementById('editEventId').value;
        const dateTime = document.getElementById('editDateTime').value;
        const venueName = document.getElementById('editVenueName').value;
        const session = document.getElementById('editSession').value;
        const duration = document.getElementById('editDuration').value;
        const ticketsAvailable = document.getElementById('editTicketsAvailable').value;
        const price = document.getElementById('editPrice').value;
        const allDaysAccessPrice = document.getElementById('editAllDaysAccessPrice').value;
        const oneDayAccessPrice = document.getElementById('editOneDayAccessPrice').value;
        const date = document.getElementById('editDate').value;
        const time = document.getElementById('editTime').value;
        const image = document.getElementById('editImage').files[0]; // Corrected id name

        // Get the values from the date and time fields
        const dateTimeValue = new Date(dateTime);
        const dateValue = new Date(date);
        const timeValue = new Date(time);

        // Format the date and time values as strings
        const formattedDateTime = dateTimeValue.toISOString(); // Format: YYYY-MM-DDTHH:MM:SS
        const formattedDate = dateValue.toISOString().split('T')[0]; // Format: YYYY-MM-DD
        const formattedTime = timeValue.toTimeString().split(' ')[0]; // Format: HH:MM:SS

        const formData = new FormData();
        formData.append("eventId", eventId);
        formData.append("dateTime", formattedDateTime); // Use formatted date and time
        formData.append("venueName", venueName);
        formData.append("session", session);
        formData.append("duration", duration);
        formData.append("ticketsAvailable", ticketsAvailable);
        formData.append("price", price);
        formData.append("allDaysAccessPrice", allDaysAccessPrice);
        formData.append("oneDayAccessPrice", oneDayAccessPrice);
        formData.append("date", formattedDate); // Use formatted date
        formData.append("time", formattedTime); // Use formatted time
        formData.append("image", image);
        formData.append("action", "edit-event");

        fetch('http://localhost/adminDanceEventApi', {
            method: 'POST',
            body: formData,
        })
            .then(response => response.json())
            .then(data => {
                if (data.status === 'success') {
                    const displayMessage = data.message;
                    alert(displayMessage);
                    fetchEvents();
                } else {
                    console.error('Error editing event:', data.message);
                }
            })
            .catch(error => console.error('Error editing event:', error));
    }


    function fetchEvents() {
        fetch('http://localhost/adminDanceEventApi')
            .then(response => response.json())
            .then(data => {
                // Update the table with the fetched data
                updateTable(data);
            })
            .catch(error => console.error('Error fetching events:', error));
    }

    function updateTable(events) {
        const tableBody = document.querySelector('tbody');
        tableBody.innerHTML = ''; // Clear the existing table rows

        events.forEach(event => {
            const row = document.createElement('tr');
            row.innerHTML = `
                <td>${event.eventId}</td>
                <td>${event.dateTime}</td>
                <td>${event.venueName}</td>
                <td>${event.session}</td>
                <td>${event.duration}</td>
                <td>${event.ticketsAvailable}</td>
                <td>${event.price}</td>
                <td>${event.allDaysAccessPrice}</td>
                <td>${event.oneDayAccessPrice}</td>
                <td>${event.date}</td>
                <td>${event.time}</td>
                <td><img class="djImg" src="${event.image}" alt="Image"></td>
                <td>
                    <button class="btn btn-danger btn-sm mr-2 delete-event"
                        data-event-id="${event.eventId}">Delete</button>
                    <button class="btn btn-primary btn-sm edit-event"
                       
                        data-date-time="${event.dateTime}"
                        data-venue-name="${event.venueName}"
                        data-session="${event.session}"
                        data-duration="${event.duration}"
                        data-tickets-available="${event.ticketsAvailable}"
                        data-price="${event.price}"
                        data-all-days-access-price="${event.allDaysAccessPrice}"
                        data-one-day-access-price="${event.oneDayAccessPrice}"
                        data-date="${event.date}"
                        data-time="${event.time}"
                        data-image="${event.image}">Edit</button>
                </td>
            `;
            tableBody.appendChild(row);
        });
    }


    const deleteEventButtons = document.querySelectorAll('.delete-event');
    deleteEventButtons.forEach(button => {
        button.addEventListener('click', function () {
            const eventId = this.dataset.eventId;
            deleteEvent(eventId);
        });
    });

    const addEventForm = document.getElementById('addEventForm');
    addEventForm.addEventListener('submit', function (event) {
        event.preventDefault(); // Prevent default form submission
        // Call the addEvent function to handle the form submission
        addEvent();
    });



    function addEvent() {
        const dateTimeElement = document.getElementById('dateTime');
        const venueName = document.getElementById('venueName').value;
        const session = document.getElementById('session').value;
        const duration = document.getElementById('duration').value;
        const ticketsAvailable = document.getElementById('ticketsAvailable').value;
        const price = document.getElementById('price').value;
        const allDaysAccessPrice = document.getElementById('allDaysAccessPrice').value;
        const oneDayAccessPrice = document.getElementById('oneDayAccessPrice').value;
        const dateElement = document.getElementById('date');
        const timeElement = document.getElementById('time');
        const image = document.getElementById('image').files[0];

        // Get the values from the date and time fields
        const dateTimeValue = new Date(dateTimeElement.value);
        const dateValue = new Date(dateElement.value);
        const timeValue = new Date(timeElement.value);

        // Format the date and time values as strings
        const formattedDateTime = dateTimeValue.toISOString(); // Format: YYYY-MM-DDTHH:MM:SS
        const formattedDate = dateValue.toISOString().split('T')[0]; // Format: YYYY-MM-DD
        const formattedTime = timeValue.toTimeString().split(' ')[0]; // Format: HH:MM:SS

        const formData = new FormData();
        formData.append("dateTime", formattedDateTime);
        formData.append("venueName", venueName);
        formData.append("session", session);
        formData.append("duration", duration);
        formData.append("ticketsAvailable", ticketsAvailable);
        formData.append("price", price);
        formData.append("allDaysAccessPrice", allDaysAccessPrice);
        formData.append("oneDayAccessPrice", oneDayAccessPrice);
        formData.append("date", formattedDate);
        formData.append("time", formattedTime);
        formData.append("image", image);
        formData.append("action", "add-event");

        fetch('http://localhost/adminDanceEventApi', {
            method: 'POST',
            body: formData,
        })
            .then(response => response.json())
            .then(data => {
                if (data.status === 'success') {
                    const displayMessage = data.message;
                    alert(displayMessage);
                    fetchEvents();
                } else {
                    console.error('Error adding event:', data.message);
                }
            })
            .catch(error => console.error('Error adding event:', error));
    }



    function deleteEvent(eventId) {
        const formData = new FormData();
        formData.append("action", "delete-event");
        formData.append("eventId", eventId);

        fetch('http://localhost/adminDanceEventApi', {
            method: 'POST',
            body: formData,
        })
            .then(response => response.json())
            .then(data => {
                if (data.status === 'success') {
                    const displayMessage = data.message;
                    alert(displayMessage);
                    fetchEvents();
                } else {
                    console.error('Error deleting event:', data.message);
                }
            })
            .catch(error => console.error('Error deleting event:', error));
    }
});
