<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 3/30/2015
 * Time: 4:44 PM
 * @category: Libraries
 * @author: Kardiwan@moratelindo.co.id
 */

class Apps {

    public function __construct()
    {
        // Instantiate the CI libraries so we can work with them
        $this->ci =& get_instance();
        $this->ci->load->model('Administration_model', 'm_user');

        // Cookie from Single Sign On Application
	if(isset($_COOKIE['SSOID']))
	{
        $cookie = base64_decode($_COOKIE['SSOID']);
        $crop   = explode('+', $cookie);
        $email  = explode('@', $crop[1]);

        $this->userId       = $crop[0];
        $this->userEmail    = $crop[1];
        $this->userFullname = $crop[2];
        $this->userName     = $email[0];
	}
    }

    public function getProject()
    {
        $this->ci =& get_instance();
        $this->ci->load->model('Planning_model', 'm_plan');
        $userRole =  $this->ci->m_user->getUserRole($this->userId);
        if($userRole[0]=='1'){
            //For System Administrator
            $projects = $this->ci->m_plan->getAllProject();
        }else{
            $projects = $this->ci->m_plan->getAllProjectByUser();
        }

        return $projects;
    }

    public function getuserPermission(){
        $userRole =  $this->ci->m_user->getUserRole($this->userId);
        // $permission = $this->ci->m_user->getPermissionbyRole($this->userRole[0]);
        $permission = $this->ci->m_user->getUserPermissionIndex($userRole[2],$userRole[0]);
        return $permission;
    }

    public function check($permission){
        $userRole =  $this->ci->m_user->getUserRole($this->userId);
        // $role_permission = $this->ci->m_user->getPermissionbyRole($this->userRole[0]);
        $role_permission = $this->ci->m_user->getUserPermissionIndex($userRole[2],$userRole[0]);
        if(isset($role_permission[$permission])){
            return true;
        } else {
            return false;
        }
    }

    public function info()
    {
        $data['apps_brand']         = 'Project';
        $data['apps_name']          = 'Project Management';
        $data['apps_company']       = 'PT. Mora Telematika Indonesia';
        $data['apps_company_brand'] = 'Moratelindo';

        // Get Data SSO
        $data['apps_user_id']       = $this->userId;
        $data['apps_user_name']     = $this->userName;
        $data['apps_user_email']    = $this->userEmail;
        $data['apps_user_fullname'] = $this->userFullname;


        // Get Data API HRIS
        $json = file_get_contents('http://morahrd.moratelindo.co.id/karyawan/index.php/employeeRestserver/employee/id/'.$this->userId);
        $obj = json_decode($json);

        $data['obj_employee_id']    = $obj->employee_id;
        $data['obj_employee_no']    = $obj->employee_no;
        $data['obj_fullname']       = $obj->fullname;
        $data['obj_photo']          = $obj->photo;
        $data['obj_position_title'] = $obj->position_title;
        $data['obj_level']          = $obj->level;
        $data['obj_grade']          = $obj->grade;
        $data['obj_department']     = $obj->department;
        $data['obj_location']       = $obj->location;

        //Get Data Project Management
        $data['userRole']       = $this->ci->m_user->getUserRole($this->userId);
        if(!empty($data['userRole'])){
            $data['projects']           = $this->getProject();
            $data['userPermission']     = $this->getuserPermission();
            $data['allProject']         = $this->ci->m_user->allProjectAccess($data['userRole'][2]);
        }
        return $data;
    }

    public function getYearsInGroup($employee_status, $join_date, $termination_date)
    {
        //TODO: Calculate Years in Group - Employee Information
        if ($employee_status == 0) {
            $today = strtotime($termination_date);
        } else {
            $today = strtotime(date('Y-m-d'));
        }
        $joindate = strtotime($join_date);

        if ($joindate != null) {
            $timeDiff = abs($today - $joindate);
            $numberDays = intval($timeDiff / 86400);  // 86400 seconds in one day AND you might want to convert to integer

            if ($numberDays > 365) {
                $year = intval($numberDays / 365);

                $modulo_year = intval($numberDays % 365);
                $month = round($modulo_year / 30);

                $day = intval($modulo_year % 30);
            } else {
                $year = 0;
                $month = round($numberDays / 30);
                $day = intval($numberDays % 30);
            }

            $YiG = $year . ' Year ' . $month . ' Month ' . $day . ' Day';
        } else {
            $YiG = 'N/A';
        }

        return $YiG;
    }

