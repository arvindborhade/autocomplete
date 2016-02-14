# autocomplete
Autocomplete Dropdown 


 <!-- Ajax CODE ------------------------->
$('input[name=\'filter_name\']').autocomplete({
			'source': function(request, response) {
				$.ajax({
					url: 'index.php?route=sale/customer/autocomplete&filter_name=' +  encodeURIComponent(request),
					dataType: 'json',			
					success: function(json) {
						response($.map(json, function(item) {
							return {
								label: item['name'],
								value: item['customer_id']
							}
						}));
					}
				});
			},
			'select': function(item) {
				$('input[name=\'filter_name\']').val(item['label']);
			}	});
  
  
  <!-- HTML CODE ------------------------->
  
  <input type="text" class="form-control" id="company_name" name="filter_name" placeholder="Company Name">
  
  
  <!-- Controller -->
  
   public function autocomplete($filter_name) {
		$json = array();

		if (isset($filter_name)) 
		{
			
			$this->load->model('billpayment/payment');
			$biilist=$this->model_billpayment_payment->biilist($filter_name);
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
	
	
	
	<!-- Model ----->
	public function biilist($filter_name="a")
		{
			if(!empty($_GET['filter_name'])){
				$sql="SELECT `id`,`name` FROM `billpayee_list` WHERE name LIKE '%" . $this->db->escape($_GET['filter_name']) . "%' LIMIT 0, 10";
			    return $this->db->query($sql)->rows;
			}
			
		}
