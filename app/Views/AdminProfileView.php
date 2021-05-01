<table class="table table-striped">
	<caption class="caption-top">Admin Profile</caption>
	<thead>
		<tr>
			<th scope="col">First Name</th>
			<th scope="col">Surname</th>
			<th scope="col">Phone Number</th>
			<th scope="col">Eircode</th>
			<th scope="col"></th>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
		</tr>
	</thead>
	<tbody>
			<tr>
				<th scope="row"><?= $profile["FirstName"]; ?></th>
				<td><?= $profile["Surname"]; ?></td>
		<td><?= $profile["Telephone"]; ?></td>
		<td><?= $profile["Eircode"]; ?></td>
				<td></td>
				<td></td>
				
				<td><a href="/admin/profile/edit/<?= $profile["Id"]; ?>">Edit Profile</a></td>
			
			
			</tr>
	</tbody>

</table>