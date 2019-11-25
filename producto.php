<!DOCTYPE html>
<html lang="en">
	<head>
		<?php
		include('html-source/head.html');
		?>
    </head>
	<body>
	
<div id="fb-root"></div>
<script async defer crossorigin="anonymous" src="https://connect.facebook.net/es_LA/sdk.js#xfbml=1&version=v5.0&appId=202902796950543"></script>
	
		<?php
		include('html-source/header.html');
		?>

		<!-- SECTION -->
		<div class="section">
			<!-- container -->
			<div class="container">
				<!-- row -->
				<div class="row">
					<!-- Product main img -->
					<div class="col-md-4">
						<div id="product-main-img">
							<div class="product-preview">
								<img id="img-main" alt="">
							</div>
						</div>
					</div>
					<!-- /Product main img -->

					<!-- Product details -->
					<div class="col-md-4">
						<div class="product-details">
							<h2 id="product-name" class="product-name"></h2>
							<div>
								<div id="product-rating" class="product-rating"></div>
							</div>
							<div>
								<h3 class="product-price"><span id="product-price"></span> <del id="product-old-price" class="product-old-price"></del></h3>
							</div>
							<p id="product-descripcion"></p>

							<div id="add-to-cart-btn" class="add-to-cart">
								<button class="add-to-cart-btn"><i class="fa fa-shopping-cart"></i> <span id="text-btn-loading">Cargando Producto...</span></button>
							</div>

						</div>
					</div>
					<!-- /Product details -->

					<!-- Product tab -->
					<div class="col-md-4">
						<div class="fb-comments" id="facebook-comments" data-mobile="true" data-numposts="5"></div>
					</div>
					<!-- /product tab -->
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
	
	var loaded = false;
	
	var id = getVarURL('id');
	if(id==''){
		window.location.href = "../";
	}
	
	$("#facebook-comments").attr("data-href", "http://storeelectronica.esy.es/producto.php?id="+id);

	var parametros = {
		'id':id
	};
	$.ajax
	({
		data:parametros,
		url:"php/productos/getInfo.php",
		type:"post",
		dataType: 'json',
		success:function(datos)
		{
			if(!datos.productos)
			{
				swal("Error", "No se encontro el producto.", "error");
				setTimeout(function(){
					location.href = "../";
				}, 3000);
			}
			for(var i=0; i<datos.productos.length; i++)
			{
				var id = datos.productos[i].id;
				var nombre = datos.productos[i].nombre;
				var descripcion = datos.productos[i].descripcion;
				var precio = datos.productos[i].precio;
				var precioOLD = parseFloat(datos.productos[i].precio)+100;
				var valoracion = datos.productos[i].estrellas;
				var imagen = datos.productos[i].imagenes[0];
				var estrellas = '';
				for(var x=0; x<valoracion; x++){
					estrellas += '<i class="fa fa-star"></i>';
				}
				
				$("#img-main").attr("src", "./img/"+imagen);
				//$("#img-thumb").attr("src", "./img/"+imagen);
				
				$("#product-name").html(nombre);
				$("#product-rating").html(estrellas);
				$("#product-price").html('$'+precio);
				$("#product-old-price").html('$'+precioOLD);
				$("#product-descripcion").html(descripcion);
				
				$("#add-to-cart-btn").attr("data-id", id);
				$("#add-to-cart-btn").attr("data-imagen", imagen);
				$("#add-to-cart-btn").attr("data-nombre", nombre);
				$("#add-to-cart-btn").attr("data-precio", precio);
				
				$("#text-btn-loading").text("Añadir al carrito");
				
				loaded = true;
			}
			
			// Product img zoom
			var zoomMainProduct = document.getElementById('product-main-img');
			if (zoomMainProduct) {
				$('#product-main-img .product-preview').zoom();
			}
		}
	});
	
	$("#add-to-cart-btn").on("click", function(e)
	{
		var id = $(this).data('id');
		var imagen = $(this).data('imagen');
		var nombre = $(this).data('nombre');
		var precio = $(this).data('precio');
		
		if(loaded)
		{
			addCarrito(id, imagen, nombre, precio);
		}
		
	});

});
</script>
	</body>
</html>
