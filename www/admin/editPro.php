<?php
session_start();
if (!isset($_SESSION['name'])) {
    header('Location: index.php');
} else {
    $curPId = $_GET['pid'];
    if (is_numeric($curPId) == true) {
        include '../dbconfig.php';

        $curProResult = mysqli_query($conn, "SELECT * FROM products WHERE pid=" . $curPId);

        while ($prArray = mysqli_fetch_array($curProResult)) {
            $curCatId = $prArray['catid'];
            $curPImg = $prArray['pimg'];
            $curPName = $prArray['pname'];
            $curPNewPrice = $prArray['pnewprice'];
            $curPOldPrice = $prArray['poldprice'];
            $curStar1 = $prArray['star_rating_1'];
            $curStar2 = $prArray['star_rating_2'];
            $curStar3 = $prArray['star_rating_3'];
            $curStar4 = $prArray['star_rating_4'];
            $curStar5 = $prArray['star_rating_5'];
            $curPReviews = $prArray['reviews'];
            $conn->close();
        }
    } else {
        header('Location: managePro.php');
    }
}
?>

<!doctype html>
<html lang="en">

<head>
    <style>
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
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Favicon -->
    <link href="images/admin_person.png" rel="icon">
    <title>Edit Product|Admin Panel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
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
                <label for="id" class="form-label">Product ID</label>
                <input type="text" class="form-control" value="<?php echo $curPId; ?>" disabled>
            </div>
            <div class="mb-3"><select class="form-select" aria-label="Category Selector" name='pcatid'>
                    <option value='<?php echo $curCatId ?>' disabled>
                        <?php
                        include '../dbconfig.php';
                        $curCatResult = mysqli_query($conn, "SELECT * FROM categories WHERE catid='$curCatId'");
                        while ($catArray = mysqli_fetch_array($curCatResult)) {
                            $curCatName = $catArray['catname'];
                        }
                        $conn->close();
                        ?>
                        Choose a Category (current category is <?php echo $curCatId . '. ' . $curCatName; ?>)
                    </option>
                    <?php
                    include '../dbconfig.php';

                    $catListResult = mysqli_query($conn, "SELECT * FROM categories");
                    $count = 1;
                    while ($catArray = mysqli_fetch_array($catListResult)):
                        ?>
                        <option value="<?php echo $count ?>" <?php if ($catArray['catid'] === $curCatId) {
                               echo "selected";
                           } ?>>
                            <!-- <?php echo $catArray['catname'] ?> -->
                            <?php echo $catArray['catid'] . '. ' . $catArray['catname']; ?>
                        </option>
                        <?php
                        $count++;
                    endwhile;
                    $conn->close();
                    ?>
                </select>
            </div>
            <div class="mb-3">
                <label for="pImgFileGrid" class="form-label">Product Image</label>
                <br>
                <img src="../<?php echo $curPImg; ?>" width="60px" title="<?php echo $curPImg; ?>">
                <label class="form-label">Current Image, Upload a New One to Overwrite</label>
                <br><br>
                <input type="file" class="form-control" id="pImgFileGrid" name="file">
                <br>
                <div class="form-floating">
                    <input type="text" class="form-control form-floating" placeholder="img/image.png"
                        id="imgPathInputGrid" value="<?php echo $curPImg; ?>" name="imgPath">
                    <label for="imgPathInputGrid">Image Path</label>
                </div>
            </div>
            <div class="mb-3">
                <label for="proNameInputGrid" class="form-label">Product Name</label>
                <input type="text" class="form-control" id="proNameInputGrid" name='pname'
                    value="<?php echo $curPName; ?>">
            </div>
            <div class="mb-3">
                <label for="proNewPriceInputGrid" class="form-label">Product New Price</label>
                <input type="number" min="0" step=".01" class="form-control" id="proNewPriceInputGrid" name='pnewprice'
                    value="<?php echo $curPNewPrice; ?>">
            </div>
            <div class="mb-3">
                <label for="proOldPriceInputGrid" class="form-label">Product Old Price</label>
                <input type="number" min="0" step=".01" class="form-control" id="proOldPriceInputGrid" name='poldprice'
                    value="<?php echo $curPOldPrice; ?>">
            </div>

            <div class="mb-3">
                <label for="proStarRatingsInputGrid" class="form-label">Enter Product Star Rating</label>
                <br>
                <label class="form-label">Current Star Rating:
                    <?php
                    $curStarIconArray = array($curStar1, $curStar2, $curStar3, $curStar4, $curStar5);

                    $curStarValue = 0;
                    foreach ($curStarIconArray as $starIcon) {
                        if ($starIcon == 'fa fa-star text-primary mr-1') {
                            $curStarValue++;
                        } elseif ($starIcon == 'fa fa-star-half-alt text-primary mr-1') {
                            $curStarValue += .5;
                        } elseif ($starIcon == 'far fa-star text-primary mr-1')
                            break;
                    }
                    ?>
                    <i class="<?php echo $curStar1 ?>"></i>
                    <i class="<?php echo $curStar2 ?>"></i>
                    <i class="<?php echo $curStar3 ?>"></i>
                    <i class="<?php echo $curStar4 ?>"></i>
                    <i class="<?php echo $curStar5 ?>"></i>
                    &nbsp;(<?php echo $curStarValue; ?>)
                </label>
                <input type="number" step=".5" min="0" max="5" class="form-control" id="proStarRatingsInputGrid"
                    name='pratings' value="<?php echo $curStarValue; ?>">
            </div>
            <div class="mb-3">
                <label for="proReviewsInputGrid" class="form-label">Reviews</label>
                <input type="number" min="0" class="form-control" id="proReviewsInputGrid" name="reviews"
                    value="<?php echo $curPReviews; ?>">
            </div>
            <div class="mb-3">
                <button type="submit" class="btn btn-primary mb-3" name="submit">Update</button>
            </div>
        </form>
        <?php
        if (isset($_POST['submit'])) {
            include '../dbconfig.php';

            $pcatid = $_POST['pcatid'] ? mysqli_real_escape_string($conn, $_POST['pcatid']) : $curCatId;

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
                    $targetDir = '../img/';
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

            $uploadPath = $uploadPath ? mysqli_real_escape_string($conn, $uploadPath) : $curPImg;
            $pname = $_POST['pname'] ? mysqli_real_escape_string($conn, $_POST['pname']) : $curPName;
            $pnewprice = $_POST['pnewprice'] ? mysqli_real_escape_string($conn, $_POST['pnewprice']) : $curPNewPrice;
            if ($pnewprice < 0) {
                error_log('Pnewprice cannot be lower than zero', 0);
                $pnewprice = $curPNewPrice;
            }
            $poldprice = $_POST['poldprice'] ? mysqli_real_escape_string($conn, $_POST['poldprice']) : $curPOldPrice;
            if ($poldprice < 0) {
                error_log('POldprice cannot be lower than zero', 0);
                $poldprice = $curPOldPrice;
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
            function processRating($rating)
            {
                if (is_numeric($rating)) {
                    if ($rating >= 0 and $rating <= 5) {
                        $rating = round($rating * 2) / 2;
                        $rating = starColumns($rating);

                        return $rating;
                    } else {
                        error_log("Rating value $rating is out of range.");

                        return $GLOBALS['curStarIconArray'];
                    }
                } else {
                    $rating = $GLOBALS['curStarIconArray'];
                    error_log("Rating value must be numeric.", 0);

                    return $GLOBALS['curStarIconArray'];
                }
            }
            $pratings = $_POST['pratings'] ? processRating($_POST['pratings']) : $curStarIconArray;

            $reviews = $_POST['reviews'] ? mysqli_real_escape_string($conn, $_POST['reviews']) : $curPReviews;
            if ($reviews < 0) {
                error_log('number of reviews cannot be lower than zero', 0);
                $reviews = $curPReviews;
            }

            $updateQuery = "UPDATE products SET catid = '" . $pcatid . "', pimg = '" . $uploadPath . "', pname='" . $pname . "', pnewprice='" . $pnewprice . "', poldprice='" . $poldprice . "', star_rating_1 = '" . $pratings[0] . "', star_rating_2 = '" . $pratings[1] . "', 
            star_rating_3 = '" . $pratings[2] . "', star_rating_4 = '" . $pratings[3] . "', star_rating_5 = '" . $pratings[4] . "', reviews = '" . $reviews . "' WHERE pid=" . $curPId;

            $updateProResult = mysqli_query($conn, $updateQuery);
            $affected_rows = $conn->affected_rows;
            $conn->close();

            if (!empty($updateProResult)) {
                if ($affected_rows === 0) {
                    echo "<script>alert('Product $curPId was not updated because the values were the same.');window.location.href='managePro.php'</script></script>";
                } else
                    echo "<script>alert('Product $curPId was Updated Successfully');
            window.location.href='managePro.php'</script>";
            } else {
                echo "<script>alert('Error! Unable to Update Product $curPId');
            window.location.href='managePro.php'</script>";
            }
        }
        ?>
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
            <p class="text-center" style="background-color: aliceblue;">&#169; Copyright | All Rights Reserved | <span
                    id="footerYear"></span>
                <script>
                    document.getElementById('footerYear').innerHTML = new Date().getFullYear();
                </script>
                <br>
                <a href='logout.php'>Logout</a>
            </p>
        </div>

    </footer>
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3-alpha1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN"
        crossorigin="anonymous"></script>
</body>

</html>