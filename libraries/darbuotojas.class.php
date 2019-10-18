<?php
/**
 * Darbuotojų redagavimo klasė
 *
 * @author ISK
 */

class darbuotojas {
	
	private $darbuotojas_lentele = '';
	private $sutartys_lentele = '';
        private $asmuo_lentele = '';
        private $Parduotuve_lentele = '';
	
	public function __construct() {
		$this->darbuotojas_lentele = config::DB_PREFIX . 'Darbuotojas';
		$this->sutartys_lentele = config::DB_PREFIX . 'Uzsakymas';
                $this->asmuo_lentele = config::DB_PREFIX . 'Asmuo';
                $this->Parduotuve_lentele = config::DB_PREFIX . 'Parduotuve';
	}
	
	/**
	 * Darbuotojo išrinkimas
	 * @param type $id
	 * @return type
	 */
	public function getDarbuotojas($id) {
		$query = "  SELECT `{$this->darbuotojas_lentele}`.`sutarties_nr`,
						   `{$this->darbuotojas_lentele}`.`pareigos`,
						   `{$this->darbuotojas_lentele}`.`sutarties_prad`,
						   `{$this->darbuotojas_lentele}`.`sutarties_pab`,
						   `{$this->darbuotojas_lentele}`.`fk_Asmuoasmens_kodas` AS `asmuo`,
                                                   `{$this->darbuotojas_lentele}`.`fk_Parduotuveid_Parduotuve` AS `parduotuve`
					FROM `{$this->darbuotojas_lentele}`
					WHERE `{$this->darbuotojas_lentele}`.`sutarties_nr`='{$id}'";
		$data = mysql::select($query);
                
		return $data[0];
	}
	
	/**
	 * Darbuotojų sąrašo išrinkimas
	 * @param type $limit
	 * @param type $offset
	 * @return type
	 */
	public function getDarbuotojasList($limit = null, $offset = null) {
		$limitOffsetString = "";
		if(isset($limit)) {
			$limitOffsetString .= " LIMIT {$limit}";
		}
		if(isset($offset)) {
			$limitOffsetString .= " OFFSET {$offset}";
		}
		
		 /* $query = "  SELECT *
					FROM `{$this->darbuotojai_lentele}`" . $limitOffsetString;
		$data = mysql::select($query);
		
		return $data; */
                
                $query = "  SELECT `{$this->darbuotojas_lentele}`.`sutarties_nr`,
						   `{$this->darbuotojas_lentele}`.`pareigos`,
                                                   `{$this->darbuotojas_lentele}`.`sutarties_prad`,
                                                   `{$this->darbuotojas_lentele}`.`sutarties_pab`,
						   `{$this->asmuo_lentele}`.`asmens_kodas` AS `asmen`,
                                                   `{$this->Parduotuve_lentele}`.`id_Parduotuve` AS `parduot`
					FROM `{$this->darbuotojas_lentele}`
						LEFT JOIN `{$this->asmuo_lentele}`
							ON `{$this->darbuotojas_lentele}`.`fk_Asmuoasmens_kodas`=`{$this->asmuo_lentele}`.`asmens_kodas`
                                                LEFT JOIN `{$this->Parduotuve_lentele}`
							ON `{$this->darbuotojas_lentele}`.`fk_Parduotuveid_Parduotuve`=`{$this->Parduotuve_lentele}`.`id_Parduotuve`{$limitOffsetString}";
		$data = mysql::select($query);
		      
		return $data;
                
                
	}
	
	/**
	 * Darbuotojų kiekio radimas
	 * @return type
	 */
	public function getDarbuotojasListCount() {
		$query = "  SELECT COUNT(`sutarties_nr`) as `kiekis`
					FROM `{$this->darbuotojas_lentele}`";
		$data = mysql::select($query);
		
		return $data[0]['kiekis'];
	}
	
	/**
	 * Darbuotojo šalinimas
	 * @param type $id
	 */
	public function deleteDarbuotojas($id) {
		$query = "  DELETE FROM `{$this->darbuotojas_lentele}`
					WHERE `sutarties_nr`='{$id}'";
		mysql::query($query);
	}
	
