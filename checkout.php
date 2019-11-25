<!DOCTYPE html>
<html lang="en">
	<head>
		<?php
		include('html-source/head.html');
		?>
    </head>
	<body>
	
		<?php
		include('html-source/header.html');
		?>

		<!-- SECTION -->
		<div class="section">
			<!-- container -->
			<div class="container">
				<!-- row -->
				<div class="row">
					<form action="#" method="post" id="checkout">
						<div class="col-md-7">
							<!-- Billing Details -->
							<div class="billing-details">
								<div class="section-title">
									<h3 class="title">Tus Datos</h3>
								</div>
								<div class="form-group">
									<input class="input" type="text" name="first-name" placeholder="Nombre" required>
								</div>
								<div class="form-group">
									<input class="input" type="text" name="last-name" placeholder="Apellido" required>
								</div>
								<div class="form-group">
									<input class="input" type="email" name="email" placeholder="Correo" required>
								</div>
								<div class="form-group">
									<input class="input" type="text" name="address" placeholder="Direccion" required>
								</div>
								<div class="form-group">
									<input class="input" type="text" name="city" placeholder="Ciudad" required>
								</div>
								<div class="form-group">
									<input class="input" type="text" name="country" placeholder="Estado" required>
								</div>
								<div class="form-group">
									<input class="input" type="text" name="zip-code" placeholder="Codigo Postal" required>
								</div>
								<div class="form-group">
									<input class="input" type="tel" name="tel" placeholder="Telefono" required>
								</div>
							</div>
							<!-- /Billing Details -->
						</div>

						<!-- Order Details -->
						<div class="col-md-5 order-details">
							<div class="section-title text-center">
								<h3 class="title">Tu Orden</h3>
							</div>
							<div class="order-summary">
								<div class="order-col">
									<div><strong>PRODUCTO</strong></div>
									<div><strong>TOTAL</strong></div>
								</div>
								<div id="order-products" class="order-products"></div>
								<div class="order-col">
									<div><strong>TOTAL</strong></div>
									<div><strong id="order-total" class="order-total"></strong></div>
								</div>
							</div>
							<button type="submit" id="btn-ordenar" class="primary-btn order-submit col-md-12">Ordenar</button>
							<a href="../">Mas Productos</a>
						</div>
						<!-- /Order Details -->
					</form>
				</div>
				<!-- /row -->
			</div>
			<!-- /container -->
		</div>
		<!-- /SECTION -->

		<?php
		include('html-source/scripts.html');
		?>
<script>
jQuery(document).ready(function(){
	var validarCompra = false;
	var subTotal = 0;
	function loadOrder()
	{
		$.ajax
		({
			url:"php/carrito/getCarrito.php",
			type:"post",
			dataType: 'json',
			success:function(datos)
			{
				$('#order-products').empty();
				for(var i=0; i<datos.total[0].productos; i++)
				{
					$('#order-products').append(
						'<div class="order-col">'+
							'<div>'+datos.productos[i].nombre+'</div>'+
							'<div>$'+datos.productos[i].precio+'</div>'+
						'</div>'
					);
				}
				if(datos.total[0].productos > 0){
					validarCompra = true;
				}else
				{
					validarCompra = false;
				}
				$('#order-total').text('$'+datos.total[0].subtotal);
				subTotal = datos.total[0].subtotal;
			}
			
		});
	}
	loadOrder();
	
	$("#checkout").submit(function ()
	{
		if(validarCompra)
		{
			vaciarCarrito();			
			swal("Exito","Paga \""+subTotal+"\" en tu oxxo mas cercano. #Referencia: \"0123 4567 8910 1112\"","success");
		}
		else
		{
			swal("Error", "Agrega productos a tu carrito.", "error");
		}
		loadOrder();
		return false;
	});
	
	$("#cart-list").on("click", "button.delete", function(e)
	{
		loadOrder();
	});
});
</script>
	</body>
</html>
