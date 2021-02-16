<?php
@session_start();

require('Connections/Connections.php');
require('include/security.php');
require('include/functions.php');

function encryptIt($q)
{
    $cryptKey = 'qJB0rGtIn5UB1xG03efyCp';
    $qEncoded = base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_256, md5($cryptKey), $q, MCRYPT_MODE_CBC, md5(md5($cryptKey))));
    return ($qEncoded);
}

function decryptIt($q)
{
    $cryptKey = 'qJB0rGtIn5UB1xG03efyCp';
    $qDecoded = rtrim(mcrypt_decrypt(MCRYPT_RIJNDAEL_256, md5($cryptKey), base64_decode($q), MCRYPT_MODE_CBC, md5(md5($cryptKey))), "\0");
    return ($qDecoded);
}

$result = "";
$currentDirectory = getcwd();
$uploadDirectory = "/images/clients/";

$registerType = $_GET['type'];

if ($registerType == 'confirmRegister') {
    $username = $_GET['username'];

    if ($query = mysqli_query($connect, "UPDATE q_user SET status = 1 WHERE username = '" . $username . "'")) {
        phpAlert('Registro exitoso!');
        phpRedirect('http://getgluck.com/');
    }
}

if (isset($_REQUEST['rowid']) and isset($_REQUEST['param'])) {
    $rowid = $_REQUEST['rowid'];
    if ($rowid > 0) {
        if ($query = mysqli_query($connect, "SELECT * FROM q_user WHERE rowid = '" . $rowid . "'")) {
            $array = mysqli_fetch_array($query);
            if (isset($_REQUEST["submit"])) {
                $username = $_REQUEST['username'];
                $name = $_REQUEST['name'];
                $lastname = $_REQUEST['lastname'];
                $email = $_REQUEST['email'];
                $password = encryptIt($_REQUEST['password']);
                $phone = $_REQUEST['phone'];
                $fk_sport = $_REQUEST['sport'];
                $status = 1;
                $state = $_REQUEST['state'];
                $city = $_REQUEST['city'];
                $code = $_REQUEST['code'];

                mysqli_query($connect, "DELETE FROM q_user_team WHERE fk_q_user = " . $rowid);
                $count = count($fk_sport);
                $fkSport = '';
                for ($i = 0; $i < count($fk_sport); $i++) {
                    $fkSport .= $fk_sport[$i] . ',';
                    mysqli_query($connect, "INSERT INTO q_user_team (fk_q_user, fk_q_team) VALUES ('" . $rowid . "', '" . $fk_sport[$i] . "') ");

                }
                $fkSport = substr($fkSport, 0, -1);
                $status = $_REQUEST['status'];
                $sql = "";
                if ($password != '') {
                    $sql = " , password = '" . $password . "' ";
                }

                if ($query = mysqli_query($connect, "UPDATE q_user SET username = '" . $username . "', name = '" . $name . "', lastname = '" . $lastname . "', email = '" . $email . "', phone = '" . $phone . "', address = '" . $address . "', state = '" . $state . "', city = '" . $city . "', code = '" . $code . "', fk_sport = '" . $fkSport . "', status = '1' " . $sql . " WHERE rowid = '" . $rowid . "'")) {
                    $errors = []; // Store errors here

                    $fileExtensionsAllowed = ['jpeg', 'jpg', 'png']; // These will be the only file extensions allowed
                    $RandomAccountNumber = uniqid();

                    $fileName = $_FILES['logo']['name'];
                    $fileSize = $_FILES['logo']['size'];
                    $fileTmpName = $_FILES['logo']['tmp_name'];
                    $fileType = $_FILES['logo']['type'];
                    $fileExtension = @strtolower(end(explode('.', $fileName)));

                    $uploadPath = $currentDirectory . $uploadDirectory . basename($RandomAccountNumber . '.' . $fileExtension);

                    if (!in_array($fileExtension, $fileExtensionsAllowed)) {
                        $errors[] = "This file extension is not allowed. Please upload a JPEG or PNG file";
                    }

                    if ($fileSize > 4000000) {
                        $errors[] = "File exceeds maximum size (4MB)";
                    }

                    if (empty($errors)) {
                        $didUpload = move_uploaded_file($fileTmpName, $uploadPath);

                        if ($didUpload) {
                            $errors[] = "The file " . basename($fileName) . " has been uploaded";
                            mysqli_query($connect, "UPDATE q_user SET img = '" . $RandomAccountNumber . '.' . $fileExtension . "' WHERE rowid = '" . $rowid . "'");
                        } else {
                            $errors[] = "An error occurred. Please contact the administrator.";
                        }
                    } else {
                        foreach ($errors as $error) {
                            $errors[] = "These are the errors" . "\n";
                        }
                    }
                    $result = '<div class="callout callout-success">
                        <h4>Actualizaci&oacute;n Exitosa!</h4>
                        <p>Su proceso fue realizado exitosamente.</p>
                      </div>';

                    phpAlert('Registro exitoso!');
                    phpRedirect('http://getgluck.com/');
                } else {
                    $result = '<div class="callout callout-danger">
                        <h4>Fallo al Actualizar!</h4>
                        <p>Ocurrio un error al actualizar la informaci&oacute;n, por favor intente nuevamente.</p>
                      </div>';
                }
            }
        } else {
            echo "Failure" . mysql_error();
            die();
        }
    } else {
        if ($query = mysqli_query($connect, "SELECT * FROM q_user WHERE rowid = '" . $rowid . "'")) {
            $array = mysqli_fetch_array($query);
            if (isset($_REQUEST["submit"])) {
                $username = $_REQUEST['username'];
                $name = $_REQUEST['name'];
                $lastname = $_REQUEST['lastname'];
                $email = $_REQUEST['email'];
                $password = encryptIt($_REQUEST['password']);
                $phone = $_REQUEST['phone'];
                $address = $_REQUEST['address'];
                $status = 0;
                $state = $_REQUEST['state'];
                $city = $_REQUEST['city'];
                $code = $_REQUEST['code'];
                $fk_sport = $_REQUEST['sport'];
                $count = count($fk_sport);
                $fkSport = '';
                for ($i = 0; $i < count($fk_sport); $i++) {
                    $fkSport .= $fk_sport[$i] . ',';
                }
                $fkSport = substr($fkSport, 0, -1);
                $status = $_REQUEST['status'];
                $sql = "";
                if ($query = mysqli_query($connect, "INSERT INTO q_user (username, name, lastname, email, phone, address,state,city,code, fk_sport, status, password) VALUES ( '" . $username . "','" . $name . "','" . $lastname . "','" . $email . "', '" . $phone . "', '" . $address . "','" . $state . "','" . $city . "','" . $code . "', '" . $fkSport . "', '1' , '" . $password . "')")) {
                    $errors = []; // Store errors here
                    $rowid = mysqli_insert_id($connect);
                    for ($i = 0; $i < count($fk_sport); $i++) {
                        mysqli_query($connect, "INSERT INTO q_user_team (fk_q_user, fk_q_team) VALUES ('" . $rowid . "', '" . $fk_sport[$i] . "') ");

                    }

                    $fileExtensionsAllowed = ['jpeg', 'jpg', 'png']; // These will be the only file extensions allowed
                    $RandomAccountNumber = uniqid();

                    $fileName = $_FILES['logo']['name'];
                    $fileSize = $_FILES['logo']['size'];
                    $fileTmpName = $_FILES['logo']['tmp_name'];
                    $fileType = $_FILES['logo']['type'];
                    $fileExtension = @strtolower(end(explode('.', $fileName)));

                    $uploadPath = $currentDirectory . $uploadDirectory . basename($RandomAccountNumber . '.' . $fileExtension);

                    if (!in_array($fileExtension, $fileExtensionsAllowed)) {
                        $errors[] = "This file extension is not allowed. Please upload a JPEG or PNG file";
                    }

                    if ($fileSize > 4000000) {
                        $errors[] = "File exceeds maximum size (4MB)";
                    }

                    if (empty($errors)) {
                        $didUpload = move_uploaded_file($fileTmpName, $uploadPath);

                        if ($didUpload) {
                            $errors[] = "The file " . basename($fileName) . " has been uploaded";
                            mysqli_query($connect, "UPDATE q_user SET img = '" . $RandomAccountNumber . '.' . $fileExtension . "' WHERE rowid = '" . $rowid . "'");
                        } else {
                            $errors[] = "An error occurred. Please contact the administrator.";
                        }
                    } else {
                        foreach ($errors as $error) {
                            $errors[] = "These are the errors" . "\n";
                        }
                    }


                    $result = '<div class="callout callout-success">
                        <h4>Actualizaci&oacute;n Exitosa!</h4>
                        <p>Su proceso fue realizado exitosamente.</p>
                      </div>';

                    $cabeceras = 'MIME-Version: 1.0' . "\r\n";
                    $cabeceras .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
                    $cabeceras .= 'From: Gluck';

                    $code = generateRandomString(120);

                    $result=mail($email, "Registro de usuario", "Un Cordial Saludo! <br><br> haga click en el siguiente enlace para activar su cuenta <br><br> <a href=\"http://getgluck.com/registro.php?code=".$code."&type=confirmRegister&username=".$username."\">Verificar cuenta!</a> <br><br> Gluck.", $cabeceras);

//                    phpAlert('Registro exitoso!');
                    phpAlert('Hemos enviado un correo para que active su cuenta y complete el registro!');
                    phpRedirect('http://getgluck.com/');
                } else {
                    $result = '<div class="callout callout-danger">
                        <h4>Fallo al Actualizar!</h4>
                        <p>Ocurrio un error al actualizar la informaci&oacute;n, por favor intente nuevamente.</p>
                      </div>';
                }
            }
        }
    }
}

