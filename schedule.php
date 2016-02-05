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
    defaultView: 'agendaDay',
    events: [
        // events go here
    ],
    resources: [
        { id: 'a', title: 'Maandag' },
        { id: 'b', title: 'Dinsdag' },
        { id: 'c', title: 'Woensdag' },
        { id: 'd', title: 'Donderdag' },
        { id: 'e', title: 'Vrijdag'}
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