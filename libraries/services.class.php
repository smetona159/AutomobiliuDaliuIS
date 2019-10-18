<?php
/**
 * Papildomų paslaugų redagavimo klasė
 *
 * @author ISK
 */

class services {
	
	
	private $paslaugos_lentele = '';
	private $sutartys_lentele = '';
	private $paslaugu_kainos_lentele = '';
	private $uzsakytos_paslaugos_lentele = '';
	
	public function __construct() {
		$this->paslaugos_lentele = config::DB_PREFIX . 'paslaugos';
		$this->sutartys_lentele = config::DB_PREFIX . 'sutartys';
		$this->paslaugu_kainos_lentele = config::DB_PREFIX . 'paslaugu_kainos';
		$this->uzsakytos_paslaugos_lentele = config::DB_PREFIX . 'uzsakytos_paslaugos';
	}
	
	/**
	 * Paslaugų sąrašo išrinkimas
	 * @param type $limit
	 * @param type $offset
	 * @return type
	 */
	public function getServicesList($limit = null, $offset = null) {
		$limitOffsetString = "";
		if(isset($limit)) {
			$limitOffsetString .= " LIMIT {$limit}";
		}
		if(isset($offset)) {
			$limitOffsetString .= " OFFSET {$offset}";
		}
		
		$query = "  SELECT *
					FROM `{$this->paslaugos_lentele}`" . $limitOffsetString;
		$data = mysql::select($query);
		
		return $data;
	}
	
	/**
	 * Paslaugų kiekio radimas
	 * @return type
	 */
	public function getServicesListCount() {
		$query = "  SELECT COUNT(`{$this->paslaugos_lentele}`.`id`) as `kiekis`
					FROM `{$this->paslaugos_lentele}`";
		$data = mysql::select($query);
		
		return $data[0]['kiekis'];
	}
	
	/**
	 * Paslaugos kainų sąrašo radimas
	 * @param type $serviceId
	 * @return type
	 */
	public function getServicePrices($serviceId) {
		$query = "  SELECT *
					FROM `{$this->paslaugu_kainos_lentele}`
					WHERE `fk_paslauga`='{$serviceId}'";
		$data = mysql::select($query);
		
		return $data;
	}
	
	/**
	 * Sutarčių, į kurias įtraukta paslauga, kiekio radimas
	 * @param type $serviceId
	 * @return type
	 */
	public function getContractCountOfService($serviceId) {
		$query = "  SELECT COUNT(`{$this->sutartys_lentele}`.`nr`) AS `kiekis`
					FROM `{$this->paslaugos_lentele}`
						INNER JOIN `{$this->paslaugu_kainos_lentele}`
							ON `{$this->paslaugos_lentele}`.`id`=`{$this->paslaugu_kainos_lentele}`.`fk_paslauga`
						INNER JOIN `{$this->uzsakytos_paslaugos_lentele}`
							ON `{$this->paslaugu_kainos_lentele}`.`fk_paslauga`=`{$this->uzsakytos_paslaugos_lentele}`.`fk_paslauga`
						INNER JOIN `{$this->sutartys_lentele}`
							ON `{$this->uzsakytos_paslaugos_lentele}`.`fk_sutartis`=`{$this->sutartys_lentele}`.`nr`
					WHERE `{$this->paslaugos_lentele}`.`id`='{$serviceId}'";
		$data = mysql::select($query);
		
		return $data[0]['kiekis'];
	}
	
	/**
	 * Paslaugos išrinkimas
	 * @param type $id
	 * @return type
	 */
	public function getService($id) {
		$query = "  SELECT *
					FROM `{$this->paslaugos_lentele}`
					WHERE `id`='{$id}'";
		$data = mysql::select($query);

		return $data[0];
	}
	
	/**
	 * Paslaugos įrašymas
	 * @param type $data
	 * @return įrašytos paslaugos ID
	 */
	public function insertService($data) {
		$query = "  INSERT INTO `{$this->paslaugos_lentele}`
								(
									`pavadinimas`,
									`aprasymas`
								)
								VALUES
								(
									'{$data['pavadinimas']}',
									'{$data['aprasymas']}'
								)";
		mysql::query($query);
		
		return mysql::getLastInsertedId();
	}
	
	/**
	 * Paslaugos atnaujinimas
	 * @param type $data
	 */
	public function updateService($data) {
		$query = "  UPDATE `{$this->paslaugos_lentele}`
					SET    `pavadinimas`='{$data['pavadinimas']}',
						   `aprasymas`='{$data['aprasymas']}'
					WHERE `id`='{$data['id']}'";
		mysql::query($query);
	}
	
