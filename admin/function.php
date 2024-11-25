<?php
require_once 'config/database.php';

function validate($tableName)
{
    // List of allowed table names
    $allowedTables = ['users', 'post', 'categories'];

    // Check if the provided table name is in the list of allowed tables
    if (in_array($tableName, $allowedTables)) {
        return $tableName;
    } else {
        // Return a default table or handle the error
        trigger_error('Invalid table name provided.', E_USER_ERROR);
        return 'default_table'; // You might want to handle this differently
    }
}

function getCount($event, $conn)
{
    // Assuming validate() sanitizes or validates table name input to prevent SQL injection
    $table = validate($event);

    // Safely using the validated table name
    $query = "SELECT * FROM {$table}";

    // Execute the query and check for errors
    $result = mysqli_query($conn, $query);
    if ($result === false) {
        // Handle error (e.g., log it, notify someone, etc.)
        trigger_error('Query failed: ' . mysqli_error($conn), E_USER_ERROR);
        return 0;
    }

    // Calculate the number of rows
    $totalCount = mysqli_num_rows($result);
    return $totalCount;
}


