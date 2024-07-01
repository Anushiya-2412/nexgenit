<?php
    session_start();
    if(isset($_SESSION['user']) && $_SESSION['user'] != '')
    {
        header("Location:dashboard.php");
    }
    
?>
<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8" />
        <title>RORIRI PVT LTD</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description" />
        <meta content="Coderthemes" name="author" />

        <!-- App favicon -->
        <link rel="shortcut icon" href="assets/images/favicon.ico">
        
        <!-- Theme Config Js -->
        <script src="assets/js/config.js"></script>

        <!-- App css -->
        <link href="assets/css/app.min.css" rel="stylesheet" type="text/css" id="app-style" />

        <!-- Icons css -->
        <link href="assets/css/icons.min.css" rel="stylesheet" type="text/css" />
    </head>
    
    <body class="authentication-bg position-relative">
        <div class="account-pages pt-2 pt-sm-5 pb-4 pb-sm-5 position-relative">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-xxl-6 col-lg-5">
                        <div class="position-relative rounded-3 overflow-hidden" style="background-image: url(assets/images/flowers/img-3.png); background-position: top right; background-repeat: no-repeat;">
                            <div class="card bg-transparent mb-0">
                            <!-- Logo-->
                            <div class="auth-brand">
                                <a href="index.html" class="logo-light">
                                    <img src="assets/images/logo.png" alt="logo" height="22">
                                </a>
                                <a href="index.html" class="logo-dark">
                                    <img src="assets/images/logo-dark.png" alt="dark logo" height="22">
                                </a>
                            </div>
                            
                            <div class="card-body p-4">
                                <div class="w-50">
                                    <h4 class="pb-0 fw-bold">Sign In</h4>
                                    <p class="fw-semibold mb-4">Enter your username and password to access admin panel.</p>
                                </div>

                                <form action="actLogin.php" method="post">

                                    <?php
                                        if(isset($_SESSION['message']) && $_SESSION['message'] != '')
                                        {
                                            ?>
                                            <div class="div" style="color:red">
                                                <?php echo $_SESSION['message']; $_SESSION['message'] = '';?>
                                            </div>
                                            <?php
                                        }
                                    ?>

                                    <div class="mb-3">
                                        <label for="username" class="form-label">Username</label>
                                        <input class="form-control" type="text" id="username" name="username" required="required" placeholder="Enter your username">
                                    </div>

                                    <div class="mb-3">
                                        <!-- <a href="auth-recoverpw.html" class="float-end fs-12">Forgot your password?</a> -->
                                        <label for="password" class="form-label">Password</label>
                                        <div class="input-group input-group-merge">
                                            <input type="password" id="password" name="password" class="form-control" placeholder="Enter your password">
                                            <div class="input-group-text" data-password="false">
                                                <span class="password-eye"></span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="mb-3 mb-0 text-center">
                                        <button class="btn btn-primary w-100" type="submit"> Log In </button>
                                    </div>

                                </form>
                            </div> <!-- end card-body -->
                        </div>
                        <!-- end card -->
                    </div>

                        
                        <!-- end row -->

                    </div> <!-- end col -->
                </div>
                <!-- end row -->
            </div>
            <!-- end container -->
        </div>
        <!-- end page -->

        <footer class="footer footer-alt fw-medium">
            <span class="bg-body"><script>document.write(new Date().getFullYear())</script> © RORIRI SOFTWARE SOLUTIONS PVT. LTD.</span>
        </footer>
        <!-- Vendor js -->
        <script src="assets/js/vendor.min.js"></script>
        
        <!-- App js -->
        <script src="assets/js/app.min.js"></script>

    </body>
</html>