	/**
	 * Paslaugos šalinimas
	 * @param type $id
	 */
	public function deleteService($id) {
		$query = "  DELETE FROM `{$this->paslaugos_lentele}`
					WHERE `id`='{$id}'";
		mysql::query($query);
	}
	
	/**
	 * Paslaugos kainų įrašymas
	 * @param type $data
	 */
	public function insertServicePrices($data) {
		if(isset($data['kainos']) && sizeof($data['kainos']) > 0) {
			foreach($data['kainos'] as $key=>$val) {
				if($data['neaktyvus'] == array() || $data['neaktyvus'][$key] == 0) {
					$query = "  INSERT INTO `{$this->paslaugu_kainos_lentele}`
											(
												`fk_paslauga`,
												`galioja_nuo`,
												`kaina`
											)
											VALUES
											(
												'{$data['id']}',
												'{$data['datos'][$key]}',
												'{$val}'
											)";
					mysql::query($query);
				}
			}
		}
	}
	
	/**
	 * Paslaugos kainų šalinimas
	 * @param type $serviceId
	 * @param type $clause
	 */
	public function deleteServicePrices($serviceId, $clause = "") {
		$query = "  DELETE FROM `{$this->paslaugu_kainos_lentele}`
					WHERE `fk_paslauga`='{$serviceId}'" . $clause;
		mysql::query($query);
	}
	
	public function getOrderedServices($dateFrom, $dateTo) {
		$whereClauseString = "";
		if(!empty($dateFrom)) {
			$whereClauseString .= " WHERE `{$this->sutartys_lentele}`.`sutarties_data`>='{$dateFrom}'";
			if(!empty($dateTo)) {
				$whereClauseString .= " AND `{$this->sutartys_lentele}`.`sutarties_data`<='{$dateTo}'";
			}
		} else {
			if(!empty($dateTo)) {
				$whereClauseString .= " WHERE `{$this->sutartys_lentele}`.`sutarties_data`<='{$dateTo}'";
			}
		}
		
		$query = "  SELECT `id`,
						   `pavadinimas`,
						   sum(`kiekis`) AS `uzsakyta`,
						   sum(`kiekis`*`{$this->uzsakytos_paslaugos_lentele}`.`kaina`) AS `bendra_suma`
					FROM `{$this->paslaugos_lentele}`
						INNER JOIN `{$this->uzsakytos_paslaugos_lentele}`
							ON `{$this->paslaugos_lentele}`.`id`=`{$this->uzsakytos_paslaugos_lentele}`.`fk_paslauga`
						INNER JOIN `{$this->sutartys_lentele}`
							ON `{$this->uzsakytos_paslaugos_lentele}`.`fk_sutartis`=`{$this->sutartys_lentele}`.`nr`
					{$whereClauseString}
					GROUP BY `{$this->paslaugos_lentele}`.`id` ORDER BY `bendra_suma` DESC";
		$data = mysql::select($query);

		return $data;
	}

	public function getStatsOfOrderedServices($dateFrom, $dateTo) {
		$whereClauseString = "";
		if(!empty($dateFrom)) {
			$whereClauseString .= " WHERE `{$this->sutartys_lentele}`.`sutarties_data`>='{$dateFrom}'";
			if(!empty($dateTo)) {
				$whereClauseString .= " AND `{$this->sutartys_lentele}`.`sutarties_data`<='{$dateTo}'";
			}
		} else {
			if(!empty($dateTo)) {
				$whereClauseString .= " WHERE `{$this->sutartys_lentele}`.`sutarties_data`<='{$dateTo}'";
			}
		}
		
		$query = "  SELECT sum(`kiekis`) AS `uzsakyta`,
						   sum(`kiekis`*`{$this->uzsakytos_paslaugos_lentele}`.`kaina`) AS `bendra_suma`
					FROM `{$this->paslaugos_lentele}`
						INNER JOIN `{$this->uzsakytos_paslaugos_lentele}`
							ON `{$this->paslaugos_lentele}`.`id`=`{$this->uzsakytos_paslaugos_lentele}`.`fk_paslauga`
						INNER JOIN `{$this->sutartys_lentele}`
							ON `{$this->uzsakytos_paslaugos_lentele}`.`fk_sutartis`=`{$this->sutartys_lentele}`.`nr`
					{$whereClauseString}";
		$data = mysql::select($query);

		return $data;
	}
}