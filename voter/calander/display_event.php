<?php                
require 'database_connection.php'; 
$display_query = "select Election_ID,Election_Name,Election_Date from election";             
$results = mysqli_query($con,$display_query);   
$count = mysqli_num_rows($results);  
if($count>0) 
{
	// Array of predefined light colors
$light_colors = array('#FFDDC1', '#FFD1DC', '#C1E1FF');

// Select a random light color from the array

	$data_arr=array();
    $i=1;
	while($data_row = mysqli_fetch_array($results, MYSQLI_ASSOC))
	{	
		$data_arr[$i]['event_id'] = $data_row['Election_ID'];
		$data_arr[$i]['title'] = $data_row['Election_Name'];
		$data_arr[$i]['start'] = date("Y-m-d", strtotime($data_row['Election_Date']));
		// $data_arr[$i]['end'] = date("Y-m-d", strtotime($data_row['event_end_date']));
		// $data_arr[$i]['color'] = '#'.substr(uniqid(),-6); // 'green'; pass colour name
		// $data_arr[$i]['url'] = 'https://www.shinerweb.com';
		$data_arr[$i]['color'] = $light_colors[array_rand($light_colors)];

	$i++;
	}
	
	$data = array(
                'status' => true,
                'msg' => 'successfully!',
				'data' => $data_arr
            );
}
else
{
	$data = array(
                'status' => false,
                'msg' => 'Error!'				
            );
}
echo json_encode($data);
?>