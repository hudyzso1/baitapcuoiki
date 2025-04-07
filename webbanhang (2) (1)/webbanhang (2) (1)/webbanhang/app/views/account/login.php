<?php include 'app/views/shares/header.php'; ?>

<!-- Import Font Awesome cho icon -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

<section class="vh-100" style="background: linear-gradient(135deg, #667eea, #764ba2);">
    <div class="container py-5 h-100">
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                <div class="card text-white bg-dark shadow-lg" style="border-radius: 15px;">
                    <div class="card-body p-5 text-center">
                        <form action="/webbanhang/account/checklogin" method="post">
                            <div class="mb-4">
                                <h2 class="fw-bold text-uppercase"><i class="fas fa-sign-in-alt"></i> Login</h2>
                                <p class="text-white-50">Please enter your credentials</p>
                            </div>

                            <!-- Hiển thị lỗi nếu có -->
                            <?php if (isset($_SESSION['login_error'])): ?>
                                <div class="alert alert-danger"><i class="fas fa-exclamation-circle"></i> <?php echo $_SESSION['login_error']; ?></div>
                                <?php unset($_SESSION['login_error']); ?>
                            <?php endif; ?>

                            <div class="form-group text-left">
                                <label for="username"><i class="fas fa-user"></i> Username</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-light"><i class="fas fa-user"></i></span>
                                    </div>
                                    <input type="text" name="username" class="form-control" required>
                                </div>
                            </div>

                            <div class="form-group text-left">
                                <label for="password"><i class="fas fa-lock"></i> Password</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-light"><i class="fas fa-lock"></i></span>
                                    </div>
                                    <input type="password" name="password" class="form-control" required>
                                </div>
                            </div>

                            <button class="btn btn-primary btn-block mt-3">
                                <i class="fas fa-sign-in-alt"></i> Login
                            </button>

                            <p class="mt-3">
                                <a class="text-white-50" href="#"><i class="fas fa-key"></i> Forgot password?</a>
                            </p>

                            <p class="mt-3">Don't have an account? 
                                <a href="/webbanhang/account/register" class="text-info"><i class="fas fa-user-plus"></i> Sign Up</a>
                            </p>

                            <!-- Social login -->
                            <div class="d-flex justify-content-center mt-3">
                                <a href="#" class="btn btn-outline-light mx-1"><i class="fab fa-facebook-f"></i></a>
                                <a href="#" class="btn btn-outline-light mx-1"><i class="fab fa-twitter"></i></a>
                                <a href="#" class="btn btn-outline-light mx-1"><i class="fab fa-google"></i></a>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php include 'app/views/shares/footer.php'; ?>
