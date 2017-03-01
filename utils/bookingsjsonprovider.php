<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once('../DBHandler.php');
require_once ('../models/booking.php');
require_once ('../models/client.php');
require_once ('../models/venue.php');
require_once ('../models/feature.php');
//TODO
$begindate=date('Y-m-d H:i:s',$_GET['from']/1000);
$todate = date('Y-m-d H:i:s',$_GET['to']/1000);

$bookings = Booking::allFromTo($begindate,$todate);
$out = array();
foreach( $bookings as  $booking) {
    $client= Client::find($booking->id);
    $out[] = array(
        'id' => $booking->id,
        'title' => $booking->description,
        'url' => 'index.php?controller=bookings&action=show&id='.$booking->id,
        'start' => strtotime($booking->startDateTime) . '000',
        'end' => strtotime($booking->endDateTime) .'000',
        'venues'=>$booking->venues,
        'clientdivision' => $booking->client->division
    );
}

echo json_encode(array('success' => 1, 'result' => $out));

exit;

?>