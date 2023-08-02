<!DOCTYPE html>
<html lang="en" class="light-style customizer-hide" dir="ltr" data-theme="theme-default" data-assets-path="../assets/" data-template="vertical-menu-template-free">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    <title>Login Basic - Pages | Sneat - Bootstrap 5 HTML Admin Template - Pro</title>

    <meta name="description" content="" />

    <?php include 'includes/css.php'; ?>
</head>

<body>
    <!-- Content -->

    <div class="container-xxl">
        <div class="authentication-wrapper authentication-basic container-p-y">
            <div class="authentication-inner">
                <!-- Register -->
                <div class="card">
                    <div class="card-body">
                        <!-- Logo -->
                        <div class="app-brand justify-content-center">
                            <a href="index.html" class="app-brand-link gap-2">
                                <span class="app-brand-logo demo">
                                    <svg width="25" viewBox="0 0 25 42" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                                        <!-- Your logo SVG or image here -->
                                    </svg>
                                </span>
                                <span class="app-brand-text demo text-body fw-bolder">Sneat</span>
                            </a>
                        </div>
                        <!-- /Logo -->
                        <h4 class="mb-2">Welcome to Sneat! 👋</h4>
                        <p class="mb-4">Please sign-in to your account and start the adventure</p>

                        <?php
                        require_once 'includes/db.php';

                        // Check if the form is submitted
                        if (isset($_POST['email-username']) && isset($_POST['password'])) {
                            $emailOrUsername = $_POST['email-username'];
                            $password = $_POST['password'];

                            // Escape user inputs to prevent SQL injection
                            $emailOrUsername = mysqli_real_escape_string($conn, $emailOrUsername);

                            // Query to check if the email or username match a record in the database
                            $query = "SELECT * FROM users WHERE (email = '$emailOrUsername' OR username = '$emailOrUsername')";
                            $result = mysqli_query($conn, $query);

                            // Check if any rows are returned
                            if (mysqli_num_rows($result) > 0) {
                                // User found, now verify the password
                                $row = mysqli_fetch_assoc($result);
                                $hashedPasswordFromDB = $row['password'];

                                // Verify the password using password_verify()
                                if (password_verify($password, $hashedPasswordFromDB)) {
                                    // Password matches, login successful, redirect to dashboard
                                    header('Location: dashboard.php');
                                    exit();
                                } else {
                                    // Password does not match, show an error message
                                    $errorMsg = "Invalid email/username or password. Please try again.";
                                }
                            } else {
                                // No matching user found, show an error message
                                $errorMsg = "Invalid email/username or password. Please try again.";
                            }
                        }

                        // Close database connection
                        mysqli_close($conn);
                        ?>

                        <form id="formAuthentication" class="mb-3" action="login.php" method="POST">
                            <div class="mb-3">
                                <label for="email" class="form-label">Email or Username</label>
                                <input type="text" class="form-control" id="email" name="email-username" placeholder="Enter your email or username" autofocus />
                            </div>
                            <div class="mb-3 form-password-toggle">
                                <div class="d-flex justify-content-between">
                                    <label class="form-label" for="password">Password</label>
                                    <a href="auth-forgot-password-basic.html">
                                        <small>Forgot Password?</small>
                                    </a>
                                </div>
                                <div class="input-group input-group-merge">
                                    <input type="password" id="password" class="form-control" name="password" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" aria-describedby="password" />
                                    <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                                </div>
                            </div>
                            <div class="mb-3">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="remember-me" />
                                    <label class="form-check-label" for="remember-me"> Remember Me </label>
                                </div>
                            </div>
                            <div class="mb-3">
                                <button class="btn btn-primary d-grid w-100" type="submit">Sign in</button>
                            </div>

                            <?php if (isset($errorMsg)): ?>
                                <div class="alert alert-danger" role="alert">
                                    <?php echo $errorMsg; ?>
                                </div>
                            <?php endif; ?>

                        </form>

                        <p class="text-center">
                            <span>New on our platform?</span>
                            <a href="auth-register-basic.html">
                                <span>Create an account</span>
                            </a>
                        </p>
                    </div>
                </div>
                <!-- /Register -->
            </div>
        </div>
    </div>

    <!-- / Content -->



    <script src="includes/js.php"></script>
</body>
</html>
