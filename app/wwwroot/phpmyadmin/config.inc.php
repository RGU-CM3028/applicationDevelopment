<?php
$cfg['blowfish_secret'] = 'b01be6ac34b5a8';  // use here a value of your choice  
$i = 0;
/* First server */
$i++;
/* Authentication type */
$cfg['Servers'][$i]['auth_type'] = 'cookie';
/* Server parameters */
$cfg['Servers'][$i]['host'] = 'eu-cdbr-azure-north-e.cloudapp.net';  // Replace with value from connection string
$cfg['Servers'][$i]['connect_type'] = 'tcp';
$cfg['Servers'][$i]['compress'] = false;
$cfg['Servers'][$i]['extension'] = 'mysqli';
$cfg['Servers'][$i]['AllowNoPassword'] = false;
?>
