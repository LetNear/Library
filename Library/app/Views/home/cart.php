<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>InScentTive - Cart</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        /* Custom CSS for header, footer, and body */
        body {
            background-color: #f4f4f9; /* Light background for a fresh look */
        }

        header {
            background-color: #008080; /* Teal background for a unique 'InScentTive' feel */
            color: #fff;
            padding: 20px 0;
            text-align: center;
        }

        footer {
            background-color: #008080; /* Matching footer to header */
            color: #fff;
            padding: 20px 0;
            text-align: center;
            position: fixed;
            bottom: 0;
            width: 100%;
        }

        .container-products {
            min-height: calc(100vh - 190px); /* Adjust height for better layout */
        }

        .cart-item {
            background-color: #fff; /* Light background for cart items */
            border: 1px solid #ccc;
            border-radius: 8px; /* Rounded borders for a soft look */
            margin-bottom: 20px;
            padding: 20px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1); /* Subtle shadow for depth */
        }

        .btn-danger {
            background-color: #dc3545; /* Bootstrap red for contrast */
        }

        .btn-back {
            margin-bottom: 20px; /* Space before cart items */
        }
    </style>
</head>
<body>
    <!-- Header -->
    <header>
        <h1>Welcome to InScentTive</h1>
        <p>Your Cart</p>
    </header>

    <!-- Back Button -->
    <div class="container mt-3">
        <button onclick="window.history.back();" class="btn btn-light btn-back">Go Back</button>
    </div>

    <!-- Cart Items Section -->
    <div class="container mt-2">
        <?php if (!empty($cartItems)) : ?>
            <?php foreach ($cartItems as $item) : ?>
                <div class="cart-item">
                    <h5><?= $item['name']; ?></h5>
                    <p>Quantity: <?= $item['quantity']; ?></p>
                    <p>Price: <?= $item['price']; ?></p>
                    <form action="<?= base_url('cart/delete/' . $item['id']); ?>" method="post">
                        <button type="submit" class="btn btn-danger">Remove</button>
                    </form>
                </div>
            <?php endforeach; ?>
        <?php else : ?>
            <p>Your cart is empty.</p>
        <?php endif; ?>
    </div>

    <!-- Footer -->
    <footer>
        <p>&copy; <?= date('Y'); ?> InScentTive. All rights reserved.</p>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
