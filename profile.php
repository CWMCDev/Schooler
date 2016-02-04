<?php
    $title = "Profile";
    include_once("header.php");
?>

<!--get student profile and output this data-->
<script type="text/javascript">
  $(document).ready( function () {
    startLoadingAnimation();
    var id = readCookie('id');
    var token = readCookie('token');

    var url = 'http://api.8t2.eu/portal/students/profile/'+id+'/'+token;

    $.ajax({
      url: url,
      dataType: 'jsonp',
      success: function(result){
        showProfile(result);
      }
    });
  });

  function showProfile (data) {
    var dataString = '<div class="row"><div class="col-md-6">';
    dataString += '<table class="table table-striped">';
    dataString += '<tr><th>Leerlingnummer</th><td>'+data.student.studentnumber+'</td></tr>';
    dataString += '<tr><th>Klas</th><td>'+data.student.class+'</td></tr>';
    dataString += '<tr><th>Geboortedatum</th><td>'+data.student.birthdate+'</td></tr>';
    if(data.student.phonenumbers.home.trim() != ""){
        dataString += '<tr><th>Telefoon privé</th><td>'+data.student.phonenumbers.home+'</td></tr>';
    }
    if(data.student.phonenumbers.mobile.trim() != ""){
        dataString += '<tr><th>Telefoon mobiel</th><td>'+data.student.phonenumbers.mobile+'</td></tr>';
    }

    dataString += '</table></div>';

    if(data.hasOwnProperty('address')){
        dataString += '<div class="col-md-6"><table class="table table-striped">'
        dataString += '<tr><th>Straat</th><td>'+data.address.street+'</td></tr>';
        dataString += '<tr><th>Postcode</th><td>'+data.address.zipcode+'</td></tr>';
        dataString += '<tr><th>Plaats</th><td>'+data.address.residence+'</td></tr>';
        dataString += '</table></div>';
    }

    if(data.hasOwnProperty('mentor')){
        dataString += '<div class="col-md-6"><table class="table table-striped">'
        dataString += '<tr><th>Mentor</th><td>'+data.mentor.name+'</td></tr>';
        dataString += '<tr><th>Afkorting</th><td>'+data.mentor.abbreviation+'</td></tr>';
        dataString += '<tr><th>E-mail</th><td>'+data.mentor.email+'</td></tr>';
        dataString += '</table></div>';
    }

    if(data.hasOwnProperty('profile')){
        dataString += '<div class="col-md-6"><table class="table table-striped">'
        dataString += '<tr><th>Onderwijstype</th><td>'+data.profile.profile+'</td></tr>';
        dataString += '<tr><th>Code</th><td>'+data.profile.code+'</td></tr>';
        dataString += '<tr><th>Afkoring</th><td>'+data.profile.abbreviation+'</td></tr>';
        dataString += '<tr><th>Leerjaar</th><td>'+data.profile.year+'</td></tr>';
        dataString += '</table></div>';
    }
    $(".container").append(dataString);
    stopLoadingAnimation();
  }

</script>
<div id="loading" style="text-align:center"></div>

<?php
    include_once("footer.php");
?>
