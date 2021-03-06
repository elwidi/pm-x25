<?php

    class Project_list_dt extends CI_Model implements DatatableModel{
    	
		/**
		 * @ return
		 * 		Expressions / Columns to append to the select created by the Datatable library
		 */
		public function appendToSelectStr() {
			//_protect_identifiers needs to be FALSE in the database.php when using custom expresions to avoid db errors.
			//CI is putting `` around the expression instead of just the column names
				return array(
						'start_date' => 'DATE_FORMAT(start_date,"%e %M %Y")'
				);
		}
    	
		public function fromTableStr() {
			return 'pm_projects';
		}
    
	    /**
	     * @return
	     *     Associative array of joins.  Return NULL or empty array  when not joining
	     */
	    public function joinArray(){
			return array(
//					'mora_employment b' => 'a.employee_id = b.employee_id',
					//'(SELECT * FROM mora_travel_request_destination GROUP BY travel_req_id) c' => 'a.travel_req_id = c.travel_req_id'
			);
	    }
	    
    /**
     * 
     *@return
     *  Static where clause to be appended to all search queries.  Return NULL or empty array
     * when not filtering by additional criteria
     */
    	public function whereClauseArray(){
			// Get Apps Config
			return array(
			);
			/*if($data['userRole'][0] == 1) {
				return array(
				);
			} else {
				$projectIds = "";
				foreach ($data['projects'] as $i => $v){
					$projectIds .= $v->id.",";
					$projectIds = "(".substr($projectIds,-1).")";
				}
				return array(
					'id IN' => $projectIds
				);
			}*/


    	}
   }
?>