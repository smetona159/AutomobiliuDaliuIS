<?php

class modelis {

	private $Modelis_lentele = '';//variklis
	private $Dalis_lentele = ''; //zaidimas
        private $Degalai_lentele = '';
        private $Kebulas_lentele = '';
        private $Transmisijos_lentele = '';
        private $Marke_lentele = '';
	
	public function __construct() {
		$this->Modelis_lentele = config::DB_PREFIX . 'modelis';
		$this->Dalis_lentele = config::DB_PREFIX . 'Dalis';
                $this->Degalai_lentele = config::DB_PREFIX . 'Degalu_tipai';
                $this->Kebulas_lentele = config::DB_PREFIX . 'Kebulo_tipas';
                $this->Transmisijos_lentele = config::DB_PREFIX . 'Transmisijos_tipai';
                $this->Marke_lentele = config::DB_PREFIX . 'Marke';
	}
	
	/**
	 * Variklio isrinkimas
	 * @param type $id
	 * @return type
	 */
	public function getModelis($id) {
		$query = "  SELECT * FROM {$this->Modelis_lentele} WHERE `id_Modelis`='{$id}'";
		$data = mysql::select($query);
		
		return $data[0];
	}
	
	/**
	 * Variklio atnaujinimas
	 * @param type $data
	 */
	public function updateModelis($data) {
		$query = "  UPDATE {$this->Modelis_lentele}
					SET     `pavadinimas`='{$data['pavadinimas']}',
                                                `pagaminimo_metai`='{$data['pagaminimo_metai']}',
                                                
                                                `fk_Degalu_tipaidegalu_id`='{$data['fk_Degalu_tipaidegalu_id']}'
                                                `fk_Kebulo_tipaskebulo_id`='{$data['fk_Kebulo_tipaskebulo_id']}',
                                                `fk_Transmisijos_tipaitransmisijos_id`='{$data['fk_Transmisijos_tipaitransmisijos_id']}',
                                                `fk_Markeid_Marke`='{$data['fk_Markeid_Marke']}',
					WHERE `id_Modelis`='{$data['id_Modelis']}'";
		mysql::query($query);
	}

	/**
	 * Variklio įrašymas
	 * @param type $data
	 */
	public function insertModelis($data) {
            
                $query = " SELECT id_Modelis FROM Modelis ORDER BY id_Modelis DESC LIMIT 1 ";
                $result = mysql::select($query);
                $temp = $result[0];
                $lastid = $temp['id_Modelis'];
               // $lastid = (int)$lastid;
                //$lastid = $lastid + 1;
                
		$query = "  INSERT INTO `{$this->Modelis_lentele}` 
								(
                                                                        `pavadinimas`,
									`pagaminimo_metai`,
									`id_Modelis`,
                                                                        `fk_Degalu_tipaidegalu_id`,
                                                                        `fk_Kebulo_tipaskebulo_id`,
                                                                        `fk_Transmisijos_tipaitransmisijos_id`,
                                                                        `fk_Markeid_Marke`
								) 
								VALUES
								(
                                                                        
									'{$data['pavadinimas']}',
									'{$data['pagaminimo_metai']}',
                                                                        '{$data['id_Modelis']}',
                                                                        '{$data['fk_Degalu_tipaidegalu_id']}',
                                                                        '{$data['fk_Kebulo_tipaskebulo_id']}',
                                                                        '{$data['fk_Transmisijos_tipaitransmisijos_id']}',
                                                                        '{$data['fk_Markeid_Marke']}'
                                                                            
								)";
		mysql::query($query);
	}
	
	/**
	 * Varikliu sąrašo išrinkimas
	 * @param type $limit
	 * @param type $offset
	 * @return type
	 */
	public function getModelisList($limit = null, $offset = null) {
		$limitOffsetString = "";
		if(isset($limit)) {
			$limitOffsetString .= " LIMIT {$limit}";
			
			if(isset($offset)) {
				$limitOffsetString .= " OFFSET {$offset}";
			}	
		}
		
		$query = "  SELECT `{$this->Modelis_lentele}`.`id_Modelis`,
						   `{$this->Modelis_lentele}`.`pavadinimas`,
                                                   `{$this->Modelis_lentele}`.`pagaminimo_metai`,
                                                   `{$this->Degalai_lentele}`.`degalu_id` AS `deg`,
						   `{$this->Kebulas_lentele}`.`kebulo_id` AS `kebul`,
                                                   `{$this->Transmisijos_lentele}`.`transmisijos_id` AS `trans`,
                                                   `{$this->Marke_lentele}`.`id_Marke` AS `mark`
					FROM `{$this->Modelis_lentele}`
						LEFT JOIN `{$this->Degalai_lentele}`
							ON `{$this->Modelis_lentele}`.`fk_Degalu_tipaidegalu_id`=`{$this->Degalai_lentele}`.`degalu_id`
                                                LEFT JOIN `{$this->Kebulas_lentele}`
							ON `{$this->Modelis_lentele}`.`fk_Kebulo_tipaskebulo_id`=`{$this->Kebulas_lentele}`.`kebulo_id`
                                                LEFT JOIN `{$this->Transmisijos_lentele}`
							ON `{$this->Modelis_lentele}`.`fk_Transmisijos_tipaitransmisijos_id`=`{$this->Transmisijos_lentele}`.`transmisijos_id`
                                                LEFT JOIN `{$this->Marke_lentele}`
							ON `{$this->Modelis_lentele}`.`fk_Markeid_Marke`=`{$this->Marke_lentele}`.`id_Marke`{$limitOffsetString}";
		$data = mysql::select($query);
		      
		return $data;
	}

	/**
	 * Varikliu kiekio radimas
	 * @return type
	 */
	public function getModelisListCount() {
		$query = "  SELECT COUNT(`id_Modelis`) as `kiekis`
					FROM {$this->Modelis_lentele}";
		$data = mysql::select($query);
		
		return $data[0]['kiekis'];
	}
	
	/**
	 * Variklio šalinimas
	 * @param type $id
	 */
	public function deleteModelis($id) {
		$query = "  DELETE FROM `{$this->Modelis_lentele}`
					WHERE `id_Modelis`='{$id}'";
		mysql::query($query);
	}
	
	/**
	 * MarkÄ—s modeliÅ³ kiekio radimas
	 * @param type $id
	 * @return type
	 */
	public function getPartCountOfModelis($id) {
		$query = "  SELECT COUNT({$this->Dalis_lentele}.`dalies_kodas`) AS `kiekis`
					FROM {$this->Modelis_lentele}
						INNER JOIN {$this->Dalis_lentele}
							ON {$this->Modelis_lentele}.`id_Modelis`={$this->Dalis_lentele}.`fk_Modelisid_Modelis`
					WHERE {$this->Modelis_lentele}.`id_Modelis`='{$id}'";
		$data = mysql::select($query);
		
		return $data[0]['kiekis'];
	}
}