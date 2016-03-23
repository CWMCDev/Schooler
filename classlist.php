<?php
$title = "Profile";
include_once("header.php");
?>
<!--get classlist + output-->
<script type="text/javascript">
  $(document).ready( function ()  {
    startLoadingAnimation();
    var id = readCookie('id');
    var token = readCookie('token');

    var url = 'http://api.8t2.eu/portal/students/classlist/'+id+'/'+token;

    $.ajax({
      url: url,
      dataType: 'jsonp',
      success: function(result){
        var classlist = result.classList;
        showClasslist(classlist);
      }
    });
  });

  function showClasslist(data) {
    var dataString = '<div class="container"><div class="col-xs12 col-md-6">';
    dataString += '<table class="table table-striped" id="classlist">';
    for(i = 0; i < data.length; i++){
      var person = data[i];
      dataString += '<tr>'
      dataString += '<th width="40px">'+person.name+'</th>';
      dataString += '<td width="40px">'+person.id+'</td>';
      dataString += '</tr>';
    }
    dataString += '</table></div></div>';
    $("body").append(dataString);
    stopLoadingAnimation();
  }
</script>
<div id="loading" style="text-align:center"></div>

<?php
include_once("footer.php");
?>
