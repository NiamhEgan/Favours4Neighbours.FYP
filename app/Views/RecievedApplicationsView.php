<table class="table table-striped">
	<caption class="caption-top">Recieved Applications</caption>
	<thead>
		<tr>
			<th scope="col">Date</th>
			<th scope="col">Job</th>
			<th scope="col">Applicant</th>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
		</tr>
	</thead>
	<tbody>
		<?php if ($recievedApplications != null) : ?>
			<?php foreach ($recievedApplications as $recievedApplication) : ?>
				<tr>
					<td><?= $recievedApplication->created_at; ?></td>
					<td>
						<a href="/client/jobs/view/<?= $recievedApplication->JobId; ?>"><?= $recievedApplication->JobDetails; ?></a></td>
					<td>
						<a href="" title="<?= $recievedApplication->UserFullName; ?>"><?= $recievedApplication->Username; ?></a>
					</td>
					<td><a href="/client/applications/accept/<?= $recievedApplication->Id; ?>">Accept</a></td>
					<td><a href="/client/applications/reject/<?= $recievedApplication->Id; ?>">Reject</a></td>
				</tr>


			<?php endforeach ?>
		<?php endif ?>
	</tbody>
</table>