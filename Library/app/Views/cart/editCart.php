<!-- Book Edit Form -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Edit Book</h6>
    </div>
    <div class="card-body">
        <a href="<?= base_url("/book/index"); ?>" class="btn btn-warning btn-icon-split">
            <span class="icon text-white-50">
                <i class="fas fa-arrow-left"></i>
            </span>
            <span class="text">Return</span>
        </a>

        <?php if (isset($validation) && $validation->getErrors()) : ?>
            <div class="alert alert-danger mt-3" role="alert">
                <ul>
                    <?php foreach ($validation->getErrors() as $error) : ?>
                        <li><?= esc($error) ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>

        <?php if (isset($error_message)) : ?>
            <div class="alert alert-danger mt-3" role="alert">
                <?= esc($error_message) ?>
            </div>
        <?php endif; ?>

        <?= form_open("cart/editCartItem/{$book_info->id}"); ?>
        <div class="form-group row">
            <div class="col-sm-4">
                <label for="Name">Name</label>
                <input type="text" class="form-control" id="Name" name="Name" value="<?= $book_info->name ?>" placeholder="Name" required>
            </div>
            <div class="col-sm-4">
                <label for="Quantity">Quantity</label>
                <input type="text" class="form-control" id="Quantity" name="Quantity" value="<?= $book_info->qty ?>" placeholder="Quantity" required>
            </div>
            <div class="col-sm-4">
                <label for="Price">Price</label>
                <input type="text" class="form-control" id="Price" name="Price" value="<?= $book_info->price ?>" placeholder="Price" required>
            </div>
        </div>

        <button class="btn btn-warning btn-block">
            <i class="fas fa-pen"></i> Edit Book
        </button>
        </form>
    </div>
</div>
