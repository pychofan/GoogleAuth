<head>
<title>Google Auth Example 2.0</title>
<link rel="icon" href="favicon.ico" type="image/x-icon"/>
<link rel="shortcut icon" type="image/x-icon" href="/favicon.ico">
</head>
<style>
body {
    background-image: url('bild1.jpg');
    background-repeat: no-repeat;
    background-attachment: fixed;
    background-position: center;
    background-color: #000000;
}
</style>
<font color='b3c4dd'><center><form method="post" >
<label for='name' >Code: </label>
<input type='text' name='name' id='name' maxlength="50" placeholder="Code"/>
<label for='bild' >URL: </label>
<input type='text' name='bild' id='bild'placeholder="URL" />
<label for='ben' >Benutzer: </label>
<input type='text' name='ben' id='ben'placeholder="Benutzer" />
<span class="validity"></span>
<input type="submit" value="Submit"/>
</form></center></font>

<?php
if (isset($_POST['name'])) {
$bild = $_POST['bild'];
$oneCode = $_POST['name'];
$ben = $_POST['ben'] ;
#echo "Checking Code '$oneCode' and Secret '$secret':\n";

require_once 'PHPGangsta/GoogleAuthenticator.php';

$imageurl = "image.php?w=200&h=200&image=$bild" ;

$ga = new PHPGangsta_GoogleAuthenticator();
#$secret = $ga->createSecret();

include 'user.php' ;
if (isset($secret)) {
$qrCodeUrl = $ga->getQRCodeGoogleUrl('DeCode', $secret);
#echo "Google Charts URL for the QR-Code: ".$qrCodeUrl."\n\n";

$checkResult = $ga->verifyCode($secret, $oneCode, 2);    // 2 = 2*30sec clock tolerance
}
echo '<center>'.$checkResult.'</center>' ;
if ($oneCode == "Code") {
  if ($bild == "1337") {
echo '<center><img src="'.$qrCodeUrl.'"  alt=""></center>';
}
}
if ($checkResult) {
  include 'page.php' ;
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
