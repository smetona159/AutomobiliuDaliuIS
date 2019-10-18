<?php
/**
 * Sutarčių redagavimo klasė
 *
 * @author ISK
 */

class contracts {

	private $sutartys_lentele = '';
	private $darbuotojai_lentele = '';
	private $klientai_lentele = '';
	private $sutarties_busenos_lentele = '';
	private $uzsakytos_paslaugos_lentele = '';
	private $aiksteles_lentele = '';
	private $paslaugu_kainos_lentele = '';
	
	public function __construct() {
		$this->sutartys_lentele = config::DB_PREFIX . 'sutartys';
		$this->darbuotojai_lentele = config::DB_PREFIX . 'darbuotojai';
		$this->klientai_lentele = config::DB_PREFIX . 'klientai';
		$this->sutarties_busenos_lentele = config::DB_PREFIX . 'sutarties_busenos';
		$this->uzsakytos_paslaugos_lentele = config::DB_PREFIX . 'uzsakytos_paslaugos';
		$this->aiksteles_lentele = config::DB_PREFIX . 'aiksteles';
		$this->paslaugu_kainos_lentele = config::DB_PREFIX . 'paslaugu_kainos';
	}
	
	/**
	 * Sutarčių sąrašo išrinkimas
	 * @param type $limit
	 * @param type $offset
	 * @return type
	 */
	public function getContractList($limit, $offset) {
		$query = "  SELECT `{$this->sutartys_lentele}`.`nr`,
						   `{$this->sutartys_lentele}`.`sutarties_data`,
						   `{$this->darbuotojai_lentele}`.`vardas` AS `darbuotojo_vardas`,
						   `{$this->darbuotojai_lentele}`.`pavarde` AS `darbuotojo_pavarde`,
						   `{$this->klientai_lentele}`.`vardas` AS `kliento_vardas`,
						   `{$this->klientai_lentele}`.`pavarde` AS `kliento_pavarde`,
						   `{$this->sutarties_busenos_lentele}`.`name` AS `busena`
					FROM `{$this->sutartys_lentele}`
						LEFT JOIN `{$this->darbuotojai_lentele}`
							ON `{$this->sutartys_lentele}`.`fk_darbuotojas`=`{$this->darbuotojai_lentele}`.`tabelio_nr`
						LEFT JOIN `{$this->klientai_lentele}`
							ON `{$this->sutartys_lentele}`.`fk_klientas`=`{$this->klientai_lentele}`.`asmens_kodas`
						LEFT JOIN `{$this->sutarties_busenos_lentele}`
							ON `{$this->sutartys_lentele}`.`busena`=`{$this->sutarties_busenos_lentele}`.`id` LIMIT {$limit} OFFSET {$offset}";
		$data = mysql::select($query);
		
		return $data;
	}
	
	/**
	 * Sutarčių kiekio radimas
	 * @return type
	 */
	public function getContractListCount() {
		$query = "  SELECT COUNT(`{$this->sutartys_lentele}`.`nr`) AS `kiekis`
					FROM `{$this->sutartys_lentele}`
						LEFT JOIN `{$this->darbuotojai_lentele}`
							ON `{$this->sutartys_lentele}`.`fk_darbuotojas`=`{$this->darbuotojai_lentele}`.`tabelio_nr`
						LEFT JOIN `{$this->klientai_lentele}`
							ON `{$this->sutartys_lentele}`.`fk_klientas`=`{$this->klientai_lentele}`.`asmens_kodas`
						LEFT JOIN `{$this->sutarties_busenos_lentele}`
							ON `{$this->sutartys_lentele}`.`busena`=`{$this->sutarties_busenos_lentele}`.`id`";
		$data = mysql::select($query);
		
		return $data[0]['kiekis'];
	}
	
