<?php
session_start();
if (!isset($_SESSION['name'])) {
    header('Location: index.php');
    //redirection
}
// else{
//     echo "Hi Admin ".$_SESSION['name'];
//     echo "<br><br>";
//     echo "<h2><a href='logout.php'>Logout</a></h2>";
// }
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Favicon -->
    <link href=admin.png rel="icon">
    <title>Admin Panel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
</head>

<body>
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
            <a class="navbar-brand" href="#"><?php echo $_SESSION['name']; ?></a>
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
        <div class="row row-cols-1 row-cols-md-2 g-4">
            <div class="col">
                <div class="card">
                    <img src="manage/manageCat.png" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">Manage Categories</h5>
                        <p class="card-text">Use this section to Update Insert Or
                            Delete Categories from Multishop</p>
                        <a href="manageCat.php" class="btn btn-primary">Manage</a>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card">
                    <img src="manage/managePr.png" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">Manage Products</h5>
                        <p class="card-text">Use this section to Update Insert Or
                            Delete Products from Multishop</p>
                        <a href="managePro.php" class="btn btn-primary">Manage</a>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card">
                    <img src="manage/manageFp.png" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">Manage Featured Products</h5>
                        <p class="card-text">Use this section to Update Insert Or
                            Delete Featured Products from Multishop</p>
                        <a href="manageFeatured.php" class="btn btn-primary">Manage</a>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card">
                    <img src="manage/manageBr.png" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">Manage Banners</h5>
                        <p class="card-text">Use this section to Update Insert Or
                            Delete Banners from Mulltishop</p>
                        <a href="manageBanner.php" class="btn btn-primary">Manage</a>
                    </div>
                </div>
            </div>
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
</body>

</html>