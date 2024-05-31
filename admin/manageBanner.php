<?php
session_start();
if (!isset($_SESSION['name'])) {
    header('Location: index.php');
}
?>

<!doctype html>
<html lang="en">

<head>
    <style>
        ion-icon {
            pointer-events: none;
            /* to disable original title of the element */
        }
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
        </div>
    </nav>
    <!-- card starts -->
    <div class="container mt-4">
        <h2>Manage Banners</h2>
        <h6>*First entry will be set as active on carousel</h6>
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
            Insert New Banner
        </button>
        <!-- Modal for New Banner -->
        <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="staticBackdropLabel">Add a New Banner</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="" method="post" enctype="multipart/form-data">
                            <div class="mb-3">
                                <label for="catname" class="form-label">Upload Banner Image</label>
                                <input type="file" class="form-control" name="file" required>
                            </div>
                            <div class="mb-3">
                                <label for="catname" class="form-label">Banner Text</label>
                                <input type="text" class="form-control" name="bannerText" placeholder="Banner Text" required>
                            </div>
                            <div class="mb-3">
                                <label for="catproducts" class="form-label">Banner Description</label>
                                <input type="text" class="form-control" name="bannerDesc" placeholder="Banner Description" required>
                            </div>
                            <div class="mb-3">
                                <button type="submit" class="btn btn-primary mb-3" name="insert">Insert</button>
                            </div>
                            <?php
                            //insert new banner code starts
                            if (isset($_POST['insert'])) {
                                include 'dbconfig.php';

                                //PHP Code for Category Image
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
                                } else {
                                    echo "<script>alert('Unable to upload image');
                                    window.location.href='panel.php'</script>";
                                }
                                $bannerClass = "carousel-item position-relative";
                                $bannerText = $_POST['bannerText'];
                                $bannerDesc = $_POST['bannerDesc'];
                                $myQuery = "INSERT INTO banners (bannerClass,bannerImg,bannerText,bannerDesc) 
                                VALUES('" . $bannerClass ." ','" . $bannerImg . "', '" . $bannerText . "', '" . $bannerDesc . "')";
                                $result = mysqli_query($conn, $myQuery);

                                if ($result) {
                                    echo "<script>alert(New Banner Inserted Successfully);
                                    window.location.href='manageBanner.php'</script>";
                                    // location.reload()
                                } else {
                                    echo "<script>alert(Error! Unable to upload new category);</script>";
                                }
                            }

                            ?>
                            <!-- insert new banner ends -->
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th class="col">Banner ID</th>
                        <th class="col">Banner Image</th>
                        <th class="col">Banner Text</th>
                        <th class="col">Banner Description</th>
                        <th class="col">Actions</th>
                    </tr>
                </thead>
                <tbody class="table-group-divider">
                    <!-- Fetch Category Table Inform form MySql Database table -->
                    <?php
                    //need not trigger action in this context, display directly
                    include 'dbconfig.php';
                    $result = mysqli_query($conn, "SELECT * FROM banners");
                    while ($bannerAray = mysqli_fetch_array($result)) :
                    ?>
                        <tr>
                            <td><?php echo $bannerAray['id'] ?></td>
                            <!-- we need to navigate to parent directory first -->
                            <td><img src="../<?php echo $bannerAray['bannerImg'] ?>" width='50px' height='50px;'></td>
                            <td><?php echo $bannerAray['bannerText'] ?></td>
                            <td><?php echo $bannerAray['bannerDesc'] ?></td>
                            <td>
                                <a href="editBanner.php?id=<?php echo $bannerAray['id']; ?>" title="Edit/Update"><ion-icon name="create-outline"></ion-icon>
                                <a href="deleteBanner.php?id=<?php echo $bannerAray['id']; ?>" title="Delete"><ion-icon name="trash-outline"></ion-icon>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </div>
    <!-- card ends -->
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
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>

</html>