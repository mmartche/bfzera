<?php

$soldados = array(
	["displayName"=>"FARRELL_E_TALITA",	"platform"=>"3"],
	["displayName"=>"mmartche_br",		"platform"=>"2"],
	["displayName"=>"nderato",			"platform"=>"2"],
	["displayName"=>"thiagossegatto",	"platform"=>"2"],
	["displayName"=>"UrsoYogi",			"platform"=>"3"],
	["displayName"=>"Valdeirsilva12",	"platform"=>"1"]
	);

$arraySoldados = array([
	"date" 				=>date('d/m/y'),
	"FARRELL_E_TALITA"	=>"0",
	"mmartche_br"		=>"0", 
	"nderato" 			=>"0", 
	"thiagossegatto" 	=>"0", 
	"UrsoYogi"			=>"0", 
	"Valdeirsilva12"	=>"0"
	]);

function adicionaDiario($dataArrayToProccess, $nomeSoldados) {
	$fileLogColeta = "./data/logColetaTotal.php";
	$contents = file_get_contents($fileLogColeta); 
	$contents = utf8_encode($contents); 
	$results = json_decode($contents); 
	if ($results[count($results)-1]->date == date('d/m/y')) {
		print_r("<br />-> Updated DB<br />");
		array_pop($results);
	}
	array_push($results, $dataArrayToProccess);
	$row = json_encode($results);
	file_put_contents($fileLogColeta, $row, LOCK_EX);
	$newResults = json_decode($row);
		$jsVariableTotal = "var dadosRaddaTotal = [";
		$jsVariableDaily = "var dadosRaddaPerDay = [";
		$jointFileTotal = "";
		$ultimoSoldado = array();
	for ($r=0; $r < count($newResults); $r++) { 
		$initFile = "['".(string)$newResults[$r]->date."'";
		$middleFile = "";
		$middleFileDaily = "";
		for ($n=0; $n < count($nomeSoldados); $n++) { 
			if (!empty($newResults[$r])) {
				$nome = $nomeSoldados[$n]["displayName"];
				$middleFile .= ",".(int)$newResults[$r]->$nome;
				if ($r == 0) {
					$ultimoSoldado[$nome] = (int)$newResults[$r]->$nome;
				} else {
					$middleFileDaily .= ",".((int)$newResults[$r]->$nome - $ultimoSoldado[$nome]);
					$ultimoSoldado[$nome] = (int)$newResults[$r]->$nome;
				}
			}
		}
		$jointFileTotal .= $initFile.$middleFile."]";
		$jointFileTotal .= ($r != count($newResults)-1) ? "," : "";
		if ($r > 0) {
			$jointFileDaily .= $initFile.$middleFileDaily."]";
			$jointFileDaily .= ($r != count($newResults)-1) ? "," : "";
		}
		// print_r($r."--".count($newResults));
		// var_dump($jointFileTotal);
	}
	$chartDaily = $jsVariableDaily.$jointFileDaily."];";
	file_put_contents('./data/chart-daily.js', $chartDaily, LOCK_EX);
	$chartTotal = $jsVariableTotal.$jointFileTotal."];";
	file_put_contents('./data/chart-total.js', $chartTotal, LOCK_EX);
}

function convertSoldier($jsonSoldier,$soldier){
	$results = json_decode($jsonSoldier); 
	// var_dump($results->result[0]->weapons[0]->stats->values->kills);
	$follow = $results->result;
	$init = '{ "name": "Raddas por arma","children":[';
	$thenFollow = '';
	for ($i=0; $i < count($follow); $i++) { 
		$firstFollow = '{ "name":"'.$follow[$i]->name.'","children":[';
		$weapons = $follow[$i]->weapons;
		$weaponList='';
		for ($w=0; $w < count($weapons); $w++) { 
			$weaponList .= '{"name":"'.$weapons[$w]->name.'", "size":'.(int)$weapons[$w]->stats->values->kills.'}';
			$weaponList .= ($w != count($weapons)-1) ? ',' : '';
		}
		$thenFollow .= $firstFollow.$weaponList.']}';
		$thenFollow .= ($i != count($follow)-1) ? ',' : '';
	}
	$end = $init.$thenFollow.']}';
	file_put_contents('./data/dataPie-'.$soldier.'.json', $end, LOCK_EX);
	// var_dump($end);
	print_r("<br>update ".$soldier." pie");
}


mkdir("./".date('y-m-d'));
mkdir("./includes");
mkdir("./data");

for ($i=0; $i < count($soldados); $i++) { 
	$curl = curl_init();
	curl_setopt_array($curl, array(
	    CURLOPT_URL => "https://battlefieldtracker.com/bf1/api/Stats/DetailedStats?platform=".$soldados[$i]["platform"]."&displayName=".$soldados[$i]["displayName"],
	    CURLOPT_RETURNTRANSFER => true,
	    CURLOPT_ENCODING => "",
	    CURLOPT_MAXREDIRS => 10,
	    CURLOPT_TIMEOUT => 30,
	    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
	    CURLOPT_CUSTOMREQUEST => "GET",
	    CURLOPT_HTTPHEADER => array(
	        "cache-control: private",
	        "TRN-Api-Key: 567820ed-aede-415b-923b-a6ce8cd88417"
	    ),
	    CURLOPT_CAINFO => dirname(__FILE__) . '/cacert.pem',
	    CURLOPT_SSL_VERIFYPEER =>false
	));
	$response = curl_exec($curl);
	$err = curl_error($curl);
	curl_close($curl);
	$fileLog = "./".date('y-m-d')."/".$soldados[$i]["displayName"].".json";
	file_put_contents($fileLog, $response, LOCK_EX);
	$fileArray = json_decode($response);
	$arraySoldados[0][$soldados[$i]["displayName"]] = $fileArray->result->basicStats->kills;
	print_r("<hr>");
}
adicionaDiario($arraySoldados[0],$soldados);


for ($i=0; $i < count($soldados); $i++) { 
	$curl = curl_init();
	curl_setopt_array($curl, array(
	    CURLOPT_URL => "https://battlefieldtracker.com/bf1/api/Progression/GetWeapons?platform=".$soldados[$i]["platform"]."&displayName=".$soldados[$i]["displayName"],
	    CURLOPT_RETURNTRANSFER => true,
	    CURLOPT_ENCODING => "",
	    CURLOPT_MAXREDIRS => 10,
	    CURLOPT_TIMEOUT => 30,
	    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
	    CURLOPT_CUSTOMREQUEST => "GET",
	    CURLOPT_HTTPHEADER => array(
	        "cache-control: private",
	        "TRN-Api-Key: 567820ed-aede-415b-923b-a6ce8cd88417"
	    ),
	    CURLOPT_CAINFO => dirname(__FILE__) . '/cacert.pem',
	    CURLOPT_SSL_VERIFYPEER =>false
	));
	$response = curl_exec($curl);
	$err = curl_error($curl);
	curl_close($curl);	
	convertSoldier($response,$soldados[$i]["displayName"]);
}

