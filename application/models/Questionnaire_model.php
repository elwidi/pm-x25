
<?php

class Questionnaire_model extends CI_Model {

    public function __construct()
    {
        parent::__construct();
    }

    function checkKuesionerById($employee_id)
    {
        $query = $this->db->query("SELECT * FROM mora_kuesioner_karir WHERE employee_id='" . $employee_id . "'");
        if ($query->num_rows() > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function getEmployeeDetailById($id)
    {
        $this->db->select('*');
        $this->db->from('mora_employee a');
        $this->db->join('mora_employment b', 'a.employee_id = b.employee_id', 'inner');
        $this->db->join('mora_employee_approval c', 'a.employee_id = c.employee_id', 'left');
        $this->db->where('a.employee_id', $id);
        $query = $this->db->get();
        return $query->row();
    }

    public function getKuesionerDetailByEmployeeId($id)
    {
        $this->db->select('*');
        $this->db->from('mora_kuesioner_karir a');
        $this->db->where('employee_id', $id);
        $query = $this->db->get();
        return $query->row();
    }

    function saveKuesioner($employee_id,$employee_no,$employee_name)
    {
        /**
         * ===================================================
         * Transactions with databases
         * ===================================================
         */
        $this->db->trans_begin();

        $pekerjaan = $this->input->post('pekerjaan');
        if(isset($pekerjaan[0])){ $pekerjaan1 = $pekerjaan[0]; }else{ $pekerjaan1=''; }
        if(isset($pekerjaan[1])){ $pekerjaan2 = $pekerjaan[1]; }else{ $pekerjaan2=''; }
        if(isset($pekerjaan[2])){ $pekerjaan3 = $pekerjaan[2]; }else{ $pekerjaan3=''; }


        //TODO: Save to mora_kuesioner_karir table
        $data = array(
            'employee_id' => $employee_id,
            'employee_no' => $employee_no,
            'employee_name' => $employee_name,
            'self_strengths' => $this->input->post('in_kekuatan'),
            'self_Weaknesses' => $this->input->post('in_kelemahan'),
            'professional_goals_short_term' => $this->input->post('jp_professional'),
            'professional_goals_medium_term' => $this->input->post('jm_professional'),
            'professional_goals_long_term' => $this->input->post('jpg_professional'),
            'improvement_goals_short_term' => $this->input->post('jp_competency'),
            'improvement_goals_medium_term' => $this->input->post('jm_competency'),
            'improvement_goals_long_term' => $this->input->post('jpg_competency'),
            'activity_to_achieve_short_term' => $this->input->post('jp_activitas'),
            'activity_to_achieve_medium_term' => $this->input->post('jm_activitas'),
            'activity_to_achieve_long_term' => $this->input->post('jpg_activitas'),
            'work_interested_1' => $pekerjaan1,
            'work_interested_2' => $pekerjaan2,
            'work_interested_3' => $pekerjaan3,
            'reason_1' => $this->input->post('alasan_pekerjaan1'),
            'reason_2' => $this->input->post('alasan_pekerjaan2'),
            'reason_3' => $this->input->post('alasan_pekerjaan3'),
            'created_by' => $employee_id,
            'created_date' => date('Y-m-d H:i:s')
        );

        $this->db->insert('mora_kuesioner_karir', $data);

        //TODO: Update to mora_employee_training table
        //$sql1="UPDATE mora_employee_training SET feedback_by_employee='OK' WHERE employee_id='" . $employee_id . "' AND training_id='" . $training_id . "'";
        //$this->db->query($sql1);

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

    function updateKuesioner($employee_id)
    {
        /**
         * ===================================================
         * Transactions with databases
         * ===================================================
         */
        $this->db->trans_begin();

        $pekerjaan = $this->input->post('pekerjaan');
        if(isset($pekerjaan[0])){ $pekerjaan1 = $pekerjaan[0]; }else{ $pekerjaan1=''; }
        if(isset($pekerjaan[1])){ $pekerjaan2 = $pekerjaan[1]; }else{ $pekerjaan2=''; }
        if(isset($pekerjaan[2])){ $pekerjaan3 = $pekerjaan[2]; }else{ $pekerjaan3=''; }


        //TODO: Update to mora_kuesioner_karir table
        $data = array(
            'self_strengths' => $this->input->post('in_kekuatan'),
            'self_Weaknesses' => $this->input->post('in_kelemahan'),
            'professional_goals_short_term' => $this->input->post('jp_professional'),
            'professional_goals_medium_term' => $this->input->post('jm_professional'),
            'professional_goals_long_term' => $this->input->post('jpg_professional'),
            'improvement_goals_short_term' => $this->input->post('jp_competency'),
            'improvement_goals_medium_term' => $this->input->post('jm_competency'),
            'improvement_goals_long_term' => $this->input->post('jpg_competency'),
            'activity_to_achieve_short_term' => $this->input->post('jp_activitas'),
            'activity_to_achieve_medium_term' => $this->input->post('jm_activitas'),
            'activity_to_achieve_long_term' => $this->input->post('jpg_activitas'),
            'work_interested_1' => $pekerjaan1,
            'work_interested_2' => $pekerjaan2,
            'work_interested_3' => $pekerjaan3,
            'reason_1' => $this->input->post('alasan_pekerjaan1'),
            'reason_2' => $this->input->post('alasan_pekerjaan2'),
            'reason_3' => $this->input->post('alasan_pekerjaan3'),
            'created_by' => $employee_id,
            'created_date' => date('Y-m-d H:i:s')
        );

        $this->db->where('employee_id', $employee_id);
        $this->db->update('mora_kuesioner_karir', $data);

        //TODO: Update to mora_employee_training table
        //$sql1="UPDATE mora_employee_training SET feedback_by_employee='OK' WHERE employee_id='" . $employee_id . "' AND training_id='" . $training_id . "'";
        //$this->db->query($sql1);

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




} 