<!DOCTYPE html>
<html lang="en">
<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<body>

<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="#">Favours4Neighbours</a>
    </div>
    <ul class="nav navbar-nav">
      <li class="active"><a href="/home">Home</a></li>
      <li class="active"><a href="/profile">Profile</a></li>
      <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="/jobs">Jobs <span class="caret"></span></a>
        <ul class="dropdown-menu">
          <li><a href="/jobs">View Jobs</a></li>
          <li><a href="/jobs/new">Create Jobs</a></li>
          <li><a href="/jobs">My Jobs</a></li>
        </ul>
      </li>
      <li><a href="#">My Applications</a></li>
      <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#">FAQ's <span class="caret"></span></a>
        <ul class="dropdown-menu">
          <li><a href="#">FAQ's</a></li>
          <li><a href="#">COVID-19</a></li>
          <li><a href="#">Safety Statement</a></li>
        </ul>
 
      <li><a href="#"><span class="glyphicon glyphicon-user"></span> Sign Up</a></li>
      <li><a href="/login"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
      <li><a href="/login/logout"><span class="glyphicon glyphicon-log-in"></span> Logout</a></li>
      <li><form class="form-inline my-8 my-lg-0"></li>
      <li>   <input class="form-control mr-sm-8" type="search" placeholder="Search" aria-label="Search"></li>
      <li>  <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button></li>
        </form>
    </ul>
  </div>

   
</nav>
  




  </header>
  <?php echo $mainContent; ?>
</body>

</html>