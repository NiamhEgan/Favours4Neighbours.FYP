
  
<div class="container">
  <div class="row">
    <div class="col-sm-4">
      <h3>Update Profile </h3>
      <p>Recent Jobs Added</p>
      <p>Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris...</p>
    </div>
    <div class="col-sm-4">
      <h3>Neighbourshood News </h3>
      <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit...</p>
      <p>Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris...</p>
    </div>
    <div class="col-sm-4">
      <h3>My Notifications</h3>        
      <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit...</p>
      <p>Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris...</p>
    </div>
  </div>
</div>
<?php $usernameValue = isset($username) ? 'value="' . $username . '"' : ""; ?>
<main>
	<table class="table table-striped">
		<caption class="caption-top">My Profile</caption>
		<thead>
	
			<tr>
      <th scope="col"> ID</th>
				<th scope="col">First Name</th>
				<th scope="col">Surname</th>
				<th scope="col">Phone Number</th>
				<th scope="col">Eircode</th>
        <th scope="col">Bio</th>
        <th scope="col">Photo</th>
				<th scope="col"></th>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
			</tr>
		</thead>
		<tbody>
			<?php foreach ($profile as $profile) : ?>
				<tr>
					<th scope="row">     <?= $profile["Id"]; ?>     
          <td>  <?= $profile["FirstName"]; ?></td>
					<td><?= $profile["Surname"]; ?></td>
          <td><?= $profile["Telephone"]; ?></td>
          <td><?= $profile["Eircode"]; ?></td>
          <td><?= $profile["Bio"]; ?></td>
          <td><?= $profile["Photo"]; ?></td>
					<td></td>
					<td></td>
					
					<td><a href="edit/<?= $profile["Id"]; ?>">Edit</a></td>
					<td><a href="delete/<?= $profile["Id"]; ?>">Delete</a></td>
				
				</tr>
			<?php endforeach ?>
		</tbody>
		<tfoot>
			<tr>
				<td colspan="8"></td><a href="new/">New Job Posts - posted in last 7 days </a>
			</tr>
		</tfoot>
	</table>
</main>
</body>
</html>
