<?php

class dalis {

	private $Tipas_lentele = '';
	private $Dalis_lentele = '';
	private $Uzsakoma_dalis_lentele = '';
	private $Modelis_lentele = '';
	
	public function __construct() {
		$this->Tipas_lentele = config::DB_PREFIX . 'Dalies_tipas';
		$this->Dalis_lentele = config::DB_PREFIX . 'Dalis';
		$this->Uzsakoma_dalis_lentele = config::DB_PREFIX . 'Uzsakoma_dalis';
		$this->Modelis_lentele = config::DB_PREFIX . 'Modelis';	
	}
	
	/**
	 * Zaidimo isrinkimas
	 * @param type $id
	 * @return type
	 */
	public function getDalis($id) {
		$query = "  SELECT `{$this->Dalis_lentele}`.`dalies_kodas`,
						   `{$this->Dalis_lentele}`.`kaina`,
						   `{$this->Dalis_lentele}`.`dalies_pavadinimas`,
						   `{$this->Dalis_lentele}`.`pagaminimo_data`,
						   `{$this->Dalis_lentele}`.`gamintojas`,
						   `{$this->Dalis_lentele}`.`fk_Modelisid_Modelis` AS `modelis`,
                                                   `{$this->Dalis_lentele}`.`fk_Dalies_tipastipo_id` AS `tipas`
					FROM `{$this->Dalis_lentele}`
					WHERE `{$this->Dalis_lentele}`.`dalies_kodas`='{$id}'";
		$data = mysql::select($query);
		
		return $data[0];
	}
	
	/**
	 * Zaidimo atnaujinimas
	 * @param type $data
	 */
	public function updateDalis($data) {
		$query = "  UPDATE `{$this->Dalis_lentele}`
					SET    `kaina`='{$data['kaina']}',
						   `dalies_pavadinimas`='{$data['dalies_pavadinimas']}',
						   `pagaminimo_data`='{$data['pagaminimo_data']}',
						   `gamintojas`='{$data['gamintojas']}',
						   `fk_Modelisid_Modelis`='{$data['fk_Modelisid_Modelis']}',
						   `fk_Dalies_tipastipo_id`='{$data['fk_Dalies_tipastipo_id']}'
					WHERE `dalies_kodas`='{$data['id']}'";
		mysql::query($query);
	}

	/**
	 * Automobilio įrašymas
	 * @param type $data
	 */
	public function insertDalis($data) {
            
            $query = " SELECT dalies_kodas FROM Dalis ORDER BY dalies_kodas DESC LIMIT 1 ";
                $result = mysql::select($query);
                $temp = $result[0];
                $lastid = $temp['dalies_kodas'];
                //$lastid = (int)$lastid;
                //$lastid = $lastid + 1;
                
		$query = "  INSERT INTO `{$this->Dalis_lentele}` 
								(
                                                                        `dalies_kodas`,
									`kaina`,
									`dalies_pavadinimas`,
									`pagaminimo_data`,
									`gamintojas`,
									`fk_Modelisid_Modelis`,
									`fk_Dalies_tipastipo_id`
								) 
								VALUES
								(
                                                                        '{$data['dalies_kodas']}',
									'{$data['kaina']}',
									'{$data['dalies_pavadinimas']}',
									'{$data['pagaminimo_data']}',
									'{$data['gamintojas']}',
									'{$data['fk_Modelisid_Modelis']}',
									'{$data['fk_Dalies_tipastipo_id']}'
								)";
		mysql::query($query);
                //var_dump($query);
               // die();
	}
	
	/**
	 * Zaidimu sąrašo išrinkimas
	 * @param type $limit
	 * @param type $offset
	 * @return type
	 */
	public function getDalisList($limit = null, $offset = null) {
		$limitOffsetString = "";
		if(isset($limit)) {
			$limitOffsetString .= " LIMIT {$limit}";
		}
		if(isset($offset)) {
			$limitOffsetString .= " OFFSET {$offset}";
		}
		
		/*$query = "  SELECT `{$this->Zaidimas_lentele}`.`Id`,
						   `{$this->Zaidimas_lentele}`.`Kaina`,
						   `{$this->Zaidimas_lentele}`.`Pavadinimas`,
						   `{$this->Zaidimas_lentele}`.`Isleidimo_data`,
						   `{$this->Zaidimas_lentele}`.`Papildymas`
                                                   `{$this->Variklis_lentele}`.`VariklioId`,
                                                   `{$this->Tipas_lentele}`.`ZanroId`,      
					FROM `{$this->Zaidimas_lentele}`
						LEFT JOIN `{$this->Variklis_lentele}`
							ON `{$this->Zaidimas_lentele}`.`fk_VariklisVariklioID`=`{$this->Variklis_lentele}`.`VariklioID`
						LEFT JOIN `{$this->Zanras_lentele}`
							ON `{$this->Zaidimas_lentele}`.`fk_ZanrasZanroID`=`{$this->Zanras_lentele}`.`ZanroID`" . $limitOffsetString;
		$data = mysql::select($query);
		*/
                
                $query = "  SELECT *
					FROM `{$this->Dalis_lentele}`" . $limitOffsetString;
		$data = mysql::select($query);
                
		return $data;
	}

