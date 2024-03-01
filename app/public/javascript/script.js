document.addEventListener("DOMContentLoaded", function() {

    // Add event listeners to "Add to Cart" buttons
    const addToCartButtons = document.querySelectorAll('.addToCartBtn');
    addToCartButtons.forEach(button => {
        button.addEventListener('click', function() {
            addToCart(this); // Pass the button element to the function
        });
    });

    // Function to handle "Add to Cart" button click
    function addToCart(button) {
        // Extract product details from the button's parent container
        const cardBody = button.closest('.card-body');
        const productName = cardBody.querySelector('input[name="product_name"]').value;
        const productPrice = cardBody.querySelector('input[name="product_price"]').value;

        // Send an AJAX request to add the item to the cart
        fetch('http://localhost/api/cart', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({
                action: 'add_to_cart',
                product_name: productName,
                product_price: productPrice,
            }),
        })
        .then(response => response.json())
        .then(data => {
            if (data.status === 'success') {
              // Access the display message
               const displayMessage = data.message;
               alert(displayMessage);
               // updateCartItemCount();
            } else {
                console.error('Error adding item :', data.message);
            }
        })
        .catch(error => console.error('Error adding item :', error));
    }

    
  // Function to fetch data from the server and update the cart items
  function fetchData() {
  fetch('http://localhost/api/cart')
      .then(response => response.json())
      .then(data => {
          const tbody = document.querySelector('.tbody');
          tbody.innerHTML = '';
          let newTotalAmount = 0;

          data.forEach(item => {
              const row = document.createElement('tr');
              row.innerHTML = `
              <td>${item.name}</td>
                      <td>
                          <input type="number" min="1" value="${item.quantity}" id="quantity_${item.id}">
                      </td>
                      <td>€${item.price}</td>
                      <td>
                          <button class="btn btn-sm btn-outline-secondary" onclick="modifyQuantity(${item.id}, 1)">+</button>
                          <button class="btn btn-sm btn-outline-secondary" onclick="modifyQuantity(${item.id}, -1)">-</button>
                      </td>
                      <td>
                          <button class="btn btn-sm btn-outline-danger" onclick="removeItem(${item.id});">Remove</button>
                      </td>
              `;
              tbody.appendChild(row);

              // Update the total amount
              newTotalAmount += item.quantity * item.price;

          });

          // Update the total amount in the HTML
          const totalAmountElement = document.getElementById('totalAmount');
          totalAmountElement.textContent = `€${newTotalAmount.toFixed(2)}`;
      })
      .catch(error => console.error('Error fetching data:', error));
      //updateCartItemCount();
}
  

});