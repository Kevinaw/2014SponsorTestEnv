<?php

//============================================================
// batch replace copyright
//============================================================
//============================================================
//  Main include doc
//=============================================
//error_reporting(0);
error_reporting( error_reporting() & ~E_NOTICE );
function convertDate($d) {
    $datePieces = explode("-", $d);
    $dateYear = $datePieces[0];
    $dateMonth = $datePieces[1];
    $dateDay = $datePieces[2];
    $timestamp = mktime(0, 0, 0, $dateMonth, $dateDay, $dateYear);
    $dayOfWeek = strftime("%A", $timestamp);
    $month = strftime("%B", mktime(0, 0, 0, $dateMonth + 1, 0, 0));

    //$dateString = $dayOfWeek . ", " . $month . " " . $dateDay . ", " . $dateYear; 
    $dateString = $month . " " . $dateDay . ", " . $dateYear;
    return $dateString;
}

// Declare Section

$username = 'banffpipeline';
$password = '8hLvxnVByHTzxwHn';
$hostname = 'localhost';
$databaseName = 'banffpipeline';

$tablename = '2014visitor'; // for workshop registrants
$tablesponsor = '2014sponsor'; // for sponsorship sign up
$tabledetailname = '2014confDetail'; // holds workshop information
$holddetail = '2014holdDetail'; // stores changes to workshop registration
$conference = '2014conferenceNew'; // holds all workshop information
$tableIP = '2014ipTrack'; // stores login attempts
$tablePayment = '2014paymentHistory'; // payments on workshop registration
$tablePaymentSponsor = '2014paymentSponsorship'; // sponsorship payments
$tableCountries = 'countryList'; // old country list
$tableCountriesNew = 'asmeCountryList'; // new country list
$tableprofile = '2014visitorProfile'; // login profiles
$tablepromo = '2014promo'; // promotional codes
$tablecomments = '2014comments'; // comments table
$tablegroups = '2014workGroups'; // list of workgroups
// CONNECT TO THE DATABASE
$link = mysql_connect($hostname, $username, $password);
if (!$link) {
    die('Could not connect to database with error : ' . mysql_error());
}
$db = mysql_select_db($databaseName, $link) or die("Connection made. But database '$databaseName' was not found.");

mysql_set_charset('utf8', $link);

$isChargingGst = 0.00; // 1.00;
?>