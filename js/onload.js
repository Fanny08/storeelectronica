//getProductos del carrito
function loadCarrito()
{
	$.ajax
	({
		url:"php/carrito/getCarrito.php",
		type:"post",
		dataType: 'json',
		success:function(datos)
		{
			$('#cart-list').empty();
			for(var i=0; i<datos.total[0].productos; i++)
			{
				$('#cart-list').append(
					'<div class="product-widget">'+
						'<div class="product-img">'+
							'<img src="./img/'+datos.productos[i].imagen+'" alt="">'+
						'</div>'+
						'<div class="product-body">'+
							'<h3 class="product-name"><a href="producto.php?id='+datos.productos[i].id+'">'+datos.productos[i].nombre+'</a></h3>'+
							'<h4 class="product-price"><span class="qty"></span>$'+datos.productos[i].precio+'</h4>'+
						'</div>'+
						'<button class="delete" data-idcookie="'+datos.productos[i].idCookie+'"><i class="fa fa-close"></i></button>'+
					'</div>'
				);
			}
			$('#qty').text(datos.total[0].productos);
			$('#cant-productos').text(datos.total[0].productos);
			$('#subtotal').text(datos.total[0].subtotal);
		}
		
	});
}
loadCarrito();

//add Carrito
function addCarrito(id, imagen, nombre, precio)
{
	var parametros = {
		'id':id,
		'imagen':imagen,
		'nombre':nombre,
		'precio':precio
	};
	$.ajax
	({
		data:parametros,
		url:"php/carrito/addCarrito.php",
		type:"post",
		dataType: 'json',
		success:function(datos)
		{
			if(datos.status[0].code == 2)
			{
				loadCarrito();
			}
			else
			{
				return false;
			}			
		}
	});
}

function deleteCarrito(idCookie)
{
	var parametros = {
		'idCookie':idCookie
	};
	$.ajax
	({
		data:parametros,
		url:"php/carrito/deleteCarrito.php",
		type:"post",
		dataType: 'json',
		success:function(datos)
		{
			if(datos.status[0].code == 2)
			{
				loadCarrito();
			}
			else
			{
				return false;
			}			
		}
	});
}

function vaciarCarrito()
{
	$.ajax
	({
		url:"php/carrito/vaciarCarrito.php",
		type:"post",
		dataType: 'json',
		success:function(datos)
		{
			if(datos.status[0].code == 2)
			{
				loadCarrito();
			}
			else
			{
				return false;
			}			
		}
	});
}

//if click en boton eliminar producto
$("#cart-list").on("click", "button.delete", function(e)
{
	var idCookie = $(this).data('idcookie');
	deleteCarrito(idCookie);
});