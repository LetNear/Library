<!-- Cart Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Cart</h6>
    </div>
    <div class="card-body">
        <a href="<?= base_url("cart/index"); ?>" class="btn btn-warning btn-sm mb-3">
            <i class="fas fa-arrow-left"></i> Return to Cart
        </a>

        <?php if (isset($validation)) : ?>
            <div class="alert alert-danger" role="alert">
                <ul>
                    <?php foreach ($validation as $error) : ?>
                        <li><?= esc($error) ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>

        <?= form_open("cart/addToCart"); ?>
        <div class="row">
            <div class="col-md-4 mb-3">
                <label for="book_id">Select Book_model</label>
                <select class="form-control" id="book_id" name="book_id">
                    <option value="">Choose...</option>
                    <?php foreach ($books as $book) : ?>
                        <option value="<?= $book["id"] ?>"><?= $book["name"] ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="col-md-4 mb-3">
                <label for="user_id">Select User</label>
                <select class="form-control" id="user_id" name="user_id">
                    <option value="">Choose...</option>
                    <?php foreach ($users as $user) : ?>
                        <option value="<?= $user["userID"] ?>"><?= $user["nickName"] ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="col-md-4 mb-3">
                <label for="quantity">Quantity</label>
                <input type="number" class="form-control" id="quantity" name="quantity" value="" placeholder="Quantity">
            </div>
        </div>

        <button type="submit" class="btn btn-primary btn-block">
            <i class="fas fa-cart-plus"></i> Add to Cart
        </button>
        </form>
    </div>
</div>