	/**
	 * Sutarties išrinkimas
	 * @param type $id
	 * @return type
	 */
	public function getContract($id) {
		$query = "  SELECT `{$this->sutartys_lentele}`.`nr`,
						   `{$this->sutartys_lentele}`.`sutarties_data`,
						   `{$this->sutartys_lentele}`.`nuomos_data_laikas`,
						   `{$this->sutartys_lentele}`.`planuojama_grazinimo_data_laikas`,
						   `{$this->sutartys_lentele}`.`faktine_grazinimo_data_laikas`,
						   `{$this->sutartys_lentele}`.`pradine_rida`,
						   `{$this->sutartys_lentele}`.`galine_rida`,
						   `{$this->sutartys_lentele}`.`kaina`,
						   `{$this->sutartys_lentele}`.`degalu_kiekis_paimant`,
						   `{$this->sutartys_lentele}`.`dagalu_kiekis_grazinus`,
						   `{$this->sutartys_lentele}`.`busena`,
						   `{$this->sutartys_lentele}`.`fk_klientas`,
						   `{$this->sutartys_lentele}`.`fk_darbuotojas`,
						   `{$this->sutartys_lentele}`.`fk_automobilis`,
						   `{$this->sutartys_lentele}`.`fk_grazinimo_vieta`,
						   `{$this->sutartys_lentele}`.`fk_paemimo_vieta`,
						   (IFNULL(SUM(`{$this->uzsakytos_paslaugos_lentele}`.`kaina` * `{$this->uzsakytos_paslaugos_lentele}`.`kiekis`), 0) + `{$this->sutartys_lentele}`.`kaina`) AS `bendra_kaina`
					FROM `{$this->sutartys_lentele}`
						LEFT JOIN `{$this->uzsakytos_paslaugos_lentele}`
							ON `{$this->sutartys_lentele}`.`nr`=`{$this->uzsakytos_paslaugos_lentele}`.`fk_sutartis`
					WHERE `{$this->sutartys_lentele}`.`nr`='{$id}' GROUP BY `{$this->sutartys_lentele}`.`nr`";
		$data = mysql::select($query);

		return $data[0];
	}
	
	/**
	 * Užsakytų papildomų paslaugų sąrašo išrinkimas
	 * @param type $orderId
	 * @return type
	 */
	public function getOrderedServices($orderId) {
		$query = "  SELECT *
					FROM `{$this->uzsakytos_paslaugos_lentele}`
					WHERE `fk_sutartis`='{$orderId}'";
		$data = mysql::select($query);
		
		return $data;
	}
	
	/**
	 * Sutarties atnaujinimas
	 * @param type $data
	 */
	public function updateContract($data) {
		$query = "  UPDATE `{$this->sutartys_lentele}`
					SET    `sutarties_data`='{$data['sutarties_data']}',
						   `nuomos_data_laikas`='{$data['nuomos_data_laikas']}',
						   `planuojama_grazinimo_data_laikas`='{$data['planuojama_grazinimo_data_laikas']}',
						   `faktine_grazinimo_data_laikas`='{$data['faktine_grazinimo_data_laikas']}',
						   `pradine_rida`='{$data['pradine_rida']}',
						   `galine_rida`='{$data['galine_rida']}',
						   `kaina`='{$data['kaina']}',
						   `degalu_kiekis_paimant`='{$data['degalu_kiekis_paimant']}',
						   `dagalu_kiekis_grazinus`='{$data['dagalu_kiekis_grazinus']}',
						   `busena`='{$data['busena']}',
						   `fk_klientas`='{$data['fk_klientas']}',
						   `fk_darbuotojas`='{$data['fk_darbuotojas']}',
						   `fk_automobilis`='{$data['fk_automobilis']}',
						   `fk_grazinimo_vieta`='{$data['fk_grazinimo_vieta']}',
						   `fk_paemimo_vieta`='{$data['fk_paemimo_vieta']}'
					WHERE `nr`='{$data['nr']}'";
		mysql::query($query);
	}
	
	/**
	 * Sutarties įrašymas
	 * @param type $data
	 */
	public function insertContract($data) {
		$query = "  INSERT INTO `{$this->sutartys_lentele}`
								(
									`nr`,
									`sutarties_data`,
									`nuomos_data_laikas`,
									`planuojama_grazinimo_data_laikas`,
									`faktine_grazinimo_data_laikas`,
									`pradine_rida`,
									`galine_rida`,
									`kaina`,
									`degalu_kiekis_paimant`,
									`dagalu_kiekis_grazinus`,
									`busena`,
									`fk_klientas`,
									`fk_darbuotojas`,
									`fk_automobilis`,
									`fk_grazinimo_vieta`,
									`fk_paemimo_vieta`
								)
								VALUES
								(
									'{$data['nr']}',
									'{$data['sutarties_data']}',
									'{$data['nuomos_data_laikas']}',
									'{$data['planuojama_grazinimo_data_laikas']}',
									'{$data['faktine_grazinimo_data_laikas']}',
									'{$data['pradine_rida']}',
									'{$data['galine_rida']}',
									'{$data['kaina']}',
									'{$data['degalu_kiekis_paimant']}',
									'{$data['dagalu_kiekis_grazinus']}',
									'{$data['busena']}',
									'{$data['fk_klientas']}',
									'{$data['fk_darbuotojas']}',
									'{$data['fk_automobilis']}',
									'{$data['fk_grazinimo_vieta']}',
									'{$data['fk_paemimo_vieta']}'
								)";
		mysql::query($query);
	}
	
