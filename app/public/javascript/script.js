document.addEventListener('DOMContentLoaded', function () {
    // Add event listeners to "Add to Cart" buttons
    const addToCartButtons = document.querySelectorAll('.add-to-cart');
    addToCartButtons.forEach(button => {
        button.addEventListener('click', function() {
            const ticketId = this.dataset.ticketId;

            // Call addToCart function
           // addToCart(ticketId);

            // Call addNewTicketToCart function
            addNewTicketToCart(ticketId, 1, null, null, null);
         
        });
    });

    // Ensure the variable name is different here
    const addToCartOneDayButtons = document.querySelectorAll('.add-oneDay-to-cart');
    addToCartOneDayButtons.forEach(button => {
        button.addEventListener('click', function() {
            const ticketId = this.dataset.ticketId;

            addNewOneDayTicketToCart(ticketId);
        });
    });

    const addToCartAllDaysButtons = document.querySelectorAll('.add-allDays-to-cart');
    addToCartAllDaysButtons.forEach(button => {
        button.addEventListener('click', function() {
            const ticketId = this.dataset.ticketId;

            addNewAllDaysTicketToCart(ticketId);
        });
    });



    // Function to handle "Add to Cart" action
    function addToCart(ticketId) {
        fetch('http://localhost/danceapi', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({
                action: 'add_to_cart',
                ticketId: ticketId,
            }),
        })
        .then(response => response.json())
        .then(data => {
            if (data.status === 'success') {
                // Access the display message
                const displayMessage = data.message;
                alert(displayMessage);
            } else {
                console.error('Error adding ticket:', data.message);
            }
        })
        .catch(error => console.error('Error adding ticket:', error));
    }

    // Function to handle "Add New Ticket" action
    function addNewTicketToCart(eventId, quantity, oneDayAccessTicketQuantity, allDaysAccessTicketQuantity, isPurchased) {
        fetch('http://localhost/dancePersonalProgramApi', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({
                action: 'add_new_ticket',
                eventId: eventId,
                quantity: quantity,
                oneDayAccessTicketQuantity: oneDayAccessTicketQuantity,
                allDaysAccessTicketQuantity: allDaysAccessTicketQuantity,
                isPurchased: isPurchased
            }),
        })
        .then(response => response.json())
        .then(data => {
            console.log(data);
            if (data.status === 'success') {
                // Access the display message
                const displayMessage = data.message;
                alert(displayMessage);
            } else {
                console.error('Error adding ticket:', data.message);
            }
        })
        .catch(error => console.error('Error adding ticket:', error));
    }



    function addNewOneDayTicketToCart(eventId, quantity, oneDayAccessTicketQuantity, allDaysAccessTicketQuantity, isPurchased) {
        fetch('http://localhost/dancePersonalProgramApi', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({
                action: 'add_new_oneDayTicket',
                eventId: eventId,
                quantity: quantity,
                oneDayAccessTicketQuantity: oneDayAccessTicketQuantity,
                allDaysAccessTicketQuantity: allDaysAccessTicketQuantity,
                isPurchased: isPurchased
            }),
        })
        .then(response => response.json())
        .then(data => {
            console.log(data);
            if (data.status === 'success') {
                // Access the display message
                const displayMessage = data.message;
                alert(displayMessage);
            } else {
                console.error('Error adding ticket:', data.message);
            }
        })
        .catch(error => console.error('Error adding ticket:', error));
    }



    function addNewAllDaysTicketToCart(eventId, quantity, oneDayAccessTicketQuantity, allDaysAccessTicketQuantity, isPurchased) {
        fetch('http://localhost/dancePersonalProgramApi', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({
                action: 'add_new_allDaysTicket',
                eventId: eventId,
                quantity: quantity,
                oneDayAccessTicketQuantity: oneDayAccessTicketQuantity,
                allDaysAccessTicketQuantity: allDaysAccessTicketQuantity,
                isPurchased: isPurchased
            }),
        })
        .then(response => response.json())
        .then(data => {
            console.log(data);
            if (data.status === 'success') {
                // Access the display message
                const displayMessage = data.message;
                alert(displayMessage);
            } else {
                console.error('Error adding ticket:', data.message);
            }
        })
        .catch(error => console.error('Error adding ticket:', error));
    }
});






