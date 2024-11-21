<?php
session_start();
if (!isset($_SESSION['name'])) {
    header('Location: index.php');
} else {
    if (isset($_GET['bid'])) {
        if ((is_numeric(value: $_GET['bid']))) {
            require '../dbconfig.php';

            $bid = $_GET['bid'];
            $deleteQuery = "DELETE FROM banners WHERE bannerid =" . $bid;
            $deleteBanResult = mysqli_query($conn, $deleteQuery);
            $conn->close();

            if (!empty($deleteBanResult)) {
                echo "<script>alert('Banner $bid Deleted Successfully');
                window.location.href='manageBr.php'</script>";
            } else {
                error_log("Error! Unable to Delete Banner $bid",0);
                echo "<script>alert('Error! Unable to Delete Banner $bid');
                window.location.href='managePro.php'</script>";
            }
        }
    } else {
        header('Location: logout.php');
    }
}
?>