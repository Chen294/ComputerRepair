<?php

class User {
    private $_db;
    private $_config;

    /**
     * @param Database $db
     * @param array $config sysconfig in config.php
     */
    public function __construct($db, $conf){
        $this->_db = $db;
        $this->_conf = $conf;
    }

    /**
     * @param string $uid
     * @return mixed false when not exist
     */
    public function getIsReg($uid){
        $response = $this->_db->select($this->_conf['user_table'], 
                                       $this->_conf['uid'],
                                       $uid);
        return $response;
    }

    /**
     * @param string $uid
     * @return int -1 when not exist, array when found
     */
    public function getStaffId($uid){
        $response = $this->_db->select($this->_conf['staff_table'], 
                                       $this->_conf['uid'],
                                       $uid);
        return ($response == false) ? -1 : $response[0]['staff_id'];
    }
    
    /**
     * @param string $uid
     * @param array result
     * @return array result
     */
    public function addUser($uid, $data){
        $response = $this->_db->insert($this->_conf['user_table'], 
                                       "ucid",
                                       array("realname"=>$data["name"], "phone"=>$data["phone"], "vip"=>$data["vip"], "register_time"=>time()),
                                       $uid
                                       );
        return $response;
        
    }
    
}
