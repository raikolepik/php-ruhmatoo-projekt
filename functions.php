<?php
	require_once("../../config_global.php");
	require_once("user.class.php");
	require_once("rate.class.php");


	$database = "if15_rate_my"; #Kui ma peaks teile edasipidi ka midagi sellist saatma siis pane asemele if15_rate_my

	session_start();

	$mysqli = new mysqli($servername, $server_username, $server_password, $database);

	$User = new User($mysqli);
	$Rate = new Rate($mysqli);


	function cleanInput($data) {
  	$data = trim($data);
  	$data = stripslashes($data);
  	$data = htmlspecialchars($data);
  	return $data;
  }
  
  function getAllData($keyword=""){
		
		if($keyword == ""){
			$search = "%%";
		}else{
			$search = "%".$keyword."%";
		}
		
		$mysqli = new mysqli($GLOBALS["servername"], $GLOBALS["server_username"], $GLOBALS["server_password"], $GLOBALS["database"]);
        // deleted IS NULL - ei ole kustutatud
        
		$stmt = $mysqli->prepare("SELECT id, pro_id, user_id, inserted, comment, accepted FROM procomment 
		WHERE deleted IS NULL AND (inserted LIKE ? OR comment LIKE ? OR accepted like ?)");
        
		echo $mysqli->error;
		
		$stmt->bind_param("ssss", $search, $search, $search, $search);
        $stmt->bind_result($id_from_db, $user_id_from_db, $carmodel_from_db, $mileage_from_db, $cost_from_db, $description_from_db);
        $stmt->execute();
	
	
	$array = array();
	
	while($stmt->fetch()){
            //suvaline muutuja, kus hoiame auto andmeid 
            //selle hetkeni kui lisame massiivi
               
            // tühi objekt kus hoiame väärtusi
            $car = new StdClass();
            
            $car->id = $id_from_db;
            $car->user_id = $user_id_from_db; 
			$car->carmodel = $carmodel_from_db;
			$car->mileage = $mileage_from_db;
            $car->cost = $cost_from_db;
			$car->description = $description_from_db;
            
            //lisan massiivi (auto lisan massiivi)
            array_push($array, $car);
            //echo "<pre>";
            //var_dump($array);
            //echo "</pre>";
        }
        
        //saadan tagasi
        return $array;
        
        $stmt->close();
        $mysqli->close();
    }

?>
