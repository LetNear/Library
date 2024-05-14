<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Edit Book</h6>
    </div>
    <div class="card-body">
        <a href="<?= base_url("/book/index"); ?>" class="btn btn-warning btn-icon-split mb-3">
            <span class="icon text-white-50">
                <i class="fas fa-arrow-left"></i>
            </span>
            <span class="text">Return to Book Table</span>
        </a>

        <?php if (isset($validation)): ?>
            <div class="alert alert-danger" role="alert">
                <ul>
                    <?php foreach ($validation as $error): ?>
                        <li><?= esc($error) ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>

        <?= form_open("book/edit/" . $book_info["id"]); ?>
        <div class="form-group row">
            <label for="Name" class="col-sm-2 col-form-label">Name</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="Name" name="Name"
                    value="<?= $book_info["name"] ?>" placeholder="Name" required>
            </div>
        </div>
        <div class="form-group row">
            <label for="Quantity" class="col-sm-2 col-form-label">Quantity</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="Quantity" name="Quantity"
                    value="<?= $book_info["qty"] ?>" placeholder="Quantity" required>
            </div>
        </div>
        <div class="form-group row">
            <label for="Price" class="col-sm-2 col-form-label">Price</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="Price" name="Price"
                    value="<?= $book_info["price"] ?>" placeholder="Price" required>
            </div>
        </div>
        <div class="form-group row">
            <label for="Description" class="col-sm-2 col-form-label">Description</label>
            <div class="col-sm-10">
                <textarea class="form-control" id="Description" name="Description" rows="3"
                    placeholder="Description"><?= $book_info["description"] ?></textarea>
            </div>
        </div>
        <div class="form-group row">
            <div class="col-sm-10 offset-sm-2">
                <button type="submit" class="btn btn-warning">
                    <i class="fas fa-pen"></i> Edit Book
                </button>
            </div>
        </div>
        <?= form_close(); ?>
    </div>
</div>
