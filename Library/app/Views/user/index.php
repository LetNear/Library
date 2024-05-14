<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">USER TABLE</h6>
    </div>
    <div class="card-body">
        <a href="<?= base_url("user/create"); ?>" class="btn btn-primary btn-icon-split mb-3">
            <span class="icon text-white-50">
                <i class="fas fa-plus"></i>
            </span>
            <span class="text">Add User</span>
        </a>

        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable">
                <thead>
                    <tr>
                        <th>USER ID</th>
                        <th>USER NICKNAME</th>
                        <th>USER FULL NAME</th>
                        <th>USER EMAIL</th>
                        <th>USER PASSWORD</th>
                        <th>FUNCTIONS</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($user_info as $user): ?>
                        <tr>
                            <td><?= $user["userID"] ?></td>
                            <td><?= $user["nickName"] ?></td>
                            <td><?= $user["fullName"] ?></td>
                            <td><?= $user["email"] ?></td>
                            <td><?= $user["password"] ?></td>
                            <td>
                                <a class="btn btn-warning" href="<?= base_url("user/edit/{$user['userID']}"); ?>">
                                    <i class="fas fa-pen"></i> Edit
                                </a>
                                <a class="btn btn-danger" href="<?= base_url("user/delete/{$user['userID']}"); ?>">
                                    <i class="fas fa-trash"></i> Delete
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
