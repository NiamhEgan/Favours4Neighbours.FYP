<table class="table table-striped">
	<caption class="caption-top">My Jobs</caption>
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
		
			<tr>
				<th scope="row"><?= $myjobs["JobDetails"]; ?></th>
				<td><?= $myjobs["EquipmentRequired"]; ?></td>
				<td><?= $myjobs["DurationEstimate"]; ?></td>
				<td><?= $myjobs["JobPrice"]; ?></td>
				<td><?= $myjobs["JobCategory"]; ?></td>
				<td><a href="view/<?= $myjobs["Id"]; ?>">View details</a></td>
				<td><a href="edit/<?= $myjobs["Id"]; ?>">Edit</a></td>
				<td><a href="delete/<?= $myjobs["Id"]; ?>">Delete</a></td>
				<td><a href="apply/<?= $myjobs["Id"]; ?>">Apply</a></td>
			</tr>
	
	</tbody>
	<tfoot>
		<tr>
			<td colspan="8"></td><a href="new/">New Job Posts in the last 7 days</a>
		</tr>
	</tfoot>
</table>