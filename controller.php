<?php 

public function autocomplete($filter_name) {
		$json = array();

		if (isset($filter_name)) 
		{
			
			$this->load->model('billpayment/payment');
			$biilist=$this->model_company_list->company_list($filter_name);
			$results=$biilist;

			foreach ($results as $result) {
				$json[] = array(
					'id'       		=> $result['id'],
					'name'	 		=> $result['name']
				);
			}
		}

		$sort_order = array();

		foreach ($json as $key => $value) {
			$sort_order[$key] = $value['name'];
		}

		array_multisort($sort_order, SORT_ASC, $json);

		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($json));
	}
	
