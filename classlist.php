<?php
$title = "Profile";
include_once("header.php");
?>

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

        var index;
        var classlist = result.classList;
        createTable(presention);
      }
    });
  });

  function createTable(data)  {
    for (var i = 0; i < data.length; i++) {
      addTable(data[i]);
    };
    stopLoadingAnimation();
  }

  function showClasslist(data) {
    for (var person in data.classlist) {
      datastring += '<tr>'
      datastring += '<th width="40px"></th>';
    }
  }
</script>




<?php
$context = stream_context_create(array('http' => array('header'=>'Connection: close\r\n')));
$json = file_get_contents('http://api.8t2.eu/portal/students/classlist/'.$_COOKIE['id'].'/'.$_COOKIE['token'],false,$context);
    $obj = json_decode($json);
    if (isset($obj->classList)){
    	echo '<div id="container">';
    	echo '<table class="table table-striped width="300px">';
        foreach ($obj->classList as $person) {
          echo '<tr><td width="100px">'.$person->name.'</td>';
          echo '<td width="200px">'.$person->id.'</td></tr>';
        }
        echo '</table>';
        echo '</div>';
    } else {
      $error = "Ongeldige gebruikersnaam of wachtwoord!";
    }
?>


<?php
include_once("footer.php");
?>