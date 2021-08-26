$(function(){
	getBienes();
});

function getBienes(){
	$.ajax({
		url: '../db/listaordenes.php',
		type: 'get',
		dataType: 'json',
		data: {
			initial: '2018-10-01',
			final: '2018-10-31'
		},
		beforeSend: function(){
			$("#tblOrders tbody").empty();
		},
		success: function(res){
			// console.log('Ordenes obtenidas: ',res);
			for (var i = 0; i < res.length; i++) {
				// console.log(res[i].order,res[i]);
				$("#tblOrders tbody").append(
					"<tr>" +
						"<td>"+res[i].date+"</td>" +
						"<td>"+res[i].customer+"</td>" +
						"<td>"+res[i].order+"</td>" +
						"<td>"+res[i].total+"</td>" +
					"<tr>"
				);
			}
		},
		error: function(error){
			console.log('Error not orders: ', error);
		}
	});
}