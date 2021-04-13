<?php if (isset($message)) : ?>
	<?= $message; ?>
<?php endif ?>
<?php helper(["form"]); ?>
<form method="post">
	<div class="form-row">
		<div class="form-group col-md-6">
			<label>Address Line 1</label>
			<input name="AddressLine1" type="text" class="form-control" value="<?= set_value("AddressLine1", $job["JobDetails"]); ?>">
		</div> <!-- form-group end.// -->
		<div class="form-group col-md-6">
			<label>Address Line 2</label>
			<input name="AddressLine2" type="text" class="form-control" value="<?= set_value("AddressLine2", $job["EquipmentRequired"]); ?>">
		</div> <!-- form-group end.// -->
		<div class="form-group col-md-6">
			<label>Assigned To:</label>
			<?= form_dropdown('AssignedTo', $asssignedToDataSource, set_value("AssignedTo", $job["AssignedTo"]), 'class="form-control"'); ?>
		</div> <!-- form-row.// -->
		<div class="form-group col-md-6">
			<label>County</label>
			<?= form_dropdown('County', $countyDataSource, set_value("County", $job["JobCounty"]), 'class="form-control"'); ?>
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
				<td> <?= $job["DurationEstimate"]; ?></td>
			</tr>
			<tr>
				<th scope="col">Surname</th>
				<td><?= $job["JobPrice"]; ?></td>
			</tr>
			<tr>
				<th scope="col">Phone Number</th>
				<td><?= $job["updated_at"]; ?></td>
			</tr>
			<tr>
				<th scope="col">Eircode</th>
				<td><?= $job["JobPrice"]; ?></td>
			</tr>
			<tr>
				<th scope="col">Bio</th>
				<td><?= $job["JobPrice"]; ?></td>
			</tr>
			<tr>
				<th scope="col">Photo</th>
				<td><?= $job["JobPrice"]; ?></td>
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
		<button name="SaveButton" type="submit" class="btn btn-primary btn-block">Save</button>
</form>