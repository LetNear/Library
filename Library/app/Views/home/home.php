<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>InScentTive - Shop the Finest Scents</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        /* Custom CSS for header and footer */
        header {
            background-color: #2c3e50; /* Dark background color */
            color: #fff;
            padding: 20px 0;
            text-align: center;
            border-bottom: 3px solid #16a085; /* Accent color */
        }

        footer {
            background-color: #2c3e50; /* Dark background color */
            color: #fff;
            padding: 20px 0;
            text-align: center;
            position: fixed;
            bottom: 0;
            width: 100%;
        }

        .container-products {
            padding-top: 2rem;
            padding-bottom: 2rem;
            min-height: calc(100vh - 190px); /* Ensure the footer does not overlap content on smaller screens */
        }

        .card {
            border: none; /* Remove border from cards */
            transition: transform .2s; /* Animation for hover transform */
            background-color: #34495e; /* Darker background color */
            color: #fff;
        }

        .card:hover {
            transform: scale(1.05); /* Scale cards on hover for interactive feel */
        }

        .card-body {
            border-radius: 10px; /* Add border radius to card body */
        }

        .btn-primary {
            width: 100%; /* Button styling for better mobile responsiveness */
            background-color: #16a085; /* Accent color */
            border-color: #16a085; /* Accent color */
        }

        .btn-primary:hover {
            background-color: #1abc9c; /* Lighter accent color on hover */
            border-color: #1abc9c; /* Lighter accent color on hover */
        }

        .library-title {
            font-family: 'Playfair Display', serif; /* Elegant font for titles */
            font-size: 36px;
            margin-bottom: 20px;
        }

        .library-description {
            font-family: 'Roboto', sans-serif; /* Sans-serif font for descriptions */
            font-size: 18px;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
    <!-- Header -->
    <header>
        <h1 class="library-title">Welcome to Library</h1>
        <p class="library-description">Discover a Library</p>
        <!-- Button for Cart -->
        <a href="<?= base_url('cartadded'); ?>" class="btn btn-outline-light">View Cart</a>
    </header>

    <!-- Products Section -->
    <div class="container container-products mt-4">
        <div class="row">
            <?php foreach ($products as $product): ?>
                <div class="col-lg-4 col-md-6">
                    <div class="card mb-4 shadow">
                        <div class="card-body">
                            <h5 class="card-title"><?= $product['name']; ?></h5>
                            <p class="card-text library-description">Description: <?= $product['description']; ?></p>
                            <p class="card-text library-description">Quantity: <?= $product['qty']; ?></p>
                            <p class="card-text library-description">Price: <?= $product['price']; ?></p>
                            <!-- Add to Cart Form -->
                            <form action="<?= base_url('cartadded'); ?>" method="post">
                                <input type="hidden" name="book_id" value="<?= $product['id']; ?>">
                                <input type="hidden" name="user_id" value="<?= $user_id; ?>">
                                <div class="form-group">
                                    <label for="quantity<?= $product['id']; ?>" class="library-description">Quantity:</label>
                                    <input type="number" name="quantity" id="quantity<?= $product['id']; ?>" class="form-control" value="1" min="1">
                                </div>
                                <button type="submit" class="btn btn-primary">Add to Cart</button>
                            </form>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>



    <!-- Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
