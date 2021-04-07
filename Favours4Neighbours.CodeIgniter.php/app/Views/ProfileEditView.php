<?php helper(["form"]); ?>
<form method="post">
	<div class="form-row">
		<div class="form-group col-md-6">
			<label>Address Line 1</label>
			<input name="AddressLine1" type="text" class="form-control" value="<?= set_value("AddressLine1", $user["AddressLine1"]); ?>">
		</div> <!-- form-group end.// -->
		<div class="form-group col-md-6">
			<label>Address Line 2</label>
			<input name="AddressLine2" type="text" class="form-control" value="<?= set_value("AddressLine2", $user["AddressLine2"]); ?>">
		</div> <!-- form-group end.// -->
		<div class="form-group col-md-6">
			<label>County</label>
			<?= form_dropdown('County', $countyDataSource, set_value("County", $user["County"]), 'class="form-control"'); ?>
		</div> <!-- form-row.// -->
		<div class="form-group">
			<label>Eircode</label>
			<input name="Eircode" type="text" class="form-control" placeholder="">
			<small class="form-text text-muted">We'll never share your email with anyone else.</small>
		</div> <!-- form-group end.// -->
	</div>

	<table class="table table-striped">
		<caption class="caption-top">My Profile</caption>
		<thead>
			<tr>
				<th scope="col"> ID</th>
			</tr>
			<tr>
				<th scope="col">First Name</th>
				<td> <?= $user["FirstName"]; ?></td>
			</tr>
			<tr>
				<th scope="col">Surname</th>
				<td><?= $user["Surname"]; ?></td>
			</tr>
			<tr>
				<th scope="col">Phone Number</th>
				<td><?= $user["Telephone"]; ?></td>
			</tr>
			<tr>
				<th scope="col">Eircode</th>
				<td><?= $user["Eircode"]; ?></td>
			</tr>
			<tr>
				<th scope="col">Bio</th>
				<td><?= $user["Bio"]; ?></td>
			</tr>
			<tr>
				<th scope="col">Photo</th>
				<td><?= $user["Photo"]; ?></td>
			</tr>
			<tr>
			</tr>
		</thead>
		<tbody>
		<tfoot>
			<tr>
				<td colspan="8"></td>
			</tr>
		</tfoot>
	</table>
	<div class="form-group">
		<button name="RegisterButton" type="submit" class="btn btn-primary btn-block"> Register </button>
</form>