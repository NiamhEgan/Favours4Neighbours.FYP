<?php helper(["form"]); ?>
<main class="form-signin" style="width: 500px;">
	<form method="post">
		<div class="login-form-to-align">
			<h1 class="h3 mb-3 fw-normal">Please sign in</h1>

			<label class="visually-hidden" for="inputEmail">Username</label>
			<input autofocus class="form-control" id="Username" name="Username" placeholder="Email address" required type="text" value="<?= set_value("Username"); ?>">

			<label class="visually-hidden" for="inputPassword">Password</label>
			<input class="form-control" id="Password" name="Password" placeholder="Password" required type="password">

			
			<button class="w-100 btn btn-lg btn-primary" name="LoginButton" type="submit">Sign in</button>

			<?php if (isset($errors)) : ?>
				<p class="error"><?php echo $errors ?></p>
			<?php endif ?>
	</form>
	<form action="/login/demo/" method="post">
		<h2 class="h3 mb-3 fw-normal">If you are not registered please Sign Up </h2>
		<button class="w-100 btn btn-lg btn-primary" type="submit"> Sign Up!</button>
	</form>
	</div>
</main>