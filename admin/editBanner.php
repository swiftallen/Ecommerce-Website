<?php
session_start();
if (!isset($_SESSION['name'])) {
    header('Location: index.php');
} else {
    $id = $_GET['id'];
    if (is_numeric($id) == true) {
        include 'dbconfig.php';
        $result = mysqli_query($conn, "SELECT * FROM banners WHERE id=" . $id);

        while ($bannerAray = mysqli_fetch_array($result)) {
            $bannerId = $bannerAray['id'];
            $bannerImg = $bannerAray['bannerImg'];
            $bannerText = $bannerAray['bannerText'];
            $bannerDesc = $bannerAray['bannerDesc'];
        }
    } else {
        header('Location: logout.php');
    }
}
?>

<!doctype html>
<html lang="en">

<head>
    <style>
    </style>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Favicon -->
    <link href=admin.png rel="icon">
    <title>Banner Section|Admin Panel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
</head>

<body>
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
            <a class="navbar-brand" href="#"><?php echo $_SESSION['name']; ?></a>
            <a class="navbar-brand" href="panel.php">Home<a>
                    <form class="d-flex" role="search" method="post">
                        <button class="btn btn-outline-success" type="submit" name="logout">Logout</button>
                    </form>
                    <?php
                    if (isset($_POST['logout'])) {
                        header('Location: logout.php');
                    }
                    ?>
        </div>
    </nav>

    <div class="container mt-4">
        <form action="" method="post" enctype='multipart/form-data'>
            <div class="mb-3">
                <label for="categoryId" class="form-label">Banner ID</label>
                <input type="text" class="form-control" value="<?php echo $bannerId; ?>" disabled readonly>
            </div>
            <div class="mb-3">
                <label for="categoryImage" class="form-label">Banner</label>
                <input type="text" class="form-control" value="<?php echo $bannerImg; ?>" name="bannerImg">
                <img src="../<?php echo $bannerImg; ?>" width="40px" height="40px">
                <label for="formFileMultiple" class="form-label">Upload New Image to Overwrite Previous Image</label>
                <input type="file" class="form-control" name="file">
            </div>
            <div class="mb-3">
                <label for="categoryName" class="form-label">Banner Text</label>
                <input type="text" class="form-control" name='bannerText' value="<?php echo $bannerText; ?>">
            </div>
            <div class="mb-3">
                <label for="categoryproducts" class="form-label">Banner Description</label>
                <input type="text" class="form-control" name='bannerDesc' value="<?php echo $bannerDesc; ?>">
            </div>
            <div class="mb-3">
                <button type="submit" class="btn btn-primary mb-3" name="submit">Update</button>
            </div>
        </form>
        <?php
        if (isset($_POST['submit'])) {
            include 'dbconfig.php';

            $bannerImg = $_POST['bannerImg']; //initialize variable, global local issue
            //image upload code starts
            if (!empty($_FILES['file']['name'])) {
                $name_of_image = $_FILES['file']['name'];
                $imgTmpLocation = $_FILES['file']['tmp_name'];
                $targetDir = '../img/';
                $imgUploadPath = $targetDir . $name_of_image; // img/mobile.jpg

                if (move_uploaded_file($imgTmpLocation, $imgUploadPath)) {
                    // use str_replace() of PHP to delete ../
                    // str_replace(find,replace,subject)
                    $imgUploadPath = str_replace('../', '', $imgUploadPath);
                    $bannerImg = $imgUploadPath;
                }
            }else{
                $bannerImg = $_POST['bannerImg']; //fallback to manual path entry
            }
            //image upload code ends

            $bannerText = $_POST["bannerText"];
            $bannerDesc = $_POST['bannerDesc'];

            $updateQuery = "UPDATE banners SET bannerImg = ?, bannerText = ?, bannerDesc = ? WHERE id = ?";
            $stmt = $conn->prepare($updateQuery);
            $stmt->bind_param("sssi", $bannerImg, $bannerText, $bannerDesc, $bannerId);
            // Set parameter values
            $bannerImg = $bannerImg; 
            $bannerText = $bannerText;
            $bannerDesc = $bannerDesc;
            $bannerId = $bannerId;
            // Execute the statement
            // $result = mysqli_query($conn, $updateQuery);

            if ($stmt->execute()) {
                echo "<script>alert('Banner Updated Successfully');
            window.location.href='manageBanner.php'</script>";
            } else {
                echo "<script>alert('Error! Unable to Update Banner');
            window.location.href='manageBanner.php'</script>";
            }
            $stmt->close();
            $conn->close();
        }
        ?>
    </div>
    <footer class="footer mt-5">
        <div class="container">
            <p class="text-center" style="background-color: aliceblue;">&#169; Copyright | All Rights Reserved
                <br>
                <a href='logout.php'>Logout</a>
            </p>
        </div>

    </footer>
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
</body>

</html>