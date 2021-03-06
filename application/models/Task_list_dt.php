<?php

    class Task_list_dt extends CI_Model implements DatatableModel{
    	
		/**
		 * @ return
		 * 		Expressions / Columns to append to the select created by the Datatable library
		 */
		public function appendToSelectStr() {
			//_protect_identifiers needs to be FALSE in the database.php when using custom expresions to avoid db errors.
			//CI is putting `` around the expression instead of just the column names
				/*return array(
						'due_date' => 'DATE_FORMAT(due_date,"%e %M %Y")'
				);*/
		}
    	
		public function fromTableStr() {
			return 'pm_tasks a';
		}
    
	    /**
	     * @return
	     *     Associative array of joins.  Return NULL or empty array  when not joining
	     */
	    public function joinArray(){
			return array(
					'pm_tasklists b' => 'a.task_list_id = b.id',
			);
	    }
	    
    /**
     * 
     *@return
     *  Static where clause to be appended to all search queries.  Return NULL or empty array
     * when not filtering by additional criteria
     */
    	public function whereClauseArray(){
    		$a = explode('/', current_url());
			$project_id = end($a);
			return array(
				'a.projects_id' => $project_id
			);
    	}
   }
?>