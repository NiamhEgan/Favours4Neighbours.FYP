<?php $usernameValue = isset($username) ? 'value="' . $username . '"' : ""; ?>
<main>

	<div class="row justify-content-center">
		<div class="col-md-6">
			<div class="card">
				<header class="card-header">
		
				
<h1> should see table of jobs here </h1>


	</div>
	<?php if (!empty($errors)) : ?>
		<div class="alert alert-danger">
			<?php foreach ($errors as $field => $error) : ?>
				<p><?= $error ?></p>
			<?php endforeach ?>
		</div>
	<?php endif ?>
	<!--container end.//-->
</main>