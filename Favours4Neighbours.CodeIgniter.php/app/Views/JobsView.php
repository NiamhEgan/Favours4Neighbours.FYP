<?php $usernameValue = isset($username) ? 'value="' . $username . '"' : ""; ?>
<main>
	<table class="table table-striped">
		<caption class="caption-top">Current Active Jobs</caption>
		<thead>
			<tr>
				<th scope="col">Details</th>
				<th scope="col">County</th>
				<th scope="col"></th>
				<th scope="col"></th>
				<th scope="col"></th>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
			</tr>
		</thead>
		<tbody>
			<?php foreach ($jobs as $job) : ?>
				<tr>
					<th scope="row"><?= $job["JobDetails"]; ?></th>
					<td><?= $job["JobDetails"]; ?></td>
					<td></td>
					<td></td>
					<td><a href="view/<?= $job["Id"]; ?>">View details</a></td>
					<td><a href="edit/<?= $job["Id"]; ?>">Edit</a></td>
					<td><a href="delete/<?= $job["Id"]; ?>">Delete</a></td>
					<td><a href="delete/<?= $job["Id"]; ?>">Apply</a></td>
				</tr>
			<?php endforeach ?>
		</tbody>
		<tfoot>
			<tr>
				<td colspan="8"></td><a href="new/">New Job Posts in the last 7 days</a>
			</tr>
		</tfoot>
	</table>
</main>