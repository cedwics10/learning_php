<?php
// "date_default_timezone_set" may be required by your server
date_default_timezone_set( 'Europe/Paris' );
$dateTimeObj = new DateTime('now', new DateTimeZone('Europe/Paris'));
$dateFormatted = 
IntlDateFormatter::formatObject( 
  $dateTimeObj, 
  'eee d MMMM y à HH:mm', 
  'fr' 
);
echo ucwords($dateFormatted);
