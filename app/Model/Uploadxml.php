<?php
App::uses('AppModel', 'Model');

class Uploadxml extends AppModel {

	public $validate = array(
		'xml_file' => array(
			'rule' => array('fileExtension', array('xml')),
			'message' => 'Extension allowed : xml'
		),
	);

	public function fileExtension($check, $extensions, $allowEmpty = false){
			$file = current($check);
			if($allowEmpty && empty($file['tmp_name'])){
				return true;
			}
		 $extension = strtolower(pathinfo($file['name'] , PATHINFO_EXTENSION));
		 	return in_array($extension , $extensions);	
		}

		public function beforeDelete($cascade = true){
			$oldextension = $this->field('xml');
			$oldfile = '../webroot/xml/' . $oldextension;
			if(file_exists($oldfile)){
				unlink($oldfile);
			} 
		}

		public function afterSave($created, $options = array()){
			$folder = '../webroot/xml';
			if(!is_dir($folder)){
				mkdir($folder);
			}
			$name_field = array();
			$name_xml = array();
			if(isset($this->data[$this->alias]['xml_file']) && !empty($this->data[$this->alias]['xml_file']["name"])){
				$file = $this->data[$this->alias]['xml_file'];
				$extension = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
				$filename = strtolower(pathinfo($file['name'], PATHINFO_FILENAME));
				if(!empty($file['tmp_name'])){
					$oldextension = $this->field('xml');
					$oldfile = '../webroot/xml/' . $oldextension;
					
					if(file_exists($oldfile)){
						unlink($oldfile);
					}
						move_uploaded_file($file['tmp_name'], '../webroot/xml/' . $this->id . '-' . $filename .'.'. $extension);
						array_push($name_field, 'xml');
						array_push($name_xml, $this->id . '-' . $filename .'.'. $extension);
					}
				
				}
				for($i = 0; $i < count($name_field); ++$i) {
				$this->saveField($name_field[$i],$name_xml[$i]);
			}

		}
}
