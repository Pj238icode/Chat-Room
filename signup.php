<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.rtl.min.css"
        integrity="sha384-dpuaG1suU0eT09tx5plTaGMLBsfDLzUCCUXOY2j/LSvXYuG6Bqs43ALlhIqAJVRb" crossorigin="anonymous">
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>

    <!-- Font Awesome for Google logo -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <!-- Custom CSS -->
     <link rel="stylesheet" href="CSS/Signup.css">

    <title>Sign Up</title>
</head>

<body>
    <div class="loading-screen" id="spinner">
        <div class="spinner-border text-primary" role="status">
            <span class="visually-hidden">Loading...</span>
        </div>
    </div>

    <?php include_once 'Partials/navbar.php'; ?>

    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-md-12 d-flex align-items-center justify-content-center">
                <div class="img-container">
                    <img src="img5.jpg" alt="Placeholder Image" class="img-fluid">
                </div>
            </div>
            <div class="col-lg-6 col-md-12 d-flex align-items-center justify-content-center">
                <div class="card" style="width: 100%; max-width: 500px;">
                    <div class="card-body">
                        <h5 class="card-title">Sign Up</h5>
                        <form id="signup-form">
                            <div class="form-group">
                                <label for="username">Username</label>
                                <input type="text" class="form-control" spellcheck="false" name="username" id="username"
                                    required>
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" class="form-control" spellcheck="false" name="email" id="email"
                                    aria-describedby="emailHelp" required>
                            </div>
                            <div class="form-group mt-3">
                                <label for="password">Password</label>
                                <div class="input-group">
                                    <input type="password" class="form-control" name="password" id="password" required>
                                    <div class="input-group-append">
                                        <span class="input-group-text" id="pass-img">
                                            <i class="fas fa-eye"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="g-recaptcha mt-3" data-sitekey=""></div>
                            <button type="submit" class="btn btn-primary mt-3" id="signup">Sign Up</button>
                            <div class="signup-link">
                                <p class="text-center">Not a registered user? <a href="Login.php">Login</a></p>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS and dependencies -->
    <script src="JS/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script src="JS/Signup.js"></script>

</body>

</html>
