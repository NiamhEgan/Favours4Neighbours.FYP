<?php helper(["form"]); ?>
<div class="row justify-content-center">
	<div class="col-md-6">
		<div class="card">
			<header class="card-header">
				
				<h4 class="card-title mt-2">User Look Up</h4>
			</header>
			<article class="card-body">
				<form method="post">
					<div class="form-row">
						<div class="col form-group">
							<label>First name </label>
							<input type="text" name="FirstName" class="form-control" placeholder="" value="<?= set_value("FirstName"); ?>">
						</div> <!-- form-group end.// -->
						<div class="col form-group">
							<label>Surname</label>
							<input type="text" name="Surname" class="form-control" placeholder="" value="<?= set_value("Surname"); ?>">
						</div> <!-- form-group end.// -->
					</div> <!-- form-row end.// -->
					<div class="form-group">
						<label>Username</label>
						<input name="Username" type="text" class="form-control" placeholder="" value="<?= set_value("Username"); ?>">
						<small class="form-text text-muted">We'll never share your email with anyone else.</small>
					</div> <!-- form-group end.// -->
					<div class="form-group">
						<label>Email address</label>
						<input name="email" type="email" class="form-control" placeholder="" required value="<?= set_value("email"); ?>">
						<small class="form-text text-muted">We'll never share your email with anyone else.</small>
					
						<div class="form-group">
							<label>Telephone</label>
							<input name="Telephone" type="telephone" class="form-control" placeholder="">
							<small class="form-text text-muted">We'll never share your email with anyone else.</small>
						</div> <!-- form-group end.// -->
						
				
						<div class="form-row">
							<div class="form-group col-md-6">
								<label>Address Line 1</label>
								<input name="AddressLine1" type="text" class="form-control">
							</div> <!-- form-group end.// -->

							<div class="form-group col-md-6">
								<label>Address Line 2</label>
								<input name="AddressLine2" type="text" class="form-control">
							</div> <!-- form-group end.// -->

							<div class="form-group col-md-6">
								<label>County</label>
								<?= form_dropdown('County', $countyDataSource, set_value("County"), 'class="form-control"'); ?>
							</div> <!-- form-row.// -->
							
							<div class="form-group">
								<label>Eircode</label>
								<input name="Eircode" type="text" class="form-control" placeholder="">
								<small class="form-text text-muted">We'll never share your email with anyone else.</small>
							</div> <!-- form-group end.// -->
							
						</div> <!-- form-group end.// -->
						<div class="form-group">
							<button name="SearchButton" type="submit" class="btn btn-primary btn-block"> Search </button>
						</div> <!-- form-group// -->
						
				</form>
			</article> <!-- card-body end .// -->
		
	</div> <!-- col.//-->

</div> <!-- row.//-->


</div>
<?php if (!empty($errors)) : ?>
	<div class="alert alert-danger">
		<?php foreach ($errors as $field => $error) : ?>
			<p><?= $error ?></p>
		<?php endforeach ?>
	</div>
<?php endif ?>