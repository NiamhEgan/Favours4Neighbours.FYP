<table class="table table-striped">
	<caption class="caption-top">My Applications</caption>
	<thead>
		<tr>
			<th scope="col">Date</th>
			<th scope="col">Job Details</th>
			<th scope="col">Status</th>
			<td>&nbsp;</td>
		</tr>
	</thead>
	<tbody>
		<?php if ($jobApplications != null) : ?>
			<?php foreach ($jobApplications as $jobApplication) : ?>
				<tr>
					<td><?= $jobApplication->created_at; ?></td>
					<td><a href="/client/applications/myapplications/<?= $jobApplication->JobId; ?>"><?= $jobApplication->JobDetails; ?></a></td>
					<td><?= $jobApplication->Status; ?></td>
					<td><a href="/client/applications/reject/<?= $jobApplication->Id; ?>">Withdraw</a></td>
					<td><a href="/client/applications/complete/<?= $jobApplication->Id; ?>">Complete</a></td>
				</tr>


			<?php endforeach ?>
		<?php endif ?>
	</tbody>
</table>