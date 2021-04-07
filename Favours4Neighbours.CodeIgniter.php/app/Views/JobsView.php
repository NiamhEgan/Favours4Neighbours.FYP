<?php $usernameValue = isset($username) ? 'value="' . $username . '"' : ""; ?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Favours4Neighbours Profile</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<body>
<main>
<title>Favours4Neighbours Jobs</title>
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
			<?php foreach ($jobs as $jobs) : ?>
				<tr>
					<th scope="row"><?= $jobs["JobDetails"]; ?></th>
					<td></td>
					<td></td>
					<td></td>
					<td><a href="view/<?= $jobs["Id"]; ?>">View details</a></td>
					<td><a href="edit/<?= $jobs["Id"]; ?>">Edit</a></td>
					<td><a href="delete/<?= $jobs["Id"]; ?>">Delete</a></td>
					<td><a href="apply/<?= $jobs["Id"]; ?>">Apply</a></td>
				</tr>
			<?php endforeach ?>
		</tbody>
		<tfoot>
			<tr>
			
				<button class="w-100 btn btn-lg btn-primary" name="NewPosts" type="submit">Latest Job Posts </button>
			</tr>
		</tfoot>
	</table>
</main>
</body>
</html>