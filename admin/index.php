<!doctype html>
<html lang="en">

<head>
    <style>
        .divider:after,
        .divider:before {
            content: "";
            flex: 1;
            height: 1px;
            background: #eee;
        }

        .h-custom {
            height: calc(100% - 73px);
        }

        @media (max-width: 450px) {
            .h-custom {
                height: 100%;
            }
        }
    </style>
    <!-- Favicon -->
    <link href='admin.png' rel='icon'>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Panel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
</head>

<body>
    <section class="vh-100">
        <div class="container-fluid h-custom">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-md-9 col-lg-6 col-xl-5">
                    <img src="draw2.webp" class="img-fluid" alt="Sample image">
                </div>
                <div class="col-md-8 col-lg-6 col-xl-4 offset-xl-1">
                    <form action="" method="post">
                        <!-- Email input -->
                        <div class="form-outline mb-4">
                            <input type="email" id="aemail" name="aemail" class="form-control form-control-lg" placeholder="Enter a valid email address" />
                            <label class="form-label" for="form3Example3">Email address</label>
                        </div>

                        <!-- Password input -->
                        <div class="form-outline mb-3">
                            <input type="password" id="apassword" name="apassword" class="form-control form-control-lg" placeholder="Enter password" />
                            <label class="form-label" for="form3Example4">Password</label>
                        </div>

                        <div class="text-center text-lg-start mt-4 pt-2">
                            <button type="submit" name="login" class="btn btn-primary btn-lg" style="padding-left: 2.5rem; padding-right: 2.5rem;">Login</button>
                            <!-- <p class="small fw-bold mt-2 pt-1 mb-0">Don't have an account? <a href="#!" class="link-danger">Register</a></p> -->
                        </div>

                    </form>

                    <?php
                    if (isset($_POST['login'])) {

                        session_start();

                        include 'dbconfig.php';
                        $aemail = $_POST['aemail'];
                        $apassword = $_POST['apassword'];
                        $result = mysqli_query($conn, "SELECT * FROM admin WHERE 
                            admin_email='" . $aemail . "'AND admin_password='" . $apassword . "'");

                        $rowCount = mysqli_num_rows($result); //returns the number of rows in a result set

                        //compatibility version may arise for php 5.6 and above
                        // if($result->num_rows>0){
                        if ($rowCount > 0) {
                            while ($adminInfo = mysqli_fetch_array($result)) {
                                $adminName  = $adminInfo['admin_name'];
                            }
                            $_SESSION['name'] = $adminName;
                            header('Location: panel.php'); //temporary page for the sake of testing
                        } else {
                            echo "<script>alert('Invalid Admin')</script>";
                        }
                        mysqli_close($conn);
                    }



                    ?>

                </div>
            </div>
        </div>
        <div class="d-flex flex-column flex-md-row text-center text-md-start justify-content-between py-4 px-4 px-xl-5 bg-primary">
            <!-- Copyright -->
            <div class="text-white mb-3 mb-md-0">
                Copyright© <?php echo date("Y"); ?>. All rights reserved&reg;.
            </div>
            <!-- Copyright -->

        </div>
    </section>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
</body>

</html>