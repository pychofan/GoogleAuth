<head>
<title>Google Auth Example</title>
<link rel="icon" href="favicon.ico" type="image/x-icon"/>
<link rel="shortcut icon" type="image/x-icon" href="/favicon.ico">
</head>
<form method="post" >
<label for='name' >Code: </label>
<input type='text' name='name' id='name' maxlength="50" placeholder="Code"/>
<label for='bild' >URL: </label>
<input type='text' name='bild' id='bild'placeholder="URL" />
<span class="validity"></span>
<input type="submit" value="Submit"/>
</form>

<?php
$link = mysql_connect('localhost', 'root', 'maximilian1');
if (!$link) {
    die('Verbindung schlug fehl: ' . mysql_error());
}
echo 'Erfolgreich verbunden';
mysql_close($link);
if (isset($_POST['name'])) {
$bild = $_POST['bild'];
$oneCode = $_POST['name'];
#echo "Checking Code '$oneCode' and Secret '$secret':\n";

require_once 'PHPGangsta/GoogleAuthenticator.php';

$imageurl = "image.php?w=200&h=200&image=$bild" ;

$ga = new PHPGangsta_GoogleAuthenticator();
#$secret = $ga->createSecret();
$secret = "OQB6ZZGYHCPSX4AK" ;
#echo "Secret is: ".$secret."\n\n";

$qrCodeUrl = $ga->getQRCodeGoogleUrl('DeCode', $secret);
#echo "Google Charts URL for the QR-Code: ".$qrCodeUrl."\n\n";

$checkResult = $ga->verifyCode($secret, $oneCode, 2);    // 2 = 2*30sec clock tolerance
echo '<center>'.$checkResult.'</center>' ;
if ($oneCode == "Code") {
  if ($bild == "1337") {
echo '<center><img src="'.$qrCodeUrl.'"  alt=""></center>';
}
}
if ($checkResult) {
    echo 'OK';
    if ($_POST['bild'])
    {
    echo '<img src="'.$imageurl.'" alt="This is Emma :D">';
    }
} else {
    echo 'FAILED';
}
}
?>
