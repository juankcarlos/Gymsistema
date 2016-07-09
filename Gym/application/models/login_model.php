<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * 
 */
class Login_model extends CI_Model {
	
	public function __construct() {
		parent::__construct();
	}

    //inicio de metodos para funcionalidad de usuario
	 function logus($nom,$pass)
	{
		$con = $this->db->query("SELECT * FROM usuario where nombre_us='".$nom."' AND clave='".$pass."'");
		if($con->num_rows()>0)
		{
			return true;
		}else
		{
			return false;
		}

	}

	function  verificarfecha($nom,$pass,$fecha,$fecha_fin)
	{
		$con=$this->db->query("SELECT * FROM usuario where nombre_us='".$nom."' AND clave='".$pass."' AND fecha_fin  BETWEEN '".$fecha."' and '".$fecha_fin."'");
		if($con->num_rows()>0)
		{
			return  true;
		}else
		{
			return false;
		}
	}

	function estadoaut($nom,$pass)
	{
		$con = $this->db->query("SELECT * FROM usuario where nombre_us='".$nom."' AND clave='".$pass."' AND estado=1");
		if($con->num_rows()>0)
		{
			return $con->row();
		}else
		{
			return NULL;
		}

	}

	function verificarasistencia($id_us,$fecha)
	{
		$con = $this->db->query("SELECT * FROM asistencia where id_us='".$id_us."' AND fech_asist ='".$fecha."'");
		if($con->num_rows()>0)
		{
           return false;
		}else
		{
			return true;
		}
	}

	function cambiarestado($nom,$pass)
	{
		$con = $this->db->query("UPDATE usuario set estado=0 where nombre_us='".$nom."' AND clave='".$pass."'");

	}

	function tomarasistencia($data)
	{
		 $this->db->insert("asistencia",$data);
	}
	//fin de metodos para funcionalidad de usuario

	//incio metodo para funcionalidad admin
	function logadmin($nombre,$pass)
	{
		$query = $this->db->query("SELECT id_admin,nombre,nombre_admin,rol FROM admin where nombre_admin='".$nombre."' AND pass='".$pass."'");
		if($query->num_rows()>0)
		{
			return $query->row();
		}else{
			return NULL;
		}
	}
}