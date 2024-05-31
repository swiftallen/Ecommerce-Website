<?php
session_start();
if (!isset($_SESSION['name'])) {
    header('Location: index.php');
} else {
    $id = $_GET['id'];
    if (is_numeric($id) == true) {
        include 'dbconfig.php';
        $result = mysqli_query($conn, "SELECT * FROM featuredproduct WHERE id=" . $id);

        while ($fpArray = mysqli_fetch_array($result)) {
            $id = $fpArray['id']; //product ID or pid
            $catid = $fpArray['catid'];
            $img = $fpArray['img'];
            $name = $fpArray['name'];
            $newprice = $fpArray['newprice'];
            $oldprice = $fpArray['oldprice'];
            $star_rating1 = $fpArray['star_rating1'];
            $star_rating2 = $fpArray['star_rating2'];
            $star_rating3 = $fpArray['star_rating3'];
            $star_rating4 = $fpArray['star_rating4'];
            $star_rating5 = $fpArray['star_rating5'];
            $reviews = $fpArray['reviews'];
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
    <title>Edit Product|Admin Panel</title>
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
                <label for="id" class="form-label">Product ID</label>
                <input type="text" class="form-control" value="<?php echo $id; ?>" disabled readonly>
            </div>
            <!-- <div class="mb-3">
                <label for="catid" class="form-label">Category ID</label>
                <input type="text" class="form-control" value="<?php echo $catid, ' test'; ?>">
            </div> -->
            <div class="mb-3"><select class="form-select" aria-label="Default select example" name='categoryname' required>
                    <option value='<?php echo $catid ?>'>
                        Choose Category (current catid is <?php echo $catid ?>)
                    </option>
                    <?php
                    //enable management thru database, php code is invisible, it's more secure
                    include 'dbconfig.php';

                    $result = mysqli_query($conn, "SELECT * FROM categories");
                    $count = 1;
                    while ($catArray = mysqli_fetch_array($result)) :
                    ?>
                        <option value="<?php echo $count ?>">
                            <?php echo $catArray['catname']?>
                        </option>
                    <?php
                        $count++;
                    endwhile;
                    $conn->close();
                    ?>
                </select>
            </div>
            <div class="mb-3">
                <label for="img" class="form-label">Product Image</label>
                <input type="text" class="form-control" value="<?php echo $img; ?>" name="img">
                <img src="../<?php echo $img; ?>" width="40px" height="40px">
                <label for="formFileMultiple" class="form-label">Upload New Image to Overwrite Previous Image</label>
                <input type="file" class="form-control" name="file">
            </div>
            <div class="mb-3">
                <label for="name" class="form-label">Product Name</label>
                <input type="text" class="form-control" name='name' value="<?php echo $name; ?>">
            </div>
            <div class="mb-3">
                <label for="newprice" class="form-label">Product New Price</label>
                <input type="text" class="form-control" name='newprice' value="<?php echo $newprice; ?>">
            </div>
            <div class="mb-3">
                <label for="oldprice" class="form-label">Product Old Price</label>
                <input type="text" class="form-control" name='oldprice' value="<?php echo $oldprice; ?>">
            </div>
            <div class="mb-3">
                <label for="star_rating1" class="form-label">Enter Star Rating 1</label>
                <select class="form-select" aria-label="star_rating1 with default selection" name="star_rating1" required>
                    <option value='<?php echo $star_rating1; ?>'>
                        current value:
                        <?php
                        if ($star_rating1 == 'fa fa-star text-primary mr-1') {
                            echo 'Full Star';
                        } elseif ($star_rating1 == 'fa fa-star-half-alt text-primary mr-1') {
                            echo 'Half Star';
                        } elseif ($star_rating1 == 'far fa-star text-primary mr-2') {
                            echo 'Blank Star';
                        } else {
                            echo 'database contains invalid value';
                        }
                        ?>
                    </option>
                    <option value="fa fa-star text-primary mr-1">Full Star</option>
                    <option value="fa fa-star-half-alt text-primary mr-1 ">Half Star</option>
                    <option value="far fa-star text-primary mr-2">Blank Star</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="star_rating1" class="form-label">Enter Star Rating 2</label>
                <select class="form-select" aria-label="star_rating with default selection" name="star_rating2" required>
                    <option value='<?php echo $star_rating2; ?>'>
                        current value:
                        <?php
                        if ($star_rating2 == 'fa fa-star text-primary mr-1') {
                            echo 'Full Star';
                        } elseif ($star_rating2 == 'fa fa-star-half-alt text-primary mr-1') {
                            echo 'Half Star';
                        } elseif ($star_rating2 == 'far fa-star text-primary mr-2') {
                            echo 'Blank Star';
                        } else {
                            echo 'database contains invalid value';
                        }
                        ?>
                    </option>
                    <option value="fa fa-star text-primary mr-1">Full Star</option>
                    <option value="fa fa-star-half-alt text-primary mr-1 ">Half Star</option>
                    <option value="far fa-star text-primary mr-2">Blank Star</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="star_rating3" class="form-label">Enter Star Rating 3</label>
                <select class="form-select" aria-label="star_rating with default selection" name="star_rating3" required>
                    <option value='<?php echo $star_rating3; ?>'>
                        current value:
                        <?php
                        if ($star_rating3 == 'fa fa-star text-primary mr-1') {
                            echo 'Full Star';
                        } elseif ($star_rating3 == 'fa fa-star-half-alt text-primary mr-1') {
                            echo 'Half Star';
                        } elseif ($star_rating3 == 'far fa-star text-primary mr-2') {
                            echo 'Blank Star';
                        } else {
                            echo 'database contains invalid value';
                        }
                        ?>
                    </option>
                    <option value="fa fa-star text-primary mr-1">Full Star</option>
                    <option value="fa fa-star-half-alt text-primary mr-1 ">Half Star</option>
                    <option value="far fa-star text-primary mr-2">Blank Star</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="star_rating1" class="form-label">Enter Star Rating 4</label>
                <select class="form-select" aria-label="star_rating with default selection" name="star_rating4" required>
                    <option value='<?php echo $star_rating4; ?>'>
                        current value:
                        <?php
                        if ($star_rating4 == 'fa fa-star text-primary mr-1') {
                            echo 'Full Star';
                        } elseif ($star_rating4 == 'fa fa-star-half-alt text-primary mr-1') {
                            echo 'Half Star';
                        } elseif ($star_rating4 == 'far fa-star text-primary mr-2') {
                            echo 'Blank Star';
                        } else {
                            echo 'database contains invalid value';
                        }
                        ?>
                    </option>
                    <option value="fa fa-star text-primary mr-1">Full Star</option>
                    <option value="fa fa-star-half-alt text-primary mr-1 ">Half Star</option>
                    <option value="far fa-star text-primary mr-2">Blank Star</option>
                </select>
                <div class="mb-3">
                    <label for="star_rating1" class="form-label">Enter Star Rating 5</label>
                    <select class="form-select" aria-label="star_rating with default selection" name="star_rating5" required>
                        <option value='<?php echo $star_rating5; ?>'>
                            current value:
                            <?php
                            if ($star_rating5 == 'fa fa-star text-primary mr-1') {
                                echo 'Full Star';
                            } elseif ($star_rating5 == 'fa fa-star-half-alt text-primary mr-1') {
                                echo 'Half Star';
                            } elseif ($star_rating5 == 'far fa-star text-primary mr-2') {
                                echo 'Blank Star';
                            } else {
                                echo 'database contains invalid value';
                            }
                            ?>
                        </option>

                        <option value="fa fa-star text-primary mr-1">Full Star</option>
                        <option value="fa fa-star-half-alt text-primary mr-1 ">Half Star</option>
                        <option value="far fa-star text-primary mr-2">Blank Star</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="reviews" class="form-label">Reviews</label>
                    <input type="text" class="form-control" name='reviews' value="<?php echo $reviews; ?>">
                </div>
                <div class="mb-3">
                    <button type="submit" class="btn btn-primary mb-3" name="submit">Update</button>
                </div>
        </form>
        <?php
        if (isset($_POST['submit'])) {
            include 'dbconfig.php';

            $categoryname = $_POST['categoryname'];
            $img = $_POST['img']; //initialize variable, global local issue
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
                    $img = $imgUploadPath;
                }
            } else {
                $img = $_POST['img']; //fallback to manual path entry
            }
            //image upload code ends

            $name = $_POST['name'];
            $oldprice = $_POST['oldprice'];
            $newprice = $_POST['newprice'];
            $star_rating1 = $_POST['star_rating1'];
            $star_rating2 = $_POST['star_rating2'];
            $star_rating3 = $_POST['star_rating3'];
            $star_rating4 = $_POST['star_rating4'];
            $star_rating5 = $_POST['star_rating5'];
            $reviews = $_POST['reviews'];

            $updateQuery = "UPDATE featuredproduct SET catid = '" . $categoryname . "', img = '" . $img . "',
            name='" . $name . "', newprice = '" . $newprice . "',
            star_rating1 = '" . $star_rating1 . "', star_rating2 = '" . $star_rating2 . "', 
            star_rating3 = '" . $star_rating3 . "', star_rating4 = '" . $star_rating4 . "', 
            star_rating5 = '" . $star_rating5 . "',reviews = '" . $reviews . "' WHERE id=" . $id;

            $result = mysqli_query($conn, $updateQuery);

            if ($result) {
                echo "<script>alert('Featured Product Updated Successfully');
            window.location.href='manageFeatured.php'</script>";
            } else {
                echo "<script>alert('Error! Unable to Featured Update Product');
            window.location.href='manageFeatured.php'</script>";
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
</body>

</html>