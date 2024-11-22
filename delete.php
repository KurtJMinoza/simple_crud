<?php
include "db_connect.php";

if (isset($_GET['id'])) {
    $id = intval($_GET['id']); // Sanitize the ID to ensure it's an integer

    // Prepare a DELETE query
    $stmt = mysqli_prepare($conn, "DELETE FROM sample WHERE id = ?");
    mysqli_stmt_bind_param($stmt, "i", $id);
    $sqlexecute =  mysqli_stmt_execute($stmt);
    // Execute the query
    if ($sqlexecute) {
        echo "Record deleted successfully.";
        header("Location: read.php"); // Redirect back to the list page
        exit();
    } else {
        echo "Error deleting record: " . mysqli_error($conn);
    }

    mysqli_stmt_close($stmt);
}

mysqli_close($conn);
?>
