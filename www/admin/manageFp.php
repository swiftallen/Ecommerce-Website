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
        }

        i {
            font-size: 0.7rem;
        }

        #btn-back-to-top {
            position: fixed;
            bottom: 40px;
            right: 40px;
            display: none;
            z-index: 11;
            cursor: pointer;
        }

        #btn-back-to-top svg {
            width: 55px;
            height: auto;
        }
    </style>
    <!-- Favicon -->
    <link href="images/admin_person.png" rel="icon">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Featured Product Section|Admin Panel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">

</head>

<body>

    <nav class="navbar bg-body-tertiary">
        <div class="container-fluid">
            <a class="navbar-brand"><?php if (isset($_SESSION['name'])) {
                echo $_SESSION['name'];
            } ?></a>
            <a class="navbar-brand" href="panel.php">Home</a>
            <form class="d-flex" role="search" action="" method="post">
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
        <!-- Modal -->
        <!-- Button trigger modal -->
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
            Insert New Featured Product
        </button>

        <!-- Modal -->
        <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
            aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="staticBackdropLabel">Add a New Featured Product</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="" method="post" enctype="multipart/form-data">
                            <div class="mb-3">
                                <select class="form-select" aria-label="Category Selector" name="catid" required>
                                    <option selected disabled value="">Select a Category (id. Category Name)</option>
                                    <!-- Take Note! php post method fetches data from value attribute instead of text/content of the option tag -->
                                    <?php
                                    include '../dbconfig.php';

                                    $catListResult = mysqli_query($conn, "SELECT * FROM categories");
                                    while ($catArray = mysqli_fetch_array($catListResult)):
                                        ?>
                                        <option value="<?php echo $catArray['catid']; ?>">
                                            <?php echo $catArray['catid'] . '. ' . $catArray['catname']; ?>
                                        </option>
                                        <!-- remember to insert corresponding category id instead of category name in the cat id field/column of product table -->
                                    <?php endwhile;
                                    $conn->close();
                                    ?>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="pimg" class="form-label">Upload Featured Product Image</label>
                                <input class="form-control" type="file" id="pimg" name="file" required>
                            </div>
                            <div class="mb-3">
                                <label for="fpname" class="form-label">Featured Product Name</label>
                                <input type="text" class="form-control" id="fpname" name="fpname" required>
                            </div>
                            <div class="mb-3">
                                <label for="fpnewprice" class="form-label">Featured Product New Price</label>
                                <input type="number" min="0" step=".01" class="form-control" id="fpnewprice"
                                    name="fpnewprice" required>
                            </div>
                            <div class="mb-3">
                                <label for="fpoldprice" class="form-label">Featured Product Old Price</label>
                                <input type="number" min="0" step=".01" class="form-control" id="fpoldprice"
                                    name="fpoldprice" required>
                            </div>
                            <div class="mb-3">
                                <label for="fpratings" class="form-label">Featured Product Ratings</label>
                                <input type="number" step=".5" min="0" max="5" class="form-control" id="fpratings"
                                    name="fpratings" required>
                            </div>
                            <div class="mb-3">
                                <label for="reviews" class="form-label">Featured Product Reviews</label>
                                <input type="number" min="0" class="form-control" id="reviews" name="reviews" required>
                            </div>
                            <div class="mb-3">
                                <button type="submit" class="btn btn-primary mb-3" name="insert">Insert</button>
                            </div>
                        </form>
                        <?php
                        if (isset($_POST['insert'])) {
                            include '../dbconfig.php';

                            $catid = $_POST['catid'] ? mysqli_real_escape_string($conn, $_POST['catid']) : '';

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
                                error_log("No file was ever sent by user. Image uploading skipped.", 0);
                                $uploadPath = null;
                            }

                            $uploadPath = mysqli_real_escape_string($conn, $uploadPath);
                            $fpname = $_POST['fpname'] ? mysqli_real_escape_string($conn, $_POST['fpname']) : null;
                            $fpnewprice = $_POST['fpnewprice'] ? mysqli_real_escape_string($conn, $_POST['fpnewprice']) : null;
                            if ($fpnewprice < 0) {
                                error_log('FPnewprice cannot be lower than zero', 0);
                                $fpnewprice = null;
                            }
                            $fpoldprice = $_POST['fpoldprice'] ? mysqli_real_escape_string($conn, $_POST['fpoldprice']) : '';
                            if ($fpoldprice < 0) {
                                error_log('FPOldprice cannot be lower than zero', 0);
                                $fpoldprice = null;
                            }

                            function starColumns($ratings)
                            {
                                $totalStars = 5;
                                $ratingsCombo = [];

                                for ($i = 1; $i <= $totalStars; $i++) {
                                    if ($ratings >= 1) {
                                        $ratingsCombo[] = $i == 1 ? mysqli_real_escape_string($GLOBALS['conn'], "fa fa-star text-primary mr-1") : mysqli_real_escape_string($GLOBALS['conn'], "fa fa-star text-primary mr-1");
                                        $ratings--;
                                    } elseif ($ratings >= 0.5) {
                                        $ratingsCombo[] = $i == 1 ? mysqli_real_escape_string($GLOBALS['conn'], "fa fa-star-half-alt text-primary mr-1") : mysqli_real_escape_string($GLOBALS['conn'], "fa fa-star-half-alt text-primary mr-1");
                                        $ratings -= .5;
                                    } else {
                                        $ratingsCombo[] = $i == 1 ? mysqli_escape_string($GLOBALS['conn'], "far fa-star text-primary mr-1") : mysqli_escape_string($GLOBALS['conn'], "far fa-star text-primary mr-1");
                                    }
                                }
                                return $ratingsCombo;
                            }
                            if ($_POST['fpratings']) {
                                $fpratings = $_POST['fpratings'];
                                if (is_numeric($fpratings)) {
                                    if ($fpratings >= 0 and $fpratings <= 5) {
                                        $fpratings = round($fpratings * 2) / 2;
                                        $fpratings = starColumns($fpratings);
                                    } else {
                                        $fpratings = null;
                                        error_log("Rating value $fpratings is out of range.");
                                    }
                                } else {
                                    $fpratings = null;
                                    error_log("Rating value must be numeric.", 0);
                                }
                            } else {
                                $fpratings = null;
                                error_log("Rating value cannot be empty.");
                            }

                            $reviews = mysqli_real_escape_string($conn, $_POST['reviews']);
                            if ($reviews < 0) {
                                error_log('Rating cannot be lower than zero');
                                $reviews = null;
                            }

                            if (empty($catid) or empty($uploadPath) or empty($fpname) or empty($fpnewprice) or empty($fpoldprice) or empty($fpratings[0]) or empty($fpratings[1]) or empty($fpratings[2]) or empty($fpratings[3]) or empty($fpratings[4]) or empty($reviews)) {
                                $invalidEntry = true;
                                echo "<script>alert('Incomplete or invalid form entry. Please fill up all required fields and satisfy all field requirements.');</script>";
                            }

                            if (!$invalidEntry) {
                                $insertQuery = "INSERT INTO featuredproduct (catid, img, name, newprice, oldprice, star_rating_1, star_rating_2, star_rating_3, star_rating_4, star_rating_5, reviews) VALUES ('" . $catid . "','" . $uploadPath . "','" . $fpname . "','" . $fpnewprice . "','" . $fpoldprice . "','" . $fpratings[0] . "','" . $fpratings[1] . "','" . $fpratings[2] . "','" . $fpratings[3] . "','" . $fpratings[4] . "','" . $reviews . "')";
                                $insertFProResult = mysqli_query($conn, $insertQuery);
                                $conn->close();
                            } else {
                                error_log('Incomplete form entry. ', 0);
                            }

                            if (!empty($insertFProResult)) {
                                echo "<script>
                                    alert('New Featured Product Inserted Successfully');
                                    window.location.href='manageFp.php';
                                </script>";
                            } else {
                                echo "<script>
                                    alert('ERROR! UNABLE TO ADD NEW FEATURED PRODUCT!');
                                    window.location.href='panel.php';
                                </script>";
                            }
                        }
                        ?>
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
                        <th scope="col">Product ID</th>
                        <th scope="col">Category ID</th>
                        <th scope="col">Product Image</th>
                        <th scope="col">Product Name</th>
                        <th scope="col">Product New Price</th>
                        <th scope="col">Product Old Price</th>
                        <th scope="col">Rating</th>
                        <th scope="col">No. of Reviews</th>
                        <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody class="table-group-divider">
                    <!-- starts fetching cat info fr mysql table -->
                    <?php
                    include '../dbconfig.php';

                    $fpResult = mysqli_query($conn, "SELECT * FROM featuredproduct");

                    while ($fpArray = mysqli_fetch_array($fpResult)):
                        ?>
                        <tr>
                            <td><?php echo $fpArray['id'] ?></td>
                            <td><?php echo $fpArray['catid'] ?></td>
                            <td><img src="../<?php echo $fpArray['img'] ?>" width="60px"></td>
                            <td><?php echo $fpArray['name'] ?></td>
                            <td><?php echo 'RM ' . $fpArray['newprice'] ?></td>
                            <td><?php echo 'RM ' . $fpArray['oldprice'] ?></td>
                            <td>
                                <i class="<?php echo $fpArray['star_rating_1'] ?>"></i>
                                <i class="<?php echo $fpArray['star_rating_2'] ?>"></i>
                                <i class="<?php echo $fpArray['star_rating_3'] ?>"></i>
                                <i class="<?php echo $fpArray['star_rating_4'] ?>"></i>
                                <i class="<?php echo $fpArray['star_rating_5'] ?>"></i>
                                <!-- use i tag because resizing small class in css won't work -->
                            </td>
                            <td><?php echo $fpArray['reviews'] ?></td>
                            <td>
                                <a href="editFp.php?fpid=<?php echo $fpArray['id']; ?>" title="Edit/Update"><ion-icon
                                        name="create-outline"></a></ion-icon>
                                <a href="#" title="Delete" onclick="confirmDelete()"><ion-icon
                                        name="trash-outline"></ion-icon></a>
                                <script>
                                    // Function to handle the deletion confirmation
                                    function confirmDelete() {
                                        var userConfirmed = confirm("Are you sure you want to delete <?php echo $fpArray['id'] . '. ' . $fpArray['name']; ?>?");

                                        if (userConfirmed) {
                                            window.location.href = "deleteFp.php?fpid=<?php echo $fpArray['id']; ?>";
                                        } else {
                                            console.log("Deletion canceled.");
                                        }
                                    }
                                </script>
                            </td>
                        </tr>
                    <?php endwhile;
                    $conn->close(); ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Scroll to Top Button -->
    <div id="btn-back-to-top" title="back to the top"></div>
    <script>
        // Function to load and inject external SVG into the <svg> tag
        function loadSVG() {
            fetch('../img/rocket.svg') // Replace with the path to your external SVG file
                .then(response => response.text()) // Get SVG as text
                .then(svg => {
                    const svgElement = document.getElementById('btn-back-to-top');
                    svgElement.innerHTML = svg; // Inject the external SVG into the <svg> tag
                })
                .catch(error => {
                    console.error('Error loading SVG:', error);
                });
        }

        // Call the function to load the SVG content
        loadSVG();
    </script>
    <script>
        // code responsible for scroll to top functionality
        //Get the button
        let mybutton = document.getElementById("btn-back-to-top");

        // When the user scrolls down 20px from the top of the document, show the button
        window.onscroll = function () {
            scrollFunction();
        };

        function scrollFunction() {
            if (
                document.body.scrollTop > 20 ||
                document.documentElement.scrollTop > 20
            ) {
                mybutton.style.display = "block";
            } else {
                mybutton.style.display = "none";
            }
        }
        // When the user clicks on the button, scroll to the top of the document
        mybutton.addEventListener("click", backToTop);

        function backToTop() {
            document.body.scrollTop = 0;
            document.documentElement.scrollTop = 0;
        }
    </script>

    <footer class="footer mt-5">
        <div class="container">
            <p class="text-center" style="background-color: aliceblue;">
                &#169; Copyright | All Rights Reserved | <span id="footerYear"></span>
                <script>
                    document.getElementById('footerYear').innerHTML = new Date().getFullYear();
                </script>
                <br>
                <a href="logout.php">Logout</a>
            </p>
        </div>
    </footer>
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
</body>

</html>