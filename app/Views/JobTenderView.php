<table class="table table-striped">
	<caption class="caption-top">Job Tender</caption>
	<thead>
		<tr>
			<th scope="col">Details</th>
			<th scope="col">County</th>
			<th scope="col">Payment</th>
			<th scope="col">Duration</th>
			<th scope="col"></th>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
		</tr>
	</thead>
	<tbody>
	<?php if ($jobs != null) : ?>
			<?php foreach ($jobs as $job) : ?>
		<tr>
					<th scope="row"><?= $job->JobDetails; ?></th>
					<td><?= $job->EquipmentRequired; ?></td>
					<td><?= $job->JobCounty; ?></td>
					<td><?= $job->DurationEstimate; ?></td>
					<td><?= $job->JobPrice; ?></td>
					<td><a href="/client/jobs/apply/<?= $job['Id']; ?>">Apply</a></td>
				</tr>
				</tbody>
</table>