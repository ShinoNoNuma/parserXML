<?php
App::uses('AppController', 'Controller');

class ParsefilesController extends AppController {

	public function parsexmlfile() {

		$this->loadModel('Uploadxml');
		$uploadxmls = $this->Uploadxml->find('all');

		if ($this->request->is('get')) {
			if(isset($this->params['url']['id_uploadxml'])){
				if(is_numeric($this->params['url']['id_uploadxml']) == TRUE){
					$this->loadModel('Uploadxml');
					$uploadxmls = $this->Uploadxml->find('all', array( 'conditions' => array('Uploadxml.id' => $this->params['url']['id_uploadxml'])));
					$parsefiles = $this->Parsefile->find('all', array( 'conditions' => array('Parsefile.id_uploadxml' => $this->params['url']['id_uploadxml'])));
					$path_xml = '../webroot/xml/'. $uploadxmls[0]['Uploadxml']['xml'];
					
					if(file_exists($path_xml) == TRUE ){
						$load_xml = simplexml_load_file($path_xml);
						$tab = json_decode( json_encode($load_xml) , 1);
						if(isset($parsefiles) && !empty($parsefiles)){
					
							$id_old_element = array();

							for($a = 0; $a < count($parsefiles); ++$a) {
								array_push($id_old_element, $parsefiles[$a]['Parsefile']['id']);
								
							}
							if ($this->Parsefile->exists($id_old_element)) {
								for($i = 0; $i < count($id_old_element); ++$i) {

									$tab['product'][$i]['id_product'] = $tab['product'][$i]['id'];
									$tab['product'][$i]['id_uploadxml'] = $uploadxmls[0]['Uploadxml']['id'];
									
									
									if (empty($tab['product'][$i]['sku'] )){
										$tab['product'][$i]['sku'] = 0;
									}
									else{
										$tab['product'][$i]['sku'] = "'" . $tab['product'][$i]['sku'] ."'";
									}
									if (empty($tab['product'][$i]['name'] )){
											$tab['product'][$i]['name'] = 0;
									}
									else{
										$tab['product'][$i]['name'] = "'" . $tab['product'][$i]['name']."'";
									}

									if (empty($tab['product'][$i]['ean'] )){
										$tab['product'][$i]['ean'] = 0;

									}
									else{
										$tab['product'][$i]['ean'] = "'" . $tab['product'][$i]['ean'] ."'";
									
									}
									if (empty($tab['product'][$i]['stock'] )){
										$tab['product'][$i]['stock'] = 0;

									}
									else{
										$tab['product'][$i]['stock'] = "'" . $tab['product'][$i]['stock'] ."'";
									}
									if (empty($tab['product'][$i]['availability'] )){
										$tab['product'][$i]['availability'] = 0;

									}
									else{
										$tab['product'][$i]['availability'] = "'" . $tab['product'][$i]['availability'] ."'";
									}
									unset($tab['product'][$i]['id']);

									$this->Parsefile->updateAll($tab['product'][$i] , array('Parsefile.id' => $id_old_element[$i]));
								}
								if(isset($tab['product'])){
									$num =  count($tab['product']) - count($id_old_element);
									for($i = count($id_old_element); $i <  count($id_old_element) + $num; ++$i) {
										$tab['product'][$i]['id_product'] = $tab['product'][$i]['id'];
										$tab['product'][$i]['id_uploadxml'] = $uploadxmls[0]['Uploadxml']['id'];
										unset($tab['product'][$i]['id']);
										$this->Parsefile->saveAll($tab['product'][$i]);
									}
								}
							}
						}
						else{
							for($i = 0; $i < count($tab['product']); ++$i) {
								$tab['product'][$i]['id_product'] = $tab['product'][$i]['id'];
								$tab['product'][$i]['id_uploadxml'] = $uploadxmls[0]['Uploadxml']['id'];
								unset($tab['product'][$i]['id']);

								$this->Parsefile->saveAll($tab['product'][$i]);	 		 	
							}
						}
					}else{
						echo 'Your file upload is empty';
					}
					$this->Uploadxml->query("UPDATE uploadxmls SET last_check = NOW() WHERE id = ". $this->params['url']['id_uploadxml'] ." ;");
					return $this->redirect(array('controller' => 'pages','action' => 'getparsexml'));
				}else{
					return $this->redirect(array('controller' => 'pages','action' => 'getparsexml'));
				}
			}
		}
		
	}


}
