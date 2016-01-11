<?php
$title = "Profile";
include_once("header.php");

$isCodeSet = false;
if (isset($_COOKIE['ztoken'])) {
  $isCodeSet = true;
}
if(!empty($_POST["code"])) {
  $json = file_get_contents('http://api.8t2.eu/zportal/settoken/'.$_POST["code"]);
  $obj = json_decode($json);
  if (!isset($obj->error)){
    setcookie('ztoken', $obj->token, time() + (60 * 60 * 24 * 365), "/");
    $isCodeSet = true;
  }
}
?>

<div id="ztoken">
  <form action="schedule.php" method="post">
    <input name="code" id="zportal_code" type="text" placeholder="Token">
    <button type="submit" class="btn btn-default">Submit</button>
  </form>
</div>
<?php
if ($isCodeSet) {
  echo '<script type="text/javascript">document.getElementById(\'ztoken\').style.display = \'none\';</script>';
}
?>

<?php
include_once("footer.php");
?>