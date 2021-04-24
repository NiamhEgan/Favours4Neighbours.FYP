<table class="table table-striped">
	<caption class="caption-top">Available Jobs</caption>
	<thead>
		<tr>
			<th scope="col">Details</th>
			<th scope="col">Equipment Required</th>
			<th scope="col">County</th>
			<th scope="col">Duration Estimate</th>
			<th scope="col">Price</th>
			<th scope="col">Category</th>
			<th scope="col">Assigned To</th>
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
					<td>
						<?php if ($job->JobCategoryId != null) : ?>
							<a href="/JobCategory/<?= $job->JobCategoryId; ?>"><?= $job->JobCategory; ?></a>
						<?php endif ?>
					</td>
					<td>
						<?php if ($job->AssignedTo != null) : ?>
							<a href="" title="<?= $job->AssignedUserFullName; ?>"><?= $job->AssignedUsername; ?></a>
						<?php endif ?>
					</td>
			
					<td><a href="/client/jobs/viewtender/<?= $job->Id; ?>">View details</a></td>
				</tr>
			<?php endforeach ?>
		<?php endif ?>
	</tbody>
	<tfoot>
		<tr>
			<td colspan="8"></td><a href="">New Job Posts in the last 7 days</a>
		</tr>
	</tfoot>
</table>