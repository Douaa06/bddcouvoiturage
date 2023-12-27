// Prepare an UPDATE statement with placeholders
$stmt = $conn->prepare("UPDATE your_table SET status = ? WHERE user_id = ?");

// Bind parameters to the statement
$stmt->bind_param("si", $new_status, $user_id);

// Execute the statement
$stmt->execute();

// Check for success
if ($stmt->affected_rows > 0) {
    echo "Update successful!";
} else {
    echo "Update failed!";
}

// Close the statement and connection
$stmt->close();

$row = $result->fetch_assoc()