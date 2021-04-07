<!DOCTYPE html>
<html lang="en">
<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <link rel="stylesheet" href="/assets/css/style.css">
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
  
      <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="/">Applications <span class="caret"></span></a>
        <ul class="dropdown-menu">
          <li><a href="/">Sent Applications</a></li>
          <li><a href="/">Recieved Applications</a></li>
        </ul>
      </li>
      <li class="active"><a href="/">Chat</a></li>
      <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#">FAQ's <span class="caret"></span></a>
        <ul class="dropdown-menu">
          <li><a href="#">FAQ's</a></li>
          <li><a href="#">COVID-19</a></li>
          <li><a href="#">Safety Statement</a></li>
        </ul>
 
      <li><a href="#"><span class="glyphicon glyphicon-user"></span> Sign Up</a></li>
      <li><a href="/login"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
      <li><a href="/logout"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
      <li><form class="form-inline my-8 my-lg-0"></li>
     
        </form>
    </ul>
  </div>

   
</nav>