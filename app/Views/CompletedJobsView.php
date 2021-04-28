<table class="table table-striped">
	<caption class="caption-top">Completed Jobs</caption>
	<thead>
		<tr>
			<th scope="col">Date</th>
			<th scope="col">Job Details</th>
			<th scope="col">Status</th>
			<th scope="col">Created By</th>
			<th scope="col">Completed By</th>
			
			<td>&nbsp;</td>
		</tr>
	</thead>
	<tbody>
	<?php if ($jobs != null) : ?>
			<?php foreach ($jobs as $job) : ?>
				<tr>
					<td><?= $job->updated_at; ?></td>
					<th scope="row"><?= $job->JobDetails; ?></th>

					<td><a href="/client/jobs/viewtender/<?= $job->Id; ?>">View details</a></td>
				</tr>
			<?php endforeach ?>
		<?php endif ?>
	
	</tbody>
</table>