<?php

$timezone = new DateTimeZone('America/Chicago');
$dt = new DateTime("now", $timezone);
	$dt->setTimestamp(time());
$close_time = "8:45 pm";
$open_time = "6:15 am";
$ct = DateTime::createFromFormat('H:i a', $close_time, $timezone);
$ot = DateTime::createFromFormat('H:i a', $open_time, $timezone);
if (!($dt >= $ot && $dt <= $ct)) {
	die; // Time out of range
}

$local_file		= dirname(__FILE__).'/WebsiteLeadsCombined.csv';
if (file_exists($local_file)) {
	$time = $dt->format('Ymd_Hi');

	$ftp_server		= 'Neptune.posrg.com';
	$ftp_user		= '.\ftpuser';
	$ftp_password	= '$1lentN1ght!';
	$ftp_port		= 44021;

	$server_file	= 'ftp://'.$ftp_user.':'.$ftp_password.'@'.$ftp_server.':'.$ftp_port.'/WebsiteLeadsCombined_'.$time.'.csv';

	$local_contents = file_get_contents($local_file);
	$remote = fopen($server_file,'w');
	$write = fwrite($remote, $local_contents);
	fclose($remote);

	if ($remote && $write) {
		unlink($local_file);
	}
}