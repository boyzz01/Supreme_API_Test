<?php
// construct the query with our apikey and the query we want to make
$endpoint = 'http://api.arrow.com/itemservice/v3/en/search/list?req={"request":{"login":"supremecomponents","apikey":"07b23129ead7328ca4f14a9c08fa89f333e30d08042a5ec4d211e7b66851825d","remoteIp":"192.168.1.5","useExact":true,"parts":[{"partNum":"MAX32,32CAE+","mfr":"MAXIM"}]}}';
// setup curl to make a call to the endpoint
$session = curl_init($endpoint);
// indicates that we want the response back
curl_setopt($session, CURLOPT_RETURNTRANSFER, true);
// exec curl and get the data back
$data = curl_exec($session);
// remember to close the curl session once we are finished retrieveing the data
curl_close($session);
// decode the json data to make it easier to parse the php
$search_results = json_decode($data, true);
if ($search_results === NULL) die('Error parsing json');
//print_r($search_results);
echo 'Data';
echo '<table border="1" cellpadding="5" cellspacing="0">';
echo ' <tr>';
echo '<th>Parts Requested</th>	';
echo '<th>Parts Found</th>	';
echo '<th>Parts Not Found</th>	';
echo '<th>Parts Error</th>	';

echo ' </tr>';

foreach ($search_results as $items) {

// $itemserviceresult = $items["itemserviceresult"];
// $serviceMetaData = $itemserviceresult["serviceMetaData"];



$data = $items["data"];
$data0 = $data[0];
$partsRequested = $data0["partsRequested"];
$partsFound = $data0["partsFound"];
$partsNotFound = $data0["partsNotFound"];
$partsError = $data0["partsError"];


echo '<td>'.$partsRequested.'</td>';
echo '<td>'.$partsFound.'</td>';
echo '<td>'.$partsNotFound.'</td>';
echo '<td>'.$partsError.'</td>';

echo '</table>';

$resultList = $data0["resultList"];

echo '<br>';
echo 'Part Result List';

echo '<br>';
echo '<table border="1" cellpadding="5" cellspacing="0">';
echo ' <tr>';
echo '<th>Parts Result List</th>	';

echo ' </tr>';
foreach ($resultList as $list)
{
    echo '<td>'.$list["requestedPartNum"].'</td>';
   
}
}
