<?php 
     include '../apartadosPhp/conexion_bd.php';
	session_start();
	$user = $_SESSION['usuario'];
	if(!isset($user)){
		echo '
			<script>
				alert("No puedes acceder a este apartado, tienes que iniciar sesion primero");
				window.location = "../index.php";
			</script>
		';
		session_destroy();
		die();
	}

	if(isset($_GET['id'])) $id = $_GET['id'];
	$sql = "SELECT * FROM usuarios WHERE id = :id";

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Join Game | Perfil</title>
	<link rel="shortcut icon" href="../img/iconos/logo.jpg">
	
	<!-- Links para los css -->
	<link rel="stylesheet" href="../css/reset.css">
	<link rel="stylesheet" href="../css/main.css">

	<!-- Los diferentes plugins Y JS -->
  	<script src="../js/jquery-3.6.0.min.js"></script>
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
		?>
	</header>
	<main class="columnas">
		<div class="perfil">
			<div class="imgNombre">
				<img src="../img/avatares/<?php echo $user['fotoPerfil']; ?>" alt="perfil">
			<p class="nombre"><?php echo $user['nombre_completo']; ?></p>
			</div>
			<div class="entradasPropias">
				<h3>ultimas entradas</h3>
				<?php 
					include("../apartadosPhp/conexion_bd.php");
     			$query = "SELECT * FROM contenido WHERE creador =" . $user['id'];
     			$resultado = $conexion -> query($query);
                              while ($row = $resultado->fetch_assoc()){
				?>
					<p class="recientes"><?php echo "<a href='../apartados/blog.php?id=" . $row["Id"] . "' class='blog'>". $row['Titulo'] ."</a>" ?></p>
     			<?php 
     				}
     			?>
			</div>
		</div>
		<div class="editar">
			<h5 class="editarPerfil">Editar datos de perfil</h5>
			<form action="" method="POST" enctype="multipart/form-data">
				<div class="form-body">
					<div class="form-group">
						<label for="nombre" class="label">Nombre Completo</label>
						<input type="text" name="nombre" placeholder="Nombre Completo" value="<?php echo $user['nombre_completo']; ?>">
					</div>
					<div class="form-group">
						<label for="usuario" class="label">Usuario</label>
						<input type="text" name="usuario" value="<?php echo $user['usuario']; ?>">
					</div>
					<div class="form-group">
						<label for="correo" class="label">Email</label>
						<input type="text" name="correo" value="<?php echo $user['correo']; ?>">
					</div>
					<div class="form-group">
						<label for="avatar" class="label">Nueva foto de perfil</label>
						<input type="file" name="avatar">
					</div>
					<div class="checkbox">
						<input type="radio" value="H" name="hombre" <?php if($user['sexo']  === 'H'){ echo 'checked'; } ?>> Hombre <br>
						<input type="radio" value="M" name="mujer" <?php if($user['sexo']  === 'M'){ echo 'checked'; } ?>> Mujer
					</div>
					<div class="form-group">
						<label class="label">Fecha de nacimiento</label>
						<div class="input-group">
							<input type="text" name="nacimiento" placeholder=" <?php echo $user['nacimiento'];?>" class="form-control" data-inputmask="'alias': 'yyyy-mm-dd'" data-mask>
						</div>
					</div>
				</div>
				<div class="form-footer">
					<button type="submit" name="actualizar">Actualizar datos</button>
				</div>
			</form>
		</div>

		<?php 
			if(isset($_POST['actualizar'])){
				$nombre = mysql_real_escape_string($_POST['nombre']);
				$usuario = mysql_real_escape_string($_POST['usuario']);
				$correo = mysql_real_escape_string($_POST['correo']);
				$sexo = mysql_real_escape_string($_POST['sexo']);
				$nacimiento = mysql_real_escape_string($_POST['nacimiento']);
				
				if ($nacimiento != '') {
					$nac = $nacimiento;
				}else{
					$nac = $user['nacimiento'];
				}

				$comprobar = mysql_num_rows(mysql_query("SELECT * FROM usuarios WHERE usuario = '$usuario' AND id != '$id'"));
				if($comprobar == 0){
					$type = 'jpg';
					$rfoto = $_FILES['avatar']['tmp_name'];
					$name = $id. '.' . $type;
					if(is_uploaded_file($rfoto)){
						$destino = '../img/avatares/'. $name;
						$nombrea = $name;
						copy($rfoto, $destino);
					}else{
						$nombrea = $user['avatar'];
					}
					$sql = mysqli_query("UPDATE usuarios SET nombre_completo= '$nombre', correo = '$correo', usuario = '$usuario', fotoPerfil = '$nombrea', sexo = '$sexo', nacimiento = '$nac' WHERE id = '$id'");
					if($sql) {echo " <script type='text/javascript' >window.location='editarPerfil.php?id=$_SESSION[id] '; </script>" ; }
				}else{
					echo "El nombre de ususario ya esta en uso, por favor, escoja otro.";
				}
			}
		?>


		<div class="publicaciones">
			<h3>ULTIMAS PUBLICACIONES</h3>
			<div class="entradas">
				<?php 
					include("../apartadosPhp/conexion_bd.php");
     			$query = "SELECT * FROM contenido LIMIT 9";
     			$resultado = $conexion -> query($query);
                              while ($row = $resultado->fetch_assoc()){
				?>
					<p class="recientes"><?php echo "<a href='../apartados/blog.php?id=" . $row["Id"] . "' class='blog'>". $row['Titulo'] ."</a>" ?></p>
     			<?php 
     				}
     			?>
			</div>
		</div>
		
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