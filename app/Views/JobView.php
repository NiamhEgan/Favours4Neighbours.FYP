<table class="table table-striped">
	<caption class="caption-top">My Current Active Jobs</caption>
	<thead>
		<tr>
			<th scope="col">Details</th>
			<th scope="col">Equipment Required</th>
			<th scope="col">Payment</th>
			<th scope="col">Assigned To</th>
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
			<th scope="row"><?= $job['JobDetails']; ?></th>
			<td><?= $job['EquipmentRequired']; ?></td>
			<td><?= $job['JobPrice']; ?></td>
			<td>
				<?php if ($job['AssignedTo'] != null) : ?>
					<a href="/client/users/view/<?= $job['AssignedTo']; ?>" title="<?= $job['AssignedUserFullName']; ?>"><?= $job['AssignedUsername']; ?></a>
				<?php endif ?>
			</td>
			<td></td>
			<td></td>
			<td></td>
			<td><a href="/client/jobs/view/<?= $job['Id']; ?>">View details</a></td>
			<td><a href="/client/jobs/edit/<?= $job['Id']; ?>">Edit</a></td>
			<td><a href="/client/jobs/close/<?= $job['Id']; ?>">Close Job</a></td>

		</tr>
	</tbody>

	<table class="table table-striped">
		<caption class="caption-top">Applications</caption>
		<thead>
			<tr>
				<th scope="col">Date</th>
				<th scope="col">Applicant</th>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
			</tr>
		</thead>
		<tbody>
			<?php if ($jobApplications != null) : ?>
				<?php foreach ($jobApplications as $jobApplication) : ?>
					<tr>
						<td><?= $jobApplication->created_at; ?></td>
						<td><?= $jobApplication->UserFullName; ?></td>
						<td><a href="/client/jobs/accept/<?= $jobApplication->Id; ?>">Accept</a></td>
						<td><a href="/client/jobs/reject/<?= $jobApplication->Id; ?>">Reject</a></td>
					</tr>
				<?php endforeach ?>
			<?php endif ?>
		</tbody>
	</table>
</table>