<?php 
	require("functions.php");
	
	
	if (!isset ($_SESSION["userId"])) {
		
		header("Location: login.php");
		
	}
	
	
	if (isset($_GET["logout"])) {
		
		session_destroy();
		
		header("Location: login.php");
		
	}
	
	
	
	/////////////////////////////////////////////
	
	if ( isset($_POST["nimi"]) &&
		 isset($_POST["type"]) &&
		 isset($_POST["brand"]) &&
		 isset($_POST["color"]) &&
		 isset($_POST["mudel"]) &&
		 !empty($_POST["nimi"]) &&
		 !empty($_POST["brand"]) &&
		 !empty($_POST["type"]) &&
		 !empty($_POST["color"]) &&
		 !empty($_POST["mudel"])
	  ) {
		

		
		saveGuitars($_POST["nimi"],$_POST["brand"],$_POST["type"],$_POST["color"],$_POST["mudel"]);
	}
	

	
	
?>
<h1>Kitarrite registreerimine</h1>
<p>
	Tere tulemast <?=$_SESSION["email"];?>!
	<a href="?logout=1">Logi valja</a>
</p> 

<form method="POST">
			<label><b>Omaniku nimi</b></label><br>
			<input name="nimi" type="text" placeholder="Nimi">
			
			<br><br>
			<label><b>Firma</b></label><br>
			<select name="brand"> 
				<option value="Gibson">Gibson</option>
				<option value="Fender">Fender</option>
				<option value="Ibanez">Ibanez</option>
				<option value="Epiphone">Epiphone</option>
				<option value="ESP">ESP</option>
				<option value="Yamaha">Yamaha</option>
				<option value="Schecter">Schecter</option>
			</select>
			
			<br><br>
			<label><b>Tuup</b></label><br>
			<select name="type"> 
				<option value="Bass">Bass</option>
				<option value="Electro">Electro</option>
				<option value="Acoustic">Acoustic</option>

			</select>
			
			<br><br>
			
			<label><b>Varv</b></label><br>
			<input name="color" type="color" placeholder="Varv"> 
			
			<br><br>
			
			<label><b>Mudel</b></label><br>
			<input name="mudel" type="text" placeholder="Mudel">
			
			<br><br>
			
			<input type="submit" value="Salvesta">
			
		</form> 
		<br><br><br><br> 
		<h2>Kitarrid</h2>
		
<?php 

	$tukk=AllGuitars();
	
	$html = "<table border=1 bordercolor='red'>";
		$html .= "<tr>";
			$html .= "<th>Id</th>";
			$html .= "<th>Omanik</th>";
			$html .= "<th>Firma</th>";
			$html .= "<th>Varv</th>";
			$html .= "<th>Tuup</th>";
			$html .= "<th>Mudel</th>";
		$html .= "</tr>";
		foreach($tukk as $t){
			$html .= "<tr>";
				$html .= "<td>".$t->id."</td>";
				$html .= "<td>".$t->nimi."</td>";
				$html .= "<td>".$t->brand."</td>";
				$html .= "<td>".$t->type."</td>";
				$html .= "<td style=' background-color:".$t->color."; '>"
						.$t->color
						."</td>";
				

				$html .= "<td>".$t->mudel."</td>";
			$html .= "</tr>";	
		}
		
	$html .= "</table>";
	echo $html;
	
?>

