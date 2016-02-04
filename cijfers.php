<?php
$title = "Grades";
include_once("header.php");
?>
<form id="myForm" class="pull-right">
<label class="radio-inline"><input type="radio" name="radioName" checked="true" value="1" /> 1 </label>
<label class="radio-inline"><input type="radio" name="radioName" value="2" /> 2 </label>
<label class="radio-inline"><input type="radio" name="radioName" value="3" /> 3 </label>
</form>
<div id="loading" style="text-align:center"></div>

<div id="grades"></div>

<script type="text/javascript">
  $(document).ready( function () {
    loadGrades(1);
  });

  $('form input').on('change', function() {
    var val = $('input:checked', 'form').val();
    console.log(val);
    loadGrades(val); 
  });

  function loadGrades(period) {
    startLoadingAnimation();
    var id = readCookie('id');
    var token = readCookie('token');

    var url = 'http://api.8t2.eu/portal/students/grades/'+period+'/'+id+'/'+token;

    $.ajax({
      url: url,
      dataType: 'jsonp',
      success: function(result){
        showGrades(result);
      }
    });
  }

  function showGrades (data) {
    var maxCount = 8;
    var classes = data.classes;
      for(i = 0; i < classes.length; i++){
        var cls = classes[i];
        if(cls.grades.length > maxCount){
          maxCount = cls.grades.length;
        }
      }

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

    $("#grades").html(dataString);
    stopLoadingAnimation();
  }

</script>

<?php
include_once("footer.php");
?>