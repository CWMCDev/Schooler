<?php
$title = "Profile";
include_once("header.php");

if(!empty($_POST["code"])) {
  $json = file_get_contents('http://86.107.110.214/zportal/settoken/'.$_POST["code"]);
  $obj = json_decode($json);
  if (!isset($obj->error)){
    setcookie('ztoken', $obj->token, time() + (60 * 60 * 24 * 365), "/");
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
if (isset($_COOKIE['ztoken'])) {
  ?>
  <script type="text/javascript">document.getElementById('ztoken').style.display = 'none';</script>
  <?php
}
?>


<?php
include_once("footer.php");
?>