<?php
// Fetch message ID from form submission
if(isset($_POST['message_id'])) {
    $message_id = $_POST['message_id'];

    // Perform further actions such as notifying the event planner admin
    // For demonstration purposes, let's just output a message
    echo "Delivery declined. Notification sent to event planner admin.";
} else {
    echo "Error: Message ID not provided.";
}
?>