<?php
class CronController extends AppController {

	public function beforeFilter() {
		parent::beforeFilter();
		$this->layout=null;
	}

	public function parse_all_xml() {
		
		if (!defined('CRON_DISPATCHER')) { $this->redirect('/'); exit(); } 
		 /* load data from database */
		$this->loadModel('Uploadxml');
		$uploadxmls = $this->Uploadxml->find('all');
		$this->loadModel('Parsefile');
		$parsefiles = $this->Parsefile->find('all');
		$db_xml = array();
		$new_xml = array();
		
		
		if(isset($parsefiles) && !empty($parsefiles)){
			foreach ($parsefiles as $parsefile ) {
				 /* push data from database in array */
				array_push($db_xml, $parsefile['Parsefile']);
			}
			foreach ($uploadxmls as $uploadxml ) {
				/* get path and load xml in array */
				$path_xmls = 'app/webroot/xml/' . $uploadxml['Uploadxml']['xml'];
				$load_xmls = simplexml_load_file($path_xmls);
				$file_xmls = json_decode(json_encode($load_xmls), 1);

				foreach ($file_xmls['product'] as $file_xml ) {
					/* replaces id xml file by id_product*/
					$file_xml['id_product']	 =  $file_xml['id'];
					$file_xml['id_uploadxml'] = $uploadxml['Uploadxml']['id'];
					unset($file_xml['id']);
					 /* push data from all xml file in array */
					array_push($new_xml, $file_xml);			

				}
			}

			for ($i=0; $i < count($db_xml); $i++) { 
				/* Update database old xml file by new xml where key exist*/
				$this->Parsefile->saveAll($new_xml[$i]+$db_xml[$i]);

			}
			if(isset($new_xml)){

				$num =  count($new_xml) - count($db_xml);
				for($i = count($db_xml); $i <  count($db_xml) + $num; ++$i) {
					/* save other element */
					$this->Parsefile->saveAll($new_xml[$i]);
				}
			}
		}
		else{
				/* if new xml element, save */
			foreach ($uploadxmls as $uploadxml ) {
				$path_xml = 'app/webroot/xml/' . $uploadxml['Uploadxml']['xml'];
				$load_xml = simplexml_load_file($path_xml);
				$tab = json_decode(json_encode($load_xml), 1);

				foreach ($tab['product'] as $value ) {

					$value['id_product']	 =  $value['id'];
					$value['id_uploadxml'] = $uploadxml['Uploadxml']['id'];
					unset($value['id']);

					$this->Parsefile->saveAll($value);	 	

				}

			}

		}
		/* add datetime for last check file */
		$this->Uploadxml->query("UPDATE uploadxmls SET last_check = NOW();");
		echo 'All xml files parsed !';
		$this->autoRender = false;
		return;
	}
}