<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Add New Book</h6>
    </div>
    <div class="card-body">
        <a href="<?= base_url("book/index"); ?>" class="btn btn-warning btn-icon-split mb-3">
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

        <?= form_open("book/create"); ?>
        <div class="form-group row">
            <label for="Name" class="col-sm-2 col-form-label">Book Name</label>
            <div class="col-sm-4">
                <input type="text" class="form-control" id="Name" name="Name" value=""
                    placeholder="Book Name" required>
            </div>
            <label for="Quantity" class="col-sm-2 col-form-label">Quantity</label>
            <div class="col-sm-4">
                <input type="text" class="form-control" id="Quantity" name="Quantity" value=""
                    placeholder="Quantity" required>
            </div>
        </div>
        <div class="form-group row">
            <label for="Price" class="col-sm-2 col-form-label">Price</label>
            <div class="col-sm-4">
                <input type="text" class="form-control" id="Price" name="Price" value=""
                    placeholder="Price" required>
            </div>
            <label for="Description" class="col-sm-2 col-form-label">Description</label>
            <div class="col-sm-4">
                <input type="text" class="form-control" id="Description" name="Description" value=""
                    placeholder="Description">
            </div>
        </div>
        <div class="form-group row">
            <div class="col-sm-12 text-center">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-plus"></i> Add Book
                </button>
            </div>
        </div>
        <?= form_close(); ?>
    </div>
</div>
