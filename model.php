public function company_name($filter_name="a")
		{
			if(!empty($_GET['filter_name'])){
				$sql="SELECT `id`,`name` FROM `company_name` WHERE name LIKE '%" . $this->db->escape($_GET['filter_name']) . "%' LIMIT 0, 10";
			    return $this->db->query($sql)->rows;
			}
			
		}
