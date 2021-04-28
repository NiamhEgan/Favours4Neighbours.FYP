<?php helper(['form']); ?>
<form method="post">
    <h2>Search for User:</h2>
    <input name="SearchValue" type="text" class="form-control" value="<?= set_value('SearchValue'); ?>">
    <button name="SearchButton" type="submit" class="btn btn-primary btn-block">Search</button>
</form>
<div id="Results">
    <table class="table table-striped">
        <caption class="caption-top">Results</caption>
        <thead>
            <tr>
                <th scope="col">Id</th>
                <th scope="col">Username</th>
                <th scope="col">First Name</th>
                <th scope="col">Surname</th>
                <th scope="col">Telephone</th>
                <th scope="col">Email</th>

                <th scope="col"></th>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
            </tr>
        </thead>
        <tbody>
            <?php if (isset($users) && $users != null) : ?>
                <?php foreach ($users as $user) : ?>
                    <tr>
                        <td><?= $user->Id; ?></td>
                        <td><?= $user->Username; ?></td>
                        <td><?= $user->FirstName; ?></td>
                        <td><?= $user->Surname; ?></td>
                        <td><?= $user->Telephone; ?></td>
                        <td><?= $user->email; ?></td>

                        <td></td>

                        <td><a href="/admin/users/view/<?= $user->Id; ?>">View Details</a></td>
                        <td><a href="/admin/users/edit/<?= $user->Id; ?>">Edit</a></td>
                        <td><a href="/admin/users/resetpassword/<?= $user->Id; ?>">Reset Password</a></td>
                    </tr>
                <?php endforeach ?>
            <?php endif ?>
        </tbody>
    </table>
</div>