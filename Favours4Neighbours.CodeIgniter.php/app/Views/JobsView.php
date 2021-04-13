<table class="table table-striped">
	<caption class="caption-top">Current Active Jobs</caption>
	<thead>
		<tr>
			<th scope="col">Details</th>
			<th scope="col">County</th>
			<th scope="col">Payment</th>
			<th scope="col"></th>
			<th scope="col"></th>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
		</tr>
	</thead>
	<tbody>
		<?php foreach ($jobs as $jobs) : ?>
			<tr>
				<th scope="row"><?= $jobs["JobDetails"]; ?></th>
				<td><?= $jobs["JobCounty"]; ?></td>
				<td><?= $jobs["JobPrice"]; ?></td>
				<td></td>
				<td></td>
				<td></td>
				<td><a href="view/<?= $jobs["Id"]; ?>">View details</a></td>
				<td><a href="edit/<?= $jobs["Id"]; ?>">Edit</a></td>
				<td><a href="delete/<?= $jobs["Id"]; ?>">Delete</a></td>
				<td><a href="apply/<?= $jobs["Id"]; ?>">Apply</a></td>
			</tr>
		<?php endforeach ?>
	</tbody>
	<tfoot>
		<tr>

			<button class="w-100 btn btn-lg btn-primary" name="NewPosts" type="submit">Latest Job Posts </button>
		</tr>
	</tfoot>
</table>