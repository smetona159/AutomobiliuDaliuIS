<?php

class parduotuve {

	private $Parduotuve_lentele = '';
	private $Darbuotojas_lentele = '';
	
	public function __construct() {
		$this->Parduotuve_lentele = config::DB_PREFIX . 'Parduotuve';
		$this->Darbuotojas_lentele = config::DB_PREFIX . 'Darbuotojas';
	}
	
	/**
	 * Variklio isrinkimas
	 * @param type $id
	 * @return type
	 */
	public function getParduotuve($id) {
		$query = "  SELECT * FROM {$this->Parduotuve_lentele} WHERE `id_Parduotuve`='{$id}'";
		$data = mysql::select($query);
		
		return $data[0];
	}
	
	/**
	 * Variklio atnaujinimas
	 * @param type $data
	 */
	public function updateParduotuve($data) {
		$query = "  UPDATE {$this->Parduotuve_lentele}
					SET `miestas`='{$data['miestas']}',
                                            `adresas`='{$data['adresas']}'
                                            
					WHERE `id_Parduotuve`='{$data['id']}'";
		mysql::query($query);
	}

	/**
	 * Variklio įrašymas
	 * @param type $data
	 */
	public function insertParduotuve($data) {
            
                $query = " SELECT id_Parduotuve FROM Parduotuve ORDER BY id_Parduotuve DESC LIMIT 1 ";
                $result = mysql::select($query);
                $temp = $result[0];
                $lastid = $temp['id_Parduotuve'];
                $lastid = (int)$lastid;
                $lastid = $lastid + 1;
                
		$query = "  INSERT INTO `{$this->Parduotuve_lentele}` 
								(
                                                                        `miestas`,
									`adresas`,			
                                                                        `id_Parduotuve`
								) 
								VALUES
								(
									'{$data['miestas']}',
									'{$data['adresas']}',
                                                                        '$lastid'
								)";
		mysql::query($query);
	}
	
	/**
	 * Varikliu sąrašo išrinkimas
	 * @param type $limit
	 * @param type $offset
	 * @return type
	 */
	public function getParduotuveList($limit = null, $offset = null) {
		$limitOffsetString = "";
		if(isset($limit)) {
			$limitOffsetString .= " LIMIT {$limit}";
			
			if(isset($offset)) {
				$limitOffsetString .= " OFFSET {$offset}";
			}	
		}
		
		$query = "  SELECT *
					FROM {$this->Parduotuve_lentele}{$limitOffsetString}";
		$data = mysql::select($query);
		
		return $data;
	}

	/**
	 * Varikliu kiekio radimas
	 * @return type
	 */
	public function getParduotuveListCount() {
		$query = "  SELECT COUNT(`id_Parduotuve`) as `kiekis`
					FROM {$this->Parduotuve_lentele}";
		$data = mysql::select($query);
		
		return $data[0]['kiekis'];
	}
	
	/**
	 * Variklio šalinimas
	 * @param type $id
	 */
	public function deleteParduotuve($id) {
		$query = "  DELETE FROM `{$this->Parduotuve_lentele}`
					WHERE `id_Parduotuve`='{$id}'";
		mysql::query($query);
	}
	
	/**
	 * MarkÄ—s modeliÅ³ kiekio radimas
	 * @param type $id
	 * @return type
	 */
	public function getDarbuotojasCountOfParduotuve($id) {
		$query = "  SELECT COUNT({$this->Darbuotojas_lentele}.`sutarties_nr`) AS `kiekis`
					FROM {$this->Parduotuve_lentele}
						INNER JOIN {$this->Darbuotojas_lentele}
							ON {$this->Parduotuve_lentele}.`id_Parduotuve`={$this->Darbuotojas_lentele}.`fk_Parduotuveid_Parduotuve`
					WHERE {$this->Parduotuve_lentele}.`id_Parduotuve`='{$id}'";
		$data = mysql::select($query);
		
		return $data[0]['kiekis'];
	}
}