	/**
	 * Zaidimu kiekio radimas
	 * @return type
	 */
	public function getDalisListCount() {
		$query = "  SELECT COUNT(`{$this->Dalis_lentele}`.`dalies_kodas`) AS `kiekis`
					FROM `{$this->Dalis_lentele}`
						LEFT JOIN `{$this->Modelis_lentele}`
							ON `{$this->Dalis_lentele}`.`fk_Modelisid_Modelis`=`{$this->Modelis_lentele}`.`id_Modelis`
						LEFT JOIN `{$this->Tipas_lentele}`
							ON `{$this->Dalis_lentele}`.`fk_Dalies_tipastipo_id`=`{$this->Tipas_lentele}`.`tipo_id`";
		$data = mysql::select($query);
		
		return $data[0]['kiekis'];
	}
	
	/**
	 * Zaidimo šalinimas
	 * @param type $id
	 */
	public function deleteDalis($id) {
		$query = "  DELETE FROM `{$this->Dalis_lentele}`
					WHERE `dalies_kodas`='{$id}'";
		mysql::query($query);
	}
	
	/**
	 * Sutarčių, į kurias įtrauktas automobilis, kiekio radimas
	 * @param type $id
	 * @return type
	 */
        
	public function getUzsakoma_dalisCountOfDalis($id) {
		$query = "  SELECT COUNT(`{$this->Uzsakoma_dalis_lentele}`.`id_Uzsakoma_dalis`) AS `kiekis`
					FROM `{$this->Dalis_lentele}`
						INNER JOIN `{$this->Uzsakoma_dalis_lentele}`
							ON `{$this->Dalis_lentele}`.`dalies_kodas`=`{$this->Uzsakoma_dalis_lentele}`.`fk_Dalisdalies_kodas`
					WHERE `{$this->Dalis_lentele}`.`dalies_kodas`='{$id}'";
		$data = mysql::select($query);
		
		return $data[0]['kiekis'];
	}	
        
        public function getCustomerDalis($dateFrom, $dateTo) {
		$whereClauseString = "";
		if(!empty($dateFrom)) {
			$whereClauseString .= " WHERE `{$this->Dalis_lentele}`.`pagaminimo_data`>='{$dateFrom}'";
			if(!empty($dateTo)) {
				$whereClauseString .= " AND `{$this->Dalis_lentele}`.`pagaminimo_data`<='{$dateTo}' ";
			}
		} else {
			if(!empty($dateTo)) {
				$whereClauseString .= " WHERE `{$this->Dalis_lentele}`.`pagaminimo_data`<='{$dateTo}'";
			}
		}
		
		$query = "SELECT  `{$this->Dalis_lentele}`.`pagaminimo_data` ,  `{$this->Dalis_lentele}`.`dalies_pavadinimas` ,  `{$this->Dalis_lentele}`.`kaina` ,  `{$this->Dalis_lentele}`.`fk_Modelisid_Modelis` ,  `{$this->Dalis_lentele}`.`fk_Dalies_tipastipo_id`
                           FROM  `{$this->Dalis_lentele}` 
                           LEFT JOIN  `{$this->Modelis_lentele}` ON  `{$this->Dalis_lentele}`.`fk_Modelisid_Modelis` =  `{$this->Modelis_lentele}`.`id_Modelis` 
                            LEFT JOIN  `{$this->Tipas_lentele}` ON  `{$this->Dalis_lentele}`.`fk_Dalies_tipastipo_id` =  `{$this->Tipas_lentele}`.`tipo_id` 
                            {$whereClauseString}";
                         
		$data = mysql::select($query);
                
		return $data;
	}
        
        public function getCustomerDalisCount($dateFrom, $dateTo) {
		$whereClauseString = "";
		if(!empty($dateFrom)) {
			$whereClauseString .= " WHERE `{$this->Dalis_lentele}`.`pagaminimo_data`>='{$dateFrom}'";
			if(!empty($dateTo)) {
				$whereClauseString .= " AND `{$this->Dalis_lentele}`.`pagaminimo_data`<='{$dateTo}' ";
			}
		} else {
			if(!empty($dateTo)) {
				$whereClauseString .= " WHERE `{$this->Dalis_lentele}`.`pagaminimo_data`<='{$dateTo}'";
			}
		}
		
		$query = "SELECT  COUNT(`{$this->Dalis_lentele}`.`dalies_kodas`) AS `kiekis`,`{$this->Dalis_lentele}`.`pagaminimo_data` ,  `{$this->Dalis_lentele}`.`dalies_pavadinimas` ,  `{$this->Dalis_lentele}`.`kaina` ,  `{$this->Dalis_lentele}`.`fk_Modelisid_Modelis` ,  `{$this->Dalis_lentele}`.`fk_Dalies_tipastipo_id`
                           FROM  `{$this->Dalis_lentele}` 
                            LEFT JOIN  `{$this->Modelis_lentele}` ON  `{$this->Dalis_lentele}`.`fk_Modelisid_Modelis` =  `{$this->Modelis_lentele}`.`id_Modelis` 
                            LEFT JOIN  `{$this->Tipas_lentele}` ON  `{$this->Dalis_lentele}`.`fk_Dalies_tipastipo_id` =  `{$this->Tipas_lentele}`.`tipo_id` 
                            {$whereClauseString}";
                                  
		$data = mysql::select($query);
                
		return $data[0]['kiekis'];
	}
}