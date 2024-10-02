<!-- Code by Brave Coder - https://youtube.com/BraveCoder -->

<?php
    session_start();
    if (isset($_SESSION['SESSION_REGISTRAR'])) {
        header("Location: ../home/index.php");
        die();
    }

    include '../../../database/config.php';
    $msg = "";

    if (isset($_GET['verification'])) {
        if (mysqli_num_rows(mysqli_query($conn, "SELECT * FROM users WHERE code='{$_GET['verification']}'")) > 0) {
            $query = mysqli_query($conn, "UPDATE users SET code='' WHERE code='{$_GET['verification']}'");
            
            if ($query) {
                $msg = "<div class='alert alert-success'>Account verification has been successfully completed.</div>";
            }
        } else {
            header("Location: index.php");
        }
    }

if (isset($_POST['submit'])) {
    // Sanitize user inputs
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = $_POST['password']; // No need to escape as we will use password_verify()

    // Prepare a query to select the user based on email/username
    $sql = "SELECT * FROM users WHERE username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $row = $result->fetch_assoc();

        // Use password_verify to check the hashed password
        if (password_verify($password, $row['password'])) {
            if ($row['role'] == "Registrar Office") {
                $id = $row['id'];

                // Update user's online status
                $query = "UPDATE users SET online = '1' WHERE id = ?";
                $stmt1 = $conn->prepare($query);
                $stmt1->bind_param("i", $id);
                $stmt1->execute();

                // Start session for the logged-in user
                $_SESSION['SESSION_REGISTRAR'] = $email;
                header("Location: ../home/index.php");
            } else {
                $msg = "<div class='alert alert-info'>Email or password do not match for this porta3l.</div>";
            }
        } else {
            $msg = "<div class='alert alert-danger'>Email or password do not match2.</div>";
        }
    } else {
        $msg = "<div class='alert alert-danger'>Email or password do not match1.</div>";
    }

    // Close the prepared statement
    $stmt->close();
}

?>

<!DOCTYPE html>
<html lang="zxx">

<head>
    <title>Login | Registrar Office</title>
    <link rel="icon" type="image" href="../../../icon.png">
    <!-- Meta tag Keywords -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="UTF-8" />
    <meta name="keywords"
        content="Login Form" />
    <!-- //Meta tag Keywords -->

    <link href="//fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">

    <!--/Style-CSS -->
    <link rel="stylesheet" href="css/style.css" type="text/css" media="all" />
    <!--//Style-CSS -->

    <script src="https://kit.fontawesome.com/af562a2a63.js" crossorigin="anonymous"></script>

</head>

<body>
    <div class="loader-wrapper" id="preloader">
      <span class="loader"><span class="loader-inner"></span></span>
    </div>
   <link rel="stylesheet" type="text/css" href="../../../loader/styles.css" />
    <script>
        var loader = document.getElementById("preloader");
        window.addEventListener("load", function(){
          loader.style.display = "none"
        }) 
    </script>

    <!-- form section start -->
    <img class="wave" src="img/wave.png">
   
    <!-- form section start -->
    
    <section class="w3l-mockup-form">
        
        <div class="container">
            <!-- /form -->
            <div class="workinghny-form-grid">
                <div class="main-mockup">
                    
                    <div class="w3l_form align-self">
                        <div class="left_grid_info">
                            <img src="images/mcc2.png" alt="">
                        </div>
                    </div>
                    <div class="content-wthree">
                        <h2>Login Now | Registrar Office</h2>
                        <p>Madridejos Community College </p>
                        <?php echo $msg; ?>
                        <form action="" method="post">
                            <input type="email" class="email" name="email" placeholder="Enter Your Email" required>
                            <input type="password" class="password" name="password" placeholder="Enter Your Password" style="margin-bottom: 2px;" required>
                            <p style="float: right ;"><a href="forgot-password.php" style="margin-bottom: 15px; display: block; text-align: right;">Forgot Password?</a></p>
                            <p style="float: left;"><a href="../../../index.php" style="margin-bottom: 15px; display: block; text-align: right;">Back Home</a></p>
                            <button name="submit" name="submit" class="btn" type="submit">Login</button>
                        </form>
                        
                    </div>
                </div>
            </div>
            <!-- //form -->
        </div>
    </section>
    <!-- //form section start -->

    <script src="js/jquery.min.js"></script>
    <script>
        $(document).ready(function (c) {
            $('.alert-close').on('click', function (c) {
                $('.main-mockup').fadeOut('slow', function (c) {
                    $('.main-mockup').remove();
                });
            });
        });
    </script>

</body>

</html>
