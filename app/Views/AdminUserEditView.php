<?php helper(["form"]); ?>
<form method="post">

	<div class="caption-top"><?= $user['Username']; ?></div>

	<h2> Please edit your details </h2>
	<div class="form-row">
		<div class="form-inline col-md-6 ">
			<label>First Name</label>
			<input name="FirstName" type="text" class="form-control" value="<?= set_value("FirstName", $user["FirstName"]); ?>">
		</div>
		<div class="form-inline col-md-6 ">
			<label>Surname</label>
			<input name="Surname" type="text" class="form-control" value="<?= set_value("Surname", $user["Surname"]); ?>">
		</div>
		<div class="form-inline col-md-6 ">
			<label>Email</label>
			<input name="email" type="email" class="form-control" value="<?= set_value("email", $user["email"]); ?>">
		</div>
		<div class="form-inline col-md-6 ">
			<label>Address Line 1</label>
			<input name="AddressLine1" type="text" class="form-control" value="<?= set_value("AddressLine1", $user["AddressLine1"]); ?>">
		</div>
		<div class="form-inline col-md-6 ">
			<label>Address Line 2</label>
			<input name="AddressLine2" type="text" class="form-control" value="<?= set_value("AddressLine2", $user["AddressLine2"]); ?>">
		</div>

		<div class="form-inline col-md-6 ">
			<label>Eircode</label>
			<input name="Eircode" type="text" class="form-control" value="<?= set_value("Eircode", $user["Eircode"]); ?>">
		</div>
		<div class="form-inline col-md-6 ">
			<label>Phone Number</label>
			<input name="Telephone" type="text" class="form-control" value="<?= set_value("Telephone", $user["Telephone"]); ?>">

		</div>
		<div class="form-group col-md-6">
			<label>County</label>
			<?= form_dropdown('County', $countyDataSource, set_value("County"), 'class="form-control"'); ?>
		</div> <!-- form-row.// -->

		<div class="form-group col-md-6">
			<label>Admin Privilege</label>
			<input type="checkbox" name="IsAdmin" value="1" <?= $user['IsAdmin'] == 1 ? 'checked' : null; ?>>
		</div> <!-- form-row.// -->

		<div class="form-group col-md-6">
			<label>Active Account</label>
			<input type="checkbox" name="Active" value="1" <?= $user['Active'] == 1 ? 'checked' : null; ?>>
		</div> <!-- form-row.// -->


		<div class="form-group">
			<button name="SaveButton" type="submit" class="btn btn-primary btn-block"> Save </button>
</form>

</table>