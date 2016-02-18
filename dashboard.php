<?php
$title = "Dashboard";
include_once("header.php");
?>

<div class="alert alert-info alert-dismissible" role="alert" id="mailAlert" style="display: none">
	<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
</div>
<!--display student name-->
<?php
$context = stream_context_create(array('http' => array('header'=>'Connection: close\r\n')));
$json = file_get_contents('https://api.8t2.eu/portal/students/profile/'.$_COOKIE['id'].'/'.$_COOKIE['token'],false,$context);
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
<!--container for vacations-->
<div class="container">
	<div class="col-md-6 col-sm-12">
		<div class="panel panel-primary">
			<div class="panel-heading">Vakanties</div>
			<table class="table" id="vacation">
			</table>
		</div>
	</div>
</div>
<!--javascript for mail count and vacations-->
<script type="text/javascript">
	function updateUnread(unread){
		$('#mailAlert').html('Je hebt ' + unread + ' ongelezen email(s).');
		$('#mailAlert').show();
		console.log(unread);
	}

	Date.prototype.getWeekNumber = function(){
      var d = new Date(+this);
      d.setHours(0,0,0);
      d.setDate(d.getDate()+4-(d.getDay()||7));
      return Math.ceil((((d-new Date(d.getFullYear(),0,1))/8.64e7)+1)/7);
    };

	$(document).ready( function () {
		var url = 'https://api.8t2.eu/vacations';

		$.ajax({
	      url: url,
	      dataType: 'jsonp',
	      success: function(result){
	        showVacation(result);
	      }
	    });
	});

	function showVacation(data){
		var dataString = '';
		for(i = 0; i < data.vacations.length; i++){
			var vacation = data.vacations[i];
			var startDate = new Date(vacation.start.replace( /(\d{2})-(\d{2})-(\d{4})/, "$2/$1/$3"));
			var endDate = new Date(vacation.end.replace( /(\d{2})-(\d{2})-(\d{4})/, "$2/$1/$3"));
			var now = new Date();
			if(startDate < now && endDate > now){
				dataString += '<tr class="label label-success"><td>' + vacation.name + '</td><td>' + vacation.start + '</td><td>' + vacation.end + '</td></tr>';
			}else if(endDate > now){
				dataString += '<tr><td>' + vacation.name + '</td><td>' + vacation.start + '</td><td>' + vacation.end + '</td></tr>';
			}
		}
		$("#vacation").html(dataString);
	}
</script>

<?php
include_once("footer.php");
?>
