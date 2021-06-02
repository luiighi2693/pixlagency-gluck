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
	<link rel="stylesheet" href="bootstrap4/css/bootstrap.css">

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

			background: rgb(185, 194, 206, 0.7);

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



@media screen and (max-width: 1250px){
			.brand_logo {

			height: 85px;

			width: 550px;

			border: 0px solid white;
			  display: block;
  margin-left: auto;
  margin-right: auto;
		}

		}
			
@media (min-width: 1250px) {
		.brand_logo {

			height: 170px;

			width: 1100px;


			border: 0px solid white;
			  display: block;
  margin-left: auto;
  margin-right: auto;

		}
	}

@media screen and (max-width: 600px) {
			.brand_logo {

			height: 70px;

			width: 350px;

			border-radius: 50%;

			border: 0px solid white;
			  display: block;
			  margin-left: auto;
			  margin-right: auto;
		}

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

		body {
  /* Location of the image */
  background-image: url(images/gluck-wallpaper.png) !important;
  
  /* Background image is centered vertically and horizontally at all times */
  background-position: fixed;
  
  /* Background image doesn't tile */
  background-repeat: no-repeat;
  
  /* Background image is fixed in the viewport so that it doesn't move when 
     the content's height is greater than the image's height */
  background-attachment: fixed;
  
  /* This is what makes the background image rescale based
     on the container's size */
  background-size: cover;
  
  /* Set a background color that will be displayed
     while the background image is loading */
  background-color: #464646;
}

@media only screen and (max-width: 1300px) {
  body {
    /* The file size of this background image is 93% smaller
       to improve page load speed on mobile internet connections */
    background-image: url(images/gluck-wallpaper-2.png) !important;
  }
}

@media only screen and (max-width: 900px) {
  body {
    /* The file size of this background image is 93% smaller
       to improve page load speed on mobile internet connections */
    background-image: url(images/gluck-wallpaper-3.png) !important;
  }
}

</style>

</head>

<!--Coded with love by Mutiullah Samim-->

<body class="hold-transition sidebar-mini">
<div class="wrapper">



	<div class="container login">
						<img src="images/gluck-logo-silver.png" class="brand_logo" alt="Logo">
		<div class="d-flex justify-content-center">

			<div class="user_card justify-content-center">

				
				<div class="d-flex justify-content-center form_container">

					<form method='post'>

						<div class="input-group">
							
						<h3 style="font-weight: 800 !important;"><b>Ingresa</b></h3>

						</div>
						<div class="input-group">
							<input type="text" name="username" class="form-control input_user" value="" placeholder="Usuario">

						</div>

						<div class="input-group mb-3">
							<input type="password" name="password" class="form-control input_pass" value="" placeholder="Contraseña">

						</div>

						<div class="d-flex justify-content-center mt-3 login_container">

				 			<button type="submit" name="submit" class="btn login_btn">Login</button>

				  		</div>
				  		<div class="d-flex justify-content-left mt-3 login_container">

				 			<a href=""><b>¿Olvidaste tu contraseña?</b></a>

				  		</div>

					</form>
					
				</div>
				<div class="d-flex justify-content-center mt-3 login_container">

				<h3 style="font-weight: 600 !important;">¿No tienes una cuenta? </h3>

				  		</div>
					<div class="d-flex justify-content-center mt-3 login_container">

				 			<a href="registro.php"><button class="registro btn">REGISTRATE AQUI!</button></a>

				  		</div>

				  					<h2 style="text-align: center;"><?=$aviso;?></h2> 
					</div>

		</div>

	</div>
</div>
<footer class="footerregistro">
    <div class="container">
    <div class="row">
        <div class=".d-none .d-lg-block .d-xl-none col-lg-3"></div>
        <div class="col-lg-7">
            <div class="col-lg-6">
            <h3 class="blanco text-center">CONTACT US</h3>
            <h5 class="blanco text-center">info@getgluck.com</h5>
            </div>
            <div class="col-lg-6 text-center">
            <h3 class="blanco">SOCIAL</h3>
            <i class="fab fa-instagram" style="font-size: 48px; color: #fff; margin-right: 3%;"></i>
            <i class="fab fa-whatsapp" style="font-size: 48px; color: #fff; margin-right: 3%;"></i>
            <i class="fab fa-facebook-f" style="font-size: 48px; color: #fff;"></i>
            </div>
        </div>
        <div class=".d-none .d-lg-block .d-xl-none col-lg-2"></div>
    </div>
</div>
</footer>
</body>

</html>

