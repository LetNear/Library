<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">User Table</h6>
    </div>
    <div class="card-body">
        <a href="<?= base_url("/"); ?>" class="btn btn-warning btn-icon-split mb-3">
            <span class="icon text-white-50">
                <i class="fas fa-arrow-left"></i>
            </span>
            <span class="text">Return</span>
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

        <?= form_open("user/create"); ?>
        <div class="row">
            <div class="col-md-6 mb-3">
                <input type="text" class="form-control" id="UN" name="UN" value="" placeholder="User Name">
            </div>
            <div class="col-md-6 mb-3">
                <input type="text" class="form-control" id="UFN" name="UFN" value="" placeholder="User Full Name">
            </div>
            <div class="col-md-6 mb-3">
                <input type="email" class="form-control" id="UE" name="UE" value="" placeholder="User Email">
            </div>
            <div class="col-md-6 mb-3">
                <input type="password" class="form-control" id="UP" name="UP" value="" placeholder="User Password">
            </div>
        </div>

        <button class="btn btn-primary btn-block">
            <i class="fas fa-plus"></i> Add User
        </button>
        </form>
    </div>
</div>
