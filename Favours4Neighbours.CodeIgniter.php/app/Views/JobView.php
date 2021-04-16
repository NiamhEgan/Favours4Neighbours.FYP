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
			<td><a href="view/<?= $job["Id"]; ?>">View details</a></td>
			<td><a href="edit/<?= $job["Id"]; ?>">Edit</a></td>
			<td><a href="delete/<?= $job["Id"]; ?>">Delete</a></td>
			<td><a href="apply/<?= $job["Id"]; ?>">Apply</a></td>
		</tr>
	</tbody>
	<tfoot>
		<tr>

			<button class="w-100 btn btn-lg btn-primary" name="NewPosts" type="submit">Latest Job Posts </button>
		</tr>
	</tfoot>
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
						<td><a href="/client/users/view/<?= $jobApplication->UserId; ?>" title="<?= $jobApplication->UserFullName; ?>"><?= $jobApplication->Username; ?></a></td>
						<td><a href="/client/jobs/accept/<?= $jobApplication->Id; ?>">Accept</a></td>
						<td><a href="/client/jobs/reject/<?= $jobApplication->Id; ?>">Reject</a></td>
					</tr>
				<?php endforeach ?>
			<?php endif ?>
		</tbody>
	</table>
</table>