	/**
	 * Darbuotojo atnaujinimas
	 * @param type $data
	 */
	public function updateDarbuotojas($data) {
		$query = "  UPDATE `{$this->darbuotojas_lentele}`
					SET
                                               `pareigos`='{$data['pareigos']}',
                                               `sutarties_prad`='{$data['sutarties_prad']}',
                                               `sutarties_pab`='{$data['sutarties_pab']}',
                                               `fk_Asmuoasmens_kodas`='{$data['asmuo']}',
                                               `fk_Parduotuveid_Parduotuve`='{$data['parduotuve']}'
					WHERE `sutarties_nr`='{$data['id']}'";
		//var_dump($query);
               // die();
                
                                        mysql::query($query);
	}
	
	/**
	 * Darbuotojo įrašymas
	 * @param type $data
	 */
	public function insertDarbuotojas($data) {
                
		$query = "  INSERT INTO `{$this->darbuotojas_lentele}`
								(
									`sutarties_nr`,
									`pareigos`,
									`sutarties_prad`,
                                                                        `sutarties_pab`,
                                                                        `fk_Asmuoasmens_kodas`,
                                                                        `fk_Parduotuveid_Parduotuve`
								) 
								VALUES
								(
                                                                        '{$data['sutarties_nr']}',
									'{$data['pareigos']}',
									'{$data['sutarties_prad']}',
									'{$data['sutarties_pab']}',
                                                                        '{$data['asmuo']}', 
                                                                        '{$data['parduotuve']}'
								)";
		mysql::query($query);
	}
	
	/**
	 * Sutarčių, į kurias įtrauktas darbuotojas, kiekio radimas
	 * @param type $id
	 * @return type
	 */
	public function getSutartisCountOfDarbuotojas($id) {
		$query = "  SELECT COUNT(`{$this->sutartys_lentele}`.`uzsakymo_nr`) AS `kiekis`
					FROM `{$this->darbuotojas_lentele}`
						INNER JOIN `{$this->sutartys_lentele}`
							ON `{$this->darbuotojas_lentele}`.`sutarties_nr`=`{$this->sutartys_lentele}`.`fk_Darbuotojassutarties_nr`
					WHERE `{$this->darbuotojas_lentele}`.`sutarties_nr`='{$id}'";
		$data = mysql::select($query);
		
		return $data[0]['kiekis'];
	}
        
        public function getCustomerDarbuotojas($dateFrom, $dateTo) {
		$whereClauseString = "";
		if(!empty($dateFrom)) {
			$whereClauseString .= " WHERE `{$this->darbuotojas_lentele}`.`sutarties_prad`>='{$dateFrom}'";
			if(!empty($dateTo)) {
				$whereClauseString .= " AND `{$this->darbuotojas_lentele}`.`sutarties_prad`<='{$dateTo}' ";
			}
		} else {
			if(!empty($dateTo)) {
				$whereClauseString .= " WHERE `{$this->darbuotojas_lentele}`.`sutarties_prad`<='{$dateTo}'";
			}
		}
		
		$query = "SELECT  `{$this->darbuotojas_lentele}`.`sutarties_prad` ,  `{$this->darbuotojas_lentele}`.`fk_Asmuoasmens_kodas` ,  `{$this->darbuotojas_lentele}`.`fk_Parduotuveid_Parduotuve` 
                           FROM  `{$this->darbuotojas_lentele}` 
                            LEFT JOIN  `{$this->asmuo_lentele}` ON  `{$this->darbuotojas_lentele}`.`fk_Asmuoasmens_kodas` =  `{$this->asmuo_lentele}`.`asmens_kodas` 
                            LEFT JOIN  `{$this->Parduotuve_lentele}` ON  `{$this->darbuotojas_lentele}`.`fk_Parduotuveid_Parduotuve` =  `{$this->Parduotuve_lentele}`.`id_Parduotuve` 
                            {$whereClauseString}";
                         
		$data = mysql::select($query);

		return $data;
	}
        
