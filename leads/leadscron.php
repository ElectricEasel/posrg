<?php

$dt = new DateTime("now", new DateTimeZone('America/Chicago'));
$dt->setTimestamp(time());
$time = $dt->format('Ymd_Hi');

$ftp_server		= 'Neptune.posrg.com';
$ftp_user		= '.\ftpuser';
$ftp_password	= '$1lentN1ght!';
$ftp_port		= 44021;

$local_file		= getcwd().'/WebsiteLeadsCombined.csv';
$server_file	= 'ftp://'.$ftp_user.':'.$ftp_password.'@'.$ftp_server.':'.$ftp_port.'/WebsiteLeadsCombined_'.$time.'.csv';

$local_contents = file_get_contents($local_file);
$remote = fopen($server_file,'w');
fwrite($remote, $local_contents);
fclose($remote);