	/**
	 * Sutarties šalinimas
	 * @param type $id
	 */
	public function deleteContract($id) {
		$query = "  DELETE FROM `{$this->sutartys_lentele}`
					WHERE `nr`='{$id}'";
		mysql::query($query);
	}
	
	/**
	 * Užsakytų papildomų paslaugų šalinimas
	 * @param type $contractId
	 */
	public function deleteOrderedServices($contractId) {
		$query = "  DELETE FROM `{$this->uzsakytos_paslaugos_lentele}`
					WHERE `fk_sutartis`='{$contractId}'";
		mysql::query($query);
	}
	
	/**
	 * Užsakytų papildomų paslaugų atnaujinimas
	 * @param type $data
	 */
	public function updateOrderedServices($data) {
		$this->deleteOrderedServices($data['nr']);
		
		if(isset($data['paslaugos']) && sizeof($data['paslaugos']) > 0) {
			foreach($data['paslaugos'] as $key=>$val) {
				$tmp = explode(":", $val);
				$serviceId = $tmp[0];
				$price = $tmp[1];
				$date_from = $tmp[2];
				$query = "  INSERT INTO `{$this->uzsakytos_paslaugos_lentele}`
										(
											`fk_sutartis`,
											`fk_kaina_galioja_nuo`,
											`fk_paslauga`,
											`kiekis`,
											`kaina`
										)
										VALUES
										(
											'{$data['nr']}',
											'{$date_from}',
											'{$serviceId}',
											'{$data['kiekiai'][$key]}',
											'{$price}'
										)";
					mysql::query($query);
			}
		}
	}
	
	/**
	 * Sutarties būsenų sąrašo išrinkimas
	 * @return type
	 */
	public function getContractStates() {
		$query = "  SELECT *
					FROM `{$this->sutarties_busenos_lentele}`";
		$data = mysql::select($query);
		
		return $data;
	}
	
	/**
	 * Aikštelių sąrašo išrinkimas
	 * @return type
	 */
	public function getParkingLots() {
		$query = "  SELECT *
					FROM `{$this->aiksteles_lentele}`";
		$data = mysql::select($query);
		
		return $data;
	}
	
	/**
	 * Paslaugos kainų įtraukimo į užsakymus kiekio radimas
	 * @param type $serviceId
	 * @param type $validFrom
	 * @return type
	 */
	public function getPricesCountOfOrderedServices($serviceId, $validFrom) {
		$query = "  SELECT COUNT(`{$this->uzsakytos_paslaugos_lentele}`.`fk_paslauga`) AS `kiekis`
					FROM `{$this->paslaugu_kainos_lentele}`
						INNER JOIN `{$this->uzsakytos_paslaugos_lentele}`
							ON `{$this->paslaugu_kainos_lentele}`.`fk_paslauga`=`{$this->uzsakytos_paslaugos_lentele}`.`fk_paslauga` AND `{$this->paslaugu_kainos_lentele}`.`galioja_nuo`=`{$this->uzsakytos_paslaugos_lentele}`.`fk_kaina_galioja_nuo`
					WHERE `{$this->paslaugu_kainos_lentele}`.`fk_paslauga`='{$serviceId}' AND `{$this->paslaugu_kainos_lentele}`.`galioja_nuo`='{$validFrom}'";
		$data = mysql::select($query);
		
		return $data[0]['kiekis'];
	}

