<?php
$correo = $_GET['correo'];
/*primero obtenemos verificacion de conexion*/
$condicional = mysqli_connect("localhost", "root","", "dbcocina");
/*veamos la cantidad de parametros, si quiere ingresar, registrarse o comentar*/
$cantParametros = count($_GET);
if($condicional){
	//vemos la conexion y si existe el usuario con tal correo
	$consulta = "SELECT * FROM cliente WHERE correo='$correo' ";
	$res = mysqli_query($condicional,$consulta);
	$existe = mysqli_num_rows($res);
	if($existe>0){
		echo "El usuario con este correo existe";
		header("refresh:5;url=CocinaDeSabrina.html");
	}else{
		echo "No existe cuenta con este correo";
		header("refresh:5;url=CrearCuenta.html");
	}
}else{
	//no tenemos conexion
	echo "No hay conexion al servidor";
}
if($existe>0 && $cantParametros==4){
	$nombre = $_GET['nombre'];
	$nota = $_GET['nota'];
	$comentario = $_GET['mensaje'];
	$consulta = "INSERT INTO comentario (correo_cliente,nombre,nota,comentario) VALUES('$correo','$nombre','$nota','$comentario')";
	$res = mysqli_query($condicional,$consulta);
	echo "Comentario con Exito";
	header("refresh:5;url=CocinaDeSabrina.html");
}
elseif($existe>0 && $cantParametros==2){
	/*veamos si ingrese bien la contrasenia*/
	$pass=$_GET['pass'];
	$consulta = "SELECT * FROM cliente WHERE correo='$correo' AND contrasenia='$pass' ";
	$res = mysqli_query($condicional,$consulta);
	$valido = mysqli_num_rows($res);
	if($valido>0){//ingresa el usuario
		echo "El usuario puede ingresar";
		header("refresh:5;url=Menu.html");
	}else{//no coinciden los datos para ingresar
		echo "ERROR de contrasenia";
		header("refresh:5;url=IngresarCuenta.html");
	}
}elseif($existe>0 && $cantParametros==5){
	if($existe>0){
		//el usuario ya existe, no puede registrarse
		echo "Ya existe esta cuenta";
		header("refresh:5;url=IngresarCuenta.html");
	}else{
		$nombre = $_GET['nombre'];
		$apellido = $_GET['apellido'];
		$pass = $_GET['pass'];
		$telefono = $_GET['telefono'];
		$consulta="INSERT INTO cliente (correo,nombre,apellido,contrasenia,telefono) VALUES('$correo','$nombre','$apellido','$pass','$telefono')";
		$res = mysqli_query($condicional,$consulta);
		echo"Registrado";
		header("refresh:5;url=CocinaDeSabrina.html");
	}
}
?>
