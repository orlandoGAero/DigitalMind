$(document).ready(function() {
	$.ajax({
				url: './index.php?url=listarCodPos',
				type: 'post',
				data: { tag: 'getData'},
				dataType: 'json',
				success: function (data) {
					if (data.success) {
						$.each(data, function (index, record) {
							if ($.isNumeric(index)) {
								var row = $("<tr />");
								$("<td />").text(record.Id).appendTo(row);
								$("<td />").text(record.CP).appendTo(row);
								$("<td />").text(record.Localidad).appendTo(row);
								$("<td />").text(record.Municipio).appendTo(row);
								$("<td />").text(record.Estado).appendTo(row);
								row.appendTo('table');
							}
						})
					}

				}
			});
})