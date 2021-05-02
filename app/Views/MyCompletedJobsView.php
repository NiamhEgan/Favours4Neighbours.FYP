<table class="table table-striped">
	<caption class="caption-top">My Completed Jobs</caption>
	<thead>
		<tr>
			<th scope="col">Date Completed</th>
			<th scope="col">Created By</th>
			<th scope="col">Job Details</th>
			<th scope="col">Status</th>
			<th scope="col">Employer</th>
			<td>&nbsp;</td>
		</tr>
	</thead>
	<tbody>
		<?php if ($jobs != null) : ?>
			<?php foreach ($jobs as $job) : ?>
				<tr>
					<th scope="row"><?= $job->JobDetails; ?></th>
					<td><?= $job->EquipmentRequired; ?></td>
					<td><?= $job->DurationEstimate; ?></td>
					<td><?= $job->JobPrice; ?></td>
					<td>
						<?php if ($job->CreatedByUserId != null) : ?>
							<a href="/client/users/view/<?= $job->CreatedByUserId; ?>" title="<?= $job->CreatedByUserFullName; ?>"><?= $job->CreatedByUsername; ?></a>
						<?php endif ?>
					</td>
				</tr>
			<?php endforeach ?>
		<?php endif ?>
	</tbody>
</table>