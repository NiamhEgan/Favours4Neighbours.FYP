<?php $usernameValue = isset($username) ? 'value="' . $username . '"' : ""; ?>


<main class="form-signin" style="width: 500px;">
	<form method="post">
		<div class="login-form-to-align">
		<h1 class="h3 mb-3 fw-normal">Please sign in</h1>

		<label class="visually-hidden" for="inputEmail">Username</label>
		<input autofocus class="form-control" id="Username" name="Username" placeholder="Email address" required type="text" <?php echo $usernameValue ?>>

		<label class="visually-hidden" for="inputPassword">Password</label>
		<input class="form-control" id="Password" name="Password" placeholder="Password" required type="password">

		<div class="checkbox mb-3"><label><input type="checkbox" value="remember-me"> Remember me</label></div>
		<button class="w-100 btn btn-lg btn-primary" name="LoginButton" type="submit">Sign in</button>

		<?php if (isset($error)) { ?><p class="error"><?php echo $error ?></p><?php } ?>
	</form>
	<form action="/login/demo/" method="post">
		<h2 class="h3 mb-3 fw-normal">If you are not registered please register below</h2>
		<button class="w-100 btn btn-lg btn-primary" type="submit">Register New User</button>
	</form>
	</div>
</main>