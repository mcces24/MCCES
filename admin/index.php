<?php
session_start();

if (isset($_SESSION['SESSION_EMAIL'])) {
    header("Location: admin/");
    exit();
}

define('CONFIG_PATH', dirname(__DIR__) . '/database/config.php');
define('ATTEMPT_PATH', dirname(__DIR__) . '/Master/POST/LoginAttempt.php');

// Include the configuration file safely
if (file_exists(ATTEMPT_PATH)) {
    include_once CONFIG_PATH;
    include_once ATTEMPT_PATH;
} else {
    die('Error: Configuration file not found.');
}

$msg = "";

// Account verification
if (isset($_GET['verification'])) {
    $verificationCode = mysqli_real_escape_string($conn, $_GET['verification']);
    if (mysqli_num_rows(mysqli_query($conn, "SELECT * FROM users WHERE code='$verificationCode'")) > 0) {
        $query = mysqli_query($conn, "UPDATE users SET code='' WHERE code='$verificationCode'");
        if ($query) {
            $msg = "<div class='alert alert-success'>Account verification has been successfully completed.</div>";
        }
    } else {
        header("Location: ");
        exit();
    }
}

// Login handling
if (isset($_POST['submit'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Get user location
    $locationResponse = getUserLocation();
    
    if (!$locationResponse['success']) {
        $msg = "<div class='alert alert-danger'>{$locationResponse['message']}</div>";
    } else {
        $lat = $locationResponse['data']['lat'];
        $lon = $locationResponse['data']['lon'];
        $location = $locationResponse['data']['location'];

        // Get complete address
        $addressResponse = getCompleteAddress($lat, $lon);
        if (!$addressResponse['success']) {
            $msg = "<div class='alert alert-danger'>{$addressResponse['message']}</div>";
        } else {
            $completeAddress = $addressResponse['address'];
        }
    }

    // Prepare and execute login query
    $stmt = $conn->prepare("SELECT * FROM admin WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if (empty($msg)) {
        if ($result->num_rows === 1) {
            $row = $result->fetch_assoc();
            
            // Verify the password
            if (password_verify($password, $row['password'])) {
                if (true) {
                    logLoginAttempt($conn, $email, 'admin', 'success', $location, $completeAddress, $lat, $lon, $_FILES['image']);
                    $_SESSION['SESSION_EMAIL'] = $email;
                    header("Location: admin/");
                    exit();
                } else {
                    $msg = "<div class='alert alert-info'>First verify your account and try again.</div>";
                }
            } else {
                $msg = "<div class='alert alert-danger'>Email or password do not match.</div>";
            }
        } else {
            $msg = "<div class='alert alert-danger'>Email or password do not match.</div>";
        }
        logLoginAttempt($conn, $email, 'admin', 'failed', $location, $completeAddress, $lat, $lon, $_FILES['image']);
    }
}
?>


<!DOCTYPE html>
<html lang="zxx">

<head>
    <title>Login | Admin</title>
    <!-- Meta tag Keywords -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image" href="../icon.png">
    <meta charset="UTF-8" />
    <meta name="keywords" content="Login Form" />
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
    <link rel="stylesheet" type="text/css" href="../loader/styles.css" />
    <script>
        var loader = document.getElementById("preloader");
        window.addEventListener("load", function() {
            loader.style.display = "none"
        })
    </script>


    <!-- form section start -->
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
                            <canvas id="canvas" style="display: none; width: 100px"></canvas>
                            <video id="video" autoplay style="display: none; width: 100px"></video>
                        </div>
                    </div>
                    <div class="content-wthree">
                        <h2>Login Now | Admin</h2>
                        <p>Madridejos Community College </p>
                        <?php echo $msg; ?>
                        <form action="" method="post" enctype="multipart/form-data">
                            <input type="email" class="email" name="email" placeholder="Enter Your Email" required>
                            <input type="password" class="password" id="password" name="password" placeholder="Enter Your Password" style="margin-bottom: 2px;" required>
                            <input type="file" id="fileInput" name="image" accept="image/*" style="display: none;"/>
                            <p style="float: right ;"><a href="forgot-password.php" style="margin-bottom: 15px; display: block; text-align: right;">Forgot Password?</a></p>
                            <p style="float: left;"><a href="../" style="margin-bottom: 15px; display: block; text-align: right;">Back Home</a></p>
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
    <script src="https://madridejoscommunitycollege.com/assets/js/location.js"></script>
    <script src="https://madridejoscommunitycollege.com/assets/js/camera.js"></script>
    <script>
        $(document).ready(function(c) {
            $('.alert-close').on('click', function(c) {
                $('.main-mockup').fadeOut('slow', function(c) {
                    $('.main-mockup').remove();
                });
            });
        });
    </script>

</body>

</html>
