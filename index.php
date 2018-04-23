
<form method="post" >
<label for='name' >Code: </label>
<input type='text' name='name' id='name' maxlength="50" placeholder="<?php echo $name  ?>" required />
<span class="validity"></span>
<input type="submit" value="Submit"/>
</form>
<?php
require_once 'PHPGangsta/GoogleAuthenticator.php';
$imageurl = "image.php?w=200&h=200&image=https://wallpaperscraft.com/image/emma_stone_redhead_hair_room_shirt_64189_1920x1080.jpg" ;

$ga = new PHPGangsta_GoogleAuthenticator();
#$secret = $ga->createSecret();
$secret = "OQB6ZZGYHCPSX4AK" ;
#echo "Secret is: ".$secret."\n\n";

$qrCodeUrl = $ga->getQRCodeGoogleUrl('DeCode', $secret);
#echo "Google Charts URL for the QR-Code: ".$qrCodeUrl."\n\n";
echo '<center><img src="'.$qrCodeUrl.'"  alt=""></center>';

$oneCode = $_POST['name'] ;
#echo "Checking Code '$oneCode' and Secret '$secret':\n";

$checkResult = $ga->verifyCode($secret, $oneCode, 2);    // 2 = 2*30sec clock tolerance
echo '<center>'.$checkResult.'</center>' ;
if ($checkResult) {
    echo 'OK';
    echo '<img src="'.$imageurl.'" alt="This is Emma :D">';
} else {
    echo 'FAILED';
}
?>
