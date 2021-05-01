<table class="table table-striped">
	<caption class="caption-top">My Profile</caption>
	<thead>
		<tr>
			<th scope="col">First Name</th>
			<th scope="col">Surname</th>
			<th scope="col">Phone Number</th>
			<th scope="col">Eircode</th>
		</tr>
	</thead>
	<tbody>
		<tr>
			<td><?= $user["FirstName"]; ?></td>
			<td><?= $user["Surname"]; ?></td>
			<td><?= $user["Telephone"]; ?></td>
			<td><?= $user["Eircode"]; ?></td>
		</tr>
	</tbody>
</table>

<table class="table table-striped">
	<caption class="caption-top"><?= $user["Username"]; ?>: Completed Jobs</caption>
	<thead>
		<tr>
			<th scope="col">Details</th>
			<th scope="col">Equipment Required</th>
			<th scope="col">Duration Estimate</th>
			<th scope="col">Price</th>
			<th scope="col">Category</th>
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