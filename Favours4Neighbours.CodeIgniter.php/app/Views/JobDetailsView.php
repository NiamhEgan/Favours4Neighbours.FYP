<table class="table table-striped">
	<caption class="caption-top">Current Active Jobs</caption>
	<thead>
		<tr>
			<th scope="col">Details</th>
			<th scope="col">Equipment Required</th>
			<th scope="col">Duration Estimate</th>
			<th scope="col">Price</th>
			<th scope="col">Category</th>
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
				<td><?= $jobs["EquipmentRequired"]; ?></td>
				<td><?= $jobs["DurationEstimate"]; ?></td>
				<td><?= $jobs["JobPrice"]; ?></td>
				<td><?= $jobs["JobCategory"]; ?></td>
				<td><a href="view/<?= $jobs["Id"]; ?>">View details</a></td>
				<td><a href="edit/<?= $jobs["Id"]; ?>">Edit</a></td>
				<td><a href="delete/<?= $jobs["Id"]; ?>">Delete</a></td>
				<td><a href="apply/<?= $jobs["Id"]; ?>">Apply</a></td>
			</tr>
		<?php endforeach ?>
	</tbody>
	<tfoot>
		<tr>
			<td colspan="8"></td><a href="new/">New Job Posts in the last 7 days</a>
		</tr>
	</tfoot>
</table>