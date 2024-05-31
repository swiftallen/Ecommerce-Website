<?php
session_start();
if (!isset($_SESSION['name'])) {
    header('Location: index.php');
} else {
    // $id = $_GET['id'];
    // custom code starts 
    require('dbconfig.php');

    if (isset($_GET['id'])) {
        // echo "<script>alert('In the loop');'</script>";

        $deleteQuery = "DELETE FROM products WHERE id =" . $_GET['id'];

        $result = mysqli_query($conn, $deleteQuery);

        // if ($result) {
        //     echo "<script>alert('Product Deleted Successfully');
        // window.location.href='managePro2.php'</script>";
        // } else {
        //     echo "<script>alert('Error! Unable to Delete Product');
        // window.location.href='managePro2.php'</script>";
        // }
    }
// }
    // custom code ends

    // if (is_numeric($id) == true) {
    //     include 'dbconfig.php';

    //     $deleteQuery = "DELETE FROM products WHERE id =" . $id;
    //     // "WHERE id" indicates
    //     $result = mysqli_query($conn, $deleteQuery);

    //     if ($result) {
    //         echo "<script>alert('Product Deleted Successfully');
    //     window.location.href='managePro2.php'</script>";
    //     } else {
    //         echo "<script>alert('Error! Unable to Delete Product');
    //     window.location.href='managePro2.php'</script>";
    //     }
    // } 
    else {
        header('Location: logout.php'); //destroy the session for unstipulated query for better security
    }
}
?>