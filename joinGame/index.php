<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Join Game</title>
	<link rel="shortcut icon" href="img/iconos/logo.jpg">
	
	<!-- Links para los css -->
	<link rel="stylesheet" href="css/reset.css">
  	<link rel="stylesheet" href="themes/default/default.css">
	<link rel="stylesheet" href="css/nivo-slider.css">
	<link rel="stylesheet" href="css/main.css">

	<!-- Los diferentes plugins Y JS -->
  	<script src="js/jquery-3.6.0.min.js"></script>
  	<script src="js/jquery.nivo.slider.js"></script>
  	<script src="js/js.js"></script>
</head>
<body>
	<header>
		<h1><a href="index.php"><img src="img/imgGeneral/logo.png" alt="logo"></a></h1>
		<div class="menu">
			<nav class="navegador">
				<ul>
					<li><a href="#" id="selected"></a></li>
					<li><a href="apartados/nosotros.php">Nosotros</a></li>
					<li><a href="apartados/formulario.php">Registro/Inicio</a></li>
				</ul>
			</nav>
		</div>
		
	</header>
	
	<main>
			<div class="slider-wrap theme-default">
	           	<div id="slider" class="nivoSlider">
	              		<img src="img/slider/portada1.jpg" alt="img1">
	               	<img src="img/slider/portada2.jpg" alt="img2">
	               	<img src="img/slider/portada3.jpg" alt="img3">
	           	</div>
	     	</div>

     		<h2 class="subtitulos">Bienvenido a Join Game</h2>
     		<p class="resumen">Aqui en Join Game encontraras los mejores consejos sobre VideoJuegos de todo tipo, tomamos consejos para mejorar nuestro sitio dia a dia, asi que cualquier recomendacion nos gustaria que nos lo envies a nuestra correo de sugerencias <3</p>

     		<h2 class="subtitulos">Post agregados recientemente</h2>

     		<?php 
     			include("apartadosPhp/conexion_bd.php");
     			$query = "SELECT a.Id, a.Img, a.Titulo, a.subtitulo, b.usuario, a.Fecha, a.Comentario1 FROM contenido a 
     			INNER JOIN usuarios b on b.id = a.creador ORDER BY a.Fecha DESC";
                              $resultado = $conexion -> query($query);
                              while ($row = $resultado->fetch_assoc()){
     					?>
     					<div class="prevEntradas">
     						<div class="img">	
     							<img class="imgEntrada" src="img/entradas/<?php echo $row ['Img']?>" alt="imgEntrada">
     						</div>
     						<div class="detalles">
     							<?php echo "<a href='apartados/blog.php?id=" . $row["Id"] . "' class='blog'><h3>". $row['Titulo'] ."</h3></a>" ?>

     							<p class="subtitulo"><?php echo $row['subtitulo'] ?></p>
     							<div class="creador_fecha">
     								<h4 class="creador"> <?php echo $row['usuario'] ?> </h4>
     								<h5 class="fecha"><?php echo $row['Fecha'] ?></h5>
     							</div>
     							
     							<p class="descripcion"><?php echo $row['Comentario1'] ?></p>
     						</div>
     					</div>
     					<?php
     					
     				}
     		?>

	</main>
	<footer>
		<h6 class="footer">Por favor, sigueme en mis redes sociales y sitios de entretenimiento para ayudarme a crecer nuestra querida comunidad <3</h6>
		<div class="redes">
			<ul>
				<li><a href="https://www.facebook.com/kian14Oficial" target="_blank"><img src="img/iconos/facebook.png" alt="Facebook"></img></a></li>
				<li><a href="https://www.instagram.com/kian14_mic/" target="_blank"><img src="img/iconos/instagram.png" alt="Instagram"></img></a></li>
				<li><a href="https://www.twitch.tv/kian_14_mic" target="_blank"><img src="img/iconos/twitch.png" alt="Twitch"></img></a></li>
				<li><a href="https://www.youtube.com/channel/UCjoR3qfEIXXoeAd0DU7y9og" target="_blank"><img src="img/iconos/youtube.png" alt="Youtube"></img></a></li>
			</ul>
		</div>
	</footer>
</body>
</html>