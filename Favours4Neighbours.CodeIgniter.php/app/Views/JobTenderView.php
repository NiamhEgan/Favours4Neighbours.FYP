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
		<tr>
			<th scope="row"><?= $job["JobDetails"]; ?></th>
			<td><?= $job["JobCounty"]; ?></td>
			<td><?= $job["JobPrice"]; ?></td>
			<td></td>
			<td></td>
			<td></td>
			<td><a href="apply/<?= $job["Id"]; ?>">Apply</a></td>
		</tr>
	</tbody>
</table>