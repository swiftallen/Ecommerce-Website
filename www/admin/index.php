<?php
session_start();

if (isset($_SESSION['name'])) {
  header('Location: panel.php');
} else {
  session_destroy();
}
?>
<!doctype html>
<html lang="en">

<head>
  <style>
    .container-fluid {
      display: flex;
      flex-direction: column;
      min-height: 100vh;
      padding-left: 0;
      padding-right: 0;
    }

    .h-custom {
      display: flex;
      flex: 1;
      justify-content: center;
      align-items: center;
      min-height: 500px;
    }

    .img-fluid {
      max-width: 100%;
      height: auto;
    }

    .footer {
      text-align: center;
      color: white;
      padding: 15px 0;
      width: 100%;
      position: relative;
      bottom: 0;
      margin: 0;
    }

    .form-outline {
      margin-bottom: 20px;
    }

    .btn-lg {
      padding-left: 2.5rem;
      padding-right: 2.5rem;
    }

    @media (max-width: 768px) {
      .img-container {
        display: none;
      }
    }

    html,
    body {
      margin: 0;
      padding: 0;
    }

    @media (min-width: 768px) and (max-width: 991px) {
      .h-custom {
        padding-bottom: 50px;
      }
    }
  </style>

  <link href="images/admin_person.png" rel="icon">
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Admin Panel</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
</head>

<body>

  <section class="container-fluid">
    <div class="h-custom">
      <div class="row d-flex justify-content-center align-items-center w-100">
        <div class="col-md-9 col-lg-6 col-xl-5 img-container">
          <img src="images/draw2.webp" class="img-fluid" alt="Sample image">
        </div>
        <div class="col-md-8 col-lg-6 col-xl-4 offset-xl-1">
          <form action="" method="post">
            <!-- leaving action attribute as blank yields the same result as <?php $_PHP_SELF ?> -->
            <div class="form-outline mb-4">
              <input type="email" id="aemail" name="aemail" class="form-control form-control-lg"
                placeholder="Enter a valid email address" />
              <label class="form-label" for="form3Example3">Email address</label>
            </div>
            <div class="form-outline mb-3">
              <input type="password" id="apassword" name="apassword" class="form-control form-control-lg"
                placeholder="Enter password" />
              <label class="form-label" for="form3Example4">Password</label>
            </div>
            <div class="text-center text-lg-start mt-4 pt-2">
              <button type="submit" name="login" class="btn btn-primary btn-lg">Login</button>
            </div>
          </form>
          <?php
          if (isset($_POST['login'])) {
            session_start();

            include '../dbconfig.php';

            $aemail = $_POST['aemail'];
            $apassword = $_POST['apassword'];
          
            $loginQuery = "SELECT * FROM admin WHERE aemail= '" . $aemail . "'";

            $adminResult = mysqli_query($conn, $loginQuery);
            mysqli_close($conn);

            $rowCount = mysqli_num_rows($adminResult);
          
            while ($adminArray = mysqli_fetch_assoc($adminResult)) {
              $hashedpw = $adminArray['apassword'];
              $aname = $adminArray['aname'];
            }

            if ($rowCount > 0) {
              if ($hashedpw) {
                if (password_verify($apassword, $hashedpw)) {
                  $_SESSION['name'] = $aname;
                  var_dump($aname);
                  echo "<script>alert('VALID CREDENTIALS!')</script>";
                  header('Location: panel.php');
                } else {
                  echo "<script>alert('INVALID CREDENTIALS!')</script>";
                }
              } else {
                echo "<script>alert('INVALID CREDENTIALS!')</script>";
              }
            } else {
              echo "<script>alert('INVALID CREDENTIALS!')</script>";
            }
          }
          ?>
        </div>
      </div>
    </div>
    </div>

    <div class="footer">
      <div style="color: #007bff;">Copyright ©
        <script>
          document.write(new Date().getFullYear())
        </script>. All rights reserved.
      </div>
    </div>
  </section>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN"
    crossorigin="anonymous"></script>
</body>

</html>