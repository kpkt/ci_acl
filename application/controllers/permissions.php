<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Permissions extends CI_Controller {

    public $aliasControllerName = "Controller";
    public $modelControllerName = "controller";
    public $modelMethodName = "action";

    /**
     * __construct method     
     * @return void
     */
    public function __construct() {
        parent::__construct();
        $this->load->model('GroupModel');
    }

    /**
     * index method     
     * @return void
     */
    public function index() {
        $data['groups'] = $this->__exist_groups();
        $data['aros'] = $this->__exist_aros();
        $data['acos'] = $this->__exist_acos();
        $data['permssions'] = $this->__exist_arosacos();

        $data['main'] = 'permissions/index';
        $this->load->view('layouts/default', $data);
    }

    /**
     * build aros method     
     * @return void
     */
    public function build_aros() {
        $data = '';
        $groups = $this->GroupModel->listing();
        if ($groups) {
            foreach ($groups as $key => $group) :
                $data[$key]['model'] = "Group";
                $data[$key]['foreign_key'] = $group['group_id'];
            endforeach;
            $this->db->truncate('aros');  //Generates a truncate SQL string and runs the query so that id auto increment start from first
            $this->db->insert_batch('aros', $data);
            $this->session->set_flashdata('item', array('message' => 'Build Aro\'s Successful', 'class' => 'success')); //danger or success            
            redirect('permissions/index'); // back to the index
        }else {
            if (!$groups) {
                $this->session->set_flashdata('item', array('message' => 'Groups Empty', 'class' => 'danger')); //danger or success            
            } else {
                $this->session->set_flashdata('item', array('message' => 'Build Aro\'s Error', 'class' => 'danger')); //danger or success            
            }
            redirect('permissions/index'); // back to the index
        }
    }

    /**
     * build acos method     
     * @return void
     */
    public function build_acos() {
        $controllers = $this->controllerlist->getControllers();
        $methos = $this->controllerlist->getMethods();
        #1 -Generates a truncate SQL string and runs the query so that id auto increment start from first 
        $this->db->truncate('acos');

        #2 - Set 1st data with alias=>Controller
        $controllers_parent = array('model' => " ", 'alias' => "$this->aliasControllerName");
        $this->db->set($controllers_parent);
        $this->db->insert('acos');

        #3 - Get id for alias=>Controller
        $acosParentData = $this->__first_acos($this->aliasControllerName);

        #3 - Save Controller
        foreach ($controllers as $keyC => $valueC) {
            $controllerName = ucwords($valueC);
            #3.1 - Save Controller as Parent
            $controllersData = array('parent_id' => $acosParentData['id'], 'model' => $this->modelControllerName, 'alias' => $controllerName);
            $this->db->set($controllersData);
            $this->db->insert('acos');
            #3.2 - Get id Parent Controller
            $acosControllerData = $this->__first_acos($controllerName);
            foreach ($methos[$keyC] as $keyM => $valueM) {
                #3.3 - Save method(action) child of the controller
                $methodData = array('parent_id' => $acosControllerData['id'], 'model' => $this->modelMethodName, 'alias' => $valueM);
                $this->db->set($methodData);
                $this->db->insert('acos');
            }
        }
        $this->session->set_flashdata('item', array('message' => 'Build Aco\'s Successful', 'class' => 'success')); //danger or success            
        redirect('permissions/index'); // back to the index
    }

    /**
     * build permission method     
     * @return void
     */
    public function build_permission() {
        $aros = $this->__listing_aros();
        $acos = $this->__listing_acos();
        if (!empty($aros) && !empty($acos)) {
            $this->db->truncate('aros_acos');
            foreach ($aros as $keyr => $aro) :
                foreach ($acos as $keyc => $aco) :
                    $this->db->set('aro_id', $aro['id']);
                    $this->db->set('aco_id', $aco['id']);
                    $this->db->set('alias', $aco['model']);
                    if ($aro['foreign_key'] == 1) {
                        $this->db->set('status', 1);
                    } else {
                        $this->db->set('status', 0);
                    }
                    $this->db->insert('aros_acos');
                endforeach;
            endforeach;
        }
    }

    /**
     * build aros method     
     * @return void
     */
    public function group_permission() {
        $data['groups'] = $this->__group_aros();
        $data['acos'] = $this->__listing_acos();
        $data['arosacos'] = $this->__listing_permission();
        //echo "<pre>";print_r($data['acos']);
        $data['permission'] = $this->__listing_permission();
        $data['main'] = 'permissions/group_permission';
        $this->load->view('layouts/default', $data);
    }

    /*
     * ajax_permission
     */

    public function ajax_permission() {
        $data = array(
            'id' => $this->input->post('id'),
            'status' => $this->input->post('status')
        );
        if ($data['status'] == 'allow') {
            $stat = 1;
        } else {
            $stat = 0;
        }
        $this->db->where('id', $data['id']);
        $this->db->set('status', $stat);  //set datetime for modified
        $this->db->update('aros_acos');
        $result = array(
            'status' => $data['status'],
            'message' => 'The type has been saved',
            'id' => $data['id']
        );
        echo json_encode($result);
    }

    /**
     * Join Group and aros
     * @return void
     */
    private function __group_aros() {
        $this->db->join('groups', 'groups.group_id = aros.foreign_key');
        $Q = $this->db->get('aros');
        if ($Q->num_rows() > 0) {
            return $Q->result_array();
        }
    }

    /**
     * exist aros_acos method     
     * @return void
     */
    private function __exist_arosacos() {
        $Q = $this->db->get('aros_acos');
        if ($Q->num_rows() > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }
    
    /**
     * exist aros method     
     * @return void
     */
    private function __exist_aros() {
        $Q = $this->db->get('aros');
        if ($Q->num_rows() > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    /**
     * exist aros method     
     * @return void
     */
    private function __exist_acos() {
        $Q = $this->db->get('acos');
        if ($Q->num_rows() > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    /**
     * exist aros method     
     * @return void
     */
    private function __exist_groups() {
        $Q = $this->db->get('groups');
        if ($Q->num_rows() > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    /**
     * exist aros_acos method     
     * @return void
     */
    private function __listing_permission() {
        $Q = $this->db->get('aros_acos');
        if ($Q->num_rows() > 0) {
            return $Q->result_array();
        }
    }

    /**
     * listing aros method     
     * @return void
     */
    private function __listing_aros() {
        $Q = $this->db->get('aros');
        if ($Q->num_rows() > 0) {
            return $Q->result_array();
        }
    }

    /**
     * listing acos method     
     * @return void
     */
    private function __listing_acos() {
        $Q = $this->db->get('acos');
        if ($Q->num_rows() > 0) {
            return $Q->result_array();
        }
    }

    /**
     * first acos record
     * @return void
     * @desc This function use for checking whether data exists or not
     */
    private function __first_acos($where) {
        $this->db->where('alias', $where);
        $Q = $this->db->get('acos');
        if ($Q->num_rows() > 0) {
            return $Q->row_array();
        }
    }

}
