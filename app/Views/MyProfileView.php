<table class="table table-striped">
	<caption class="caption-top">My Profile</caption>
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
		</tr>
	</thead>
	<tbody>
			<tr>
				<td> <?= $user["FirstName"]; ?></td>
				<td><?= $user["Surname"]; ?></td>
				<td><?= $user["Telephone"]; ?></td>
				<td><?= $user["Eircode"]; ?></td>
			
				<td></td>

				<td><a href="/client/profile/edit">Edit</a></td>
				<td><a href="/client/profile/changepassword">Change Password</a></td>
				<td><a href="/client/profile/delete/">Delete</a></td>

			</tr>
	</tbody>
	<tfoot>
		<tr>
			<td colspan="8"></td><a href="new/">New Job Posts - posted in last 7 days </a>
		</tr>
	</tfoot>
</table>