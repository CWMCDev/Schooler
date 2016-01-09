<?php
$title = "Dashboard";
include_once("header.php");
?>
<?php
$json = file_get_contents('http://86.107.110.214/portal/students/profile/cc112335/CcEUkYxk6vVZwtXmJa8JhmvrOcov0GATXeULtr6VgMUI0p2Ad1BZ8yQUG1P6JYBNAr2vyireQQ8EiAreH7ne8Pp7L3ggR1xhS4zHaWGwwNhBsgEWgaTIIA3PnGTifTlos0DEq17s4DihW5KLHxuFo0IleAvKaY5x7YYg8KGCtwtXyvtDMiByxFJI5CJQWvIGLmv6O1XCk3onukZd867vjERunf4w0EjzQ17vrJKPZ6uozirK0egwYgkzQ1x6LvBi');
    $obj = json_decode($json);
    if (isset($obj->student->name)){
      echo $obj->student->name;
    } else {
      $error = "Ongeldige gebruikersnaam of wachtwoord!";
    }
?>

<?php
include_once("footer.php");
?>
