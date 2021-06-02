<?php

@session_start();



function sport($fk_sport=0, $connect, $unique=0){

	$and=''; if($unique==1){$and=' AND rowid in ( '.$fk_sport.' ) ';}

	if($query = mysqli_query($connect,"SELECT * FROM q_sport WHERE status = 1 ".$and)){

		$option='';

		$option2=explode(',', $fk_sport);

		while ($array=mysqli_fetch_array($query)) {

			$status='';

			for ($i=0; $i < count(explode(',', $fk_sport)); $i++) { 

				if ($option2[$i]==$array['rowid']) {

					$status='selected="selected"';

				}

			}



			$option.='<option '.$status.' value='.$array['rowid'].'>'.$array['name'].'</option>';

		}

	}

	return $option;

}



function team( $rowid, $connect, $fk_team=0){

	if($query = mysqli_query($connect,"SELECT * FROM q_team WHERE fk_sport = ".$rowid." AND status = 1")){

		$option='<option>Seleccione</option>';

		while ($array=mysqli_fetch_array($query)) {

			$status='';

			if ($fk_team==$array['rowid']) {

				$status='selected="selected"';

			}

			$option.='<option '.$status.' value='.$array['rowid'].'>'.$array['name'].'</option>';

		}

	}

	return $option;

}



function team_list( $rowid, $connect){

	if($query = mysqli_query($connect,"SELECT * FROM q_team WHERE rowid = ".$rowid." AND status = 1")){

		$option='';

		$array=mysqli_fetch_array($query);

		$option=($array['name']!='')?$array['name']:'No Definido';

	}

	return $option;

}



function inserUserPool( $rowid, $userId, $connect){

    mysqli_query($connect,"INSERT INTO q_user_pools (fk_q_user, fk_q_pools) VALUES ('".$userId."','".$rowid."') ");

	return 'Done!';

}



function getByUsername( $username, $connect){

    if($query = mysqli_query($connect,"SELECT * FROM q_user WHERE username = '".$username."'")){


        $array=mysqli_fetch_array($query);

        return json_encode($array);
    }

    return null;

}



function array_random($arr, $num = 1) {

    shuffle($arr);

   

    $r = array();

    for ($i = 0; $i < $num; $i++) {

        $r[] = $arr[$i];

    }

    return $num == 1 ? $r[0] : $r;

}



function team_pools($fk_sport=0, $connect, $unique=0, $selected=0){

	$and=''; if($unique==1){$and=' AND fk_sport = '.$fk_sport.'  ';}

	if($query = mysqli_query($connect,"SELECT * FROM q_team WHERE status = 1 ".$and)){

		$option='';

		$option2=explode(',', $fk_sport);

		while ($array=mysqli_fetch_array($query)) {

			$status='';

			if ($selected==$array['rowid']) {

				$status='selected="selected"';

			}



			$option.='<option '.$status.' value='.$array['rowid'].'>'.$array['name'].'</option>';

		}

	}

	return $option;

}



function team_pools_result($fk_sport=0, $connect, $unique=0, $selected=0){

	$and=''; if($unique==1){$and=' AND rowid = '.$selected.'  ';}

	if($query = mysqli_query($connect,"SELECT * FROM q_team WHERE status = 1 ".$and)){

		$array=mysqli_fetch_array($query);

		$option=$array['name'];

	}

	return $option;

}



function checked($fk_q_user=0, $fk_q_pools=0, $connect){

	if($query = mysqli_query($connect,"SELECT * FROM q_user_pools WHERE fk_q_user = ".$fk_q_user." AND fk_q_pools = ".$fk_q_pools)){

		    $array=mysqli_fetch_array($query);

			$status='';

			if ($array['rowid']) {

				$status='checked="checked"';

			}



		}

	return $status;

}



function count_user($fk_sport_pools, $connect){

	$query = @mysqli_query($connect,"SELECT U.rowid, U.name, U.email, U.phone  FROM q_user U, q_user_team T WHERE U.status = 1 AND U.rowid=T.fk_q_user AND fk_q_team IN (".$fk_sport_pools." )  ORDER BY U.name DESC");

	$cantidad=@mysqli_num_rows ($query);

	return ($cantidad>0)?$cantidad:0;

}


function getUsersInPool($rowid, $connect){

	$query = @mysqli_query($connect,"SELECT * FROM q_user_pools qup left join q_user qu on qup.fk_q_user = qu.rowid WHERE fk_q_pools = ".$rowid);

	$cantidad=@mysqli_num_rows ($query);

	return ($cantidad>0)?$cantidad:0;

}





