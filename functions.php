<?php
	

	require("../config.php");


	session_start();
	

	 
	$database = "if16_velial";
	
	function signup ($email, $password, $sex) {
		$error2="";
		
		$mysqli = new mysqli($GLOBALS["serverHost"],$GLOBALS["serverUsername"],$GLOBALS["serverPassword"],$GLOBALS["database"]);
		$stmt = $mysqli->prepare("INSERT INTO logindata (email, password, sugu) VALUES (?, ?, ?)");
		echo $mysqli->error;
		$stmt->bind_param("sss", $email, $password, $sex);
		
		if ($stmt->execute()) {
			echo "salvestamine onnestus";
		} else {
			echo "ERROR ".$stmt->error;
		}
		return $error2;
	}
	
	
	
	function login($email, $password) {
		
		$error = "";
		
		$mysqli = new mysqli($GLOBALS["serverHost"],$GLOBALS["serverUsername"],$GLOBALS["serverPassword"],$GLOBALS["database"]);
		$stmt = $mysqli->prepare("
			SELECT id, email, password, created 
			FROM logindata
			WHERE email = ?
		");
		echo $mysqli->error;
		
		//asendan kusimargi
		$stmt->bind_param("s", $email);
		
		//maaran tupladele muutujad
		$stmt->bind_result($id, $emailFromDb, $passwordFromDb, $created);
		$stmt->execute();
		
		//kusin rea andmeid
		if($stmt->fetch()) {
			//oli rida
		
			// vordlen paroole
			
			if($password == $passwordFromDb) {
				
				echo "kasutaja ".$id." logis sisse";
				
				
				$_SESSION["userId"] = $id;
				$_SESSION["email"] = $emailFromDb;
				
				//suunaks uuele lehele
				header("Location: data.php");
				
			} else {
				$error = "parool vale";
			}
			
		
		} else {
			//ei olnud 
			
			$error = "sellise emailiga ".$email." kasutajat ei olnud";
		}
		
		
		return $error;
		
		
	}
	
	
	
	
	function saveGuitars ($nimi, $brand, $type, $color, $mudel) {
		
		$mysqli = new mysqli($GLOBALS["serverHost"],$GLOBALS["serverUsername"],$GLOBALS["serverPassword"],$GLOBALS["database"]);
		$stmt = $mysqli->prepare("INSERT INTO guitars (nimi, brand, type, color, mudel) VALUES (?, ?, ?, ?, ?)");
		echo $mysqli->error;
		$stmt->bind_param("sssss", $nimi, $brand, $type, $color, $mudel);
		
		if ($stmt->execute()) {
			echo "salvestamine onnestus";
		} else {
			echo "ERROR ".$stmt->error;
		}
		
	}
	
	
	function AllGuitars () {
		
		$mysqli = new mysqli($GLOBALS["serverHost"],$GLOBALS["serverUsername"],$GLOBALS["serverPassword"],$GLOBALS["database"]);
		$stmt = $mysqli->prepare("
			SELECT id, nimi, brand, type, color, mudel
			FROM guitars
		");
		echo $mysqli->error;
		
		$stmt->bind_result($id, $nimi, $brand, $type, $color, $mudel);
		$stmt->execute();
		
		
		$result = array();
		
		// seni kuni on uks rida andmeid saada (10 rida = 10 korda)
		while ($stmt->fetch()) {
			
			$tukk = new StdClass();
			$tukk->id = $id;
			$tukk->nimi = $nimi;
			$tukk->brand = $brand;
			$tukk->type = $type;
			$tukk->color = $color;
			$tukk->mudel = $mudel;
			
			//echo $color."<br>";
			array_push($result, $tukk);
		}
		
		$stmt->close();
		$mysqli->close();
		
		return $result;
		
	}
	
	
	
	
	
	
	

?>