<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delivery Management System</title>
</head>
<body>
    <h2>Incoming Messages from Event Planner Admin</h2>
    <table border="1">
        <tr>
            <th>Subject</th>
            <th>Message</th>
            <th>Action</th>
        </tr>
        <?php
        // Fetch incoming messages from event planner admin (assuming stored in a database)
        // Replace this with your actual database connection and query
        include('../conn.php');
        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Fetch incoming messages from the database
        $sql = "SELECT message_id, message_subject, message_content FROM incoming_messages";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // Output data of each row
            while($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row["message_subject"] . "</td>";
                echo "<td>" . $row["message_content"] . "</td>";
                echo "<td>";
                echo "<form method='post' action='accept_delivery.php'><input type='hidden' name='message_id' value='" . $row["message_id"] . "'><input type='submit' value='Accept'></form>";
                echo "<form method='post' action='decline_delivery.php'><input type='hidden' name='message_id' value='" . $row["message_id"] . "'><input type='submit' value='Decline'></form>";
                echo "</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='3'>No incoming messages.</td></tr>";
        }
        $conn->close();
        ?>
    </table>
</body>
</html>
