<?php
$title = "Profile";
include_once("header.php");
?>

<?php
$json = file_get_contents('http://api.8t2.eu/portal/students/profile/'.$_COOKIE['id'].'/'.$_COOKIE['token']);
    $obj = json_decode($json);
    if (isset($obj->student)){
echo '<div id="student_short">';
echo '<table table-striped width="100px">';
echo '<tr><td>'.$obj->student->name.'</td></tr>';
echo '<tr><td>Leerlingnummer</td>';
echo '<td>'.$obj->student->studentnumber.'<td></tr>';
echo 'tr><td>klas</td>';
echo '<td>'.$obj->student->class.'</td></tr>';
echo '<tr><td>Geboortedatum</td>';
echo '<td>'.$obj->student->birthdate.'</td></tr>';
echo '<tr><td>Telefoon privé</td>';
echo '<td>'.$obj->student->phonenumbers->home.'</td></tr>';
echo '<tr><td>Telefoon mobile</td>';
echo '<td>'.$obj->student->phonenumbers->mobile.'</td></tr>';
echo '</table>';
      
echo '<table class="table table-striped" width="100px">';
echo '<tr><td>Straat</td>';
echo '<td>'.$obj->adress->street.'</td></tr>';
echo '<tr><td>Postcode</td>';
echo '<td>'.$obj->adress->zipcode.'</td></tr>';
echo '<tr><td>Plaats</td>';
echo '<td>'.$obj->adress->place.'</td></tr>';
echo '</table>';

echo '<table class="table table-striped">';
echo '<tr><td>Mentor</td>';
echo '<td>'.$obj->mentor->name.'</td></tr>';
echo '<tr><td>Afkorting</td>';
echo '<td>'.$obj->mentor->abbreviation.'</td></tr>';
echo '<tr><td>E-mail</td>';
echo '<td>'.$obj->mentor->email.'</td></tr>';
echo '</table>';

echo '<table class="table-striped">'
echo '<tr><td>Onderwijstype</td>';
echo '<td>'.$obj->profile->profile.'</td></tr>';
echo '<tr><td>Code</td>';
echo '<td>'.$obj->profile->code.'</td></tr>';
echo '<tr><td>Afkorting</td>';
echo '<td>'.$obj->profile->abbreviation.'</td></tr>';
echo '<tr><td>Leerjaar</td>';
echo '<td>'.$obj->profile->year.'</td></tr>';
    } 
echo '</table>';
echo '</div>';
    else {
      $error = "Ongeldige gebruikersnaam of wachtwoord!";
    }
?>

<?php
include_once("footer.php");
?>
