<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý sản phẩm</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
/* Navbar gradient background - Hologram style */
.navbar {
    background: linear-gradient(90deg, #ff9a9e, #fad0c4, #a1c4fd, #c2e9fb);
    background-size: 400% 400%;
    animation: gradientShift 8s ease infinite;
}

/* Navbar text */
.navbar-brand, .nav-link {
    color: white !important;
    text-shadow: 0 0 5px rgba(255, 255, 255, 0.8);
}

.nav-link:hover {
    color: #ffe4ff !important;
}

/* Product image styling */
.product-image {
    max-width: 120px;
    height: auto;
    border-radius: 8px;
    box-shadow: 0 4px 10px rgba(173, 216, 230, 0.6);
}

/* Custom button style - Hologram inspired */
.btn-custom {
    background: linear-gradient(135deg, #f6d365, #fda085);
    border: none;
    color: #333;
    font-weight: bold;
    border-radius: 25px;
    padding: 10px 20px;
    box-shadow: 0 4px 15px rgba(255, 255, 255, 0.4);
    transition: all 0.3s ease;
}

.btn-custom:hover {
    background: linear-gradient(135deg, #a1c4fd, #c2e9fb);
    color: #000;
}

/* Container padding */
.container {
    margin-top: 30px;
}

/* Username display */
.username {
    font-weight: bold;
    color: #f8c8dc;
    text-shadow: 0 0 5px #ffffff;
}


}

    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light">
        <a class="navbar-brand" href="#">Quản lý sản phẩm</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="/webbanhang/Product/">📋 Danh sách sản phẩm</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/webbanhang/Product/add">➕ Thêm sản phẩm</a>
                </li>
                <li class="nav-item">
                    <?php
                        if (SessionHelper::isLoggedIn()) {
                            echo "<a class='nav-link username'>👤 " . htmlspecialchars($_SESSION['username']) . "</a>";
                        } else {
                            echo "<a class='nav-link' href='/webbanhang/account/login'>🔑 Đăng nhập</a>";
                        }
                    ?>
                </li>
                <?php if (SessionHelper::isLoggedIn()): ?>
                <li class="nav-item">
                    <a class="nav-link text-danger" href="/webbanhang/account/logout">🚪 Đăng xuất</a>
                </li>
                <?php endif; ?>
            </ul>
        </div>
    </nav>

    <div class="container mt-4">
        <h1 class="text-center" style="color: #6a1b9a;">🌌 Quản lý sản phẩm</h1>
        <p class="text-center">Trang quản lý sản phẩm dành cho quản trị viên.</p>

        
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
                }