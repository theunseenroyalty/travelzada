<?php

session_start();
if (isset($_SESSION['username'])) {
    header("Location: dashboard");
    exit();
}

include 'admin-database-connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Prepare and bind
    $stmt = $conn->prepare("SELECT * FROM user WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if user exists
    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        // Verify password
        if ($password === $user['password']) {
            // Password is correct, start a session
            session_start();
            $_SESSION['username'] = $user['username'];
            // Redirect to admin dashboard or any other page
            header("Location: dashboard");
            exit();
        } else {
            $error_login_message = "Invalid password.";
        }
    } else {
        $error_login_message = "No user found with that username or email.";
    }

    $stmt->close();
    $conn->close();
}
?>

<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>Login</title>

    <!-- Template CSS -->
    <link rel="stylesheet" href="assets/css/style-starter.css">

</head>

<body class="sidebar-menu-collapsed">
    <div class="se-pre-con"></div>
    <section>
        
            <!-- content -->
            <div class="container-fluid content-top-gap">

                <?php include 'admin-breadcrumb.php'; ?>
                
                <!-- forms -->
                <section class="forms">
                    <!-- forms 1 -->
                    <div class="card card_border py-2 mb-4">
                        <div class="cards__heading">
                            <h3>Admin Login</h3>
                        </div>
                        <div class="card-body">
                            <?php if (isset($error_login_message)): ?>
                                <div class="alert alert-danger" role="alert">
                                    <?php echo $error_login_message; ?>
                                </div>
                            <?php endif; ?>
                            <form action="#" method="post">
                                <div class="form-group">
                                    <label for="username" class="input__label">Email address or Username</label>
                                    <input type="text" class="form-control input-style" id="username" name="username" placeholder="Enter email or username" required>
                                </div>
                                <div class="form-group">
                                    <label for="password" class="input__label">Password</label>
                                    <input type="password" class="form-control input-style" id="password" name="password" placeholder="Password" required>
                                </div>
                                <button type="submit" class="btn btn-primary btn-style mt-4">Login</button>
                            </form>
                        </div>
                    </div>
                    <!-- //forms 1 -->
                </section>
                <!-- //forms -->
            </div>
            <!-- //content -->

    </section>
    
    <?php include 'admin-footer.php'; ?>

    <!-- move top -->
    <button onclick="topFunction()" id="movetop" class="bg-primary" title="Go to top">
        <span class="fa fa-angle-up"></span>
    </button>
    <script>
        // When the user scrolls down 20px from the top of the document, show the button
        window.onscroll = function () {
            scrollFunction()
        };

        function scrollFunction() {
            if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
                document.getElementById("movetop").style.display = "block";
            } else {
                document.getElementById("movetop").style.display = "none";
            }
        }

        // When the user clicks on the button, scroll to the top of the document
        function topFunction() {
            document.body.scrollTop = 0;
            document.documentElement.scrollTop = 0;
        }
    </script>
    <!-- /move top -->


    <script src="assets/js/jquery-3.3.1.min.js"></script>
    <script src="assets/js/jquery-1.10.2.min.js"></script>

    <!-- chart js -->
    <script src="assets/js/Chart.min.js"></script>
    <script src="assets/js/utils.js"></script>
    <!-- //chart js -->

    <!-- Different scripts of charts.  Ex.Barchart, Linechart -->
    <script src="assets/js/bar.js"></script>
    <script src="assets/js/linechart.js"></script>
    <!-- //Different scripts of charts.  Ex.Barchart, Linechart -->


    <script src="assets/js/jquery.nicescroll.js"></script>
    <script src="assets/js/scripts.js"></script>

    <!-- close script -->
    <script>
        var closebtns = document.getElementsByClassName("close-grid");
        var i;

        for (i = 0; i < closebtns.length; i++) {
            closebtns[i].addEventListener("click", function () {
                this.parentElement.style.display = 'none';
            });
        }
    </script>
    <!-- //close script -->

    <!-- disable body scroll when navbar is in active -->
    <script>
        $(function () {
            $('.sidebar-menu-collapsed').click(function () {
                $('body').toggleClass('noscroll');
            })
        });
    </script>
    <!-- disable body scroll when navbar is in active -->

    <!-- loading-gif Js -->
    <script src="assets/js/modernizr.js"></script>
    <script>
        $(window).load(function () {
            // Animate loader off screen
            $(".se-pre-con").fadeOut("slow");;
        });
    </script>
    <!--// loading-gif Js -->

    <!-- Bootstrap Core JavaScript -->
    <script src="assets/js/bootstrap.min.js"></script>


</body>

</html>
