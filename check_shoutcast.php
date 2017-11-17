<?php

$shortOptions  = "";
$shortOptions .= "H:";
$shortOptions .= "p:";
$shortOptions .= "u:";
$shortOptions .= "P:";

$options = getopt($shortOptions);

$useragent    = "Mozilla (DNAS 2 Statuscheck)";
$shoutcastHost    = $options['H'];
$shoutcastPort    = $options['p'];
$shoutcastUser    = $options['u'];
$shoutcastPassword    = $options['P'];


$ch = curl_init($shoutcastHost . '/admin.cgi?mode=viewxml');

curl_setopt($ch, CURLOPT_PORT, $shoutcastPort);
curl_setopt($ch, CURLOPT_USERAGENT, $useragent);
curl_setopt($ch, CURLOPT_TIMEOUT, 5);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
curl_setopt($ch, CURLOPT_USERPWD, $shoutcastUser . ':' . $shoutcastPassword);

$curl = curl_exec($ch);

$response = curl_getinfo($ch,CURLINFO_HTTP_CODE);


if ($curl)
{
    $xml = simplexml_load_string($curl);
    $status = ($xml->STREAMSTATUS);
    $name = ($xml->SERVERTITLE);
    $type = ($xml->CONTENT);
    if ($response == 401){
      $status = 3;
    }
    switch($status){
      case (0):
      echo "WARNING – Stream is currently down\n";
      exit(1);

      case(1):
      echo "OK - Stream is currently up (name: ".$name." – type: ".$type.");\n";
      exit(0);

      case(3):
      echo "WARNING - Unable to log into Shoutcast DNAS using provided credentials\n";
      exit(1);
    }

}
else
{
    echo("CRITICAL - Couldn't connect to specified stream\n");
    exit(2);
}
?>
