<?php
$title = "Profile";
include_once("header.php");
?>
<script type="text/javascript">
  $(document).ready( function () {
    startLoadingAnimation();
    var id = readCookie('id');
    var token = readCookie('token');

    var url = 'http://api.8t2.eu/portal/students/presention/'+id+'/'+token;

    $.ajax({
      url: url,
      dataType: 'jsonp',
      success: function(result){

        var index;
        var presention = result.presentie;
        createTable(presention);
      }
    });
  });

  function createTable(data) {
    for (var i = 0; i < data.length; i++) {
      addTable(data[i]);
    };
    stopLoadingAnimation();
  }

  function addTable(week) {
    var weekNumber = week.week;
    var weekData = week.dagen;

    console.log(week.week);
    var div = document.createElement('div');

    var dataString =  '<div class="col-xs-12 col-md-6 week-'+weekNumber+'">';
    dataString += '<table class="table table-striped">';

    dataString += '<tr><th width="20px">'+weekNumber+'</th>';
    for (var i = 0; i < 10; i++) {
      var hour = i +1;
      dataString += '<td>'+ hour +'</td>';
    };
    dataString += '</tr>';

    for (var day in weekData) {
      dataString += '<tr>'
      dataString += '<th width="20px">'+day+'</th>';

      for (var i = 0; i < weekData[day].length; i++) {
        var type = '', msg = '';
        switch(weekData[day][i].status){
          case 'aanw':
            type = 'success';
            break;
          
          case 'geoorlafw':
            type = 'success';
            msg = 'GA';
            break;

          case 'melding-only':
            type = 'warning';
            msg = 'Mld';
            break;

          case 'afw':
            type = 'danger';
            msg = 'Afw';
            break;
          
          default:
            break;
        };
        dataString += '<td class='+type+'>'+msg+'</td>';
      };
      dataString += '</tr>';
    };
    dataString += '</table>';
    $("body").append(dataString);
  }
</script>
<div id="loading" style="text-align:center"></div>
<?php
include_once("footer.php");
?>
