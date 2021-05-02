<table class="table table-striped">
	<caption class="caption-top">Current Active Jobs</caption>
	<thead>
		<tr>
			<th scope="col">Date</th>
			<th scope="col">Details</th>
			<th scope="col">Equipment Required</th>
			<th scope="col">County</th>
			<th scope="col">Duration Estimate</th>
			<th scope="col">Price</th>
			<th scope="col">Category</th>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
		</tr>
	</thead>
	<tbody>
		
			<?php foreach ($jobs as $job) : ?>
				<tr>
					<td><?= $job->updated_at; ?></td>
					
					<th scope="row"><?= $job->JobDetails; ?></th>
					<td><?= $job->EquipmentRequired; ?></td>
					<td><?= $job->JobCounty; ?></td>
					<td><?= $job->DurationEstimate; ?></td>
					<td><?= $job->JobPrice; ?></td>
					<td><?= $job->JobCategory; ?></td>
					<td><a href="/admin/jobs/view/<?= $job->Id; ?>">View deatils</a></td>
				</tr>
			<?php endforeach ?>
		
	</tbody>

</table>