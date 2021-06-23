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
		if(empty($_POST['proveedor']) || empty($_POST['producto']) || empty($_POST['precio']) || empty($_POST['id'] || empty($_POST['exitencia'])))
		{
			$alert='<p class="msg_error">Todos los campos son obligatorios.</p>';
		}else{
            $codproducto = $_POST['id'];
			$proveedor = $_POST['proveedor'];
			$producto  = $_POST['producto'];
			$precio  = $_POST['precio'];
			$existencia  = $_POST['existencia'];

			$usuario_id    = $_SESSION['idUser'];
            

         


				$query_insert = mysqli_query($conection,"UPDATE producto SET descripcion='$producto',proveedor='$proveedor',precio='$precio' ,existencia='$existencia' WHERE codproducto=$codproducto");
																	

	
               if($query_insert){
					$alert='<p class="msg_save">Producto actualizado correctamente.</p>';
        
				}else{
					$alert='<p class="msg_error">Error al actualizar el Producto.</p>';
				}

			


		}

	}


//validar 
     if(empty($_REQUEST['id'])){
     header("location: lista_producto.php");
     }else{

     	$id_producto = $_REQUEST['id'];
     	if(!is_numeric($id_producto)){
     		header("location: lista_producto.php");
     	}
    

        $query_producto= mysqli_query($conection,"SELECT p.codproducto, p.descripcion, p.precio,p.descripcion, pr.codproveedor,pr.proveedor FROM producto p INNER JOIN proveedor pr ON  p.proveedor = pr.codproveedor WHERE p.codproducto = $id_producto and p.estatus=1"); 
				
				$result_producto = mysqli_num_rows($query_producto);
          if($result_producto > 0){

				$data_producto = mysqli_fetch_assoc($query_producto);     
       }else{
        header("location: lista_producto.php");
    }
}

 ?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<?php include "includes/scripts.php"; ?>
	<title>	Actualizar  Producto</title>
</head>
<body>
	<?php include "includes/header.php"; ?>
	<section id="container">
		
		<div class="form_register">
			<h1><i class="fas fa-cubes"></i> Actualizar  Producto</h1>
			<hr>
			<div class="alert"><?php echo isset($alert) ? $alert : ''; ?></div>

			<form action="" method="post">

<input type="hidden" name="id"  value="<?php echo $data_producto['codproducto'];?>">

				<label for="proveedor">Nombre Proveedor</label>
                 <?php  

                  $query_proveedor =mysqli_query($conection,"SELECT * from proveedor WHERE estatus= 1 order by proveedor asc ");
                  $result_proveedor = mysqli_num_rows($query_proveedor); 
                  mysqli_close($conection);

?>  
                  <select name="proveedor" id="proveedor">
                  		<option value="<?php echo $data_producto['codproveedor'];  ?>" selected ><?php echo $data_producto['proveedor'];?> </option>            



                  		             <?php
	             if($result_proveedor >0){
		while ($proveedor=mysqli_fetch_array($query_proveedor)) {
			# code...
			?>
			<option value="<?php echo $proveedor['codproveedor']; ?>"> <?php echo $proveedor['proveedor'];?>
			</option>
<?php
		}
	}


?>



</select>
				<label for="producto">Nombre del Producto</label>
				<input type="text" name="producto" id="producto" placeholder="Nombre del Producto " value="<?php echo $data_producto['descripcion'];?>">
				<label for="precio">Precio del Producto</label>
				<input type="number" name="precio" id="precio" placeholder="Precio del Producto" value="<?php echo $data_producto['precio'];?>">
				<label for="existencia">Stock del Producto</label>
				<input type="number" name="existencia" id="existencia" placeholder="Stock del Producto" value="<?php echo $data_producto['existencia'];?>">


			<input type="submit" value="Actualizar  Producto" class="btn_save">

			</form>


		</div>


	</section>
	<?php include "includes/footer.php"; ?>
</body>
</html>