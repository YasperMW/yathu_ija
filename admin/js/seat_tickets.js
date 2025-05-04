

// Function to open the modal
function openModal(ticketId) {
    // Get the modal element
    var modal = document.getElementById("myModal");

    // Get the confirm button inside the modal
    var confirmButton = document.getElementById("confirmCancelBtn");

    // Open the modal
    modal.style.display = "block";

    // Set the ticketId as a data attribute of the confirm button
    confirmButton.setAttribute("data-ticket-id", ticketId);

    // Add event listener to the confirm button
    confirmButton.addEventListener("click", function() {
        // When the confirm button is clicked, call the deleteTicket function
        deleteTicket(ticketId);
    });

    // Add event listener to close the modal when clicking outside of it
    window.addEventListener("click", function(event) {
        if (event.target == modal) {
            closeModal();
        }
    });
}

// Function to close the modal
function closeModal() {
    // Get the modal element
    var modal = document.getElementById("myModal");

    // Close the modal
    modal.style.display = "none";
}

// Function to delete the ticket
function deleteTicket(ticketId) {
    // Perform AJAX request to delete the ticket
    
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "delete_ticket.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.onreadystatechange = function () {
        if (xhr.readyState == 4 && xhr.status == 200) {
            // Reload the page after deletion
            window.location.reload();
        }
    };
    xhr.send("ticket_id=" + ticketId);
}

// Function to open the modal for updating ticket details
function openUpdateModal(ticketId) {
    // Get the update modal element
    var updateModal = document.getElementById("updateModal");
    
    // Get the input field for ticket ID
    var updateTicketIdInput = document.getElementById("updateTicketId");
    
    // Set the ticket ID in the hidden input field
    updateTicketIdInput.value = ticketId;
    
    // Open the update modal
    updateModal.style.display = "block";
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

// Function to handle form submission and update ticket details
document.getElementById("updateTicketForm").addEventListener("submit", function(event) {
    event.preventDefault(); // Prevent default form submission
    
    // Get form data
    var ticketId = document.getElementById("updateTicketId").value;
    var paymentStatus = document.getElementById("status").value; // Assuming payment status is being updated
    
    // Create XMLHttpRequest object
    var xhr = new XMLHttpRequest();
    
    // Configure the request
    xhr.open("POST", "update_payment_status.php", true); // Update the URL to your PHP script
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
  
    // Define the callback function
    xhr.onreadystatechange = function() {
      if (xhr.readyState === 4) {
        if (xhr.status === 200) {
          // Update successful, show response message
          openPopupModal(xhr.responseText); // Display success message in pop-up modal
          
          // Close the update modal
          closeUpdateModal();
        } else {
          // Handle error
          console.error("Failed to update payment status");
        }
      }
    };
  
    // Prepare the data to be sent in the request
    var formData = "ticket_id=" + encodeURIComponent(ticketId) + "&payment_status=" + encodeURIComponent(paymentStatus);
    
    // Send the request
    xhr.send(formData);
});


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

