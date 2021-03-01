<!DOCTYPE html>
<html lang="en">

<head>
    <title><?php echo $title; ?></title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>

<body>
    <header>
        <nav>
            <div class="navigation">
                <ul>
                    <li class="menu-toggle">
                        <button onclick="toggleMenu();">&#9776;</button>
                    </li>
                    <li class="menu-item hidden"><a href="#">Home</a></li>
                    <li class="menu-item hidden"><a href="#">Edit Profile</a></li>
                    <li class="menu-item hidden"><a href="#">Jobs</a></li>
                    <li class="menu-item hidden"><a href="#">Logout</a></li>
                </ul>
            </div>
        </nav>
    </header>
    <?php echo $mainContent; ?>
    <aside>
        <div class="col-sm-4">
            <h3>Profile </h3>
            <p>Profile Image </p>

            <img src="">
            <p> Profile Description <br>Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris...</p>
        </div>
        <div class="col-sm-4">
            <h3>Quick Access</h3>
            <ul>
                </li>
                <li class="Create-Jobs-CTA"><a href="#">Create Job </a></li>
                <li class="Create-Jobs-CTA"><a href="#">My Jobs </a></li>
                <li class="Create-Jobs-CTA"><a href="#">Search Jobs</a></li>
            </ul>
        </div>
    </aside>

    <footer>
        <div class="container">
            <div class="row">
                <div class="col-sm-4">
                    <h3>Useful Information</h3>
                    <ul>
                        <li class="menu-item hidden"><a href="#">About Us </a></li>
                        <li class="menu-item hidden"><a href="#">COVID-19 </a></li>
                        <li class="menu-item hidden"><a href="#">FAQ's</a></li>
                        <li class="menu-item hidden"><a href="#">Safety Declareation</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </footer>
</body>

</html>