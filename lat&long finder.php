<?php
 
/* 
* Given an address, return the longitude and latitude using The Google Geocoding API V3
*
*/
 
function Get_LatLng_From_Google_Maps($address) {
 
    $url = "http://maps.googleapis.com/maps/api/geocode/json?address=$address&sensor=false";
 
    // Make the HTTP request
    $data = @file_get_contents($url);
    // Parse the json response
    $jsondata = json_decode($data,true);
 
    // If the json data is invalid, return empty array
    if (!check_status($jsondata))    return array();
 
    $LatLng = array(
        'lat' => $jsondata["results"][0]["geometry"]["location"]["lat"],
        'lng' => $jsondata["results"][0]["geometry"]["location"]["lng"],
    );
 
    return $LatLng;
}
 
/* 
* Check if the json data from Google Geo is valid 
*/
 
function check_status($jsondata) {
    if ($jsondata["status"] == "OK") return true;
    return false;
}
 
/*
*  Print an array
*/
 
function d($a) {
    echo "<pre>";
    print_r($a);
    echo "</pre>";
}
?>
<form method="post" action="">
Enter place name<input name="add" type="text" id="add" required placeholder="Enter Address" /><input name="findadd" type="submit" value="submit" id="findadd" />

</form>

<?php
if(isset($_POST['findadd']))
{
$addr = $_POST['add'];
$address = $_POST['add'];
for ($i=0; $i<strlen($address); $i++){
   if ($address[$i]==' '){
       $address[$i]='+';
   }
}
//echo $address;
$sample = Get_LatLng_From_Google_Maps($address);
echo "Adress: $addr <BR />";
echo "The latitude of the above address is " . $sample['lat'] . " and its longitude is " . $sample['lng'];

}
else 
$address = "NULL";

?>

<html>
    <head>
        <style type="text/css">
            div#map {
                position: relative;
            }

            div#crosshair {
                position: absolute;
                top: 192px;
                height: 19px;
                width: 19px;
                left: 50%;
                margin-left: -8px;
                display: block;
                background: url(crosshair.gif);
                background-position: center center;
                background-repeat: no-repeat;
            }
        </style>
        <script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>
        <script type="text/javascript">
            var map;
            var geocoder;
            var centerChangedLast;
            var reverseGeocodedLast;
            var currentReverseGeocodeResponse;

            function initialize() {
                var latlng = new google.maps.LatLng(<?php echo $sample['lat'];?>,<?php echo $sample['lng'];?>);
                var myOptions = {
                    zoom: 10,
                    center: latlng,
                    mapTypeId: google.maps.MapTypeId.ROADMAP
                };
                map = new google.maps.Map(document.getElementById("map_canvas"), myOptions);
                geocoder = new google.maps.Geocoder();

                var marker = new google.maps.Marker({
                    position: latlng,
                    map: map,
                    title: "Hello World!"
                });

            }

        </script>
    </head>
    <body onload="initialize()">
        <div id="map" style="width:100%; height:100%">
            <div id="map_canvas" style="width:100%; height:100%"></div>
            <div id="crosshair"></div>
        </div>
    </body>
</html>