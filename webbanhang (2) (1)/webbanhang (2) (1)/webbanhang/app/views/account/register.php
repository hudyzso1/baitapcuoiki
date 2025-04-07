<?php include 'app/views/shares/header.php'; ?>

<!-- Import Font Awesome cho icon -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

<section class="vh-100" style="background: linear-gradient(135deg, #667eea, #764ba2);">
    <div class="container py-5 h-100">
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                <div class="card text-white bg-dark shadow-lg" style="border-radius: 15px;">
                    <div class="card-body p-5 text-center">
                        <h2 class="fw-bold text-uppercase"><i class="fas fa-user-plus"></i> Register</h2>
                        <p class="text-white-50 mb-4">Create your account</p>

                        <!-- Hiển thị lỗi nếu có -->
                        <?php if (isset($errors) && !empty($errors)) : ?>
                            <div class="alert alert-danger text-left">
                                <ul class="mb-0">
                                    <?php foreach ($errors as $error) : ?>
                                        <li><i class="fas fa-exclamation-triangle"></i> <?php echo htmlspecialchars($error); ?></li>
                                    <?php endforeach; ?>
                                </ul>
                            </div>
                        <?php endif; ?>

                        <form class="user" action="/webbanhang/account/save" method="post">
                            <div class="form-group text-left">
                                <label for="username"><i class="fas fa-user"></i> Username</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-light"><i class="fas fa-user"></i></span>
                                    </div>
                                    <input type="text" class="form-control" id="username" name="username" placeholder="Enter username" required>
                                </div>
                            </div>

                            <div class="form-group text-left">
                                <label for="fullname"><i class="fas fa-user-edit"></i> Full Name</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-light"><i class="fas fa-user-edit"></i></span>
                                    </div>
                                    <input type="text" class="form-control" id="fullname" name="fullname" placeholder="Enter full name" required>
                                </div>
                            </div>

                            <div class="form-group text-left">
                                <label for="password"><i class="fas fa-lock"></i> Password</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-light"><i class="fas fa-lock"></i></span>
                                    </div>
                                    <input type="password" class="form-control" id="password" name="password" placeholder="Enter password" required>
                                </div>
                            </div>

                            <div class="form-group text-left">
                                <label for="confirmpassword"><i class="fas fa-lock"></i> Confirm Password</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-light"><i class="fas fa-lock"></i></span>
                                    </div>
                                    <input type="password" class="form-control" id="confirmpassword" name="confirmpassword" placeholder="Confirm password" required>
                                </div>
                            </div>

                            <button type="submit" class="btn btn-primary btn-block mt-3">
                                <i class="fas fa-user-plus"></i> Register
                            </button>

                            <p class="mt-3">Already have an account? 
                                <a href="/webbanhang/account/login" class="text-info"><i class="fas fa-sign-in-alt"></i> Login</a>
                            </p>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php include 'app/views/shares/footer.php'; ?>
