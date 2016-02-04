<?php
$title = "Grades";
include_once("header.php");
?>

<script type="text/javascript">
  $(document).ready( function () {
    startLoadingAnimation();
    var id = readCookie('id');
    var token = readCookie('token');

    var url = 'http://api.8t2.eu/portal/students/grades/1/'+id+'/'+token;

    $.ajax({
      url: url,
      dataType: 'jsonp',
      success: function(result){
        showGrades(result);
      }
    });
  });

  function showGrades (data) {
    var maxCount = 8;
    var classes = data.classes;
      for(i = 0; i < classes.length; i++){
        var cls = classes[i];
        console.log(cls.grades);
        if(cls.grades.length > maxCount){
          maxCount = cls.grades.length;
        }
      }
    console.log(maxCount);

    var dataString = '<div><table class="table table-striped">';
    for (var i = 0; i < classes.length; i++) {
      var cls = classes[i];
      dataString += '<tr><th width="100px">' + cls.text + '</th>';
      for (var j = 0; j < maxCount; j++) {
        var grade = cls.grades[j];
        if(typeof grade != 'undefined'){
          dataString += '<td width="25px">' + grade.Cijfer + '</td>';
        }else{
          dataString += '<td width="25px"> </td>';
        }
      };
      dataString += '</tr>';
    };
    dataString += '</div>';

    $(".container").append(dataString);
    stopLoadingAnimation();
  }

</script>
<div id="loading" style="text-align:center"></div>

<?php
include_once("footer.php");
?>