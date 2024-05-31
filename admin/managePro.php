<?php
//Demo by Mr Yash
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

        i {
            font-size: .7rem;
        }
    </style>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Favicon -->
    <link href=admin.png rel="icon">
    <title>Product Section|Admin Panel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <!-- font awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"> -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
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
        <h2>Manage Products</h2>
        <button type="button" class="btn btn-primary mx-auto" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
            Insert New Product
        </button>
        <!-- Modal for New Category -->
        <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="staticBackdropLabel">Add a New Product</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="" method="post" enctype="multipart/form-data">
                            <!-- Method 1: manual insertion of all categories -->
                            <!-- required and selected attribute CANNOT be used together,  -->
                            <div class="mb-3"><select class="form-select" aria-label="Default select example" name='categoryname' required>
                                    <option value=''>Choose Category</option>
                                    <!-- now required works, because value is blank for default choice -->
                                    <option value="1">Clothing</option>
                                    <option value="2">Footwear</option>
                                    <option value="3">Electronic Appliances</option>
                                    <option value="4">Groceries</option>
                                    <!-- value is important, it will be fetched by php, name would be IGNORED by php  -->
                                    <!-- <option value="4">Jewellery</option> -->
                                    <option value="5">Smartphone</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="imagefile" class="form-label">Upload Product Image</label>
                                <input type="file" class="form-control" name="file" required>
                            </div>
                            <div class="mb-3">
                                <label for="pname" class="form-label">Product Name</label>
                                <input type="text" class="form-control" name="pname" placeholder="Product Name" required>
                            </div>
                            <div class="mb-3">
                                <label for="pnewprice" class="form-label">Product New Price</label>
                                <input type="text" class="form-control" name="pnewprice" placeholder="Product New Price" required>
                            </div>
                            <div class="mb-3">
                                <label for="poldprice" class="form-label">Product Old Price</label>
                                <input type="text" class="form-control" name="poldprice" placeholder="Product Old Price" required>
                            </div>
                            <div class="mb-3">
                                <label for="starRating1" class="form-label">Enter Star Rating 1</label>
                                <select class="form-select" aria-label="Default select example" name="star_rating1" required>
                                    <option value=''>Select Star 1</option>
                                    <option value="fa fa-star text-primary mr-1">Full Star</option>
                                    <option value="fa fa-star-half-alt text-primary mr-1 ">Half Star</option>
                                    <option value="far fa-star text-primary mr-2">Blank Star</option>
                                    <!-- PROBLEM! Icon INVISIBLE! -->
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="starRating2" class="form-label">Enter Star Rating 2</label>
                                <select class="form-select" aria-label="Default select example" name="star_rating2" required>
                                    <option value=''>Select Star 2</option>
                                    <option value="fa fa-star text-primary mr-1">Full Star</option>
                                    <option value="fa fa-star-half-alt text-primary mr-1 ">Half Star</option>
                                    <option value="far fa-star text-primary mr-2">Blank Star</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="starRating4" class="form-label">Enter Star Rating 3</label>
                                <select class="form-select" aria-label="Default select example" name="star_rating3" required>
                                    <option value=''>Select Star 3</option>
                                    <option value="fa fa-star text-primary mr-1">Full Star</option>
                                    <option value="fa fa-star-half-alt text-primary mr-1 ">Half Star</option>
                                    <option value="far fa-star text-primary mr-2">Blank Star</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="starRating4" class="form-label">Enter Star Rating 4</label>
                                <select class="form-select" aria-label="Default select example" name="star_rating4" required>
                                    <option value=''>Select Star 4</option>
                                    <option value="fa fa-star text-primary mr-1">Full Star</option>
                                    <option value="fa fa-star-half-alt text-primary mr-1 ">Half Star</option>
                                    <option value="far fa-star text-primary mr-2">Blank Star</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="starRating5" class="form-label">Enter Star Rating 5</label>
                                <select class="form-select" aria-label="Default select example" name="star_rating5" required>
                                    <option value=''>Select Star 5</option>
                                    <option value="fa fa-star text-primary mr-1">Full Star</option>
                                    <option value="fa fa-star-half-alt text-primary mr-1 ">Half Star</option>
                                    <option value="far fa-star text-primary mr-2">Blank Star</option>
                                </select>
                            </div>



                            <div class="mb-3">
                                <label for="reviews" class="form-label">Product Review</label>
                                <input type="number" class="form-control" name="reviews" placeholder="Reviews" required>
                            </div>
                            <!-- 
                            <div class="mb-3">
                                <label for="catproducts" class="form-label"></label>
                                <input type="text" class="form-control" name="catproducts" placeholder="Number of Products" required>
                            </div> -->
                            <div class="mb-3">
                                <button type="submit" class="btn btn-primary mb-3" name="insert">Insert</button>
                            </div>
                            <?php
                            //insert new Product code STARTS
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

                                        $pr_img = $imgUploadPath;
                                    }
                                } else {
                                    echo "<script>alert('Unable to upload image');</script>";
                                }

                                $categorySelected = $_POST['categoryname'];
                                $pname = $_POST['pname'];
                                $pnewprice = $_POST['pnewprice'];
                                $poldprice = $_POST['poldprice'];
                                $star_rating1 = $_POST['star_rating1'];
                                $star_rating2 = $_POST['star_rating2'];
                                $star_rating3 = $_POST['star_rating3'];
                                $star_rating4 = $_POST['star_rating4'];
                                $star_rating5 = $_POST['star_rating5'];
                                $reviews = $_POST['reviews'];

                                $myQuery = "INSERT INTO products (catid,pimg,pname,pnewprice,poldprice,
                                star_rating1,star_rating2,star_rating3,star_rating4,star_rating5,reviews) 
                                VALUES('" . $categorySelected . "', '" . $pr_img . "', '" . $pname . "', '" . $pnewprice . "', '" . $poldprice . "', 
                                '" . $star_rating1 . "', '" . $star_rating2 . "', '" . $star_rating3 . "', '" . $star_rating4 . "'
                                , '" . $star_rating5 . "', '" . $reviews . "')";
                                $result = mysqli_query($conn, $myQuery);

                                if ($result) {
                                    echo "<script>alert('New Product Inserted Successfully');
                                    window.location.href='managePro.php'</script>";
                                    // location.reload()
                                } else {
                                    echo "<script>alert(Error! Unable to upload new product.);
                                    window.location.href='panel.php'</script>";
                                }
                            }

                            ?>
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
                        <th scope="col">Product ID</th>
                        <th scope="col">Category ID</th>
                        <th scope="col">Product Image</th>
                        <th scope="col">Product Name</th>
                        <th scope="col">Product New Price</th>
                        <th scope="col">Product Old Price</th>
                        <th scope="col">Ratings</th>
                        <!-- noneditable, display only -->
                        <th scope="col">No. of Reviews</th>
                        <th scope="col">Action</th>

                    </tr>
                </thead>
                <tbody class="table-group-divider">
                    <!-- Fetch Category Table Inform form MySql Database table -->
                    <?php
                    //need not trigger action in this context, display directly
                    include 'dbconfig.php';
                    $result = mysqli_query($conn, "SELECT * FROM products");
                    while ($prArray = mysqli_fetch_array($result)) :
                    ?>
                        <tr>
                            <td><?php echo $prArray['id'] ?></td>
                            <td><?php echo $prArray['catid'] ?></td>
                            <td><img src="../<?php echo $prArray['pimg'] ?>" width='60px' height='60px'></td>
                            <td><?php echo $prArray['pname'] ?></td>
                            <td><?php echo $prArray['pnewprice'] ?></td>
                            <td><?php echo $prArray['poldprice'] ?></td>
                            <td>
                                <i class="<?php echo $prArray['star_rating1'] ?>"></i>
                                <i class="<?php echo $prArray['star_rating2'] ?>"></i>
                                <i class="<?php echo $prArray['star_rating3'] ?>"></i>
                                <i class="<?php echo $prArray['star_rating4'] ?>"></i>
                                <i class="<?php echo $prArray['star_rating5'] ?>"></i>
                            </td>
                            <td><?php echo $prArray['reviews'] ?></td>
                            <td>
                                <!-- id means pid here, too late to change.. -->
                                <a href="editPro.php?id=<?php echo $prArray['id']; ?>" title="Edit/Update"><ion-icon name="create-outline"></ion-icon>
                                <!-- <a href="deletePro.php?id=<?php echo $prArray['id']; ?>" title="Delete"><ion-icon name="trash-outline"></ion-icon> -->
                                <a class="deletePro" title='Delete' id=<?php echo $prArray['id']; ?>><ion-icon name="trash-outline" title='Delete'></ion-icon>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </div>

    <script type="text/javascript">
        $(".deletePro").click(function() {
            var id = $(this).attr("id");
            if (confirm('Are you sure you want to delete entry '+ id + '?')) {
                $.ajax({
                    url: 'deletePro.php',
                    type: 'GET',
                    data: {
                        'id': id
                    },
                    error: function() {
                        alert('Something is wrong, couldn\'t delete record');
                    },
                    success: function(data) {
                        $("#" + id).remove();
                        alert("Product Successfuly Deleted");
                        // alert(data);
                    }
                });
            }else{
                alert('Deletion Cancelled');
            }
        });
    </script>

    <!-- card ends -->
    <footer class="footer mt-5">
        <div class="container">
            <p class="text-center" style="background-color: aliceblue;">&#169; Copyright | All Rights Reserved | <script>
                    document.write(new Date().getFullYear())
                </script>
                <br>
                <a href='logout.php'>Logout</a>
            </p>
        </div>

    </footer>
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.2.1.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>

</html>