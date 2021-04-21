<?php helper(["form"]); ?>
<form method="post">


			
	</table>
<h2> Please edit your password </h2>
	<div class="form-row">
		
	
		<div class="form-group col-md-6">
			<label>Current Pasword </label>
			<input name="CurrentPassword" type="password" placeholder="Password"  class="form-control" value="">
		</div> <!-- form-group end.// -->
		<div class="form-group col-md-6">
			<label>New Pasword</label>
			<input name="NewPassword" type="text" placeholder="New Password"  class="form-control" value="">
		</div> <!-- form-group end.// -->
		
		<div class="form-group col-md-6">
			<label>Re-enter New Password</label>
			<input name="ConfirmNewPassword" type="text" placeholder="Confirm New Password"  class="form-control" value=" ">
		</div> <!-- form-group end.// -->
	

	
	<div class="form-group">
		<button name="ChangePasswordButton" type="submit" class="btn btn-primary btn-block"> Save </button>
</form>

			
	
</table>