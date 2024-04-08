document.addEventListener('DOMContentLoaded', function () {

    function fetchUserTable() {
        fetch('http://localhost/userAdminApi')
            .then(response => response.json())
            .then(data => {
                // Update the table with the fetched data
                updateTable(data);
            })
            .catch(error => console.error('Error fetching users:', error));
    }
    
    function updateTable(users) {
        const tableBody = document.querySelector('tbody');
        tableBody.innerHTML = ''; // Clear the existing table rows
    
        users.forEach(user => {
            const row = document.createElement('tr');
            row.innerHTML = `
                <td>${user.id}</td>
                <td>${user.username}</td>
                <td>${user.email}</td>
                <td>${user.roleId}</td>
                <td>${user.registrationDate}</td>
                <td><img class="userImg" src="${user.img}" alt="User Image"></td>
                <td>
                    <button class="btn btn-danger btn-sm mr-2 delete-user"
                        data-user-id="${user.id}">Delete</button>
                    <button class="btn btn-primary btn-sm edit-user"
                        data-user-id="${user.id}"
                        data-user-email="${user.email}"
                        data-user-username="${user.username}"
                        data-user-roleid="${user.roleId}"
                        data-user-img="${user.img}">Edit</button>
                </td>
            `;
            tableBody.appendChild(row);
        });
    }
   // fetchUserTable();
    const editButtons = document.querySelectorAll('.edit-user');
    const modal = document.getElementById("editUserModal");
    const span = document.getElementsByClassName("close")[0];
    const editUserForm = document.getElementById("editUserForm");
    
    editButtons.forEach(function (button) {
        button.addEventListener("click", function () {
            const userId = this.getAttribute("data-user-id");
            const email = this.getAttribute("data-user-email");
            const username = this.getAttribute("data-user-username");
            const roleId = this.getAttribute("data-user-roleid");
    
            document.getElementById("editUserId").value = userId;
            document.getElementById("editEmail").value = email;
            document.getElementById("editUsername").value = username;
            document.getElementById("editRoleId").value = roleId;
    
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
    
    editUserForm.addEventListener('submit', function (event) {
        event.preventDefault(); // Prevent default form submission
        editUser();
    });
    
    function editUser() {
        const userId = document.getElementById('editUserId').value;
        const email = document.getElementById('editEmail').value;
        const username = document.getElementById('editUsername').value;
        const roleId = document.getElementById('editRoleId').value;
        const img = document.getElementById('editUserImage').files[0];
    
        const formData = new FormData();
        formData.append("userId", userId);
        formData.append("email", email);
        formData.append("username", username);
        formData.append("roleId", roleId);
        formData.append("img", img);
        formData.append("action", "edit-user");
    
        fetch('http://localhost/userAdminApi', {
            method: 'POST',
            body: formData,
        })
        .then(response => response.json())
        .then(data => {
            const displayMessage = data.message;
            if (data.status === 'success') {
                
                alert(displayMessage);
                fetchUserTable();
            } else {
               // alert(displayMessage);
                fetchUserTable();
                console.error('Error editing user:', data.message);
            }
        })
        .catch(error => console.error('Error editing user:', error));
    }
    
    
    const addUserForm = document.getElementById('addUserForm');
    addUserForm.addEventListener('submit', function (event) {
        event.preventDefault(); // Prevent default form submission
        // Call the addUser function to handle the form submission
        addUser();
    });

    function addUser() {
        const email = document.getElementById('email').value;
        const username = document.getElementById('username').value;
        const password = document.getElementById('password').value;
        const roleId = document.getElementById('roleId').value;
        const image = document.getElementById('img').files[0];

        const formData = new FormData();
        formData.append("email", email);
        formData.append("username", username);
        formData.append("password", password);
        formData.append("roleId", roleId);
        formData.append("img", image);
        formData.append("action", "add-user");

        fetch('http://localhost/userAdminApi', {
            method: 'POST',
            body: formData,
        })
            .then(response => response.json())
            .then(data => {
                const displayMessage = data.message;

                if (data.status === 'success') {
                   
                    alert(displayMessage);
                    fetchUserTable();

                } else {
                 //   if (data.message.includes('username') || data.message.includes('email')) {
                       // alert('Username or email is already in use.');
                   // } else {
                      //  alert(displayMessage); // Display generic error message
                 //   }
                    fetchUserTable();
                    console.error('Error adding user:', data.message);
                }
            })
            .catch(error => console.error('Error adding user:', error));
    }


    // Add event listener to each delete user button
    const deleteUserButtons = document.querySelectorAll('.delete-user');
    deleteUserButtons.forEach(button => {
        button.addEventListener('click', function () {
            const userId = this.dataset.userId; // Corrected to retrieve 'data-user-id'
            deleteUser(userId); // Call deleteUser function with userId as argument
        });
    });

    function deleteUser(userId) {
        const formData = new FormData();
        formData.append("action", "delete-user");
        formData.append("userId", userId); // Append userId to FormData

        fetch('http://localhost/userAdminApi', {
            method: 'POST',
            body: formData,
        })
            .then(response => response.json())
            .then(data => {
                const displayMessage = data.message;
                if (data.status === 'success') {
                    
                    alert(displayMessage);
                    fetchUserTable();
                } else {
                   // alert(displayMessage);
                    fetchUserTable();
                    console.error('Error deleting user:', data.message);
                    
                }
            })
            .catch(error => console.error('Error deleting user:', error));
    }

});
