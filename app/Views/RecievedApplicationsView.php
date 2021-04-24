<table class="table table-striped">
	<caption class="caption-top">Recieved Applications</caption>
	<thead>
		<tr>
			<th scope="col">Date</th>
			<th scope="col">Job Details</th>
			<th scope="col">Applicant</th>
			<td>&nbsp;</td>
		</tr>
	</thead>
	<tbody>
		<?php if ($recievedApplications != null) : ?>
			<?php foreach ($jobApplirecievedApplicationscations as $jobApplication) : ?>
				<tr>
					<td><?= $recievedApplications->created_at; ?></td>
					<td><a href="/client/applications/recievedapplications/<?= $jobApplication->JobId; ?>"><?= $jobApplication->JobDetails; ?></a></td>
					<td><?= $recievedApplications->Status; ?></td>
					<td><a href="/client/applications/reject/<?= $recievedApplications->Id; ?>">Withdraw</a></td>
					<td><a href=#<?= $recievedApplications->Id; ?>">Complete</a></td>
				</tr>


			<?php endforeach ?>
		<?php endif ?>
	</tbody>
</table>