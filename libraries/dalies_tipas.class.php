<?php

class dalies_tipas{

	private $Dalies_tipo_lentele = ''; //zanras
	private $Dalis_lentele = '';   //zaidimas
	
	public function __construct() {
		$this->Dalies_tipo_lentele = config::DB_PREFIX . 'Dalies_tipas';
		$this->Dalis_lentele = config::DB_PREFIX . 'Dalis';
	}
	
	/**
	 * Variklio isrinkimas
	 * @param type $id
	 * @return type
	 */
	public function getTipas($id) {
		$query = "  SELECT * FROM {$this->Dalies_tipo_lentele} WHERE `tipo_id`='{$id}'";
		$data = mysql::select($query);
		
		return $data[0];
	}
	
	/**
	 * Variklio atnaujinimas
	 * @param type $data
	 */
	public function updateTipas($data) {
		$query = "  UPDATE {$this->Dalies_tipo_lentele}
					SET    `tipo_reiksme`='{$data['tipo_reiksme']}'
					WHERE `tipo_id`='{$data['tipo_id']}'";      
		mysql::query($query);
	}

	/**
	 * Variklio įrašymas
	 * @param type $data
	 */
	public function insertTipas($data) { 
                
                $query = " SELECT tipo_id FROM Dalies_tipas ORDER BY tipo_id DESC LIMIT 1 ";
                $result = mysql::select($query);
                $temp = $result[0];
                $lastid = $temp['tipo_id'];
                $lastid = (int)$lastid;
                $lastid = $lastid + 1;
                
		$query = "  INSERT INTO `{$this->Dalies_tipo_lentele}` 
								(
                                                                    `tipo_id`,
                                                                    `tipo_reiksme`
								) 
								VALUES
								(
                                                                    '$lastid', 
                                                                    '{$data['tipo_reiksme']}'
								)";
		mysql::query($query);
	}
	
	/**
	 * Varikliu sąrašo išrinkimas
	 * @param type $limit
	 * @param type $offset
	 * @return type
	 */
	public function getTipasList($limit = null, $offset = null) {
		$limitOffsetString = "";
		if(isset($limit)) {
			$limitOffsetString .= " LIMIT {$limit}";
			
			if(isset($offset)) {
				$limitOffsetString .= " OFFSET {$offset}";
			}	
		}
		
		$query = "  SELECT *
					FROM {$this->Dalies_tipo_lentele}{$limitOffsetString}";
		$data = mysql::select($query);
		
		return $data;
	}

	/**
	 * Varikliu kiekio radimas
	 * @return type
	 */
	public function getTipasListCount() {
		$query = "  SELECT COUNT(`tipas_id`) as `kiekis`
					FROM {$this->Dalies_tipo_lentele}";
		$data = mysql::select($query);
		
		return $data[0]['kiekis'];
	}
	
	/**
	 * Variklio šalinimas
	 * @param type $id
	 */
	public function deleteTipas($id) {
		$query = "  DELETE FROM `{$this->Dalies_tipo_lentele}`
					WHERE `tipas_id`='{$id}'";
		mysql::query($query);
	}
	
	/**
	 * MarkÄ—s modeliÅ³ kiekio radimas
	 * @param type $id
	 * @return type
	 */
	public function getPartCountOfTipas($id) {
		$query = "  SELECT COUNT({$this->dalis_lentele}.`dalies_kodas`) AS `kiekis`
					FROM {$this->Dalies_tipo_lentele}
						INNER JOIN {$this->Dalis_lentele}
							ON {$this->Dalies_tipo_lentele}.`tipas_id`={$this->Dalis_lentele}.`fk_Dalies_tipastipo_id`
					WHERE {$this->Dalies_tipo_lentele}.`ZanroID`='{$id}'";
		$data = mysql::select($query);
		
		return $data[0]['kiekis'];
	}
}