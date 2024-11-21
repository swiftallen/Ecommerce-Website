<?php
session_start();
if (!isset($_SESSION['name'])) {
    header('Location: index.php');
} else {
    $curFPId = $_GET['fpid'];
    if (is_numeric($curFPId) == true) {
        include '../dbconfig.php';

        $curFPResult = mysqli_query($conn, "SELECT * FROM featuredproduct WHERE id=" . $curFPId);

        while ($fpArray = mysqli_fetch_array($curFPResult)) {
            $curCatId = $fpArray['catid'];
            $curFPImg = $fpArray['img'];
            $curFPName = $fpArray['name'];
            $curFPNewPrice = $fpArray['newprice'];
            $curFPOldPrice = $fpArray['oldprice'];
            $curStar1 = $fpArray['star_rating_1'];
            $curStar2 = $fpArray['star_rating_2'];
            $curStar3 = $fpArray['star_rating_3'];
            $curStar4 = $fpArray['star_rating_4'];
            $curStar5 = $fpArray['star_rating_5'];
            $curPReviews = $fpArray['reviews'];
            $conn->close();
        }
    } else {
        header('Location: manageFp.php');
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
    <title>Edit Featured Product|Admin Panel</title>
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
                <label for="id" class="form-label">Featured Product ID</label>
                <input type="text" class="form-control" value="<?php echo $curFPId; ?>" disabled>
            </div>
            <div class="mb-3">
                <select class="form-select" aria-label="Category Selector" name="fpcatid">
                    <option value="<?php echo $curCatId ?>" disabled>
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
                <label for="fpImgFileGrid" class="form-label">Product Image</label>
                <br>
                <img src="../<?php echo $curFPImg; ?>" width="60px" title="<?php echo $curFPImg; ?>">
                <label class="form-label">Current Image, Upload a New One to Overwrite</label>
                <br><br>
                <input type="file" class="form-control" id="fpImgFileGrid" name="file">
                <br>
                <div class="form-floating">
                    <input type="text" class="form-control form-floating" placeholder="img/image.png"
                        id="imgPathInputGrid" value="<?php echo $curFPImg; ?>" name="imgPath">
                    <label for="imgPathInputGrid">Image Path</label>
                </div>
            </div>
            <div class="mb-3">
                <label for="fpNameInputGrid" class="form-label">Featured Product Name</label>
                <input type="text" class="form-control" id="fpNameInputGrid" name="fpname"
                    value="<?php echo $curFPName; ?>">
            </div>
            <div class="mb-3">
                <label for="fpNewPriceInputGrid" class="form-label">Featured Product New Price</label>
                <input type="number" min="0" step=".01" class="form-control" id="fpNewPriceInputGrid" name='fpnewprice'
                    value="<?php echo $curFPNewPrice; ?>">
            </div>
            <div class="mb-3">
                <label for="fpOldPriceInputGrid" class="form-label">Featured Product Old Price</label>
                <input type="number" min="0" step=".01" class="form-control" id="fpOldPriceInputGrid" name='fpoldprice'
                    value="<?php echo $curFPOldPrice; ?>">
            </div>

            <div class="mb-3">
                <label for="fpputGrid" class="form-label">Enter Featured Product Star Rating</label>
                <br>
                <label class="form-label">Current Star Ratings:
                    <?php
                    include '../dbconfig.php';
                    $curStarResult = mysqli_query($conn, "SELECT * FROM featuredproduct WHERE id='" . $curFPId . "'");
                    while ($fpArray = mysqli_fetch_array($curStarResult)) {
                        $curStar1 = $fpArray['star_rating_1'];
                        $curStar2 = $fpArray['star_rating_2'];
                        $curStar3 = $fpArray['star_rating_3'];
                        $curStar4 = $fpArray['star_rating_4'];
                        $curStar5 = $fpArray['star_rating_5'];
                    }

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

                    $conn->close();
                    ?>
                    <i class="<?php echo $curStar1 ?>"></i>
                    <i class="<?php echo $curStar2 ?>"></i>
                    <i class="<?php echo $curStar3 ?>"></i>
                    <i class="<?php echo $curStar4 ?>"></i>
                    <i class="<?php echo $curStar5 ?>"></i>
                    &nbsp;(<?php echo $curStarValue; ?>)
                </label>
                <input type="number" step=".5" min="0" max="5" class="form-control" id="fpStarRatingsInputGrid"
                    name="fpratings" value="<?php echo $curStarValue; ?>">
            </div>
            <div class="mb-3">
                <label for="fpReviewsInputGrid" class="form-label">Reviews</label>
                <input type="number" min="0" class="form-control" id="fpReviewsInputGrid" name="reviews"
                    value="<?php echo $curPReviews; ?>">
            </div>
            <div class="mb-3">
                <button type="submit" class="btn btn-primary mb-3" name="submit">Update</button>
            </div>
        </form>
        <?php
        if (isset($_POST['submit'])) {
            include '../dbconfig.php';

            error_log("this is sparta", 0);
            error_log($_POST['fpcatid'], 0);
            $fpcatid = $_POST['fpcatid'] ? mysqli_real_escape_string($conn, $_POST['fpcatid']) : $curCatId;
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
            $fpname = $_POST['fpname'] ? mysqli_real_escape_string($conn, $_POST['fpname']) : $curFPName;
            $fpnewprice = $_POST['fpnewprice'] ? mysqli_real_escape_string($conn, $_POST['fpnewprice']) : $curFPNewPrice;
            if ($_POST['fpnewprice'] < 0) {
                error_log('FPnewprice cannot be lower than zero', 0);
                $fpnewprice = $curFPNewPrice;
            }
            $fpoldprice = $_POST['fpoldprice'] ? mysqli_real_escape_string($conn, $_POST['fpoldprice']) : $curFPOldPrice;
            if ($fpoldprice < 0) {
                error_log('FPOldprice cannot be lower than zero', 0);
                $fpoldprice = $curFPOldPrice;
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
                    ;
                    error_log("Rating value must be numeric.", 0);

                    return $GLOBALS['curStarIconArray'];
                }
            }
            $fpratings = $_POST['fpratings'] ? processRating($_POST['fpratings']) : $curStarIconArray;

            $reviews = $_POST['reviews'] ? mysqli_real_escape_string($conn, $_POST['reviews']) : $curPReviews;
            if ($reviews < 0) {
                error_log('number of reviews cannot be lower than zero', 0);
                $reviews = $curPReviews;
            }

            $updateQuery = "UPDATE featuredproduct SET catid = '" . $fpcatid . "', img = '" . $uploadPath . "', name='" . $fpname . "', newprice='" . $fpnewprice . "', oldprice='" . $fpoldprice . "', star_rating_1 = '" . $fpratings[0] . "', star_rating_2 = '" . $fpratings[1] . "', star_rating_3 = '" . $fpratings[2] . "', star_rating_4 = '" . $fpratings[3] . "', star_rating_5 = '" . $fpratings[4] . "', reviews = '" . $reviews . "' WHERE id=" . $curFPId;

            $updateFPResult = mysqli_query($conn, $updateQuery);
            $affected_rows = $conn->affected_rows;
            $conn->close();

            if (!empty($updateFPResult)) {
                if ($affected_rows === 0) {
                    echo "<script>alert('Featured product $curFPId was not updated because the values were the same.');window.location.href='manageFp.php'</script></script>";
                } else
                    echo "<script>alert('Featured Product $curFPId was Updated Successfully');
            window.location.href='manageFp.php'</script>";
            } else {
                echo "<script>alert('Error! Unable to Update Featured Product $curFPId');window.location.href='manageFp.php'</script>";
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