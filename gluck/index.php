<?php

require('Connections/Connections.php');
function encryptIt( $q ) {
    $cryptKey  = 'qJB0rGtIn5UB1xG03efyCp';
    $qEncoded      = base64_encode( mcrypt_encrypt( MCRYPT_RIJNDAEL_256, md5( $cryptKey ), $q, MCRYPT_MODE_CBC, md5( md5( $cryptKey ) ) ) );
    return( $qEncoded );
}

$aviso = "";

if ( @$_REQUEST['param']=='exit' ) {

	@session_start();

	session_destroy();
	
		header("location: index.php");

}


if(isset($_POST['username']) and isset($_POST['password'])){

$username = $_POST['username'];

$password = encryptIt($_POST['password']);


if(isset($_POST["submit"])){

	if($query = mysqli_query($connect,"SELECT * FROM q_user WHERE username = '".$username."' AND password = '".$password."' AND status = 1")){
			
		
		if($row=mysqli_num_rows($query)>0){

			$array=mysqli_fetch_array($query);


			mysqli_query($connect,"UPDATE q_user  SET date_Access = '".date('Y-m-d')."', contador = '".$contador."' WHERE username = '".$username."' AND password = '".$password."' AND status = 1");

			$_SESSION['user_id'] = $array['email'];

			$_SESSION['loggedin_time'] = time();		

			$_SESSION['user'] = $array;
			function contador()
				   	 {
				        $archivo = "contador.txt"; //el archivo que contiene en numero
				        $f = fopen($archivo, "r"); //abrimos el archivo en modo de lectura
				        if($f)
				        {
				            $contador = fread($f, filesize($archivo)); //leemos el archivo
				            $contador = $contador + 1; //sumamos +1 al contador
				            fclose($f);
				        }
				        $f = fopen($archivo, "w+");
				        if($f)
				        {
				            fwrite($f, $contador);
				            fclose($f);
				        }
				        return $contador;
				    }
							

			header("location: home.php");

		}
		 $aviso = '<div class="callout callout-success">
                        <h4>Actualizaci&oacute;n Exitosa!</h4>
                        <p>Su proceso fue realizado exitosamente.</p>
                      </div>';
                      header( "refresh:3;url=q_user_list.php" );



	}else{

		echo "Failure" . mysql_error();

	}
	 $aviso = '<div class="callout callout-success">
                        <h4>Usuario o contraseña incorrectos.</h4>
                      </div>';
                      header( "refresh:3;url=q_user_list.php" );

}

}

?>

<!DOCTYPE html>

<html>



<head>

	<title>Gluck</title>

	<link rel="stylesheet" href="//stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

	<script src="//ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

	<link rel="stylesheet" href="//use.fontawesome.com/releases/v5.6.1/css/all.css" integrity="sha384-gfdkjb5BdAXd+lj+gudLWI+BXq4IuLW5IT+brZEZsLFm++aCMlF1V92rMkPaX4PP" crossorigin="anonymous">
	<link rel="stylesheet" href="bootstrap/css/bootstrap.css">

    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">

    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>

    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="//code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
    <link rel="stylesheet" href="bootstrap/css/bootstrap.css">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="dist/css/skins/_all-skins.min.css">
    <link rel="stylesheet" href="plugins/daterangepicker/daterangepicker-bs3.css">
    <link rel="stylesheet" href="plugins/timepicker/bootstrap-timepicker.min.css">

    <link rel="stylesheet" href="Css/style.css">


<style>

	/* Coded with love by Mutiullah Samim */

		body,

		html {

			margin: 0;

			padding: 0;

			height: 100%;

		}

		.user_card {

			height: 400px;

			width: 350px;

			margin-top: auto;

			margin-bottom: auto;

			background: #ffff09;

			position: relative;

			display: flex;

			justify-content: center;

			flex-direction: column;

			padding: 10px;

			box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);

			-webkit-box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);

			-moz-box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);

			border-radius: 5px;



		}

		.brand_logo_container {

			position: absolute;

			height: 170px;

			width: 170px;

			top: -75px;

			border-radius: 50%;

			background: #000000;

			padding: 10px;

			text-align: center;

		}

		.brand_logo {

			height: 150px;

			width: 150px;

			border-radius: 50%;

			border: 2px solid white;

		}

		.form_container {

			margin-top: 100px;

		}

		.login_btn {

			width: 100%;

			background: #000000 !important;

			color: white !important;

		}

		.login_btn:focus {

			box-shadow: none !important;

			outline: 0px !important;

		}

		.login_container {

			padding: 0 2rem;

		}

		.input-group-text {

			background: #000000 !important;

			color: white !important;

			border: 0 !important;

			border-radius: 0.25rem 0 0 0.25rem !important;

		}

		.input_user,

		.input_pass:focus {

			box-shadow: none !important;

			outline: 0px !important;

		}

		.custom-checkbox .custom-control-input:checked~.custom-control-label::before {

			background-color: #c0392b !important;

		}


</style>

</head>

<!--Coded with love by Mutiullah Samim-->

<body class="hold-transition skin-black sidebar-mini" style="background: url(images/banner-index.jpg) !important;">
<div class="wrapper">
	<div class="container login">

		<div class="d-flex justify-content-center">

			<div class="user_card">

				<div class="d-flex justify-content-center">

					<div class="brand_logo_container">
						<img src="images/gluck.png" class="brand_logo" alt="Logo">

					</div>

				</div>

				<div class="d-flex justify-content-center form_container">

					<form method='post'>

						
						<div class="input-group mb-3">

							<div class="input-group-append" style="background: #000;">

								<span class="input-group-text"><i class="fas fa-user"></i></span>

							</div>
							<input type="text" name="username" class="form-control input_user" value="" placeholder="Usuario">

						</div>

						<div class="input-group mb-3">

							<div class="input-group-append" style="background: #000;">

								<span class="input-group-text"><i class="fas fa-key"></i></span>

							</div>

							<input type="password" name="password" class="form-control input_pass" value="" placeholder="Contraseña">

						</div>

						<div class="d-flex justify-content-center mt-3 login_container">

				 			<button type="submit" name="submit" class="btn login_btn">Login</button>

				  		</div>

					</form>
					
				</div>
					<div class="d-flex justify-content-center mt-3 login_container">

				 			<a href="registro.php"><button class="btn login_btn">Registrar</button></a>

				  		</div>

				  					<h2 style="text-align: center;"><?=$aviso;?></h2> 
					</div>

		</div>

	</div>
</div>
</body>

</html>

