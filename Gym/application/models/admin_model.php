<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * 
 */
class Admin_model extends CI_Model {
	
	public function __construct() {
		parent::__construct();
	}

  function alladim()
  {
    $sql=$this->db->query("SELECT * FROM admin WHERE rol=0");
    if($sql->num_rows()>0)
    {
     return $sql->result();
    }else{
      return NULL;
    }
  }
  function eliminarad($id)
  {
    $this->db->query("DELETE FROM admin WHERE id_admin='".$id."'");
  }

  function addadmin($nombre,$nombreus,$pas)
  {
    $this->db->query("INSERT INTO admin VALUES(null,'".$nombre."','".$nombreus."','".$pas."',0)");
  }
}