<?php
$title = "Dashboard";
include_once("header.php");
?>

<div class="alert alert-info alert-dismissible" role="alert" id="mailAlert" style="display: none">
	<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
</div>

<?php
$context = stream_context_create(array('http' => array('header'=>'Connection: close\r\n')));
$json = file_get_contents('http://api.8t2.eu/portal/students/profile/'.$_COOKIE['id'].'/'.$_COOKIE['token'],false,$context);
$obj = json_decode($json);
if (isset($obj->student->name)){
	?>
	<div class="page-header">
		<h1>Hallo, <?php echo($obj->student->name); ?>!</h1>
	</div>
</div>
<?php
} else {
	$error = "Ongeldige gebruikersnaam of wachtwoord!";
}
?>

<script type="text/javascript">
	function updateUnread(unread){
		$('#mailAlert').html('Je hebt ' + unread + ' ongelezen email(s).');
		$('#mailAlert').show();
		console.log(unread);
	}
</script>

<?php
include_once("footer.php");
?>