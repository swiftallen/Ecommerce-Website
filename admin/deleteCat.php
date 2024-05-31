<?php
session_start();
if (!isset($_SESSION['name'])) {
    header('Location: index.php');
} else {
    $id = $_GET['id'];
    if (is_numeric($id) == true) {
        include 'dbconfig.php';

        $deleteQuery = "DELETE FROM categories WHERE catid=" . $id;

        $result = mysqli_query($conn, $deleteQuery);

        if ($result) {
            echo "<script>alert('Category Deleted Successfully');
        window.location.href='manageCat.php'</script>";
        } else {
            echo "<script>alert('Error! Unable to Delete Category');
        window.location.href='manageCat.php'</script>";
        }
    } else {
        header('Location: logout.php');
    }
}
?>