<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Votero - Voting and Elections</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css'>
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/gentelella/1.3.0/css/custom.css'>
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css'>
    <link rel="stylesheet" href="../include/style.css">
    <style>
        /* Navbar styles */
        .navbar {
            background-color: #2563eb;
            color: #fff;
            padding: 20px 0;
        }

        .navbar h1 {
            font-size: 1.8rem;
            margin: 0;
            padding: 0;
        }

        .navbar ul {
            margin: 0;
            padding: 0;
            list-style: none;
        }

        .navbar ul li {
            display: inline-block;
            margin-left: 20px;
            position: relative;
        }

        .navbar ul li a {
            color: #fff;
            text-decoration: none;
        }

        .navbar ul li a:hover {
            text-decoration: underline;
        }

        /* Dropdown menu */
        .dropdown-menu {
            display: none;
            position: absolute;
            background-color: #2563eb;
            padding: 10px;
            z-index: 1;
            top: calc(100% + 5px); /* Adjusted */
            left: 0;
            width: max-content;
        }

        .dropdown-menu a {
            display: block;
            color: #fff;
            text-decoration: none;
            margin-bottom: 5px;
        }
    </style>
</head>

<body class="nav-md">
  <!-- top navigation -->
  <div class="top_nav">
    <div class="nav_menu">
      <nav>
        <div class="nav toggle">
          <!-- <a id="menu_toggle"><i class="fa fa-bars"></i></a> -->
        </div>
        
        <div>
            <a class="navbar-brand" href="#" style="color: #fff; font-size: 24px;">VOTERO</a>
        </div>


        <ul class="nav navbar-nav navbar-right">
          <li class="">
            <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" style="color: #fff; font-size: 24px; aria-expanded="false">
            <?php
                        session_start(); // Start the session
                        if (isset($_SESSION['user']['Voter_Username'])) {
                            $username = $_SESSION['user']['Voter_Username'];
                            // echo "Welcome ";
                            echo  $username; // Display the username
                        }
                         else {
                            echo "My Account"; // If not logged in, display default text
                        }
                        
                        ?>
                        
              <span class=" fa fa-angle-down"></span>
            </a>
            <ul class="dropdown-menu dropdown-usermenu pull-right">
              <!-- <li><a href="javascript:;"> Profile</a></li> -->
              <li>
                <!-- <a href="javascript:;">
                  <span class="badge bg-red pull-right">50%</span>
                  <span>Settings</span>
                </a> -->
              </li>
              <li><a href="javascript:;">Help</a></li>
              <li><a href="../authentication/login.php"><i class="fa fa-sign-out pull-right"></i> Log Out</a></li>
            </ul>
          </li>














          

          <li role="presentation" class="dropdown">
            <a href="javascript:;" class="dropdown-toggle info-number" data-toggle="dropdown" aria-expanded="false">
              <!-- <i class="fa fa-envelope-o"></i> -->
              <!-- <span class="badge bg-green">6</span> -->
            </a>
            <ul id="menu1" class="dropdown-menu list-unstyled msg_list" role="menu">
              <li>
                <a>
                  <span class="image"><img src="images/img.jpg" alt="Profile Image" /></span>
                  <span>
                    <span>John Smith</span>
                    <span class="time">3 mins ago</span>
                  </span>
                  <span class="message">
                    Film festivals used to be do-or-die moments for movie makers. They were where...
                  </span>
                </a>
              </li>
              <li>
                <a>
                  <span class="image"><img src="images/img.jpg" alt="Profile Image" /></span>
                  <span>
                    <span>John Smith</span>
                    <span class="time">3 mins ago</span>
                  </span>
                  <span class="message">
                    Film festivals used to be do-or-die moments for movie makers. They were where...
                  </span>
                </a>
              </li>
              <li>
                <a>
                  <span class="image"><img src="images/img.jpg" alt="Profile Image" /></span>
                  <span>
                    <span>John Smith</span>
                    <span class="time">3 mins ago</span>
                  </span>
                  <span class="message">
                    Film festivals used to be do-or-die moments for movie makers. They were where...
                  </span>
                </a>
              </li>
              <li>
                <a>
                  <span class="image"><img src="images/img.jpg" alt="Profile Image" /></span>
                  <span>
                    <span>John Smith</span>
                    <span class="time">3 mins ago</span>
                  </span>
                  <span class="message">
                    Film festivals used to be do-or-die moments for movie makers. They were where...
                  </span>
                </a>
              </li>
              <li>
                <div class="text-center">
                  <a>
                    <strong>See All Alerts</strong>
                    <i class="fa fa-angle-right"></i>
                  </a>
                </div>
              </li>
            </ul>
          </li>
        </ul>
      </nav>
    </div>
  </div>
  <!-- /top navigation -->

  <!-- page content -->
  <!-- <div class="right_col" role="main">
    Right
  </div> -->
  <!-- /page content -->

  <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js'></script>
  <script src='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.min.js'></script>
  <script  src="./script.js"></script>
</body>

</html>
