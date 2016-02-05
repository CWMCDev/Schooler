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
    schedulerLicenseKey: 'GPL-My-Project-Is-Open-Source',
			defaultView: 'agendaWeek',
			defaultDate: moment(),
      height: 800,
      slotDuration: '00:15:00',
      minTime: '08:00:00',
      maxTime: '18:00:00',
      slotLabelFormat: 'HH:mm',
      weekends: false,
			editable: false,
			selectable: true,
			eventLimit: true, // allow "more" link when too many events
			header: {
				left: 'prev, today',
				center: 'title',
				right: 'today, next'
			},
			views: {
				agendaTwoDay: {
					type: 'agenda',
					duration: { days: 2 },

					// views that are more than a day will NOT do this behavior by default
					// so, we need to explicitly enable it
					groupByResource: true

					//// uncomment this line to group by day FIRST with resources underneath
					//groupByDateAndResource: true
				}
			},

			//// uncomment this line to hide the all-day slot
			allDaySlot: false,

			resources: [
				{ id: 'a', title: 'Day' },
			],
			events: [
				{ id: '1', resourceId: 'a', start: '2016-02-01T09:00:00', end: '2016-02-01T11:00:00', title: 'les 1' },
				{ id: '1', resourceId: 'a', start: '2016-02-02T09:00:00', end: '2016-02-02T11:00:00', title: 'les 2' },
				{ id: '1', resourceId: 'a', start: '2016-02-03T09:00:00', end: '2016-02-03T11:00:00', title: 'les 3' },
				{ id: '1', resourceId: 'a', start: '2016-02-04T09:00:00', end: '2016-02-04T11:00:00', title: 'les 4' },
				{ id: '1', resourceId: 'a', start: '2016-02-05T09:00:00', end: '2016-02-05T11:00:00', title: 'les 5' }
			],

			select: function(start, end, jsEvent, view, resource) {
				console.log(
					'select',
					start.format(),
					end.format(),
					resource ? resource.id : '(no resource)'
				);
			},
			dayClick: function(date, jsEvent, view, resource) {
				console.log(
					'dayClick',
					date.format(),
					resource ? resource.id : '(no resource)'
				);
			}
		});
  
    console.log(data);1
  }
</script>
<div id="loading" style="text-align:center"></div>
<div id="calendar"></div>

<?php
}
?>

<?php
include_once("footer.php");
?>