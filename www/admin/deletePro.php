<?php
session_start();
if (!isset($_SESSION['name'])) {
    header('Location: index.php');
} else {
    if (isset($_GET['pid'])) {
        if ((is_numeric(value: $_GET['pid']))) {
            require '../dbconfig.php';

            $pid = $_GET['pid'];
            $deleteQuery = "DELETE FROM products WHERE pid =" . $pid;
            $deleteProResult = mysqli_query($conn, $deleteQuery);
            $conn->close();

            if (!empty($deleteProResult)) {
                echo "<script>alert('Product $pid Deleted Successfully');
                window.location.href='managePro.php'</script>";
            } else {
                error_log("Error! Unable to Delete Product $pid",0);
                echo "<script>alert('Error! Unable to Delete Product $pid');
                window.location.href='managePro.php'</script>";
            }
        }
    } else {
        header('Location: logout.php');
    }
}
?>