<?php
$title = "Schedule";

$isCodeSet = isset($_COOKIE['ztoken']);

if(!$isCodeSet && isset($_POST['code'])){
  $code = str_replace(' ', '', $_POST["code"]);
  $json = file_get_contents('http://api.8t2.eu/zportal/settoken/'.$code,false);
  $obj = json_decode($json);
  if (!isset($obj->error)){
    setcookie('ztoken', $obj->token, time() + (60 * 60 * 24 * 365), "/");
    $isCodeSet = true;
  }else{
    error_log("ERROR!");
    error_log($obj->error);
  }
}
include_once("header.php");

if(!$isCodeSet){
?>

<div id="ztoken">
  <form action="schedule.php" method="post">
    <input name="code" id="zportal_code" type="text" placeholder="Token">
    <button type="submit" class="btn btn-default">Submit</button>
  </form>
</div>
<?php
}else{
?>

<!--load schedule of student-->
<script type="text/javascript">
  $(document).ready( function () {
    startLoadingAnimation();

    Date.prototype.getWeekNumber = function(){
      var d = new Date(+this);
      d.setHours(0,0,0);
      d.setDate(d.getDate()+4-(d.getDay()||7));
      return Math.ceil((((d-new Date(d.getFullYear(),0,1))/8.64e7)+1)/7);
    };

    var id = readCookie('id');
    var week = 0;
    <?php if(isset($_GET['week'])){
      echo('week = '.$_GET['week'].';');
    } else {
      echo '
      var today = new Date;
      week = today.getWeekNumber() - 1;';
    }?>
    console.log(week);
    var ztoken = readCookie('ztoken');
    var token = readCookie('token');
    
    var url = 'http://api.8t2.eu/zportal/schedule/student/self/'+week+'/'+ztoken+'/'+id+'/'+token+'';

    $.ajax({
      url: url,
      dataType: 'jsonp',
      success: function(result){
        showSchedule(result);
        stopLoadingAnimation();
      }
    });
  });

  function showSchedule(data){
    $('#calendar').fullCalendar({
     header: {
				left: 'prev,next today',
				center: 'title',
				right: 'agendaWeek,agendaDay'
			},
			defaultDate: '2016-01-12',
			editable: true,
			eventLimit: true, // allow "more" link when too many events
			events: [
				{
					title: 'All Day Event',
					start: '2016-01-01'
				},
				{
					title: 'Long Event',
					start: '2016-01-07',
					end: '2016-01-10'
				},
				{
					id: 999,
					title: 'Repeating Event',
					start: '2016-01-09T16:00:00'
				},
				{
					id: 999,
					title: 'Repeating Event',
					start: '2016-01-16T16:00:00'
				},
				{
					title: 'Conference',
					start: '2016-01-11',
					end: '2016-01-13'
				},
				{
					title: 'Meeting',
					start: '2016-01-12T10:30:00',
					end: '2016-01-12T12:30:00'
				},
				{
					title: 'Lunch',
					start: '2016-01-12T12:00:00'
				},
				{
					title: 'Meeting',
					start: '2016-01-12T14:30:00'
				},
				{
					title: 'Happy Hour',
					start: '2016-01-12T17:30:00'
				},
				{
					title: 'Dinner',
					start: '2016-01-12T20:00:00'
				},
				{
					title: 'Birthday Party',
					start: '2016-01-13T07:00:00'
				},
				{
					title: 'Click for Google',
					url: 'http://google.com/',
					start: '2016-01-28'
				}
			]
    });
  
    console.log(data);1
  }
</script>
<div id="loading" style="text-align:center"></div>
<div id="calender"></div>

<?php
}
?>

<?php
include_once("footer.php");
?>