	public function getCustomerContracts($dateFrom, $dateTo) {
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
		
		$query = "  SELECT  `{$this->sutartys_lentele}`.`nr`,
							`{$this->sutartys_lentele}`.`sutarties_data`,
							`{$this->klientai_lentele}`.`asmens_kodas`,
							`{$this->klientai_lentele}`.`vardas`,
						    `{$this->klientai_lentele}`.`pavarde`,
						    `{$this->sutartys_lentele}`.`kaina` as `sutarties_kaina`,
						    IFNULL(sum(`{$this->uzsakytos_paslaugos_lentele}`.`kiekis` * `{$this->uzsakytos_paslaugos_lentele}`.`kaina`), 0) as `sutarties_paslaugu_kaina`,
						    `t`.`bendra_kliento_sutarciu_kaina`,
						    `s`.`bendra_kliento_paslaugu_kaina`
					FROM `{$this->sutartys_lentele}`
						INNER JOIN `{$this->klientai_lentele}`
							ON `{$this->sutartys_lentele}`.`fk_klientas`=`{$this->klientai_lentele}`.`asmens_kodas`
						LEFT JOIN `{$this->uzsakytos_paslaugos_lentele}`
							ON `{$this->sutartys_lentele}`.`nr`=`{$this->uzsakytos_paslaugos_lentele}`.`fk_sutartis`
						LEFT JOIN (
							SELECT `asmens_kodas`,
									sum(`{$this->sutartys_lentele}`.`kaina`) AS `bendra_kliento_sutarciu_kaina`
							FROM `{$this->sutartys_lentele}`
								INNER JOIN `{$this->klientai_lentele}`
									ON `{$this->sutartys_lentele}`.`fk_klientas`=`{$this->klientai_lentele}`.`asmens_kodas`
							{$whereClauseString}
							GROUP BY `asmens_kodas`
						) `t` ON `t`.`asmens_kodas`=`{$this->klientai_lentele}`.`asmens_kodas`
						LEFT JOIN (
							SELECT `asmens_kodas`,
									IFNULL(sum(`{$this->uzsakytos_paslaugos_lentele}`.`kiekis` * `{$this->uzsakytos_paslaugos_lentele}`.`kaina`), 0) as `bendra_kliento_paslaugu_kaina`
							FROM `{$this->sutartys_lentele}`
								INNER JOIN `{$this->klientai_lentele}`
									ON `{$this->sutartys_lentele}`.`fk_klientas`=`{$this->klientai_lentele}`.`asmens_kodas`
								LEFT JOIN `{$this->uzsakytos_paslaugos_lentele}`
									ON `{$this->sutartys_lentele}`.`nr`=`{$this->uzsakytos_paslaugos_lentele}`.`fk_sutartis`
								{$whereClauseString}							
								GROUP BY `asmens_kodas`
						) `s` ON `s`.`asmens_kodas`=`{$this->klientai_lentele}`.`asmens_kodas`
					{$whereClauseString}
					GROUP BY `{$this->sutartys_lentele}`.`nr` ORDER BY `{$this->klientai_lentele}`.`pavarde` ASC";
		$data = mysql::select($query);

		return $data;
	}
	
	public function getSumPriceOfContracts($dateFrom, $dateTo) {
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
		
		$query = "  SELECT sum(`{$this->sutartys_lentele}`.`kaina`) AS `nuomos_suma`
					FROM `{$this->sutartys_lentele}`
					{$whereClauseString}";
		$data = mysql::select($query);

		return $data;
	}

	public function getSumPriceOfOrderedServices($dateFrom, $dateTo) {
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
		
		$query = "  SELECT sum(`{$this->uzsakytos_paslaugos_lentele}`.`kiekis` * `{$this->uzsakytos_paslaugos_lentele}`.`kaina`) AS `paslaugu_suma`
					FROM `{$this->sutartys_lentele}`
						INNER JOIN `{$this->uzsakytos_paslaugos_lentele}`
							ON `{$this->sutartys_lentele}`.`nr`=`{$this->uzsakytos_paslaugos_lentele}`.`fk_sutartis`
					{$whereClauseString}";
		$data = mysql::select($query);

		return $data;
	}
	
	public function getDelayedCars($dateFrom, $dateTo) {
		$whereClauseString = "";
		if(!empty($dateFrom)) {
			$whereClauseString .= " AND `{$this->sutartys_lentele}`.`sutarties_data`>='{$dateFrom}'";
			if(!empty($dateTo)) {
				$whereClauseString .= " AND `{$this->sutartys_lentele}`.`sutarties_data`<='{$dateTo}'";
			}
		} else {
			if(!empty($dateTo)) {
				$whereClauseString .= " AND `{$this->sutartys_lentele}`.`sutarties_data`<='{$dateTo}'";
			}
		}
		
		$query = "  SELECT `nr`,
						   `sutarties_data`,
						   `planuojama_grazinimo_data_laikas`,
						   IF(`faktine_grazinimo_data_laikas`='0000-00-00 00:00:00', 'negrąžinta', `faktine_grazinimo_data_laikas`) AS `grazinta`,
						   `{$this->klientai_lentele}`.`vardas`,
						   `{$this->klientai_lentele}`.`pavarde`
					FROM `{$this->sutartys_lentele}`
						INNER JOIN `{$this->klientai_lentele}`
							ON `{$this->sutartys_lentele}`.`fk_klientas`=`{$this->klientai_lentele}`.`asmens_kodas`
					WHERE (DATEDIFF(`faktine_grazinimo_data_laikas`, `planuojama_grazinimo_data_laikas`) >= 1 OR
						(`faktine_grazinimo_data_laikas` = '0000-00-00 00:00:00' AND DATEDIFF(NOW(), `planuojama_grazinimo_data_laikas`) >= 1))
					{$whereClauseString}";
		$data = mysql::select($query);

		return $data;
	}
	
}