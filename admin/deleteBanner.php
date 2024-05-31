<?php
session_start();
if (!isset($_SESSION['name'])) {
    header('Location: index.php');
} else {
    $id = $_GET['id'];
    if (is_numeric($id) == true) {
        include 'dbconfig.php';

        $deleteQuery = "DELETE FROM banners WHERE id=" . $id;

        $result = mysqli_query($conn, $deleteQuery);

        if ($result) {
            echo "<script>alert('Banner Deleted Successfully');
        window.location.href='manageBanner.php'</script>";
        } else {
            echo "<script>alert('Error! Unable to Delete Banner');
        window.location.href='manageBanner.php'</scrBanner>";
        }
    } else {
        header('Location: logout.php');
    }
}
?>