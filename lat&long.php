<?php
function lat ($zip)
{
	$URL = "http://maps.google.co.uk/maps/geo?q=" . urlencode($zip.",US") . "&output=csv";
	$data = file_get_contents($URL);

		if($data)
			{
			$data = explode(",",$data);
			if($data[0]!=200)
				{
				$long = "";
				$lat = "";
				}
			else
				{
				$long = $data[3];
				$lat = $data[2];
				}
			}
			
$latlon_arr=array("0"=>$long,"1"=>$lat);
echo   $latlon_arr[0]."long:".$latlon_arr[1];
}

//calling the function
lat(60601);
?>