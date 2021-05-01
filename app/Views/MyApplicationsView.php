<table class="table table-striped">
	<caption class="caption-top">My Applications</caption>
	<thead>
		<tr>
			<th class="caption-top" colspan="4">Applications</th>
		</tr>
		<tr>
			<th scope="col">Date</th>
			<th scope="col">Job Details</th>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
		</tr>
		<tr>
			<th class="caption-top" colspan="4">My Pending Applications</th>
		</tr>
	</thead>
	<tbody>
		<?php if ($jobApplicationsPending != null) : ?>
			<?php foreach ($jobApplicationsPending as $jobApplication) : ?>
				<tr>
					<td><?= $jobApplication->created_at; ?></td>
					<td><a href="/client/applications/myapplications/<?= $jobApplication->JobId; ?>"><?= $jobApplication->JobDetails; ?></a></td>
					<td><a href="/client/applications/withdraw/<?= $jobApplication->Id; ?>">Withdraw</a></td>
					<td>&nbsp;</td>
				</tr>
			<?php endforeach ?>
		<?php endif ?>
	</tbody>
	<thead>
		<tr>
			<th class="caption-top" colspan="4">My Accepted Applications</th>
		</tr>
	</thead>
	<tbody>
		<?php if ($jobApplicationsAccepted != null) : ?>
			<?php foreach ($jobApplicationsAccepted as $jobApplication) : ?>
				<tr>
					<td><?= $jobApplication->created_at; ?></td>
					<td><a href="/client/applications/myapplications/<?= $jobApplication->JobId; ?>"><?= $jobApplication->JobDetails; ?></a></td>
					<td><a href="/client/applications/withdraw/<?= $jobApplication->Id; ?>">Withdraw</a></td>
					<!--TODO:-->
					<td><a href="/client/applications/complete/<?= $jobApplication->Id; ?>">Complete</a></td>
				</tr>
			<?php endforeach ?>
		<?php endif ?>
	</tbody>
	<thead>
		<tr>
			<th class="caption-top" colspan="4">My Withdrawn Applications</th>
		</tr>
	</thead>
	<tbody>
		<?php if ($jobApplicationsWithdrawn != null) : ?>
			<?php foreach ($jobApplicationsWithdrawn as $jobApplication) : ?>
				<tr>
					<td><?= $jobApplication->created_at; ?></td>
					<td><a href="/client/applications/myapplications/<?= $jobApplication->JobId; ?>"><?= $jobApplication->JobDetails; ?></a></td>
					<td><a href="/client/applications/withdraw/<?= $jobApplication->Id; ?>">Withdraw</a></td>
					<td>&nbsp;</td>
				</tr>
			<?php endforeach ?>
		<?php endif ?>
	</tbody>
	<thead>
		<tr>
			<th class="caption-top" colspan="4">My Rejected Applications</th>
		</tr>
	</thead>
	<tbody>
		<?php if ($jobApplicationsRejected != null) : ?>
			<?php foreach ($jobApplicationsRejected as $jobApplication) : ?>
				<tr>
					<td><?= $jobApplication->created_at; ?></td>
					<td><a href="/client/applications/myapplications/<?= $jobApplication->JobId; ?>"><?= $jobApplication->JobDetails; ?></a></td>
					<td><a href="/client/applications/withdraw/<?= $jobApplication->Id; ?>">Withdraw</a></td>
					<td>&nbsp;</td>
				</tr>
			<?php endforeach ?>
		<?php endif ?>
	</tbody>
</table>