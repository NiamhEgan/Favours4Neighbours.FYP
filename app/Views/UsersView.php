<table class="table table-striped">
	<caption class="caption-top">Users</caption>
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
		<?php if ($users != null) : ?>
			<?php foreach ($users as $user) : ?>
				<tr>
					<td> <?= $user['FirstName']; ?></td>
					<td><?= $user['Surname']; ?></td>
					<td><?= $user['Telephone']; ?></td>
					<td><?= $user['Eircode']; ?></td>

					<td></td>

					<td><a href="/admin/users/view/<?= $user['Id']; ?>">View Details</a></td>
					<td><a href="/admin/users/edit/<?= $user['Id']; ?>">Edit</a></td>
					<td><a href="/admin/users/resetpassword/<?= $user['Id']; ?>">Reset Password</a></td>
				
				</tr>

			<?php endforeach ?>
		<?php endif ?>
	</tbody>
</table>