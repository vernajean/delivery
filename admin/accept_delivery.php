<?php
// Fetch message ID from form submission
if(isset($_POST['message_id'])) {
    $message_id = $_POST['message_id'];

    // Perform further actions such as notifying the event planner admin and redirecting to the delivery details page
    // For demonstration purposes, let's just redirect to the delivery details page
    header("Location: delivery_details.php?message_id=$message_id");
    exit;
} else {
    echo "Error: Message ID not provided.";
}
?>