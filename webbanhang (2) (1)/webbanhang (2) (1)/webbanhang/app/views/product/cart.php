<?php include 'app/views/shares/header.php'; ?>

<div class="container mt-4" style="background: linear-gradient(to right,rgb(166, 160, 255),rgb(208, 182, 255)); padding: 30px; border-radius: 15px; box-shadow: 0 6px 12px rgba(0, 0, 0, 0.1);">
    <h1 class="text-center text-primary" style="font-family: 'Comic Sans MS', sans-serif; color: #2E3A59;">Giỏ hàng <span style="font-size: 1.5rem;">🌙 ⭐</span></h1>

    <?php if (!empty($cart)): ?>
        <ul class="list-group shadow-sm rounded">
            <?php foreach ($cart as $id => $item): ?>
                <li class="list-group-item d-flex align-items-center justify-content-between mb-3" style="background-color: #fff; border-radius: 10px; border: 1px solid #ddd; padding: 15px;">
                    <div class="d-flex align-items-center">
                        <?php if ($item['image']): ?>
                            <img src="/webbanhang/<?php echo htmlspecialchars($item['image'], ENT_QUOTES, 'UTF-8'); ?>" alt="Product Image" style="max-width: 80px; margin-right: 15px; border-radius: 10px;">
                        <?php endif; ?>

                        <div>
                            <h5 class="mb-1 text-dark"><?php echo htmlspecialchars($item['name'], ENT_QUOTES, 'UTF-8'); ?></h5>
                            <p class="mb-1" style="color:rgb(99, 64, 255);">
                                Giá: <strong id="price-<?php echo $id; ?>">
                                    <?php echo number_format(htmlspecialchars($item['price'] * $item['quantity'], ENT_QUOTES, 'UTF-8')); ?> VND
                                </strong>
                            </p>
                            <p class="mb-0" style="color: #6f6f6f;">
                                Số lượng:
                                <button class="btn btn-sm btn-outline-secondary update-quantity" data-id="<?php echo $id; ?>" data-action="decrease">-</button>
                                <span class="text-muted quantity" id="quantity-<?php echo $id; ?>">
                                    <?php echo htmlspecialchars($item['quantity'], ENT_QUOTES, 'UTF-8'); ?>
                                </span>
                                <button class="btn btn-sm btn-outline-secondary update-quantity" data-id="<?php echo $id; ?>" data-action="increase">+</button>
                                <button class="btn btn-sm btn-outline-danger remove-item" data-id="<?php echo $id; ?>">❌</button>
                            </p>
                        </div>
                    </div>
                </li>
            <?php endforeach; ?>
        </ul>

        <div class="d-flex justify-content-between mt-4">
            <a href="/webbanhang/Product" class="btn btn-outline-info btn-lg">
                <i class="fas fa-arrow-left"></i> Tiếp tục mua sắm
            </a>
            <a href="/webbanhang/Product/checkout" class="btn btn-primary btn-lg">
                <i class="fas fa-credit-card"></i> Thanh toán
            </a>
        </div>
    <?php else: ?>
        <p class="mt-3 text-center" style="font-size: 1.2rem;">Giỏ hàng của bạn đang trống. 🛒</p>
        <div class="text-center mt-2">
            <a href="/webbanhang/Product" class="btn btn-outline-info btn-lg">
                <i class="fas fa-arrow-left"></i> Tiếp tục mua sắm
            </a>
        </div>
    <?php endif; ?>
</div>

<?php include 'app/views/shares/footer.php'; ?>

<script>
document.querySelectorAll('.update-quantity').forEach(button => {
    button.addEventListener('click', function() {
        const productId = this.getAttribute('data-id');
        const action = this.getAttribute('data-action');
        
        fetch('/webbanhang/Product/updateCart', {
            method: 'POST',
            headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
            body: `id=${productId}&action=${action}`
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                document.getElementById(`quantity-${productId}`).innerText = data.quantity;
                document.getElementById(`price-${productId}`).innerText = new Intl.NumberFormat().format(data.totalPrice) + " VND";
            }
        });
    });
});

document.querySelectorAll('.remove-item').forEach(button => {
    button.addEventListener('click', function() {
        const productId = this.getAttribute('data-id');

        fetch('/webbanhang/Product/removeFromCart', {
            method: 'POST',
            headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
            body: `id=${productId}`
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                location.reload();
            }
        });
    });
});
</script>

<style>
    .list-group-item {
        display: flex;
        justify-content: space-between;
        align-items: center;
        border-radius: 10px;
        background-color: #fff;
        padding: 20px;
        border: 1px solid #ddd;
    }

    .btn {
        font-size: 1rem;
        padding: 6px 12px;
        border-radius: 30px;
        transition: all 0.3s;
    }

    .btn:hover {
        box-shadow: 0 5px 15px rgba(0, 123, 255, 0.2);
        transform: translateY(-2px);
    }

    .remove-item {
        margin-left: 10px;
        color: red;
        cursor: pointer;
        border: none;
        background: none;
        font-size: 1.2rem;
    }
</style>

<script src="https://kit.fontawesome.com/a076d05399.js"></script>
