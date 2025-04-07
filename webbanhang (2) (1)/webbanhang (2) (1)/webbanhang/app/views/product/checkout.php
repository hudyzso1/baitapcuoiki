
<?php include 'app/views/shares/header.php'; ?>

<div class="container mt-4">
    <h1>Thanh toán</h1>

    <form method="POST" action="/webbanhang/Product/processCheckout">
        <div class="mb-3">
            <label for="name" class="form-label">Họ tên:</label>
            <input type="text" id="name" name="name" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="phone" class="form-label">Số điện thoại:</label>
            <input type="text" id="phone" name="phone" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="address" class="form-label">Địa chỉ:</label>
            <textarea id="address" name="address" class="form-control" required></textarea>
        </div>

        <button type="submit" class="btn btn-primary">Thanh toán</button>
        <a href="/webbanhang/Product/cart" class="btn btn-secondary mt-2">Quay lại giỏ hàng</a>
    </form>

</div>

<?php include 'app/views/shares/footer.php'; ?>