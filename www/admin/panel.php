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
    <title>Admin Panel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>

    <nav class="navbar bg-body-tertiary">
        <div class="container-fluid">
            <a class="navbar-brand"><?php if (isset($_SESSION['name'])) {
                echo $_SESSION['name'];
            } ?></a>
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
        <div class="row row-cols-1 row-cols-md-3 g-4">
            <div class="col">
                <div class="card h-100">
                    <img src="images/manageCat.png" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">Manage Categories</h5>
                        <p class="card-text">Use this section to insert, update or delete Categories from Multishop</p>
                        <a href="manageCat.php" class="btn btn-primary">Manage</a>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card h-100">
                    <img src="images/managePr.png" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">Manage Products</h5>
                        <p class="card-text">Use this section to insert, update or delete Products from Multishop</p>
                        <a href="managePro.php" class="btn btn-primary">Manage</a>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card h-100">
                    <img src="images/manageBr.png" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">Manage Banners</h5>
                        <p class="card-text">Use this section to insert, update or delete Banners from Multishop</p>
                        <a href="manageBr.php" class="btn btn-primary">Manage</a>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card h-100">
                    <img src="images/manageFp.png" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">Manage Featured Products</h5>
                        <p class="card-text">Use this section to insert, update or delete Featured Products from
                            Multishop</p>
                        <a href="manageFp.php" class="btn btn-primary">Manage</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <footer class="footer mt-5">
        <div class="container">
            <p class="text-center" style="background-color: aliceblue;">
                &#169; Copyright | All Rights Reserved | <script>
                    document.write(new Date().getFullYear())
                </script>
                <br>
                <a href="logout.php">Logout</a>
            </p>
        </div>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
</body>

</html>