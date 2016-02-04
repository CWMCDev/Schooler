<?php
$title = "Dashboard";
include_once("header.php");
?>
<?php
$context = stream_context_create(array('http' => array('header'=>'Connection: close\r\n')));
$json = file_get_contents('http://api.8t2.eu/portal/students/profile/'.$_COOKIE['id'].'/'.$_COOKIE['token'],false,$context);
$obj = json_decode($json);
if (isset($obj->student->name)){
	?>
	<div class="page-header">
		<h1>Hello, <?php echo($obj->student->name); ?>!</h1>
	</div>
</div>
<?php
} else {
	$error = "Ongeldige gebruikersnaam of wachtwoord!";
}
?>

<?php
include_once("footer.php");
?>