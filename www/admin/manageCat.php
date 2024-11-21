<?php
session_start();

if (!isset($_SESSION['name'])) {
    header('Location: index.php');
}

?>
<!doctype html>
<html lang="en">

<head>
    <!-- Favicon -->
    <link href="images/admin_person.png" rel="icon">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Category Section|Admin Panel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        ion-icon {
            pointer-events: none;
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
            Insert New Category
        </button>

        <!-- Modal -->
        <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
            aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="staticBackdropLabel">Insert New Category</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="" method="post" enctype="multipart/form-data">
                            <div class="mb-3">
                                <label for="catImgInputGrid" class="form-label">Upload Category Image</label>
                                <input class="form-control" type="file" name="file" id="catImgInputGrid" required>
                            </div>
                            <div class="mb-3">
                                <label for="catNameInputGrid" class="form-label">Category Name</label>
                                <input type="text" class="form-control" name="catname" id="catNameInputGrid" required>
                            </div>
                            <div class="mb-3">
                                <label for="catInventoryInputGrid" class="form-label">No. of Stock</label>
                                <input type="number" min="0" class="form-control" name="catinventory" required
                                    id="catInventoryInputGrid">
                            </div>
                            <div class="mb-3">
                                <button type="submit" class="btn btn-primary mb-3" name="insert">Insert</button>
                            </div>
                        </form>
                        <?php
                        if (isset($_POST['insert'])) {
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
                                        $uploadPath = NULL;
                                    } else {
                                        $uploadPath = str_replace('../', '', $uploadPath);
                                    }
                                } else {
                                    error_log('Only image files are allowed!', 0);
                                    $uploadPath = NULL;
                                }
                            } else {
                                error_log("No file was ever sent by user. Image uploading skipped.", 0);
                                $uploadPath = NULL;
                            }

                            $uploadPath = mysqli_real_escape_string($conn, $uploadPath);
                            $catname = $_POST['catname'] ? mysqli_real_escape_string($conn, $_POST['catname']) : null;
                            $catinventory = $_POST['catinventory'] ? mysqli_real_escape_string($conn, $_POST['catinventory']) : null;

                            if (empty($uploadPath) or empty($catname) or empty($catinventory)) {
                                $invalidEntry = true;
                                echo "<script>alert('Incomplete form entry. Please fill up all required fields.');</script>";
                            }

                            if (!$invalidEntry) {
                                $insertQuery = "INSERT INTO categories (catimg, catname, catinventory) VALUES ('" . $uploadPath . "','" . $catname . "','" . $catinventory . "')";
                                $insertCatResult = mysqli_query($conn, $insertQuery);
                                $conn->close();
                            } else {
                                error_log('Incomplete form entry. ', 0);
                            }

                            if (!empty($insertCatResult)) {
                                echo "<script>
                                    alert('New Category Inserted Successfully');
                                    window.location.href='manageCat.php';
                                </script>";
                            } else {
                                echo "<script>
                                    alert('ERROR! UNABLE TO ADD NEW CATEGORY!');
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
                        <th scope="col">Cat ID</th>
                        <th scope="col">Category Image</th>
                        <th scope="col">Category Name</th>
                        <th scope="col">No. of Stock</th>
                        <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody class="table-group-divider">
                    <!-- starts fetching cat info fr mysql table -->
                    <?php
                    include '../dbconfig.php';

                    $catResult = mysqli_query($conn, "SELECT * FROM categories");

                    while ($catArray = mysqli_fetch_array($catResult)):
                        ?>
                        <tr>
                            <td><?php echo $catArray['catid'] ?></td>
                            <td><img src="../<?php echo $catArray['catimg'] ?>" width="60px"></td>
                            <td><?php echo $catArray['catname'] ?></td>
                            <td><?php echo $catArray['catinventory'] ?></td>
                            <td>
                                <!-- pass a GET request to editCat.php. Id acts as an identifier so editCat.php knows which category to edit -->
                                <a href="editCat.php?cid=<?php echo $catArray['catid']; ?>" title="Edit/Update"><ion-icon
                                        name="create-outline"></a></ion-icon>
                                <a href="#" title="Delete" onclick="confirmDelete()">
                                    <ion-icon name="trash-outline"></ion-icon>
                                </a>
                                <!-- deleteCat.php?id=<?php echo $catArray['catid']; ?> -->
                                <script>
                                    // Function to handle the deletion confirmation
                                    function confirmDelete() {
                                        var userConfirmed = confirm("Are you sure you want to delete <?php echo $catArray['catid'] . '. ' . $catArray['catname']; ?>?");

                                        if (userConfirmed) {
                                            // If confirmed, proceed to delete.php with the query string for the row ID
                                            window.location.href = "deleteCat.php?id=<?php echo $catArray['catid']; ?>"; // Add your dynamic ID or other parameters here
                                        } else {
                                            console.log("Deletion canceled.");
                                        }
                                    }
                                </script>
                            </td>
                        </tr>
                    <?php endwhile; ?>
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