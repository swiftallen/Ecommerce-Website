<?php
session_start();
if (!isset($_SESSION['name'])) {
    header('Location: index.php');
} else {
    if (isset($_GET['cid'])) {
        if (is_numeric(value: $cid) == true) {
            include '../dbconfig.php';
            
            $cid = $_GET['cid'];
            $deleteQuery = "DELETE FROM categories WHERE catid=" . $cid;
            $deleteCatResult = mysqli_query($conn, $deleteQuery);
            $conn->close();

            if (!empty($deleteCatResult)) {
                echo "<script>alert('Category $cid Deleted Successfully');
                window.location.href='manageCat.php'</script>";
            } else {
                error_log("Error! Unable to Delete Category $cid",0);
                echo "<script>alert('Error! Unable to Delete Category $cid');
                window.location.href='manageCat.php'</script>";
            }
        }
    } else {
        header('Location: logout.php');
    }
}
?>