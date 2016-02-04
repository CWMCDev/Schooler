<?php
$title = "Profile";
include_once("header.php");

$isCodeSet = false;
if (isset($_COOKIE['ztoken'])) {
  $isCodeSet = true;
}
if(!empty($_POST["code"])) {
  $code = str_replace(' ', '', $_POST["code"]);
  $context = stream_context_create(array('http' => array('header'=>'Connection: close\r\n')));
  $json = file_get_contents('http://api.8t2.eu/zportal/settoken/'.$code,false,$context);
  $obj = json_decode($json);
  if (!isset($obj->error)){
    var_dump($obj);
    setcookie('ztoken', $obj->token, time() + (60 * 60 * 24 * 365), "/");
    $isCodeSet = true;
  }else{
    var_dump("ERROR!");
    var_dump($obj->error);
  }
}
if(!$isCodeSet){
  echo'
<div id="ztoken">
  <form action="schedule.php" method="post">
    <input name="code" id="zportal_code" type="text" placeholder="Token">
    <button type="submit" class="btn btn-default">Submit</button>
  </form>
</div>';
}
?>

<?php
include_once("footer.php");
?>