<?php
	include_once 'conexion.php';
	session_start();

	if(isset($_SESSION['user'])){

	if(isset($_GET['id'])){
		$id=(int) $_GET['id'];

		$buscar_id=$con->prepare('SELECT * FROM tallerpfinal WHERE id=:id LIMIT 1');
		$buscar_id->execute(array(
			':id'=>$id
		));
		$resultado=$buscar_id->fetch();
	}else{
		header('Location: pfinal.php');
	}


	if(isset($_POST['guardar'])){
		$nombre=$_POST['nombre'];
		$apellido=$_POST['apellido'];
		$telefono=$_POST['telefono'];
		$direccion=$_POST['direccion'];
		$correo=$_POST['correo'];
		$placa=$_POST['placa'];
		$servicio=$_POST['servicio'];
		$modelo=$_POST['modelo'];
		$id=(int) $_GET['id'];

		if(!empty($nombre) && !empty($apellido) && !empty($telefono) && !empty($direccion) && !empty($correo) && !empty($placa) && !empty($servicio) && !empty($modelo) ){
			if(!filter_var($correo,FILTER_VALIDATE_EMAIL)){
				echo "<script> alert('Correo no valido');</script>";
			}else{
				$consulta_update=$con->prepare(' UPDATE tallerpfinal SET  
					nombre=:nombre,
					apellido=:apellido,
					telefono=:telefono,
					direccion=:direccion,
					correo=:correo,
					placa=:placa,
					servicio=:servicio,
					modelo=:modelo
					WHERE id=:id;'
				);
				$consulta_update->execute(array(
					':nombre' =>$nombre,
					':apellido' =>$apellido,
					':telefono' =>$telefono,
					':direccion' =>$direccion,
					':correo' =>$correo,
					':placa' =>$placa,
					':servicio' =>$servicio,
					':modelo' =>$modelo,
					':id' =>$id
				));
				header('Location: pfinal.php');
			}
		}else{
			echo "<script> alert('Los campos estan vacios');</script>";
		}
	}

?>
<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<title>Editar Cliente</title>
	<link rel="stylesheet" href="css/estilo.css">
</head>
<body>
	<div class="contenedor">
		<h2>Sistema RepairComputer S.A</h2>
		<form action="" method="post">
			<div class="form-group">
				<input type="text" name="nombre" value="<?php if($resultado) echo $resultado['nombre']; ?>" class="input__text">
				<input type="text" name="apellido" value="<?php if($resultado) echo $resultado['apellido']; ?>" class="input__text">
			</div>
			<div class="form-group">
				<input type="text" name="telefono" value="<?php if($resultado) echo $resultado['telefono']; ?>" class="input__text">
				<input type="text" name="direccion" value="<?php if($resultado) echo $resultado['direccion']; ?>" class="input__text">
			</div>
			<div class="form-group">
				<input type="text" name="correo" value="<?php if($resultado) echo $resultado['correo']; ?>" class="input__text">
				<input type="text" name="placa" value="<?php if($resultado) echo $resultado['placa']; ?>" class="
				input__text">
			</div>
			<div class="form-group">
				<input type="text" name="servicio" value="<?php if($resultado) echo $resultado['servicio']; ?>" class="input__text">
				<input type="text" name="modelo" value="<?php if($resultado) echo $resultado['modelo']; ?>" class="input__text">
			</div>
			<div class="btn__group">
				<a href="pfinal.php" class="btn btn__danger">Cancelar</a>
				<input type="submit" name="guardar" value="Guardar" class="btn btn__primary">
			</div>
		</form>
	</div>
</body>
</html>

<?php
} else {
	header("location:index.php");
	}
?>
