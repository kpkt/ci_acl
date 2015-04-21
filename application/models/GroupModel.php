<?php

class GroupModel extends CI_Model {

    public function __construct() {
        $this->load->database();
    }

    /**
     * exists group
     * @return void
     * @desc This function use for checking whether data exists or not
     */
    public function exists($group_id) {
        $this->db->where('group_id', $group_id);
        $Q = $this->db->get('groups');
        if ($Q->num_rows() > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    /**
     * senarai group
     * @return void
     * @desc This function use for checking whether data exists or not
     */
    public function listing() {
        $Q = $this->db->get('groups');
        if ($Q->num_rows() > 0) {
            return $Q->result_array();
        }
    }

    /**
     * insert new data
     * @return void
     */
    public function create($data) {
        $this->db->set('created', date("Y-m-d H:i:s")); //set datetime for created
        $this->db->set('modified', date("Y-m-d H:i:s")); //set datetime for modified
        $this->db->insert('groups', $data);
        $group_id = $this->db->insert_id();
        $this->__create_aros($group_id);
    }

    /**
     * insert new data
     * @return void
     * @desc everytime when insert new groups, id groups will create in ARO's
     */
    public function __create_aros($group_id) {
        $array = array(
            //'parent_id' => "NULL",
            'model' => "Group",
            'foreign_key' => $group_id
        );
        $this->db->set($array);
        $this->db->insert('aros');
    }

    /**
     * read exist data     
     * @param int group_id 
     * @return void
     */
    public function read($group_id) {
        $this->db->where('group_id', $group_id);
        $Q = $this->db->get('groups');
        if ($Q->num_rows() > 0) {
            return $Q->row_array();
        }
    }

    /**
     * modified exist data     
     * @param int group_id 
     * @return void
     */
    public function modified($data) {
        $this->db->where('group_id', $data['group_id']);
        $this->db->set('modified', date("Y-m-d H:i:s"));  //set datetime for modified
        $this->db->update('groups', $data);
    }

    /**
     * delete  exist data      
     * @param int group_id
     */
    public function delete($group_id) {
        $this->db->where('group_id', $group_id);
        $this->db->delete('groups');
        return TRUE;
    }

    /*     * **************Aditional Function**************** */

    /**
     * dropdown_list method     
     * @return void
     */
    public function multiple_select() {
        $groups = $this->listing();
        $group_id = array();
        $group_name = array();
        foreach ($groups as $group) {
            array_push($group_id, $group['group_id']);
            array_push($group_name, $group['name']);
        }
        return $group_list = array_combine($group_id, $group_name);
    }

}
