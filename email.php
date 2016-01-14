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
				var mails = result.mails;
				createTable(result);
			}
		});

		function createTable(data) {
			var tbdy = $('#email-table');
			for (index = 0; index < mails.length; ++index) {
				var mail = mails[index];
				var tr = document.createElement('tr');
				var subjectTD = document.createElement('td');
				subjectTD.appendChild(document.createTextNode(mail.subject));
				tr.appendChild(subjectTD);
				var senderTD = document.createElement('td');
				senderTD.appendChild(document.createTextNode(mail.sender));
				tr.appendChild(senderTD);
				tbdy.appendChild(tr);
			}
		}
	});
</script>
<table class="table table-striped">
	<tbody id="email-table">
	</tbody>
</table>
<?php
include_once("footer.php");
?>
