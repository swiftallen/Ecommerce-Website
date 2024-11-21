<?php
session_start();
if (!isset($_SESSION['name'])) {
    header('Location: index.php');
} else {
    $curBanId = $_GET['bid'];
    if (is_numeric($curBanId) == true) {
        include '../dbconfig.php';
        $curBanResult = mysqli_query($conn, "SELECT * FROM banners WHERE bannerid=" . $curBanId);

        while ($catarray = mysqli_fetch_array($curBanResult)) {
            $curBanImg = $catarray['bannerimg'];
            $curBanText = $catarray['bannertext'];
            $curBanDesc = $catarray['bannerdesc'];
        }
    } else {
        header('Location: manageBan.php');
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
    <link href="images/admin_person.png" rel="icon">
    <title>Edit Banner|Admin Panel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
</head>

<body>
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
            <a class="navbar-brand" href="#"><?php if (isset($_SESSION['name'])) {
                echo $_SESSION['name'];
            } ?></a>
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
                <label for="categoryIdInputGrid" class="form-label">Banner ID</label>
                <input type="text" class="form-control" value="<?php echo $curBanId; ?>" id="categoryIdInputGrid"
                    disabled readonly>
            </div>
            <div class="mb-3">
                <label for="banImgFileGrid" class="form-label">Banner Image</label>
                <br>
                <img src="../<?php echo $curBanImg; ?>" width="60px" title="<?php echo $curBanImg; ?>">
                <label class="form-label">Current Image, Upload a New One to Overwrite</label>
                <br><br>
                <input type="file" class="form-control" name="file" id="banImgFileGrid">
                <br>
                <div class="form-floating">
                    <input type="text" class="form-control form-floating" placeholder="img/image.png"
                        id="imgPathInputGrid" value="<?php echo $curBanImg; ?>" name="imgPath">
                    <label for="imgPathInputGrid">Image Path</label>
                </div>
            </div>
            <div class="mb-3">
                <label for="bannerTextInputGrid" class="form-label">Banner Text</label>
                <input type="text" class="form-control" id="bannerTextInputGrid" name="bannertext"
                    value="<?php echo $curBanText; ?>">
            </div>
            <div class="mb-3">
                <label for="bannerDescInputGrid" class="form-label">Banner Text</label>
                <input type="text" class="form-control" id="bannerDescInputGrid" name="bannerdesc"
                    value="<?php echo $curBanDesc; ?>">
            </div>
            
            <div class="mb-3">
                <button type="submit" class="btn btn-primary mb-3" name="submit">Update</button>
            </div>
        </form>
        <?php
        if (isset($_POST['submit'])) {
            include '../dbconfig.php';

            function isImage($fileTmpLoc)
            {
                $finfo = finfo_open(FILEINFO_MIME_TYPE);
                $mimeType = finfo_file($finfo, $fileTmpLoc);
                finfo_close($finfo);

                if (strpos($mimeType, 'image/') === 0) {
                    return true;
                } else {
                    echo "<script>alert('Only image files are allowed!');</script>";
                }
            }
            if (!empty($_FILES['file']['name'])) {
                $fileName = $_FILES['file']['name'];
                $fileTmpLoc = $_FILES['file']['tmp_name'];
                if (isImage($fileTmpLoc)) {
                    $targetDir = "../img/";
                    $uploadPath = $targetDir . $fileName;

                    if (!move_uploaded_file($fileTmpLoc, $uploadPath)) {
                        echo "<script>alert('Unable to upload image.')</script>";
                        error_log('Failed to upload image.', 0);
                        $uploadPath = null;
                    } else {
                        $uploadPath = str_replace('../', '', $uploadPath);
                    }
                } else {
                    error_log('Only image files are allowed!', 0);
                    $uploadPath = null;
                }
            } else {
                $uploadPath = $_POST['imgPath'];
            }
            $uploadPath = $uploadPath ? mysqli_real_escape_string($conn, $uploadPath) : $currentCatImg;
            $bannertext = $_POST['bannertext'] ? mysqli_real_escape_string($conn, $_POST['bannertext']) : $curBanText;
            $bannerdesc = $_POST['bannerdesc'] ? mysqli_real_escape_string($conn, $_POST['bannerdesc']) : $curBanDesc;

            $updateQuery = "UPDATE banners SET bannerimg = '" . $uploadPath . "', bannertext='" . $bannertext . "', bannerdesc='" . $bannerdesc . "' WHERE bannerid=" . $curBanId;

            $updateBanResult = mysqli_query($conn, $updateQuery);
            $affected_rows = $conn->affected_rows;
            $conn->close();

            if (!empty($updateBanResult)) {
                if ($affected_rows === 0) {
                    echo "<script>alert('Banner $curBanId was not updated because the values were the same.');window.location.href='manageBr.php'</script></script>";
                } else {
                    echo "<script>alert('Banner $curBanId was Updated Successfully');window.location.href='manageBr.php'</script>";
                }
            } else {
                echo "<script>alert('Error! Unable to Update Banner $curBanId');window.location.href='manageBr.php'</script>";
            }
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN"
        crossorigin="anonymous"></script>
</body>

</html>