function generateRandomString($length = 10) {
    return substr(str_shuffle(str_repeat($x='0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil($length/strlen($x)) )),1,$length);
}
?>


<?php
function phpAlert($msg)
{
    echo '<script type="text/javascript">alert("' . $msg . '")</script>';
}

?>
<?php
function phpRedirect($msg)
{
    echo '<script type="text/javascript">window.location.href = "' . $msg . '";</script>';
}

?>

<!DOCTYPE html>
<head>

    <title>Gluck</title>

    <link rel="stylesheet" href="//stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"
          integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

    <script src="//ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

    <link rel="stylesheet" href="//use.fontawesome.com/releases/v5.6.1/css/all.css"
          integrity="sha384-gfdkjb5BdAXd+lj+gudLWI+BXq4IuLW5IT+brZEZsLFm++aCMlF1V92rMkPaX4PP" crossorigin="anonymous">
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

    <style type="text/css">
        .form_container {
            padding-top: 0% !important;
        }
    </style>


</head>

<!--Coded with love by Mutiullah Samim-->

<body>

<body class="skin-black">
<div class="wrapper" style="padding-top: 5%;">


    <div class="d-flex justify-content-center paddinsito">

        <div class="brand_logo_container" style="position: relative;">

            <img src="images/gluck.png" class="brand_logo" alt="Logo">

        </div>

    </div>


    <div class="d-flex justify-content-center" style="padding-top: 0% !important;">
        <form role="form" class="blanco" method="post" enctype="multipart/form-data">


            <div class="col-md-6 col-xs-12">
                <div class="input-group-append">
                    <label for="exampleInputEmail1">Usuario</label>

                </div>
                <?php $readonly = '  ';
                if ($_SESSION['user']['type'] == 1) {
                    $readonly = ' readonly="readonly" ';
                } ?>
                <input type="text" class="form-control" placeholder="Usuario" name="username" required="required"
                       id="username" onchange="verifyUser()">
            </div>

            <div class="col-md-6 col-xs-12">
                <div class="input-group-append">
                    <label for="exampleInputEmail1">Nombre</label>

                </div>
                <?php $readonly = '  ';
                if ($_SESSION['user']['type'] == 1) {
                    $readonly = ' readonly="readonly" ';
                } ?>
                <input type="text" class="form-control" placeholder="Nombre" name="name" required="required">
            </div>

            <div class="col-md-6 col-xs-12">
                <div class="input-group-append">
                    <label for="exampleInputEmail1">Apellido</label>

                </div>

                <input type="text" class="form-control" placeholder="Nombre" name="lastname" required="required">
            </div>


            <div class="col-md-6 col-xs-12">
                <div class="input-group-append">
                    <label for="exampleInputEmail1">Email</label>
                </div>
                <input type="email" name="email" <?= $readonly; ?> class="form-control" id="exampleInputEmail1"
                       required="required" placeholder="Email">
            </div>


            <div class="col-md-6 col-xs-12">
                <div class="input-group-append">
                    <label for="exampleInputPassword1">Password</label>
                </div>
                <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password"
                       name="password">
            </div>


            <div class="col-md-6 col-xs-12">
                <label>Tel&eacute;fono:</label>
                <div class="input-group">
                    <div class="input-group-addon">
                        <i class="fas fa-phone"></i>
                    </div>
                    <input type="text" class="form-control" required="required"
                           data-inputmask='"mask": "(999) 999-9999"' data-mask name="phone">
                </div>
            </div>


            <div class="col-md-6 col-xs-12">
                <h3 class="box-title">Direcci&oacute;n</h3>
                <div class="box-body pad">
                    <textarea class="textarea" name="address" required="required" placeholder="Direcci&oacute;n"
                              style="width: 100%; height: 100px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"><?= $array['address']; ?></textarea>
                </div>
            </div>

            <div class="col-md-6 col-xs-12">
                <label>Estado:</label>
                <div class="input-group">
                    <div class="input-group-addon">
                        <i class="fa fa-globe"></i>
                    </div>
                    <input type="text" class="form-control" required="required" name="state"
                           value="<?= $array['state']; ?>">
                </div>
            </div>

            <div class="col-md-6 col-xs-12">
                <label>Ciudad:</label>
                <div class="input-group">
                    <div class="input-group-addon">
                        <i class="fa fa-globe"></i>
                    </div>
                    <input type="text" class="form-control" required="required" name="city"
                           value="<?= $array['city']; ?>">
                </div>
            </div>

            <div class="col-md-6 col-xs-12">
                <label>Código Postal:</label>
                <div class="input-group">
                    <div class="input-group-addon">
                        <i class="fa fa-globe"></i>
                    </div>
                    <input type="text" class="form-control" required="required" name="code">
                </div>
            </div>

            <div class="col-md-6 col-xs-12">
                <label>Deporte Favorito</label>
                <?php $disabled = '  ';
                if ($_SESSION['user']['type'] == 1) {
                    $disabled = ' disabled="disabled" ';
                } ?>
                <select <?= $disabled; ?> class="form-control select2" multiple="multiple" required="required"
                                          name="sport[]" style="width: 100%;">
                    <?= sport($array['fk_sport'], $connect); ?>
                </select>
            </div>

            <?php if ($_SESSION['user']['type'] == 1) { ?>
            <?php } ?>
    </div><!-- /.box-body -->

    <div class="box-footer botonregistro" style="border-top: 0px solid #f4f4f4; background-color: transparent;">
        <button type="submit" name="submit" class="btn btn-primary" id="submit" disabled>Enviar</button>
        <input type="hidden" name="rowid" value="<?= $array['rowid']; ?>">
        <input type="hidden" name="param" value="<?= $array['param']; ?>">
    </div>
    </form>
    <style type="text/css">
        .botonregistro {
            text-align: center;
        }
    </style>
</div>


</div>
</div>
</div>
</div>

</div>

<!-- jQuery 2.1.4 -->
<script src="plugins/jQuery/jQuery-2.1.4.min.js"></script>
<!-- Bootstrap 3.3.5 -->
<script src="bootstrap/js/bootstrap.min.js"></script>
<!-- FastClick -->
<script src="plugins/fastclick/fastclick.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/app.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>
<script src="plugins/input-mask/jquery.inputmask.js"></script>
<script src="plugins/input-mask/jquery.inputmask.date.extensions.js"></script>
<script src="plugins/input-mask/jquery.inputmask.extensions.js"></script>
<script>
    $(function () {

        $("[data-mask]").inputmask();
    });

    function verifyUser() {
        let username = $('#username').val();
        console.log(username);

        $.ajax({
            url: 'external/actions.php',
            data: {username: username, type: '4'},
            type: 'POST',

            success: function (json) {
                console.log(json);
                json = JSON.parse(json);

                $('#submit').prop('disabled', json !== null);
            },

            error: function (xhr, status) {
                alert('Disculpe, existió un problema');
            },

            complete: function (xhr, status) {
                console.log('Petición realizada');
            }
        });
    }
</script>
<!-- page script -->
</body>

</html>








































