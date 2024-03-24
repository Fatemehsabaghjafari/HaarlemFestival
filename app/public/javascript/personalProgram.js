$(".agenda-view").hide();

$(document).on("click", ".btn-list-view", function() {
    $(".list-view").show();
    $(".agenda-view").hide();
    $(".btn-list-view").addClass("view-active");
    $(".btn-agenda-view").removeClass("view-active");
});

$(document).on("click", ".btn-agenda-view", function() {
    $(".list-view").hide();
    $(".agenda-view").show();
    $(".btn-agenda-view").addClass("view-active");
    $(".btn-list-view").removeClass("view-active");
});

$(document).on("click", ".fa-circle-check", function() {
    const event = $(this).closest(".event");
    $(this).removeClass("fa-circle-check");
    $(this).addClass("fa-circle");
    event[0].style.opacity = "0.5";
    const ticketId = event.attr("data-ticket-id");
    const eventType = event.attr("data-event-type");
    setActiveStatus(ticketId, eventType, 0);
});

$(document).on("click", ".fa-circle", function() {
    const event = $(this).closest(".event");
    $(this).removeClass("fa-circle");
    $(this).addClass("fa-circle-check");
    event[0].style.opacity = "1";
    const ticketId = event.attr("data-ticket-id");
    const eventType = event.attr("data-event-type");
    setActiveStatus(ticketId, eventType, 1);
});

function setActiveStatus($ticketId, $eventType, $status) {
    const formData = new FormData();
    formData.append("ticketId", $ticketId);
    formData.append("eventType", $eventType);
    formData.append("status", $status);

    fetch("/api/personalprogram/setactivestatus", {
        method: "POST",
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        console.log(data);
    });
}

function updateTicketQuantityAndPrice(eventType, ticketType, newAmount, element) {
    const ticketId = element.closest(".event").attr("data-ticket-id");
    const selector = element.closest(".amount-selector");

    selector.attr("data-amount", newAmount);
    selector.find(".ticket-amount").text(newAmount);

    const formData = new FormData();
    formData.append("ticketId", ticketId);
    formData.append("eventType", eventType);
    formData.append("ticketType", ticketType);
    formData.append("quantity", newAmount);

    fetch("/api/personalprogram/updateticket", {
        method: "POST",
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        console.log(data);
        if (data.status == "success") {
            console.log("Ticket updated successfully");
            console.log(eventType);
            element.closest(".event").attr(`data-${ticketType}-quantity`, newAmount);

            let price = 0;

            if (eventType === "music") {
                const musicQuantity = parseInt(element.closest(".event").attr("data-single-quantity"));
                const musicPrice = parseFloat(element.closest(".event").attr("data-single-price"));
                
                price = musicQuantity * musicPrice;
            } else if (eventType === "yummy") {
                const adultQuantity = parseInt(element.closest(".event").attr("data-adult-quantity"));
                const adultPrice = parseFloat(element.closest(".event").attr("data-adult-price"));
                const kidQuantity = parseInt(element.closest(".event").attr("data-kid-quantity"));
                const kidPrice = parseFloat(element.closest(".event").attr("data-kid-price"));

                price = (adultQuantity * adultPrice) + (kidQuantity * kidPrice);
            } else if (eventType == "history") {
                const singleQuantity = parseInt(element.closest(".event").attr("data-single-quantity"));
                const singlePrice = parseFloat(element.closest(".event").attr("data-single-price"));
                const familyQuantity = parseInt(element.closest(".event").attr("data-family-quantity"));
                const familyPrice = parseFloat(element.closest(".event").attr("data-family-price"));

                price = (singleQuantity * singlePrice) + (familyQuantity * familyPrice);
            }

            element.closest(".event").find(".price").text(`€${price}`);
        }
    });
}

$(document).on("click", ".fa-circle-minus", function() {
    try {
        const eventType = $(this).closest(".event").attr("data-event-type");
        const ticketType = $(this).closest(".amount-selector").attr("data-ticket-type");
        const currentAmount = parseInt($(this).closest(".amount-selector").find(".ticket-amount").text());
        if (currentAmount === 0) return;
        const newAmount = currentAmount - 1;

        updateTicketQuantityAndPrice(eventType, ticketType, newAmount, $(this));

    } catch (error) {
        
    }
});

$(document).on("click", ".fa-circle-plus", function() {
    try {
        const eventType = $(this).closest(".event").attr("data-event-type");
        const ticketType = $(this).closest(".amount-selector").attr("data-ticket-type");
        const currentAmount = parseInt($(this).closest(".amount-selector").find(".ticket-amount").text());
        const newAmount = currentAmount + 1;

        updateTicketQuantityAndPrice(eventType, ticketType, newAmount, $(this));

    } catch (error) {
        
    }
});


$(document).on("click", ".fa-trash-can", function() {
    $(this).closest(".event").hide(200);
    const ticketId = $(this).closest(".event").attr("data-ticket-id");
    const eventType = $(this).closest(".event").attr("data-event-type");

    const formData = new FormData();
    formData.append("ticketId", ticketId);
    formData.append("eventType", eventType);

    fetch("/api/personalprogram/deleteticket", {
        method: "POST",
        body: formData
    });
});