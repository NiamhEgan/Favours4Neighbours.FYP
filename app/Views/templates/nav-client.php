<nav class="navbar navbar-inverse ">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="#">Favours4Neighbours</a>
    </div>
    <ul class="nav navbar-nav">
      <li class="active"><a href="/home">Home</a></li>
      <li class="active"><a href="/client/profile">Profile</a></li>
      <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="/client/jobs">Jobs <span class="caret"></span></a>
        <ul class="dropdown-menu">
          <li><a href="/client/jobs">View Available Jobs</a></li>
          <li><a href="/client/jobs/create">Create Jobs</a></li>
          <li><a href="/client/jobs/myjobs">My Active Jobs</a></li>
          <li><a href="/client/jobs/mycompletedjobs/">My Completed Jobs</a></li>
        </ul>
      </li>
      <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="/">Applications <span class="caret"></span></a>
        <ul class="dropdown-menu">
          <li><a href="/client/applications/myapplications/">My Applications</a></li>
          <li><a href="/client/applications/recievedapplications/">Recieved Applications</a></li>
        </ul>
      </li>
      <li><a href="/logout"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
      <li>
        <form class="form-inline my-8 my-lg-0">
      </li>
      </form>
    </ul>
  </div>
</nav>
<?php if (isset($username)) : ?>
  <div>Hello <?= $username; ?></div>
<?php endif ?>