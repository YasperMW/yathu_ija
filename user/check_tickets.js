   // Get the modal
    var modal = document.getElementById("myModal");

    function openModal(ticketId) {
      
    modal.style.display = "block";
    // Set the ticket ID as a data attribute of the confirmation button
    document.getElementById('confirmCancelBtn').setAttribute('data-ticket-id', ticketId);

      // Disable scrolling on the body
      document.body.style.overflow = 'hidden';
}

    // When the user clicks anywhere outside of the modal, close it
    window.onclick = function(event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
    }

    // Function to close the modal
    function closeModal() {
        modal.style.display = "none";
    }

    // Function to cancel the ticket
    document.getElementById('confirmCancelBtn').addEventListener('click', function() {
        var ticketId = this.getAttribute('data-ticket-id');
        // Send an AJAX request to delete the ticket from the database
        var xhr = new XMLHttpRequest();
        xhr.open("POST", "cancel_seat_ticket.php", true);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xhr.onreadystatechange = function() {
            if (xhr.readyState === 4 && xhr.status === 200) {
                // Reload the page after successful cancellation
                window.location.reload();
            }
        };
        xhr.send("ticket_id=" + ticketId);
        // Close the modal
        modal.style.display = "none";
    });


    // Function to cancel the Hire_ticket
    document.getElementById('confirmCancelBtn').addEventListener('click', function() {
        var ticketId = this.getAttribute('data-ticket-id');
        // Send an AJAX request to delete the ticket from the database
        var xhr = new XMLHttpRequest();
        xhr.open("POST", "cancel_Hire_ticket.php", true);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xhr.onreadystatechange = function() {
            if (xhr.readyState === 4 && xhr.status === 200) {
                // Reload the page after successful cancellation
                window.location.reload();
            }
        };
        xhr.send("ticket_id=" + ticketId);
        // Close the modal
        modal.style.display = "none";
    });
    