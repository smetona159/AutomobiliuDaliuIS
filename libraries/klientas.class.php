<?php
/**
 * Klientų redagavimo klasė
 *
 * @author ISK
 */

class klientas {
	
	private $uzsakymo_sutartis_lentele = '';
        private $uzsakovas_lentele = '';
        private $asmuo_lentele = '';
	
	public function __construct() {
		$this->uzsakymo_sutartis_lentele = config::DB_PREFIX . 'Uzsakymas';
                $this->uzsakovas_lentele = config::DB_PREFIX . 'Klientas';
                $this->asmuo_lentele = config::DB_PREFIX . 'Asmuo';
	}
	
	/**
	 * Darbuotojo išrinkimas
	 * @param type $id
	 * @return type
	 */
	public function getKlientas($id) {
		$query = "  SELECT `{$this->uzsakovas_lentele}`.`atsiemimo_miestas`,
						   `{$this->uzsakovas_lentele}`.`id_Klientas`,
						   `{$this->uzsakovas_lentele}`.`fk_Asmuoasmens_kodas` AS `asmuo`
					FROM `{$this->uzsakovas_lentele}`
					WHERE `{$this->uzsakovas_lentele}`.`id_Klientas`='{$id}'";
		$data = mysql::select($query);
                
		return $data[0];
	}
	
	/**
	 * Darbuotojų sąrašo išrinkimas
	 * @param type $limit
	 * @param type $offset
	 * @return type
	 */
	public function getKlientasList($limit = null, $offset = null) {
		$limitOffsetString = "";
		if(isset($limit)) {
			$limitOffsetString .= " LIMIT {$limit}";
		}
		if(isset($offset)) {
			$limitOffsetString .= " OFFSET {$offset}";
		}
		
		$query = "  SELECT `{$this->uzsakovas_lentele}`.`id_Klientas`,
						   `{$this->uzsakovas_lentele}`.`atsiemimo_miestas`,
						    `{$this->asmuo_lentele}`.`asmens_kodas` AS `asmen`
					FROM `{$this->uzsakovas_lentele}`
						LEFT JOIN `{$this->asmuo_lentele}`
							ON `{$this->uzsakovas_lentele}`.`fk_Asmuoasmens_kodas`=`{$this->asmuo_lentele}`.`asmens_kodas`{$limitOffsetString}";
		$data = mysql::select($query);
		//var_dump($data);
                
		return $data;
	}
	
	/**
	 * Darbuotojų kiekio radimas
	 * @return type
	 */
	public function getKlientasListCount() {
		$query = "  SELECT COUNT(`id_Klientas`) as `kiekis`
					FROM `{$this->uzsakovas_lentele}`";
		$data = mysql::select($query);
                
               /* $query = "  SELECT COUNT(`{$this->uzsakovas_lentele}`.`id_Klientas`) as `kiekis`
					FROM `{$this->uzsakovas_lentele}`
						LEFT JOIN `{$this->asmuo_lentele}`
							ON `{$this->uzsakovas_lentele}`.`fk_Asmuoasmens_kodas`=`{$this->asmuo_lentele}`.`asmens_kodas`";
		$data = mysql::select($query);
		*/
		return $data[0]['kiekis'];
	}
	
	/**
	 * Darbuotojo šalinimas
	 * @param type $id
	 */
	public function deleteKlientas($id) {
		$query = "  DELETE FROM `{$this->uzsakovas_lentele}`
					WHERE `id_Klientas`='{$id}'";
		mysql::query($query);
	}
	
	/**
	 * Darbuotojo atnaujinimas
	 * @param type $data
	 */
	public function updateKlientas($data) {
		$query = "  UPDATE `{$this->uzsakovas_lentele}`
					SET
                                               `atsiemimo_miestas`='{$data['atsiemimo_miestas']}',
                                               `fk_Asmuoasmens_kodas`='{$data['fk_Asmuoasmens_kodas']}'
					WHERE `id_Klientas`='{$data['id']}'";
		mysql::query($query);
                var_dump($data);
                die();
	}
	
	/**
	 * Darbuotojo įrašymas
	 * @param type $data
	 */
	public function insertKlientas($data) {
                
                $query = " SELECT id_Klientas FROM Klientas ORDER BY id_Klientas DESC LIMIT 1 ";
                $result = mysql::select($query);
                $temp = $result[0];
                $lastid = $temp['id_Klientas'];
                $lastid = (int)$lastid;
                $lastid = $lastid + 1;
            
		$query = "  INSERT INTO `{$this->uzsakovas_lentele}`
								(
									`atsiemimo_miestas`,
                                                                        'fk_Asmuoasmens_kodas',
                                                                        `id_Klientas`
                                                                        
								) 
								VALUES
								(
                                                                        '{$data['atsiemimo_miestas']}',
									'{$data['fk_Asmuoasmens_kodas']}',
                                                                        '$lastid'
								)";
		
                var_dump($query);
                //die();
                      mysql::query($query);
	}
	
	/**
	 * Sutarčių, į kurias įtrauktas darbuotojas, kiekio radimas
	 * @param type $id
	 * @return type
	 */
	public function getSutartisCountOfKlientas($id) {
		$query = "  SELECT COUNT(`{$this->uzsakymo_sutartis_lentele}`.`uzsakymo_nr`) AS `kiekis`
					FROM `{$this->uzsakovas_lentele}`
						INNER JOIN `{$this->uzsakymo_sutartis_lentele}`
							ON `{$this->uzsakovas_lentele}`.`id_Klientas`=`{$this->uzsakymo_sutartis_lentele}`.`fk_Klientasid_Klientas`
					WHERE `{$this->uzsakovas_lentele}`.`id_Klientas`='{$id}'";
		$data = mysql::select($query);
		
		return $data[0]['kiekis'];
	}	
}