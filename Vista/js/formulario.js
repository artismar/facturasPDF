// Agregar campos de entrada para agregar productos
// function agregarItems(){
//     count = ++count;
//     var tablaItems = document.getElementById('tablaItems');
//     var htmlRows = '';
// 		htmlRows += '<tr>';
// 		htmlRows += '<td><input type="text" name="itemProducto[]" id="itemProducto_'+count+'" class="form-control" autocomplete="off"></td>';     
// 		htmlRows += '<td><input type="text" name="descProducto[]" id="descProducto_'+count+'" class="form-control" autocomplete="off"></td>';
// 		htmlRows += '<td><input type="number" name="cantidad[]" id="cantidad_'+count+'" class="form-control" autocomplete="off"></td>';  		
// 		htmlRows += '<td><input type="number" name="precio[]" id="precio_'+count+'" class="form-control" autocomplete="off"></td>';	 
// 		htmlRows += '<td><input type="number" name="total[]" id="total_'+count+'" class="form-control" autocomplete="off"></td>';
//         htmlRows += '<td><input type="button" class="borrar" value="Eliminar" /></td>';
// 		htmlRows += '</tr>';

//     tablaItems.innerHTML += htmlRows;
// }
var count = 0;
$(document).on('click', '.addRows', function() { 
    count++;
    var htmlRows = '';
		htmlRows += '<tr>';
		htmlRows += '<td><input type="text" name="itemProducto[]" id="itemProducto_'+count+'" class="form-control" pattern="[0-9]{0,8}" autocomplete="off" required></td>';     
		htmlRows += '<td><input type="text" name="descProducto[]" id="descProducto_'+count+'" class="form-control" patternt="[a-zA-Z0-9 ]{1,30}" autocomplete="off" required></td>';
		htmlRows += '<td><input type="number" name="cantidad[]" id="cantidad_'+count+'" class="form-control" min="1" autocomplete="off" required></td>';  		
		htmlRows += '<td><input type="number" name="precio[]" id="precio_'+count+'" class="form-control" min="1" autocomplete="off" required></td>';	 
        htmlRows += '<td><button type="button" class="btn btn-outline-danger borrar"><i class="far fa-trash-alt"></i></button></td>';
		htmlRows += '</tr>';
    $('#tablaItems').append(htmlRows);
}); 

$(document).on('click', '.borrar', function (event) {
    event.preventDefault();
    $(this).closest('tr').remove();
});