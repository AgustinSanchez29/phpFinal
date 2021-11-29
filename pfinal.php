<?php
	include_once 'conexion.php';
	session_start();

	if(isset($_SESSION['user'])){

	$sentencia_select=$con->prepare('SELECT *FROM tallerpfinal ORDER BY id asc');
	$sentencia_select->execute();
	$resultado=$sentencia_select->fetchAll();

	// metodo buscar
	if(isset($_POST['btn_buscar'])){
		$buscar_text=$_POST['buscar'];
		$select_buscar=$con->prepare('
			SELECT *FROM tallerpfinal WHERE nombre LIKE :campo OR apellido LIKE :campo OR placa LIKE :campo;'
		);

		$select_buscar->execute(array(
			':campo' =>"%".$buscar_text."%"
		));

		$resultado=$select_buscar->fetchAll();

	}

?>

<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<title>Inicio</title>
	<link rel="stylesheet" href="css/estilo.css">
	 <?php require_once "scripts.php";?>
</head>
<body>


	<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="#">Repair Computer S.A</a>
    </div>
    <ul class="nav navbar-nav">
      <li class="active"><a href="inicio.php">Inicio</a></li>
     
    </ul>
    <ul class="nav navbar-nav navbar-right">
      <li><a href="index.php"><span class="glyphicon glyphicon-user"></span> Login</a></li>
      <li><a href="php/salir.php"><span class="glyphicon glyphicon-log-in"></span> Logout</a></li>
    </ul>
  </div>
</nav>


	<div class="contenedor">
<h2>SISTEMA DE REGISTRO DE EQUIPOS</h2>
		
		<div class="barra__buscador">
			<form action="" class="formulario" method="post">
				<input type="text" name="buscar" placeholder="buscar nombre, apellidos o placa" 
				value="<?php if(isset($buscar_text)) echo $buscar_text; ?>" class="input__text">
				<input type="submit" class="btn" name="btn_buscar" value="Buscar">
				<a href="insert.php" class="btn btn__nuevo">Nuevo</a>
			</form>
		</div>
		<table>
			<tr class="head">
				<td>Id</td>
				<td>Nombre</td>
				<td>Apellido</td>
				<td>Teléfono</td>
				<td>Direccion</td>
				<td>Correo</td>
				<td>Equipo</td>
				<td>Servicio</td>
				<td>Modelo</td>
				<td colspan="2">Acciónes</td>
			</tr>
			<?php foreach($resultado as $fila):?>
				<tr >
					<td><?php echo $fila['id']; ?></td>
					<td><?php echo $fila['nombre']; ?></td>
					<td><?php echo $fila['apellido']; ?></td>
					<td><?php echo $fila['telefono']; ?></td>
					<td><?php echo $fila['direccion']; ?></td>
					<td><?php echo $fila['correo']; ?></td>
					<td><?php echo $fila['placa']; ?></td>
					<td><?php echo $fila['servicio']; ?></td>
					<td><?php echo $fila['modelo']; ?></td>
					<td><a href="update.php?id=<?php echo $fila['id']; ?>"  class="btn__update" >Editar</a></td>
					<td><a href="delete.php?id=<?php echo $fila['id']; ?>" class="btn__delete">Eliminar</a></td>
				</tr>
			<?php endforeach ?>

		</table>
	</div>
</body>
</html>

<?php
} else {
	header("location:index.php");
	}
?>