<?php 
	
	session_start();
	if(!isset($_SESSION['usuario'])){
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Join Game</title>
	<link rel="shortcut icon" href="../img/iconos/logo.jpg">
	
	<!-- Links para los css -->
	<link rel="stylesheet" href="../css/reset.css">
	<link rel="stylesheet" href="../css/main.css">

	<!-- Los diferentes plugins Y JS -->
  	<script src="../js/jquery-3.6.0.min.js"></script>
  	<script src="../js/js.js"></script>
</head>
<body>
	<header>
		<h1><a href="../index.php"><img src="../img/imgGeneral/logo.png" alt="logo"></a></h1>
		<div class="menu">
			<nav class="navegador">
				<ul>
					<li><a href="../index.php" id="selected"></a></li>
					<li><a href="#">Categorias</a>
						<ul class="navCategoria">
							<li><a href="#">Terror</a></li>
							<li><a href="#">Accion y Aventura</a></li>
							<li><a href="#">Mundo Abierto</a></li>
							<li><a href="#">Retro</a></li>
							<li><a href="#">Metroidvania</a></li>
						</ul>
						
					</li>
					<li><a href="#">Nosotros</a></li>
					<li><a href="formulario.php">Registro/Inicio</a></li>
				</ul>
			</nav>
		</div>
		
	</header>
<?php 
	}else{
		include("../apartadosPhp/conexion_bd.php");
		$user = $_SESSION['usuario'];

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Join Game | Blog </title>
	<link rel="shortcut icon" href="../img/iconos/logo.jpg">
	
	<!-- Links para los css -->
	<link rel="stylesheet" href="../css/reset.css">
	<link rel="stylesheet" href="../css/main.css">

	<!-- Los diferentes plugins Y JS -->
  	<script src="../js/jquery-3.6.0.min.js"></script>
  	<script src="../js/js.js"></script>
</head>
<body>
	<header>
		<h1><a href="../sessionStart/index.php"><img src="../img/imgGeneral/logo.png" alt="logo"></a></h1>
		<?php 
			$user = $_SESSION['usuario'];
			if ($user['perfil'] === 1){
			    include("../sessionStart/encabezadoAdmin.php");
			}else{
			    include("../sessionStart/encabezadoUsuario.php");
			}
		}
		?>
	</header>
	<main>
		<div id="wrapper">
			<?php
				include("../apartadosPhp/conexion_bd.php");
     			$query = "SELECT a.ID, a.Img, a.Titulo, a.subtitulo, b.usuario, a.Fecha, a.Comentario1, a.img2, a.Comentario2, a.pieEntrada FROM contenido a 
     			INNER Join usuarios b on b.id = a.creador WHERE a.Id = " . $_GET['id'] . "";
                              $resultado = $conexion -> query($query);
                              while ($row = $resultado->fetch_assoc()){
     		?>
			<div class="contenido">	
	     		<p class="fecha"><?php echo $row['Fecha'] ?></p>
	     		<h2 class="titulo">
	     			<?php echo $row['Titulo'] ?>
	     		</h2>
	     		<h3 class="subtitulo2">
	     			<?php echo $row['subtitulo'] ?>
	     		</h3>
	     		<div class="imgBlog">
	     			<img src="../img/entradas/<?php echo $row['Img'] ?>" alt="img">
	     		</div>
	     		<p class="informacion"><?php echo $row['Comentario1'] ?></p>
	     		<div class="imgBlog">
	     			<img src="../img/entradas/<?php echo $row['img2'] ?>" alt="img">
	     		</div>
	     		<p class="informacion"><?php echo $row['Comentario2'] ?></p>
	     		<p class="pieEntrada"><?php echo $row['pieEntrada'] ?></p>
	     		<p class="creadro">Blog Subido por: <a href="#"><?php echo $row['usuario'] ?></a></p>
			</div>
			<div id="comentariosBlog">
				
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
				<li><a href="https://www.facebook.com/kian14Oficial"><img src="../img/iconos/facebook.png" alt="Facebook"></img></a></li>
				<li><a href="https://www.instagram.com/kian14_mic/"><img src="../img/iconos/instagram.png" alt="Instagram"></img></a></li>
				<li><a href="https://www.twitch.tv/kian_14_mic"><img src="../img/iconos/twitch.png" alt="Twitch"></img></a></li>
				<li><a href="https://www.youtube.com/channel/UCjoR3qfEIXXoeAd0DU7y9og"><img src="../img/iconos/youtube.png" alt="Youtube"></img></a></li>
			</ul>
		</div>
	</footer>
</body>
</html>