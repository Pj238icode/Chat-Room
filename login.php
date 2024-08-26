<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css"
        integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="CSS/login.css">

    <title>Chat Room</title>
</head>

<body>
    <?php
       include 'partials/navbar.php';
    ?>
    <div class="loading-screen" id="spinner">
        <div class="spinner-border text-primary" role="status"></div>
    </div>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-6 col-md-12 d-flex align-items-center justify-content-center">
                <div class="img-container">
                    <img src="img4.jpg" alt="Placeholder Image" class="img-fluid">
                </div>
            </div>
            <div class="col-lg-6 col-md-12 d-flex align-items-center justify-content-center">
                <div class="card" style="width: 100%; max-width: 500px;">
                    <div class="card-body">
                        <h5 class="card-title">Login</h5>
                        <form id="sign_in">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Email</label>
                                <input type="email" class="form-control" name="email" id="exampleInputEmail1"
                                    aria-describedby="emailHelp" required>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Password</label>
                                <div class="input-group">
                                    <input type="password" class="form-control" name="password" id="exampleInputPassword1"
                                        required>
                                    <div class="input-group-append">
                                        <span class="input-group-text" id="pass-img">
                                            <i class="fas fa-eye"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group form-check">
                                <input type="checkbox" class="form-check-input" id="exampleCheck1">
                                <label class="form-check-label" for="exampleCheck1">Remember Me</label>
                            </div>
                            <div class="form-group forgot-password-link">
                                <a href="forgot_password.php" class="text-primary">Forgot Password?</a>
                            </div>
                            <button type="submit" class="btn btn-primary mt-3">Login</button>
                            <div class="signup-link text-center mt-3">
                                <p>Not a registered user? <a href="signup.php">Sign up</a></p>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="JS/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script src="JS/login.js"></script>

</body>

</html>
