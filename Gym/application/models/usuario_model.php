<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * 
 */
class Usuario_model extends CI_Model {
	
	public function __construct() {
		parent::__construct();
	}

	function nuevousuario($nombre,$nombreus,$fechain,$fechafin,$clave,$paquete,$membresia)
	{
		$sql="INSERT INTO usuario VALUES(null,'".$nombre."','".$nombreus."','".$fechain."','".$fechafin."','".$clave."',1,'".$paquete."',".$membresia.")";
		$this->db->query($sql);
	}

	public function actualizarfecha($id,$fecha)
    {
    	$sql="UPDATE usuario set estado=1,fecha_fin='".$fecha."' WHERE id=".$id."";
    	$this->db->query($sql);
    }

	function eliminarusuario($id)
	{
        $sql="DELETE FROM usuario where id=".$id."";
        $this->db->query($sql);
	}

	function comprobarclave($clave)
	{
		$sql=$this->db->query("SELECT * FROM usuario WHERE clave='".$clave."'");
		if($sql->num_rows()>0)
		{
          return true;
		}else
		{
			return false;
		}
	}

	public function listar($buscar,$inicio = FALSE, $cantidadregistro = FALSE,$estado= FALSE)
	{
		
		$this->db->like("nombre",$buscar);

		if ($inicio !== FALSE && $cantidadregistro !== FALSE) {
			$this->db->limit($cantidadregistro,$inicio);

		}
		
		$this->db->where('estado',1);
		$this->db->order_by("id","desc");
		$consulta = $this->db->get("usuario");
          
		return $consulta->result();
	}
	public function listardeudores($buscar,$inicio = FALSE, $cantidadregistro = FALSE,$estado= FALSE)
	{
		
		$this->db->like("nombre",$buscar);

		if ($inicio !== FALSE && $cantidadregistro !== FALSE) {
			$this->db->limit($cantidadregistro,$inicio);

		}
		
		$this->db->where('estado',0);
		$consulta = $this->db->get("usuario");
          
		return $consulta->result();
	}

	function totoaldiasas($año,$mes,$dia,$id)
	{
		$query=$this->db->query("SELECT count(*) as total FROM  asistencia  where id_us=".$id." and fech_asist BETWEEN  '".$año."/".$mes."/01' and '".$año."/".$mes."/".$dia."'");
		if($query->num_rows()>0)
		{
             return $query->row();
		}else{
             return  $query->NULL;
		}
	}
}	