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
	});

	function createTable(data) {
		var dataString = '';
		for (index = 0; index < data.length; ++index) {
			var mail = data[index];

			var rowData = '<tr>';
			rowData += '<td>'+mail.subject+'</td>';
			rowData += '<td>'+mail.sender+'</td>';
			rowData += '</tr>';
			dataString += rowData
		}
		$("#email-table").html(dataString);
		alert(dataString);
	}
</script>
<table class="table table-striped">
	<tbody id="email-table">
	</tbody>
</table>
<?php
include_once("footer.php");
?>
