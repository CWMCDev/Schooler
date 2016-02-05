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
    
    var url = 'http://api.8t2.eu/zportal/schedule/student/self/'+week+'/'+ztoken+'/'+id+'/'+token;

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
				<?php
          $useragent = 'Mozilla/5.0 (Windows; U; Windows NT 6.1; en-US) AppleWebKit/533.2 (KHTML, like Gecko) Chrome/5.0.342.3 Safari/533.2';
  
          $token = $_COOKIE['token'];
          $ztoken = $_COOKIE['ztoken'];
          $id = $_COOKIE['id'];
          $week = date('W');
  
          if(isset($_GET['week'])){
            $week = $_GET['week'];
          }
  
                    $ch = curl_init();
          curl_setopt($ch, CURLOPT_URL, 'http://api.8t2.eu/zportal/schedule/student/self/'.$week.'/'.$ztoken.'/'.$id.'/'.$token);
          curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
          curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
          curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
          curl_setopt($ch, CURLOPT_USERAGENT, $useragent);
  
          $schedule = json_decode(curl_exec($ch));
    
          foreach ($schedule as $lesson) {
            $subject = "";
            $teacher = "";
            $location = "";
            foreach ($lesson->subjects as $s) {
              $subject .= $s;
            }
            foreach ($lesson->teachers as $t) {
              $teacher .= $t;
            }
            foreach ($lesson->locations as $l) {
              $location .= $l;
            }
      
            $backgroundColor = '#E0E0E0';
            if ($lesson->status == 'aanw'){
              $backgroundColor = '#dff0d8';
            } elseif ($lesson->status == 'geoorlafw'){
              $backgroundColor = '#dff0d8';
            } elseif ($lesson->status == 'melding-only'){
              $backgroundColor = '#fcf8e3';
            } elseif ($lesson->status == 'afw'){
              $backgroundColor = '#f2dede';
            }
            
            if ($lesson->cancelled) {
              $backgroundColor = 'FF0000';
            }
            
            echo '{ id: \''.$lesson->id.'\', start: \''.date("Y-m-d\TH:i:s",$lesson->start).'\', end: \''.date("Y-m-d\TH:i:s",$lesson->end).'\', title: \''.$subject.'\n'.$teacher.'\n'.$location.'\', backgroundColor: \''.$backgroundColor.'\', textColor: \'black\'},';
            
          }
        ?>
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