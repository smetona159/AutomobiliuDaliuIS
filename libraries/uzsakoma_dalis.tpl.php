<?php

class uzsakoma_dalis {

	private $Dalis_lentele = '';
	private $Sandelis_lentele = '';
        private $Uzsakymo_sutartis_lentele = '';
        private $Uzsakomas_zaidimas_lentele = '';
	
	public function __construct() {
		$this->Sandelis_lentele = 'Sandelis';
		$this->Zaidimas_lentele = 'Zaidimas';
                $this->Uzsakymo_sutartis_lentele = 'Uzsakymo_sutartis';
                $this->Uzsakomas_zaidimas_lentele = 'Uzsakomas_zaidimas';
	}
	
	/**
	 * Variklio isrinkimas
	 * @param type $id
	 * @return type
	 */
	public function getUzsakymas($id) {
		$query = "  SELECT `{$this->Uzsakomas_zaidimas_lentele}`.`Kiekis`,
						   `{$this->Uzsakomas_zaidimas_lentele}`.`Kaina`,
						   `{$this->Uzsakomas_zaidimas_lentele}`.`fk_ZaidimasId` AS `zaidimas`,
						   `{$this->Uzsakomas_zaidimas_lentele}`.`fk_Sandelisid_Sandelis` AS `sandelis`
					FROM `{$this->Uzsakomas_zaidimas_lentele}`
					WHERE `{$this->Uzsakomas_zaidimas_lentele}`.`id_Uzsakomas_zaidimas`='{$id}'";
		$data = mysql::select($query);
		
		return $data[0];
	}
	
	/**
	 * Variklio atnaujinimas
	 * @param type $data
	 */
	public function updateUzsakymas($data) {
		$query = "  UPDATE {$this->Uzsakomas_zaidimas_lentele}
					SET `Kiekis`='{$data['Kiekis']}',
                                            `Kaina`='{$data['Kaina']}',
                                            `fk_ZaidimasId`='{$data['zaidimas']}',
                                            `fk_Sandelisid_Sandelis`='{$data['sandelis']}'
					WHERE `id_Uzsakomas_zaidimas`='{$data['id']}'";
		mysql::query($query);
	}

	/**
	 * Variklio įrašymas
	 * @param type $data
	 */
	public function insertUzsakymas($data) {
            
                $query = " SELECT id_Uzsakomas_zaidimas FROM Uzsakomas_zaidimas ORDER BY id_Uzsakomas_zaidimas DESC LIMIT 1 ";
                $result = mysql::select($query);
                $temp = $result[0];
                $lastid = $temp['id_Uzsakomas_zaidimas'];
                $lastid = (int)$lastid;
                $lastid = $lastid + 1;
                
		$query = "  INSERT INTO `{$this->Uzsakomas_zaidimas_lentele}` 
								(
                                                                        `Kiekis`,
									`Kaina`,
                                                                        'id_Uzsakomas_zaidimas',
									`fk_ZaidimasId`,
                                                                        `fk_Sandelisid_Sandelis`
								) 
								VALUES
								(
									'{$data['Kiekis']}',
									'{$data['Kaina']}',
                                                                        '$lastid',
                                                                        '{$data['zaidimas']}',
                                                                        '{$data['sandelis']}'
								)";
		mysql::query($query);
	}
	
	/**
	 * Varikliu sąrašo išrinkimas
	 * @param type $limit
	 * @param type $offset
	 * @return type
	 */
	public function getUzsakymasList($limit = null, $offset = null) {
		$limitOffsetString = "";
		if(isset($limit)) {
			$limitOffsetString .= " LIMIT {$limit}";
			
			if(isset($offset)) {
				$limitOffsetString .= " OFFSET {$offset}";
			}	
		}
		
		$query = "  SELECT *
					FROM {$this->Uzsakomas_zaidimas_lentele}{$limitOffsetString}";
		$data = mysql::select($query);
		
		return $data;
	}

	/**
	 * Varikliu kiekio radimas
	 * @return type
	 */
	public function getUzsakymasListCount() {
		$query = "  SELECT COUNT(`id_Uzsakomas_zaidimas`) as `kiekis`
					FROM {$this->Uzsakomas_zaidimas_lentele}";
		$data = mysql::select($query);
		
		return $data[0]['kiekis'];
	}
	
	/**
	 * Variklio šalinimas
	 * @param type $id
	 */
	public function deleteUzsakymas($id) {
		$query = "  DELETE FROM `{$this->Uzsakomas_zaidimas_lentele}`
					WHERE `id_Uzsakomas_zaidimas`='{$id}'";
		mysql::query($query);
	}
	
	/**
	 * MarkÄ—s modeliÅ³ kiekio radimas
	 * @param type $id
	 * @return type
	 */
	public function getSutartisCountOfUzsakymas($id) {
		$query = "  SELECT COUNT({$this->Uzsakymo_sutartis_lentele}.`Nr`) AS `kiekis`
					FROM {$this->Uzsakomas_zaidimas_lentele}
						INNER JOIN {$this->Uzsakymo_sutartis_lentele}
							ON {$this->Uzsakomas_zaidimas_lentele}.`id_Uzsakomas_zaidimas`={$this->Uzsakymo_sutartis_lentele}.`fk_Uzsakomas_zaidimasid_Uzsakomas_zaidimas`
					WHERE {$this->Uzsakomas_zaidimas_lentele}.`id_Uzsakomas_zaidimas`='{$id}'";
		$data = mysql::select($query);
		
		return $data[0]['kiekis'];
	}
}