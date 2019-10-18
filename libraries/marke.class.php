<?php

class marke {

	private $Marke_lentele = ''; // Zanras
	private $Zaidimas_lentele = '';
	
	public function __construct() {
		$this->Zanras_lentele ='Zanras';
		$this->Zaidimas_lentele ='Zaidimas';
	}
	
	/**
	 * Variklio isrinkimas
	 * @param type $id
	 * @return type
	 */
	public function getZanras($id) {
		$query = "  SELECT * FROM {$this->Zanras_lentele} WHERE `ZanroID`='{$id}'";
		$data = mysql::select($query);
		
		return $data[0];
	}
	
	/**
	 * Variklio atnaujinimas
	 * @param type $data
	 */
	public function updateZanras($data) {
		$query = "  UPDATE {$this->Zanras_lentele}
					SET    `Zanro_aprasas`='{$data['Zanro_aprasas']}'
					WHERE `ZanroID`='{$data['id']}'";      
		mysql::query($query);
	}

	/**
	 * Variklio įrašymas
	 * @param type $data
	 */
	public function insertZanras($data) { 
                
                $query = " SELECT ZanroID FROM Zanras ORDER BY ZanroID DESC LIMIT 1 ";
                $result = mysql::select($query);
                $temp = $result[0];
                $lastid = $temp['ZanroID'];
                $lastid = (int)$lastid;
                $lastid = $lastid + 1;
                
		$query = "  INSERT INTO `{$this->Zanras_lentele}` 
								(
                                                                    `ZanroID`,
                                                                    `Zanro_aprasas`
								) 
								VALUES
								(
                                                                    '$lastid', 
                                                                    '{$data['Zanro_aprasas']}'
								)";
		mysql::query($query);
	}
	
	/**
	 * Varikliu sąrašo išrinkimas
	 * @param type $limit
	 * @param type $offset
	 * @return type
	 */
	public function getZanrasList($limit = null, $offset = null) {
		$limitOffsetString = "";
		if(isset($limit)) {
			$limitOffsetString .= " LIMIT {$limit}";
			
			if(isset($offset)) {
				$limitOffsetString .= " OFFSET {$offset}";
			}	
		}
		
		$query = "  SELECT *
					FROM {$this->Zanras_lentele}{$limitOffsetString}";
		$data = mysql::select($query);
		
		return $data;
	}

	/**
	 * Varikliu kiekio radimas
	 * @return type
	 */
	public function getZanrasListCount() {
		$query = "  SELECT COUNT(`ZanroID`) as `kiekis`
					FROM {$this->Zanras_lentele}";
		$data = mysql::select($query);
		
		return $data[0]['kiekis'];
	}
	
	/**
	 * Variklio šalinimas
	 * @param type $id
	 */
	public function deleteZanras($id) {
		$query = "  DELETE FROM `{$this->Zanras_lentele}`
					WHERE `ZanroID`='{$id}'";
		mysql::query($query);
	}
	
	/**
	 * MarkÄ—s modeliÅ³ kiekio radimas
	 * @param type $id
	 * @return type
	 */
	public function getGameCountOfZanras($id) {
		$query = "  SELECT COUNT({$this->Zaidimas_lentele}.`Id`) AS `kiekis`
					FROM {$this->Zanras_lentele}
						INNER JOIN {$this->Zaidimas_lentele}
							ON {$this->Zanras_lentele}.`ZanroID`={$this->Zaidimas_lentele}.`fk_ZanrasZanroID`
					WHERE {$this->Zanras_lentele}.`ZanroID`='{$id}'";
		$data = mysql::select($query);
		
		return $data[0]['kiekis'];
	}
}