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

					<!-- section title -->
					<div class="col-md-12">
						<div class="section-title">
							<h3 class="title">Productos</h3>
						</div>
					</div>
					<!-- /section title -->

					<!-- Products tab & slick -->
					<div class="col-md-12">
						<div class="row">
							<div class="products-tabs">
								<!-- tab -->
								<div id="tab1" class="tab-pane active">
									<div class="products-slick" data-nav="#slick-nav-1" id="products-slick"></div>
									<div id="slick-nav-1" class="products-slick-nav"></div>
								</div>
								<!-- /tab -->
							</div>
						</div>
					</div>
					<!-- Products tab & slick -->
				</div>
				<!-- /row -->
			</div>
			<!-- /container -->
		</div>
		<!-- /SECTION -->

		<!-- jQuery Plugins -->
		<script src="js/jquery.min.js"></script>
		<script src="js/bootstrap.min.js"></script>
		<script src="js/slick.min.js"></script>
		<script src="js/nouislider.min.js"></script>
		<script src="js/jquery.zoom.min.js"></script>
		<script src="js/jquery.cookie.js"></script>
		<script src="js/jquery.json.min.js"></script>
		<script src="js/custom.cookie.js"></script>
		<script src="js/main.js"></script>
<script>
jQuery(document).ready(function(){
	
	function initSlick()
	{
		// Products Slick
		$('.products-slick').each(function() {
			var $this = $(this),
					$nav = $this.attr('data-nav');

			$this.slick({
				slidesToShow: 4,
				slidesToScroll: 1,
				autoplay: true,
				infinite: true,
				speed: 300,
				dots: false,
				arrows: true,
				appendArrows: $nav ? $nav : false,
				responsive: [{
				breakpoint: 991,
				settings: {
				  slidesToShow: 2,
				  slidesToScroll: 1,
				}
			  },
			  {
				breakpoint: 480,
				settings: {
				  slidesToShow: 1,
				  slidesToScroll: 1,
				}
			  },
			]
			});
		});
	}
	
	function loadList()
	{
		
	}
	$("#products-slick").on("click", "button.add-to-cart-btn", function(e)
	{
		var id = $(this).data('id');
		var imagen = $(this).data('imagen');
		var nombre = $(this).data('nombre');
		var precio = $(this).data('precio');
		
		$('#cart-list').append(
			'<div class="product-widget">'+
				'<div class="product-img">'+
					'<img src="./img/product01.png" alt="">'+
				'</div>'+
				'<div class="product-body">'+
					'<h3 class="product-name"><a href="#">'+nombre+'</a></h3>'+
					'<h4 class="product-price"><span class="qty"></span>$'+precio+'</h4>'+
				'</div>'+
				'<button class="delete" data-id="'+id+'"><i class="fa fa-close"></i></button>'+
			'</div>'
		);
		
		$('#subtotal').text('2500');
		
	});
	
	var list = new cookieList("Productos"); // all items in the array.
	//var array = '{"nombre":"John", "precio":50}';
	//list.add(array);
	//var resultados = list.items();
	//var spliteado = resultados.split(',');
	//alert(resultados[1]);
	list.clear();
	
	var array = ["foo1", "foo2"];
	
	$.cookie("1", array);
	alert($.cookie("1") );
	alert(JSON.stringify($.cookie()));
	
	$.removeCookie('Productos');
	
	$("#cart-list").on("click", "button.delete", function(e)
	{
		var id = $(this).data('id');
		
	});
	
	$.ajax
	({
		url:"php/getProductos.php",
		type:"post",
		dataType: 'json',
		success:function(datos)
		{
			for(var i=0; i<datos.productos.length; i++)
			{
				var id = datos.productos[i].id;
				var nombre = datos.productos[i].nombre;
				var precio = datos.productos[i].precio;
				var precioOLD = parseFloat(datos.productos[i].precio)+100;
				var valoracion = datos.productos[i].estrellas;
				var imagen = datos.productos[i].imagenes[0];
				var estrellas = '';
				for(var x=0; x<valoracion; x++){
					estrellas += '<i class="fa fa-star"></i>';
				}
				$('#products-slick').append(
					'<div class="product">'+
						'<div class="product-img">'+
							'<img src="./img/product02.png" alt="">'+
						'</div>'+
						'<div class="product-body">'+
							'<h3 class="product-name"><a href="#">'+nombre+'</a></h3>'+
							'<h4 class="product-price">$'+precio+' <del class="product-old-price">$'+precioOLD+'</del></h4>'+
							'<div class="product-rating">'+
								estrellas +
							'</div>'+
							'<div class="product-btns">'+
								'<button class="quick-view"><a href="producto.php?producto='+id+'"><i class="fa fa-eye"></i><span class="tooltipp">Ver</span></a></button>'+
							'</div>'+
						'</div>'+
						'<div class="add-to-cart">'+
							'<button class="add-to-cart-btn" data-id="'+id+'" data-imagen="'+imagen+'" data-nombre="'+nombre+'" data-precio="'+precio+'"><i class="fa fa-shopping-cart"></i> Añadir al carrito</button>'+
						'</div>'+
					'</div>'
				);
			}
			initSlick();
		}
		
	});
});
</script>
	</body>
</html>
