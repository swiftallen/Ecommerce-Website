<?php
session_start();
if (!isset($_SESSION['name'])) {
    header('Location: index.php');
} else {
    if (isset($_GET['fpid'])) {
        if ((is_numeric(value: $_GET['fpid']))) {
            require '../dbconfig.php';

            $fpid = $_GET['fpid'];
            $deleteQuery = "DELETE FROM featuredproduct WHERE id =" . $fpid;
            $deleteFPResult = mysqli_query($conn, $deleteQuery);
            $conn->close();

            if (!empty($deleteFPResult)) {
                echo "<script>alert('Featured Product $fpid Deleted Successfully');
                window.location.href='manageFp.php'</script>";
            } else {
                error_log("Error! Unable to Delete Featured Product $fpid",0);
                echo "<script>alert('Error! Unable to Delete Featured Product $fpid');
                window.location.href='manageFp.php'</script>";
            }
        }
    } else {
        header('Location: logout.php');
    }
}
?>