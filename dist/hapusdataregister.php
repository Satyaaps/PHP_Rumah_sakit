<?php
include "dbconnect.php";

if (isset($_GET['idu'])) {
    $id = $_GET['idu'];
    $collection = $database->selectCollection("user");
    $result = $collection->deleteOne(['_id' => new MongoDB\BSON\ObjectID($id)]);

    if ($result->getDeletedCount() > 0) {
        // Redirect to the data display page
        header("Location: showregister.php");
        exit();
    } else {
        echo "Failed to delete data.";
    }
} else {
    echo "Invalid ID.";
}
?>