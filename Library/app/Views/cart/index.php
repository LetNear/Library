<!-- DataTales Example for Cart -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">CART TABLE</h6>
    </div>
    <div class="card-body">
        <!-- Add to Cart button -->
        <a href="<?= base_url("cart/addToCart/"); ?>" class="btn btn-primary mb-3">
            <i class="fas fa-cart-plus"></i> Add to Cart
        </a>

        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Cart ID</th>
                        <th>User ID</th>
                        <th>Book ID</th>
                        <th>Quantity</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>Cart ID</th>
                        <th>User ID</th>
                        <th>Book ID</th>
                        <th>Quantity</th>
                        <th>Actions</th>
                    </tr>
                </tfoot>
                <tbody>
                    <?php foreach ($cart_info as $cart) : ?>
                        <tr>
                            <td><?= $cart['id'] ?></td>
                            <td><?= $cart['user_id'] ?></td>
                            <td><?= $cart['book_id'] ?></td>
                            <td><?= $cart['quantity'] ?></td>
                            <td>
                                <a class='btn btn-danger btn-sm' href='<?= base_url("cart/delete/{$cart['id']}") ?>'>
                                    <i class='fas fa-trash'></i> Remove
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