        public function getCustomerDarbuotojasCount($dateFrom, $dateTo) {
		$whereClauseString = "";
		if(!empty($dateFrom)) {
			$whereClauseString .= " WHERE `{$this->darbuotojas_lentele}`.`sutarties_prad`>='{$dateFrom}'";
			if(!empty($dateTo)) {
				$whereClauseString .= " AND `{$this->darbuotojas_lentele}`.`sutarties_prad`<='{$dateTo}' ";
			}
		} else {
			if(!empty($dateTo)) {
				$whereClauseString .= " WHERE `{$this->darbuotojas_lentele}`.`sutarties_prad`<='{$dateTo}'";
			}
		}
		
		$query = "SELECT  COUNT(`{$this->darbuotojas_lentele}`.`sutarties_nr`) AS `kiekis`,`{$this->darbuotojas_lentele}`.`sutarties_prad` ,  `{$this->darbuotojas_lentele}`.`fk_Asmuoasmens_kodas` ,  `{$this->darbuotojas_lentele}`.`fk_Parduotuveid_Parduotuve` 
                          FROM  `{$this->darbuotojas_lentele}` 
                            LEFT JOIN  `{$this->asmuo_lentele}` ON  `{$this->darbuotojas_lentele}`.`fk_Asmuoasmens_kodas` =  `{$this->asmuo_lentele}`.`asmens_kodas` 
                            LEFT JOIN  `{$this->Parduotuve_lentele}` ON  `{$this->darbuotojas_lentele}`.`fk_Parduotuveid_Parduotuve` =  `{$this->Parduotuve_lentele}`.`id_Parduotuve` 
                            {$whereClauseString}";
                                  
		$data = mysql::select($query);

		return $data[0]['kiekis'];
	}
        
        
        
        
        
        public function getCustomerDarbuotojas2($dateFrom, $dateTo) {
		$whereClauseString = "";
		if(!empty($dateFrom)) {
			$whereClauseString .= " WHERE `{$this->darbuotojas_lentele}`.`sutarties_pab`>='{$dateFrom}'";
			if(!empty($dateTo)) {
				$whereClauseString .= " AND `{$this->darbuotojas_lentele}`.`sutarties_pab`<='{$dateTo}' ";
			}
		} else {
			if(!empty($dateTo)) {
				$whereClauseString .= " WHERE `{$this->darbuotojas_lentele}`.`sutarties_pab`<='{$dateTo}'";
			}
		}
		
		$query = "SELECT  `{$this->darbuotojas_lentele}`.`sutarties_pab` ,  `{$this->darbuotojas_lentele}`.`fk_Asmuoasmens_kodas` ,  `{$this->darbuotojas_lentele}`.`fk_Parduotuveid_Parduotuve` 
                           FROM  `{$this->darbuotojas_lentele}` 
                            LEFT JOIN  `{$this->asmuo_lentele}` ON  `{$this->darbuotojas_lentele}`.`fk_Asmuoasmens_kodas` =  `{$this->asmuo_lentele}`.`asmens_kodas` 
                            LEFT JOIN  `{$this->Parduotuve_lentele}` ON  `{$this->darbuotojas_lentele}`.`fk_Parduotuveid_Parduotuve` =  `{$this->Parduotuve_lentele}`.`id_Parduotuve` 
                            {$whereClauseString}";
                         
		$data = mysql::select($query);

		return $data;
	}
        
        public function getCustomerDarbuotojas2Count($dateFrom, $dateTo) {
		$whereClauseString = "";
		if(!empty($dateFrom)) {
			$whereClauseString .= " WHERE `{$this->darbuotojas_lentele}`.`sutarties_pab`>='{$dateFrom}'";
			if(!empty($dateTo)) {
				$whereClauseString .= " AND `{$this->darbuotojas_lentele}`.`sutarties_pab`<='{$dateTo}' ";
			}
		} else {
			if(!empty($dateTo)) {
				$whereClauseString .= " WHERE `{$this->darbuotojas_lentele}`.`sutarties_pab`<='{$dateTo}'";
			}
		}
		
		$query = "SELECT  COUNT(`{$this->darbuotojas_lentele}`.`sutarties_nr`) AS `kiekis`,`{$this->darbuotojas_lentele}`.`sutarties_pab` ,  `{$this->darbuotojas_lentele}`.`fk_Asmuoasmens_kodas` ,  `{$this->darbuotojas_lentele}`.`fk_Parduotuveid_Parduotuve` 
                          FROM  `{$this->darbuotojas_lentele}` 
                            LEFT JOIN  `{$this->asmuo_lentele}` ON  `{$this->darbuotojas_lentele}`.`fk_Asmuoasmens_kodas` =  `{$this->asmuo_lentele}`.`asmens_kodas` 
                            LEFT JOIN  `{$this->Parduotuve_lentele}` ON  `{$this->darbuotojas_lentele}`.`fk_Parduotuveid_Parduotuve` =  `{$this->Parduotuve_lentele}`.`id_Parduotuve` 
                            {$whereClauseString}";
                                  
		$data = mysql::select($query);

		return $data[0]['kiekis'];
	}
	
}