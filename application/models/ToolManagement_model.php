
<?php

class ToolManagement_model extends CI_Model {

    public function __construct()
    {
        parent::__construct();
    }

    public function setUserId()
    {
        $cookie = base64_decode($_COOKIE['SSOID']);
        $crop = explode('+', $cookie);
        return $crop[0];
    }

    public function getTools(){
        $this->db->select('*');
        $this->db->from('pm_tools_lists');
        $query = $this->db->get();
        $tools = $query->result();
        return $tools;
    }

    public function getToolsDetail($id){
        $this->db->select('*');
        $this->db->from('pm_tools_inventory');
        $this->db->where('id', $id);
        $query = $this->db->get();
        $tools = $query->row();
        return $tools;
    }

    public function getTransmitDetail($id){
        $this->db->select('*');
        $this->db->from('pm_tools_transmittal_daily');
        $this->db->where('id', $id);
        $query = $this->db->get();
        $tools = $query->row();
        return $tools;
    }

    private function _get_datatable_tools_query()
    {
        $column_search = array("tools_id", "description", "pr_number", "po_number");
        $column_order = array("tools_id", "description", "pr_number", "pr_date", "po_number", "po_date");
        $this->db->select('*');
        $this->db->from('pm_tools_inventory');

        $i = 0;
        foreach ($column_search as $item) // loop column
        {
            if($_POST['search']['value']) // if datatable send POST for search
            {
                if($i===0) // first loop
                {
                    $this->db->like($item, $_POST['search']['value']);
                }
                else
                {
                    $this->db->or_like($item, $_POST['search']['value']);
                }
            }
            $i++;
        }

        if(isset($_POST['order'])) // here order processing
        {
            $this->db->order_by($column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        }

    }

    function get_datatable_tools()
    {
        $this->_get_datatable_tools_query();
        if($_POST['length'] != -1)
            $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }

    function count_filtered_tools()
    {
        $this->_get_datatable_tools_query();
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function count_all_tools()
    {
        $this->db->from("pm_tools_inventory");
        return $this->db->count_all_results();
    }

    public function saveNewTool(){
        /**
         * ===================================================
         * Transactions with databases
         * ===================================================
         */
        $this->db->trans_begin();

        $pr_date = $this->input->post('pr_date');
        $po_date = $this->input->post('po_date');
        if(!empty($po_date)){
            $po_date = date('Y-m-d H:i:s', strtotime($this->input->post('po_date')));
        }
        if(!empty($pr_date)){
            $pr_date = date('Y-m-d H:i:s', strtotime($this->input->post('pr_date')));
        }
        $data = array(
            'tools_id' => $this->input->post('tools_id'),
            'description' => $this->input->post('description'),
            'pr_number' => $this->input->post('pr_number'),
            'po_number' => $this->input->post('po_number'),
            'pr_date' => $pr_date,
            'po_date' => $po_date,
            'brand' => $this->input->post('brand'),
            'type' => $this->input->post('type'),
            'serial_number' => $this->input->post('serial_number'),
            'warranty' => $this->input->post('waranty'),
            'position' => $this->input->post('current_area'),
            'price' => $this->input->post('price'),
            'condition' => $this->input->post('condition'),
            'new_rent' => $this->input->post('new'),
            'remarks' => $this->input->post('remarks'),
            'created_by' => $this->setUserId(),
            'created_date' => date('Y-m-d H:i:s')
        );
        $this->db->insert('pm_tools_inventory', $data);

        /**
         * ===================================================
         * Transactions with databases
         * ===================================================
         */
        if ($this->db->trans_status() === FALSE)
        {
            $this->db->trans_rollback();
        }
        else
        {
            $this->db->trans_commit();
        }

        return true;
    }

    public function updateTool(){
        /**
         * ===================================================
         * Transactions with databases
         * ===================================================
         */
        $this->db->trans_begin();

        $toolsId = $this->input->post('id_tool');

        $pr_date = $this->input->post('pr_date');
        $po_date = $this->input->post('po_date');
        if(!empty($po_date)){
            $po_date = date('Y-m-d H:i:s', strtotime($this->input->post('po_date')));
        }
        if(!empty($pr_date)){
            $pr_date = date('Y-m-d H:i:s', strtotime($this->input->post('pr_date')));
        }

        $data = array(
            'tools_id' => $this->input->post('tools_id'),
            'description' => $this->input->post('description'),
            'pr_number' => $this->input->post('pr_number'),
            'po_number' => $this->input->post('po_number'),
            'pr_date' => $pr_date,
            'po_date' => $po_date,
            'brand' => $this->input->post('brand'),
            'type' => $this->input->post('type'),
            'serial_number' => $this->input->post('serial_number'),
            'warranty' => $this->input->post('waranty'),
            'position' => $this->input->post('current_area'),
            'price' => $this->input->post('price'),
            'condition' => $this->input->post('condition'),
            'new_rent' => $this->input->post('new'),
            'remarks' => $this->input->post('remarks'),
            'created_by' => $this->setUserId(),
            'created_date' => date('Y-m-d H:i:s')
        );
        $this->db->where('id', $toolsId);
        $this->db->update('pm_tools_inventory', $data);

        /**
         * ===================================================
         * Transactions with databases
         * ===================================================
         */
        if ($this->db->trans_status() === FALSE)
        {
            $this->db->trans_rollback();
        }
        else
        {
            $this->db->trans_commit();
        }

        return true;
    }

    public function deleteTool($id)
    {
        $this->db->delete('pm_tools_inventory', array('id' => $id)); 
        return true;
    }

    public function deleteTrans($id)
    {
        $this->db->delete('pm_tools_transmittal_daily', array('id' => $id)); 
        return true;
    }

    private function _get_datatable_transmittal_daily_query()
    {
        $column_search = array("tools_name", "serial_number", "date_of_borrowing", "date_of_returning", "remark_borrowing");
        $column_order = array("tools_name", "serial_number", "date_of_borrowing", "date_of_returning");
        $this->db->select('a.*, b.tools_name');
        $this->db->from('pm_tools_transmittal_daily a');
        $this->db->join('pm_tools_lists b', 'a.tools_id = b.id');
        $i = 0;
        foreach ($column_search as $item) // loop column
        {
            if($_POST['search']['value']) // if datatable send POST for search
            {
                if($i===0) // first loop
                {
                    $this->db->like($item, $_POST['search']['value']);
                }
                else
                {
                    $this->db->or_like($item, $_POST['search']['value']);
                }
            }
            $i++;
        }

        if(isset($_POST['order'])) // here order processing
        {
            $this->db->order_by($column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        }

    }

    function get_datatable_transmittal_daily()
    {
        $this->_get_datatable_transmittal_daily_query();
        if($_POST['length'] != -1)
            $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }

    function count_filtered_transmittal_daily()
    {
        $this->_get_datatable_transmittal_daily_query();
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function count_all_transmittal_daily()
    {
        $this->db->from("pm_tools_inventory");
        return $this->db->count_all_results();
    }

    public function saveTransmitTool(){
        /**
         * ===================================================
         * Transactions with databases
         * ===================================================
         */
        $this->db->trans_begin();

        // var_dump($this->input->post(null, true)); exit;

        $date_of_borrowing = $this->input->post('date_of_borrowing');
        $date_of_returning = $this->input->post('date_of_returning');
        if(!empty($date_of_borrowing)){
            $date_of_borrowing = date('Y-m-d H:i:s', strtotime($this->input->post('date_of_borrowing')));
        } else {
            $date_of_borrowing = null;
        }
        if(!empty($date_of_returning)){
            $date_of_returning = date('Y-m-d H:i:s', strtotime($this->input->post('date_of_returning')));
        } else {
            $date_of_returning = null;
        }
        $data = array(
            'tools_id' => $this->input->post('tools_id'),
            'date_of_borrowing' => $date_of_borrowing,
            'project_id' => $this->input->post('project_id'),
            'serial_number' => $this->input->post('serial_number'),
            'pic_borrowers' => $this->input->post('pic_borrowers'),
            'conditions_of_borrowing' => $this->input->post('conditions_of_borrowing'),
            'date_of_returning' => $date_of_returning,
            'pic_returning' => $this->input->post('pic_returning'),
            'conditions_of_returning' => $this->input->post('conditions_of_returning'),
            'remark_borrowing' => $this->input->post('remarks'),
            'created_by' => $this->setUserId(),
            'created_date' => date('Y-m-d H:i:s')
        );
        $this->db->insert('pm_tools_transmittal_daily', $data);

        /**
         * ===================================================
         * Transactions with databases
         * ===================================================
         */
        if ($this->db->trans_status() === FALSE)
        {
            $this->db->trans_rollback();
        }
        else
        {
            $this->db->trans_commit();
        }

        return true;
    }

    public function updateTransmitTool(){
        /**
         * ===================================================
         * Transactions with databases
         * ===================================================
         */
        $this->db->trans_begin();

        $transId = $this->input->post('trans_id');

        $date_of_borrowing = $this->input->post('date_of_borrowing');
        $date_of_returning = $this->input->post('date_of_returning');
        if(!empty($date_of_borrowing)){
            $date_of_borrowing = date('Y-m-d H:i:s', strtotime($this->input->post('date_of_borrowing')));
        } else {
            $date_of_borrowing = null;
        }
        if(!empty($date_of_returning)){
            $date_of_returning = date('Y-m-d H:i:s', strtotime($this->input->post('date_of_returning')));
        } else {
            $date_of_returning = null;
        }
        $data = array(
            'tools_id' => $this->input->post('tools_id'),
            'date_of_borrowing' => $date_of_borrowing,
            'project_id' => $this->input->post('project_id'),
            'serial_number' => $this->input->post('serial_number'),
            'pic_borrowers' => $this->input->post('pic_borrowers'),
            'conditions_of_borrowing' => $this->input->post('conditions_of_borrowing'),
            'date_of_returning' => $date_of_returning,
            'pic_returning' => $this->input->post('pic_returning'),
            'conditions_of_returning' => $this->input->post('conditions_of_returning'),
            'remark_borrowing' => $this->input->post('remarks'),
            'last_updated_by' => $this->setUserId(),
            'last_updated_date' => date('Y-m-d H:i:s')
        );
        $this->db->where('id', $transId);
        $this->db->update('pm_tools_transmittal_daily', $data);

        /**
         * ===================================================
         * Transactions with databases
         * ===================================================
         */
        if ($this->db->trans_status() === FALSE)
        {
            $this->db->trans_rollback();
        }
        else
        {
            $this->db->trans_commit();
        }

        return true;
    }

    // Dendy 01-04-2019
    private function _get_datatable_progress_parameter_query()
    {
        $column_search = array('a.id', 'a.parameter_name', 'a.measurement', 'b.group_name');
        $column_order = array('a.id', 'a.parameter_name', 'a.measurement', 'b.group_name');
        $this->db->select('a.id, a.parameter_name, a.measurement, b.group_name');
        $this->db->from('pm_daily_parameter a');
        $this->db->join('pm_milestone_group b', 'a.ms_group_id = b.id', 'left');

        $i = 0;
        foreach ($column_search as $item) // loop column
        {
            if($_POST['search']['value']) // if datatable send POST for search
            {
                if($i===0) // first loop
                {
                    $this->db->like($item, $_POST['search']['value']);
                }
                else
                {
                    $this->db->or_like($item, $_POST['search']['value']);
                }
            }
            $i++;
        }

        if(isset($_POST['order'])) // here order processing
        {
            $this->db->order_by($column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        }

    }

    function get_datatable_progress_parameter()
    {
        $this->_get_datatable_progress_parameter_query();
        if($_POST['length'] != -1)
            $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }

    function count_filtered_progress_parameter()
    {
        $this->_get_datatable_progress_parameter_query();
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function count_all_progress_parameter()
    {
        $this->db->from("pm_daily_parameter");
        return $this->db->count_all_results();
    }

    public function getMilestoneGroup(){
        $this->db->select('*');
        $this->db->from('pm_milestone_group');
        $query = $this->db->get();
        $milestone = $query->result();
        return $milestone;
    }

    public function saveProgressParameter(){
        /**
         * ===================================================
         * Transactions with databases
         * ===================================================
         */
        $this->db->trans_begin();

        $uom_name = $this->getMilestoneUOMDetail($this->input->post('measurement_id'));

        $data = array(
            'ms_group_id' => $this->input->post('ms_group_id'),
            'parameter_name' => $this->input->post('parameter_name'),
            'measurement' => $uom_name->uom_name            
        );
        $this->db->insert('pm_daily_parameter', $data);

        /**
         * ===================================================
         * Transactions with databases
         * ===================================================
         */
        if ($this->db->trans_status() === FALSE)
        {
            $this->db->trans_rollback();
        }
        else
        {
            $this->db->trans_commit();
        }

        return true;
    }

    public function getProgressParameterDetail($id){
        $this->db->select('*');
        $this->db->from('pm_daily_parameter');
        $this->db->where('id', $id);
        $query = $this->db->get();
        $pp = $query->row();
        return $pp;
    }

    public function getMilestoneGroupPP(){
        $this->db->select('id, group_name AS text');
        $this->db->from('pm_milestone_group');
        $query = $this->db->get();
        $milestone = $query->result();
        return $milestone;
    }

    // Dendy 02-04-2019
    public function updateProgressParameter(){
        /**
         * ===================================================
         * Transactions with databases
         * ===================================================
         */
        $this->db->trans_begin();

        $data = array(
            'ms_group_id' => $this->input->post('ms_group_id'),
            'parameter_name' => $this->input->post('parameter_name'),
            'measurement' => $this->input->post('measurement'),            
        );
        $this->db->where('id', $this->input->post('parameter_id'));
        $this->db->update('pm_daily_parameter', $data);

        /**
         * ===================================================
         * Transactions with databases
         * ===================================================
         */
        if ($this->db->trans_status() === FALSE)
        {
            $this->db->trans_rollback();
        }
        else
        {
            $this->db->trans_commit();
        }

        return true;
    }

    // Dendy 02-02-2019
    public function getMilestoneUOM(){
        $this->db->select('*');
        $this->db->from('pm_milestone_uom');
        $query = $this->db->get();
        $milestone = $query->result();
        return $milestone;
    }

    // Dendy 02-02-2019
    public function getMilestoneUOMPP(){
        $this->db->select('uom_name AS id, uom_name AS text');
        $this->db->from('pm_milestone_uom');
        $query = $this->db->get();
        $milestone = $query->result();
        return $milestone;
    }

    public function getMilestoneUOMDetail($id){
        $this->db->select('*');
        $this->db->from('pm_milestone_uom');
        $this->db->where('id', $id);
        $query = $this->db->get();
        $pp = $query->row();
        return $pp;
    }

} 
