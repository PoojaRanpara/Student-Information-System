<?php
// include database connection
include 'database.php';
 
try {
    $id=isset($_GET['id']) ? $_GET['id'] : die('ERROR: Record ID not found.');
 
    // delete query
    $query = "DELETE FROM student WHERE id = ?";
    $stmt = $con->prepare($query);
    $stmt->bindParam(1, $id);
     
    if($stmt->execute()){
        header('Location: index.php?action=deleted');
    }else{
        die('Unable to delete record.');
    }
}
 
// show error
catch(PDOException $exception){
    die('ERROR: ' . $exception->getMessage());
}
?>