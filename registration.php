<!DOCTYPE html>
<html lang="en" class="light-style customizer-hide" dir="ltr" data-theme="theme-default" data-assets-path="../assets/" data-template="vertical-menu-template-free">
<head>
    <meta charset="utf-8" />
    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0"
    />

    <title>Register Basic - PMMS</title>

    <meta name="description" content="" />

<?php include 'includes/css.php'; ?>
</head>
<body>
<!-- Content -->
<div class="container-xxl">
    <div class="authentication-wrapper authentication-basic container-p-y">
        <div class="authentication-inner">
            <!-- Register Card.. -->
            <div class="card">
                <div class="card-body">
                    <!-- Logo -->
                    <div class="app-brand justify-content-center">
                        <a href="#" class="app-brand-link gap-2">
                            <span class="app-brand-logo demo">
                                <!-- Your logo SVG or image here -->
                            </span>
                            <h2 class=" demo text-body fw-bolder">PMMS</h2>
                        </a>
                    </div>
                    <!-- /Logo -->
                    <div class="justify-content-center">
                    <h4 class="mb-2 ">Adventure starts here 🚀</h4>
                    </div>

                    <!-- Bootstrap Toasts for warnings and success messages -->
                    <div class="bs-toast toast fade bg-warning position-fixed bottom-0 end-0 me-3 mb-3" role="alert" aria-live="assertive" aria-atomic="true">
                        <div class="toast-header">
                            <i class="bx bx-bell me-2"></i>
                            <div class="me-auto fw-semibold">Warning</div>
                            <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                        </div>
                        <div class="toast-body">
                            <?php echo isset($warningMsg) ? $warningMsg : ''; ?>
                        </div>
                    </div>

                    <div class="bs-toast toast fade bg-success position-fixed bottom-0 end-0 me-3 mb-3" role="alert" aria-live="assertive" aria-atomic="true">
                        <div class="toast-header">
                            <i class="bx bx-bell me-2"></i>
                            <div class="me-auto fw-semibold">Success</div>
                            <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                        </div>
                        <div class="toast-body">
                            <?php echo isset($successMsg) ? $successMsg : ''; ?>
                        </div>
                    </div>
                    <!-- /Bootstrap Toasts -->

                    <!-- Registration Form -->
                    <form id="formAuthentication" class="mb-3" action="register.php" method="POST" enctype="multipart/form-data">
                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="Enter your name" autofocus required>
                        </div>
                        <div class="mb-3">
                            <label for="username" class="form-label">Username</label>
                            <input type="text" class="form-control" id="username" name="username" placeholder="Enter your username" required>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email" placeholder="Enter your email" required>
                        </div>
                        <div class="mb-3">
                            <label for="phone" class="form-label">Phone</label>
                            <input type="tel" class="form-control" id="phone" name="phone" placeholder="Enter your phone number" required>
                        </div>
                        <div class="mb-3 form-password-toggle">
                            <label for="password" class="form-label">Password</label>
                            <div class="input-group input-group-merge">
                                <input type="password" id="password" class="form-control" name="password" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" aria-describedby="password" required>
                                <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                            </div>
                        </div>
                        <div class="mb-3 form-password-toggle">
                            <label for="confirm_password" class="form-label">Confirm Password</label>
                            <div class="input-group input-group-merge">
                                <input type="password" id="confirm_password" class="form-control" name="confirm_password" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" aria-describedby="confirm_password" required>
                                <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                            </div>
                            <div class="invalid-feedback " id="password-mismatch-feedback">
                                Password and Confirm Password do not match!
                            </div>
                            <div class="valid-feedback " id="password-mismatch-feedback2">
                                Password and Confirm Password is match!
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="profile_picture" class="form-label">Profile Picture</label>
                            <input type="file" class="form-control" id="profile_picture" name="profile_picture" required>
                        </div>
                        <div class="mb-3">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="terms-conditions" name="terms" required>
                                <label class="form-check-label" for="terms-conditions">
                                    I agree to <a href="javascript:void(0);">privacy policy & terms</a>
                                </label>
                            </div>
                        </div>
                        <button class="btn btn-primary d-grid w-100" type="submit" name="submit" id="submit-btn" disabled>Sign up</button>
                    </form>
                    <!-- /Registration Form -->

                    <p class="text-center">
                        <span>Already have an account?</span>
                        <a href="login.php">
                            <span>Sign in instead</span>
                        </a>
                    </p>
                </div>
            </div>
            <!-- /Register Card -->
        </div>
    </div>
</div>
<!-- /Content -->


<script src="includes/js.php"></script>

<script>
    // JavaScript to check if password and confirm password match
    const passwordInput = document.getElementById('password');
    const confirmPasswordInput = document.getElementById('confirm_password');
    const passwordMismatchFeedback = document.getElementById('password-mismatch-feedback');
    const passwordMismatchFeedback2 = document.getElementById('password-mismatch-feedback2');
    const submitButton = document.getElementById('submit-btn');

    confirmPasswordInput.addEventListener('input', () => {
        if (passwordInput.value === confirmPasswordInput.value) {
            passwordMismatchFeedback.style.display = 'none';
            passwordMismatchFeedback2.style.display = 'block';
            submitButton.disabled = false;
        } else {
            passwordMismatchFeedback.style.display = 'block';
            passwordMismatchFeedback2.style.display = 'none';
            submitButton.disabled = true;
        }
    });
</script>
</body>
</html>
