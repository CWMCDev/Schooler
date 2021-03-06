<?php
$title = "Mail";
include_once("header.php");
?>

<!--script by Kurt Stam to load emails-->
<script type="text/javascript">
	$(document).ready( function () {
		startLoadingAnimation();
		var id = readCookie('id');
		var token = readCookie('token');

		var url = 'http://api.8t2.eu/mail/'+id+'/'+token;

		$.ajax({
			url: url,
			dataType: 'jsonp',
			success: function(result){

				var index;
				var mails = result.mails;
				createTable(mails);
			}
		});
	});

	function createTable(data) {
		var dataString = '<tr><th>Onderwerp</th><th>Afzender</th></tr>';
		for (index = 0; index < data.length; ++index) {
			var mail = data[index];

			var rowData = '<tr>';
			rowData += '<td>'+mail.subject+'</td>';
			rowData += '<td>'+mail.sender+'</td>';
			rowData += '</tr>';
			dataString += rowData
		}
		$("#email-table").html(dataString);
		stopLoadingAnimation();
	}
</script>
<table class="table table-striped">
	<tbody id="email-table">
	</tbody>
</table>
<div id="loading" style="text-align:center"></div>
<?php
include_once("footer.php");
?>
