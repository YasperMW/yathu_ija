// Function to open the modal for updating hire receipt
function openUpdateModal(hireReceiptId) {
    var updateModal = document.getElementById('updateModal');
    updateModal.style.display = 'block';
    
    // Set the hire receipt ID in the hidden input field
    document.getElementById('updateTicketId').value = hireReceiptId;
}

// Function to open the modal for deleting hire receipt
function openDeleteModal(hireReceiptId) {
    var deleteModal = document.getElementById('myModal');
    deleteModal.style.display = 'block';

    // Set the hire receipt ID as a data attribute of the confirm button
    var confirmDeleteBtn = document.getElementById('confirmDeleteBtn');
    confirmDeleteBtn.setAttribute('data-hire-receipt-id', hireReceiptId);

    // Add event listener to the confirm button
    confirmDeleteBtn.addEventListener('click', function() {
        deleteHireReceipt(hireReceiptId);
    });
}

// Function to close modal
function closeModal() {
    var modal = document.getElementById('myModal');
    modal.style.display = 'none';
}

// Function to delete hire receipt
function deleteHireReceipt(hireReceiptId) {
    // AJAX call to delete the hire receipt
    var xhr = new XMLHttpRequest();
    xhr.open('POST', 'delete_receipt.php', true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.onreadystatechange = function () {
        if (xhr.readyState == 4 && xhr.status == 200) {
            // Reload the page after deletion
            window.location.reload();
        }
    };
    xhr.send('hire_receipt_id=' + hireReceiptId);
}

// Function to handle form submission and update hire receipt details
document.getElementById('updateTicketForm').addEventListener('submit', function(event) {
    event.preventDefault(); // Prevent default form submission
    
    // Get form data
    var hireReceiptId = document.getElementById('updateTicketId').value;
    var paymentStatus = document.getElementById('status').value; // Assuming receipt status is being updated
    
    // Create XMLHttpRequest object
    var xhr = new XMLHttpRequest();
    
    // Configure the request
    xhr.open('POST', 'update_receipt_status.php', true); // Update the URL to your PHP script
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
  
    // Define the callback function
    xhr.onreadystatechange = function() {
        if (xhr.readyState === 4) {
            if (xhr.status === 200) {
                // Update successful, show response message
                openPopupModal(xhr.responseText); // Display success message in pop-up modal
                closeModal(); // Close the update modal
            } else {
                // Handle error
                console.error('Failed to update receipt status');
            }
        }
    };
  
    // Prepare the data to be sent in the request
    var formData = 'hire_receipt_id=' + encodeURIComponent(hireReceiptId) + '&receipt_status=' + encodeURIComponent(paymentStatus);
    
    // Send the request
    xhr.send(formData);
});

// Add event listener to close the modal if the user clicks outside of it
window.onclick = function(event) {
    var modal = document.getElementById('myModal');
    if (event.target == modal) {
        modal.style.display = 'none';
    }
}


// Function to open the pop-up modal and display the message
function openPopupModal(message) {
    var popupModal = document.getElementById("popupModal");
    var popupMessage = document.getElementById("popupMessage");
    popupMessage.innerHTML = message;
    popupModal.style.display = "block";

    // Add a button to close the pop-up modal
    var closeButton = document.createElement("button");
    closeButton.textContent = "OK";
    closeButton.onclick = closePopupModal;
    popupModal.appendChild(closeButton);
}

// Function to close the pop-up modal
function closePopupModal() {
    var popupModal = document.getElementById("popupModal");
    popupModal.style.display = "none";
    // Remove the button from the pop-up modal after closing
    var closeButton = popupModal.querySelector("button");
    if (closeButton) {
        popupModal.removeChild(closeButton);
    }
    // Reload the page
    window.location.reload();
}

// Function to close the update modal
function closeUpdateModal() {
    // Get the update modal element
    var updateModal = document.getElementById("updateModal");
    
    // Close the update modal
    updateModal.style.display = "none";
  }
  // Add event listener to the "Cancel" button
document.getElementById("cancelUpdateBtn").addEventListener("click", function() {
  // Close the update modal
  closeUpdateModal();
});

