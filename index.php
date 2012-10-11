<?Php 
//
include "site.html";
include"logs/contador.php";
//inicio

	$ip = $_SERVER['REMOTE_ADDR'];
	$time = time();
	$cutoff = 15; //online cut of time
	$exists = 0;
	$users = 0;
	$user  = "";

		$fp = fopen ("online.txt","r+"); //if the file exists open it

		while (!feof($fp))
		{
		$user[] = chop(fgets($fp,65536));
		}
		fseek($fp,0,SEEK_SET);


		foreach ($user as $line)
		{
		list($oldip,$oldtime) = explode('|',$line);
		if ($oldip == $ip) {$oldtime = $time;$exists = 1;} //check to see if the user is already in the text file
		if ($time < $oldtime + ($cutoff * 60)) //see if the last time the user visited is past the cut off time
		{
		fputs($fp,"$oldip|$oldtime\n"); //write the old data to the text file
		$users = $users + 1; // add one to the user count
		}
		}


		if ($exists == 0) //if the user isn't in the text file already:
		{
		fputs($fp,"$ip|$time\n"); //write the new data to the text file
		$users = $users + 1; //add one to the user count
		}


		fclose ($fp); //close the text file
		print "$users"; //display the number of users online


//fim
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<!--METAS -->
<meta name="verify-v1" content="aYQcesttCR0WMo800E4czuk/FcDIvBfeAzaZq1Qf/P0=" >
<meta name="title" content="TWOBrasil - web design">
<meta name="author" content="twobrasil.com">
<meta name="description" content="Tenha seu site, hotsite e muito mais. Flexibilidade no pagamento, layouts personalizados. TWOBrasil Web design.">
<meta name="keywords" content="flash sites, blogs, hotsites, html, material impresso, cartão de visita, joomla, wordpress, B2C, personalizada, completa, TWOBrasil websites, webdesign, webdesigner, two brasil">
<meta NAME="robots" CONTENT="INDEX,FOLLOW">
<meta Name="msnbot" CONTENT="NOODP">
<meta http-equiv="pragma" content="no-cache">
<meta http-equiv="content-type" content="text/html; charset=iso-8859-1">
<meta name="language" content="pt-br">
<!--METAS -->
<title>TWOBrasil - Web design</title>
<link rel="shortcut icon" type="imgs/ico" href="icon.ico" />

</head>
<!--GOOGLE ANALYTCS-->
<script type="text/javascript">
var gaJsHost = (("https:" == document.location.protocol) ? "https://ssl." : "http://www.");
document.write(unescape("%3Cscript src='" + gaJsHost + "google-analytics.com/ga.js' type='text/javascript'%3E%3C/script%3E"));
</script>
<script type="text/javascript">
try {
var pageTracker = _gat._getTracker("UA-9465911-1");
pageTracker._trackPageview();
} catch(err) {}</script>
<!--GOOGLE ANALYTCS-->
<body>


<script type="text/javascript">
var gaJsHost = (("https:" == document.location.protocol) ? "https://ssl." : "http://www.");
document.write(unescape("%3Cscript src='" + gaJsHost + "google-analytics.com/ga.js' type='text/javascript'%3E%3C/script%3E"));
</script>
<script type="text/javascript">
try {
var pageTracker = _gat._getTracker("UA-2382594-1");
pageTracker._trackPageview();
} catch(err) {}</script>
</body>
</html>