    public function time_elapsed_string($ptime)
    {
        $etime = time() - $ptime;

        if ($etime < 1)
        {
            return '0 seconds';
        }

        $a = array( 365 * 24 * 60 * 60  =>  'year',
            30 * 24 * 60 * 60  =>  'month',
            24 * 60 * 60  =>  'day',
            60 * 60  =>  'hour',
            60  =>  'minute',
            1  =>  'second'
        );
        $a_plural = array( 'year'   => 'years',
            'month'  => 'months',
            'day'    => 'days',
            'hour'   => 'hours',
            'minute' => 'minutes',
            'second' => 'seconds'
        );

        foreach ($a as $secs => $str)
        {
            $d = $etime / $secs;
            if ($d >= 1)
            {
                $r = round($d);
                return $r . ' ' . ($r > 1 ? $a_plural[$str] : $str) . ' ago';
            }
        }
    }

    function getWorkingDays($startDate, $endDate)
    {
        $begin = strtotime($startDate);
        $end   = strtotime($endDate);
        if ($begin > $end) {

            return 0;
        } else {
            $no_days  = 0;
            while ($begin <= $end) {
                $what_day = date("N", $begin);
                if (!in_array($what_day, array(6,7)) ) // 6 and 7 are weekend
                    $no_days++;
                $begin += 86400; // +1 day
            };

            return $no_days;
        }
    }

    

    /*
    public function menu()
    {
        // Get Current Url
        $controller = $this->ci->uri->segment(1);
        $method = $this->ci->uri->segment(2);

        // Get Role Id
        $user = $this->ci->m_user->get_user_by_employee_id($this->userId);
        $role_id = $user->role_id;

        // Generate Menu Sidebar
        $menuLev1 = $this->ci->m_module->get_menu_by_role_id($role_id);
        $genMenu = '';
        foreach ($menuLev1 as $row) {
            // for Active Menu level 1
            $group_menu1 = explode(';', $row->group_link);
            if ($group_menu1[0] == $controller || $group_menu1[0] == 'ess') {
                $cls_L1 = 'active';
            } else {
                $cls_L1 = '';
            }

            if ($row->is_link == '1') {
                $icon_arrow1 = '';
            } else {
                $icon_arrow1 = '<span class="fa arrow"></span>';
            }

            $genMenu .= '<li class="' . $cls_L1 . '">';
            $genMenu .= '<a href="' . base_url() . $row->module_url . '"><i class="' . $row->menu_icon . '"></i> <span class="nav-label">' . $row->menu_name . '</span> '.$icon_arrow1.'</a>';

            //TODO: Menu level 2
            $level_2 = 2;
            $menuLev2 = $this->ci->m_module->get_submenu_by_level($row->module_id, $level_2);
            if (isset($menuLev2) && !empty($menuLev2)) {
                $genMenu .= '<ul class="nav nav-second-level">';
                foreach ($menuLev2 as $raw) {

                    // for Active Menu level 2
                    $group_menu2 = explode(';', $raw->group_link);
                    if ($group_menu2[0] == $method) {
                        $cls_L2 = 'active';
                    } else {
                        $cls_L2 = '';
                    }

                    if ($raw->is_link == '1') {
                        $icon_arrow2 = '';
                    } else {
                        $icon_arrow2 = '<span class="fa arrow"></span>';
                    }

                    $genMenu .= '<li class="' . $cls_L2 . '">';
                    $genMenu .= '<a href="' . base_url() . $raw->module_url . '" >' . $raw->menu_name . ' '.$icon_arrow2.'</a>';

                    //TODO: Menu level 3
                    $level_3 = 3;
                    $menuLev3 = $this->ci->m_module->get_submenu_by_level($raw->module_id, $level_3);
                    if (isset($menuLev3) && !empty($menuLev3)) {
                        $genMenu .= '<ul class="nav nav-third-level">';
                        foreach ($menuLev3 as $rec) {

                            // for Active Menu level 3
                            $group_menu3 = explode(';', $rec->group_link);
                            if ($group_menu3[0] == $method) {
                                $cls_L3 = 'active';
                            } else {
                                $cls_L3 = '';
                            }

                            $genMenu .= '<li class="' . $cls_L3 . '">';
                            $genMenu .= '<a href="' . base_url() . $rec->module_url . '" >' . $rec->menu_name . '</a>';


                            $genMenu .= '</li >';
                        }
                        $genMenu .= '</ul>';
                    }


                    $genMenu .= '</li >';
                }
                $genMenu .= '</ul>';
            }

            $genMenu .= '</li >';
        }
        $data = $genMenu;

        return $data;
    }
    */


}

/* End of file Apps.php */
/* Location: ./application/libraries/Apps.php */
