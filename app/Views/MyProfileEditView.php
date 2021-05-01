<?php helper(["form"]); ?>
<form method="post">

<table class="table table-striped">
		<caption class="caption-top">Current Profile</caption>
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
				<th scope="col">Email</th>
				<td><?= $user["email"]; ?></td>
			</tr>
			<tr>
				<th scope="col">Address Line 1</th>
				<td><?= $user["AddressLine1"]; ?></td>
			</tr>
			<tr>
			<th scope="col">Address Line 2</th>
				<td><?= $user["AddressLine2"]; ?></td>
			</tr>
			<tr>
				<th scope="col">Eircode</th>
				<td><?= $user["Eircode"]; ?></td>
			</tr>
		
			<tr>
				<th scope="col">Phone Number</th>
				<td><?= $user["Telephone"]; ?></td>
			</tr>
			
		
		</thead>
		<tbody>
		<tfoot>
			<tr>
				<td colspan="8"></td>
			</tr>
		</tfoot>
	</table>
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

	
	<div class="form-group">
		<button name="SaveButton" type="submit" class="btn btn-primary btn-block"> Save </button>
</form>

</table>