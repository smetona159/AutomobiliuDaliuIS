<?php
/**
 * Automobilių markių redagavimo klasė
 *
 * @author ISK
 */

class asmuo {
	
	private $asmuo_lentele = '';
	private $klientas_lentele = '';
        private $darbuotojas_lentele = '';
	
	public function __construct() {
		$this->asmuo_lentele = config::DB_PREFIX . 'Asmuo';
		$this->klientas_lentele = config::DB_PREFIX . 'Klientas';
                $this->darbuotojas_lentele = config::DB_PREFIX . 'Darbuotojas';
	}
	
	/**
	 * Markės išrinkimas
	 * @param type $id
	 * @return type
	 */
	public function getAsmuo($id) {
		$query = "  SELECT * FROM `{$this->asmuo_lentele}` WHERE `asmens_kodas`='{$id}'";
		$data = mysql::select($query);
		
		return $data[0];
	}
	
	/**
	 * Markių sąrašo išrinkimas
	 * @param type $limit
	 * @param type $offset
	 * @return type
	 */
	public function getAsmuoList($limit = null, $offset = null) {
		$limitOffsetString = "";
		if(isset($limit)) {
			$limitOffsetString .= " LIMIT {$limit}";
		}
		if(isset($offset)) {
			$limitOffsetString .= " OFFSET {$offset}";
		}	
		
		
		$query = "  SELECT * FROM `{$this->asmuo_lentele}`" . $limitOffsetString;
		$data = mysql::select($query);
		
		return $data;
                
              /* $query = "  SELECT `{$this->asmuo_lentele}`.`asmens_kodas`,
						   `{$this->asmuo_lentele}`.`vardas`,
                                                   `{$this->asmuo_lentele}`.`pavarde`,
                                                   `{$this->asmuo_lentele}`.`telefono_nr`,
						   `{$this->asmuo_lentele}`.`el_pastas`
					FROM `{$this->asmuo_lentele}`";
		$data = mysql::select($query);
		      
		return $data;*/
	}

	/**
	 * Markių kiekio radimas
	 * @return type
	 */
	public function getAsmuoListCount() {
		$query = "  SELECT COUNT(`asmens_kodas`) as `kiekis`
					FROM {$this->asmuo_lentele}";
		$data = mysql::select($query);
		
		return $data[0]['kiekis'];
	}
	
	/**
	 * Markės šalinimas
	 * @param type $id
	 */
	public function deleteAsmuo($id) {
		$query = "  DELETE FROM `{$this->asmuo_lentele}`
					WHERE `asmens_kodas`='{$id}'";
		mysql::query($query);
	}
	
	/**
	 * Markės modelių kiekio radimas
	 * @param type $id
	 * @return type
	 */
	public function getAsmuoCountOfBrand() {
		$query = "  SELECT COUNT(`asmens_kodas`) as `kiekis`
					FROM {$this->asmuo_lentele}";
		$data = mysql::select($query);
		
		return $data[0]['kiekis'];
	}
        
        /**
	 * Markės atnaujinimas
	 * @param type $data
	 */
	public function updateAsmuo($data) {
		$query = "  UPDATE `{$this->asmuo_lentele}`
					SET    `asmens_kodas`='{$data['asmens_kodas']}',
                                               `vardas`='{$data['vardas']}',
                                               `pavarde`='{$data['pavarde']}',
                                               `telefono_nr`='{$data['telefono_nr']}',
                                               `el_pastas`='{$data['el_pastas']}'
					WHERE `asmens_kodas`='{$data['asmens_kodas']}'";
		mysql::query($query);
	}
        
        /**
	 * Markės įrašymas
	 * @param type $data
	 */
	public function insertAsmuo($data) {
            
                $query = " SELECT asmens_kodas FROM Asmuo ORDER BY asmens_kodas DESC LIMIT 1 ";
                $result = mysql::select($query);
                $temp = $result[0];
                $lastid = $temp['asmens_kodas'];
                //$lastid = (int)$lastid;
                $lastid = $lastid + 1;
                
            
		$query = "  INSERT INTO `{$this->asmuo_lentele}`
								(
									`asmens_kodas`,
									`vardas`,
									`pavarde`,
                                                                        `telefono_nr`,
                                                                        `el_pastas`
                                                                        
								) 
								VALUES
								(
									'{$data['asmens_kodas']}',
									'{$data['vardas']}',
									'{$data['pavarde']}',
                                                                        '{$data['telefono_nr']}', 
                                                                        '{$data['el_pastas']}'
                                                                        
								)";
		
                      mysql::query($query);
	}
        
        /**
	 * Sutarčių, į kurias įtrauktas darbuotojas, kiekio radimas
	 * @param type $id
	 * @return type
	 */
	public function getKlientasCountOfAsmuo($id) {
		$query = "  SELECT COUNT(`{$this->klientas_lentele}`.`id_klientas`) AS `kiekis`
					FROM `{$this->asmuo_lentele}`
						INNER JOIN `{$this->klientas_lentele}`
							ON `{$this->asmuo_lentele}`.`asmens_kodas`=`{$this->klientas_lentele}`.`fk_Asmuoasmens_kodas`
					WHERE `{$this->asmuo_lentele}`.`asmens_kodas`='{$id}'";
		$data = mysql::select($query);
		
		return $data[0]['kiekis'];
	}
        
       
        public function getDarbuotojasCountOfAsmuo($id) {
		$query = "  SELECT COUNT(`{$this->darbuotojas_lentele}`.`sutarties_nr`) AS `kiekis`
					FROM `{$this->asmuo_lentele}`
						INNER JOIN `{$this->darbuotojas_lentele}`
							ON `{$this->asmuo_lentele}`.`asmens_kodas`=`{$this->darbuotojas_lentele}`.`fk_Asmuoasmens_kodas`
					WHERE `{$this->asmuo_lentele}`.`asmens_kodas`='{$id}'";
		$data = mysql::select($query);
		
		return $data[0]['kiekis'];
	}

	
}