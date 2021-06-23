<?php 
	
	session_start();
	if($_SESSION['rol'] != 1)
	{
		header("location: ./");
	}

	include "../conexion.php";

	if(!empty($_POST))
	{
		$alert='';
		if(empty($_POST['categoria']))
		{
			$alert='<p class="msg_error">Todos los campos son obligatorios.</p>';
		}else{

			$idcategoria = $_POST['id'];
			$categoria = $_POST['categoria'];
	

			
      		$sql_update = mysqli_query($conection,"UPDATE categoria
															SET categoria = '$categoria'											WHERE codcategoria= $idcategoria ");

				

				if($sql_update){
					$alert='<p class="msg_save">categoria actualizado correctamente.</p>';
				}else{
					$alert='<p class="msg_error">Error al actualizar el categoria.</p>';
				}

			


		}

	}

	//Mostrar Datos
	if(empty($_REQUEST['id']))
	{
		header('Location: lista_categoria.php');
		mysqli_close($conection);
	}
	$idcategoria = $_REQUEST['id'];

	$sql= mysqli_query($conection,"SELECT * FROM categoria
									WHERE codcategoria= $idcategoria ");
	mysqli_close($conection);
	$result_sql = mysqli_num_rows($sql);

	if($result_sql == 0){
		header('Location: lista_categoria.php');
	}else{
		$option = '';
		while ($data = mysqli_fetch_array($sql)) {
			# code...
			$idcategoria  = $data['codcategoria'];
			$categoria  = $data['categoria'];
		

			

		}
	}

 ?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<?php include "includes/scripts.php"; ?>
	<title>Actualizar categoria</title>
</head>
<body>
	<?php include "includes/header.php"; ?>
	<section id="container">
		
		<div class="form_register">
			<h1>Actualizar categoria</h1>
			<hr>
			<div class="alert"><?php echo isset($alert) ? $alert : ''; ?></div>

			<form action="" method="post">
				<input type="hidden" name="id" value="<?php echo $idproveedor; ?>" >
				<label for="categoria">Nombre categoria</label>
				<input type="text" name="categoria" id="categoria" placeholder="Nombre del categoria" value="<?php echo $categoria?>">

			


				<input type="submit" value="Actualizar categoria" class="btn_save">


			</form>


		</div>


	</section>
	<?php include "includes/footer.php"; ?>
</body>
</html>