if(isset($_SESSION['user_id'])){



	if (isLoginSessionExpired()) {

		header("Location: index.php");

	}

	$_SESSION['loggedin_time'] = time();		

}



function isLoginSessionExpired(){

	$login_session_duration = 1200;

	$current_time = time();

	if (isset($_SESSION['loggedin_time'])) {

		if (($current_time - $_SESSION['loggedin_time']) > $login_session_duration) {

		 	return true;

		}

	}

	return false;

}



function team_pools_result_total($fk_q_user=0, $connect, $fk_q_pools=0, $fk_team=0, $type=0, $status=''){

		if ($type==1) {

			$campo='fk_team_1';

		}

		if ($type==2) {

			$campo='fk_team_2';

		}



		if($query = mysqli_query($connect,"SELECT * FROM q_result_pools WHERE  fk_q_user = ".$fk_q_user." AND fk_q_pools = ".$fk_q_pools." AND ".$campo." = ".$fk_team)){

			$array=mysqli_fetch_array($query); 

			if ($type==1) {

				$result=$array['team__result_1'];

			}

			if ($type==2) {

				$result=$array['team__result_2'];

			}

			if ($type==3) {

				if($array['status']==$status){

					$result='selected="selected"';

				}else{

					$result='';

				}

			} 



		}



	return $result;

}



function team_pools_result_total_select($fk_q_user=0, $connect, $fk_q_pools=0, $fk_team=0,$fk_team2=0,  $status='',  $date_Sport='',  $hour=''){

	if($query = mysqli_query($connect,"SELECT * FROM q_result_pools WHERE  fk_q_user = ".$fk_q_user." AND fk_q_pools = ".$fk_q_pools." AND fk_team_1 = ".$fk_team. " AND fk_team_2 = ".$fk_team2)){

			$array=mysqli_fetch_array($query); 

			if($array['status']==$status){

				$result='selected="selected"';

			}else{

				$result='';

			}

	} 

	return $result;

}





function sport_home( $connect){

	if($query = mysqli_query($connect,"SELECT * FROM q_sport WHERE status = 1")){

	   $rowCount=mysqli_num_rows($query);

	}

	return $rowCount;

}



function team_home( $connect){

	if($query = mysqli_query($connect,"SELECT * FROM q_result_pools")){

	   $rowCount=mysqli_num_rows($query);

	}

	return $rowCount;

}

function quinielas_activas( $connect){

	if($query = mysqli_query($connect,"SELECT * FROM q_pools WHERE status = 1 ")){

	   $rowCount=mysqli_num_rows($query);

	}

	return $rowCount;

}

function quinielas_activas_nombres( $connect){

	if($query = mysqli_query($connect,"SELECT name FROM q_pools WHERE status = 1 ")){

        $option='';

        while ($array=mysqli_fetch_array($query)) {

            $option.='<option value='.$array['rowid'].'>'.$array['name'].'</option>';

        }

	}

	return $option;

}

function quinielas_nombres( $connect){

	if($query = mysqli_query($connect,"SELECT name FROM q_pools")){

        $option='';

        while ($array=mysqli_fetch_array($query)) {

            $option.='<option value='.$array['rowid'].'>'.$array['name'].'</option>';

        }

	}

	return $option;

}


function user_home( $connect){

	if($query = mysqli_query($connect,"SELECT * FROM q_user WHERE status = 1 ")){

	   $rowCount=mysqli_num_rows($query);

	}

	return $rowCount;

}


function users_active( $connect){

	if($query = mysqli_query($connect,"SELECT * FROM q_user WHERE status = 1 ")){

        $option='';

        while ($array=mysqli_fetch_array($query)) {

            $option.='<option value='.$array['rowid'].'>'.$array['username'].'</option>';

        }

    }

    return $option;

}



function quiniela_home( $connect){

	if($query = mysqli_query($connect,"SELECT * FROM q_pools WHERE status = 1 ")){

	   $rowCount=mysqli_num_rows($query);

	}

	return $rowCount;

}



function ranking( $connect, $rowid){

	if($query = mysqli_query($connect,"SELECT ranking FROM q_user WHERE rowid = ".$rowid)){

	   $row=mysqli_fetch_array($query);

	}

	return $row['ranking'];

}

