<?php
// Initialize the session
session_start();
?>
<html>
    <head>
        <title>Core PHP</title>
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <!-- Styles -->
        <!-- bootstrap5 css -->
        <link href="css/bootstrap.min.css" rel="stylesheet">
    </head>
    <body>
        <?php
        include 'header.php';
        ?>
        <div class='container'>
            <?php if (isset($_SESSION["error"]) && $_SESSION["error"] != '') { ?>
                <div class='row mt-4 justify-content-center'>
                    <div class='col col-8'>
                        <div class="alert alert-danger">
                            <ul>
                                <li><?php echo $_SESSION["error"] ?></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <?php
                unset($_SESSION['error']);
            }
            ?>
            <div class='row mt-5 justify-content-center'>
                <div class='col col-3'>
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title mb-5">Register Here</h5>
                            <form method="post" action="register.php" class="signup-form">
                                <div class="mb-3">
                                    <label class="form-label">Name</label>
                                    <input type="text" class="form-control" name="name" required="">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Email address</label>
                                    <input type="email" class="form-control" name="email" required="">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Password</label>
                                    <input type="password" class="form-control" name="password" required="">
                                </div>
                                <div class="mb-3">
                                    <button type="submit" class="btn btn-primary signup-button" style="width:100%">Sign Up</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- bootstrap5 js -->
        <script src="js/bootstrap.min.js"></script>
    </body>
</html>