<?php
$title = "Mail";
include_once("header.php");
?>
<script type="text/javascript">
	$(document).ready( function () {
      var id = readCookie('id');
      var token = readCookie('token');

      var url = 'http://api.8t2.eu/mail/'+id+'/'+token;

      $.ajax({
        url: url,
        dataType: 'jsonp',
        success: function(result){

        	var index;
			for (index = 0; index < a.length; ++index) {
    			console.log(result[index].subject);
			}
        }
      });
  });
</script>
<?php
include_once("footer.php");
?>
