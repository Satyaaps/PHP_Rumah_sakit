<?php
include "dbconnect.php";

if (isset($_GET['ido'])) {
    $id = $_GET['ido'];
    $collection = $database->selectCollection("pasien");
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