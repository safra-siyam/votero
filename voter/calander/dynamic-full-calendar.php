<?php
                       session_start(); // Start the session
                       if (isset($_SESSION['user']['Voter_Username'])) {
                           $username = $_SESSION['user']['Voter_Username'];
                          //  echo "Welcome ";
                       }
                        else {
                           $username = "My Account"; // If not logged in, display default text
                       }
                       
                       ?>


<!DOCTYPE html>
<html>
<head>
<title>How to create dynamic event calendar in HTML and PHP</title>
<!-- *Note: You must have internet connection on your laptop or pc other wise below code is not working -->
<!-- CSS for full calender -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.min.css" rel="stylesheet" />
<!-- JS for jQuery -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<!-- JS for full calender -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.20.1/moment.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.min.js"></script>
<!-- bootstrap css and js -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"/>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>

<link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200">



</head>



<body>

<!-- start of the navbar -->

<div class="top_nav" style="background-color: #2563eb; color: #fff; padding: 20px 0;">
        <div class="nav_menu">
            <nav>
                <div class="nav toggle">
                    <!-- <a id="menu_toggle"><i class="fa fa-bars"></i></a> -->
                </div>
                <br>
                <div>
                    <a class="navbar-brand" href="#" style="color: #fff; font-size: 34px; font-weight: bold;">VOTERO</a>
                </div>

                <ul class="nav navbar-nav navbar-right ">
                    <li class="">
                        <!-- <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" style="color: #fff; font-size: 24px;" aria-expanded="false ">
                            <?php echo "Welcome to Voter dashboard : $username"; ?>
                            <span class=" fa fa-angle-down"></span>
                        </a> -->
                        <ul class="dropdown-menu dropdown-usermenu pull-right" style="display: none; position: absolute; background-color: #2563eb; padding: 10px; z-index: 1; top: calc(100% + 5px); left: 0; width: max-content;">
                            <li><a href="javascript:;" style="color: #fff; text-decoration: none; margin-bottom: 5px;">Help</a></li>
                            <li><a href="../authentication/login.php" style="color: #fff; text-decoration: none; margin-bottom: 5px;"><i class="fa fa-sign-out pull-right"></i> Log Out</a></li>
                        </ul>
                    </li>

                    <br><br><br>
                    <h1 style="text-align: right; font-size: 46px; color: #fff; font-weight: bold; margin-right: 500px;">Welcome To Votero</h1><br>
                    <h1 style="text-align: right; font-size: 20px; color: #fff; margin-right: 500px;">Empowering Srilankans to register and participate in elections</h1>
                    <br>
                </ul>
            </nav>
        </div>
    </div>

<!-- end of the navbar -->

<h1 class="text-2xl font-bold mb-4" style="font-size: 24px;">Upcoming Elections</h1><br>





	<div class="container" style="max-width:600px;"> <!-- Adjust the max-width as needed -->
		<div class="row">
			<div class="col-lg-12">
				<div id="calendar"></div>
			</div>
		</div>
	</div>




	<div class="container mx-auto p-4">
    <!-- <h1 class="text-2xl font-bold mb-4" style="font-size: 24px;">Upcoming Elections</h1><br> -->
    <div class="flex justify-center" id="calendar"></div>
    <div class="mt-8">
        <h2 class="text-xl font-semibold mb-4">Election Details</h2>
        <table class="w-full border-collapse border border-gray-200">
            <thead class="bg-gray-200">
                <tr>
                    <th class="px-8 py-4">Election ID</th>
                    <th class="px-12 py-4">Name of Election</th>
                    <th class="px-8 py-4">Date of Election</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Establish connection to your database
                $servername = "localhost";
                $username = "root";
                $password = "";
                $dbname = "votero";

                // Attempt to connect to the database
                $conn = new mysqli($servername, $username, $password, $dbname);

                // Check for connection errors
                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }

                // Fetch data from the election table
                $sql = "SELECT * FROM Election";
                $result = $conn->query($sql);

                // Output data of each row
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td class='px-8 py-4'>" . $row["Election_ID"] . "</td>";
                    echo "<td class='px-12 py-4'>" . $row["Election_Name"] . "</td>";
                    echo "<td class='px-8 py-4'>" . $row["Election_Date"] . "</td>";
                    echo "</tr>";
                }

                // Close the database connection
                $conn->close();
                ?>
            </tbody>
        </table>
    </div>
</div>












	
<!-- Start popup dialog box -->

<!-- End popup dialog box -->




</body>
<script>
$(document).ready(function() {
	display_events();
}); //end document.ready block

function display_events() {
	var events = new Array();
$.ajax({
    url: 'display_event.php',  
    dataType: 'json',
    success: function (response) {
         
    var result=response.data;
    $.each(result, function (i, item) {
    	events.push({
            event_id: result[i].event_id,
            title: result[i].title,
            start: result[i].start,
            //end: result[i].end,
            color: result[i].color,
            //url: result[i].url
        }); 	
    })
	var calendar = $('#calendar').fullCalendar({
	    defaultView: 'month',
		 timeZone: 'local',
	    editable: true,
        selectable: true,
		selectHelper: true,
        select: function(start, end) {
				//alert(start);
				//alert(end);
				$('#event_start_date').val(moment(start).format('YYYY-MM-DD'));
				$('#event_end_date').val(moment(end).format('YYYY-MM-DD'));
				$('#event_entry_modal').modal('show');
			},
        events: events,
	    eventRender: function(event, element, view) { 
            element.bind('click', function() {
				// alert(event.event_id);
					alert(event.title);
				});
    	}
		}); //end fullCalendar block	
	  },//end success block
	  error: function (xhr, status) {
	  alert(response.msg);
	  }
	});//end ajax block	
}

function save_event()
{
var event_name=$("#event_name").val();
var event_start_date=$("#event_start_date").val();
var event_end_date=$("#event_end_date").val();
if(event_name=="" || event_start_date=="" || event_end_date=="")
{
alert("Please enter all required details.");
return false;
}
$.ajax({
 url:"save_event.php",
 type:"POST",
 dataType: 'json',
 data: {event_name:event_name,event_start_date:event_start_date,event_end_date:event_end_date},
 success:function(response){
   $('#event_entry_modal').modal('hide');  
   if(response.status == true)
   {
	alert(response.msg);
	location.reload();
   }
   else
   {
	 alert(response.msg);
   }
  },
  error: function (xhr, status) {
  console.log('ajax error = ' + xhr.statusText);
  alert(response.msg);
  }
});    
return false;
}
</script>
</html> 