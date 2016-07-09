<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login_Controller extends CI_Controller {

	function __construct()
	{
		 parent::__construct();
		 //se carga login_model ubicado en /application/models
     $this->load->model('login_model');
	}
//funcion que carga la vista principal o de bienvenida de administradores
function index()
{
    $this->load->view("indexcontenido/header");
	  $this->load->view("indexcontenido/index");
} 

/*
  funcion que recibe por parametro una opcion
  para determinar si es un usuario o  administrador
  y ejecutar las acciones de autentificacion
*/
function tipo()
{
	$nombre=$this->input->post('nom');
	$pass=$this->input->post('pas');
	$this->form_validation->set_rules('nom', 'nombre', 'required');
	$this->form_validation->set_rules('pas', 'password', 'required');
	$this->form_validation->set_message('required','El campo %s  no puede estar vacio');
	if($this->form_validation->run() == FALSE)
	{
	  $this->index();
  	}else{
  		switch ($this->input->post('opciones')) {
			case '0':
			 	$this->autus($nombre,$pass);
				break;
		
			default:
			 $this->autadmin($nombre,$pass);
			break;
		}
   }

}
function autus($nomus,$pass)
{
      /*if que verifica si existe el nombre de usuario y la clave
        en caso de no exxistir devuelve un falce
      */
    if($this->login_model->logus($nomus,$pass))
    {
      /*Se verifica el estado del usuario si su estado es  0 (desabilitado) devuelve null en caso
        contrario nos devuelve un objeto con sus atributos
      */  
      $verificar=$this->login_model->estadoaut($nomus,$pass);
    	if($verificar!=NULL)
    	{
             $data=array(
                'fech_asist'=>date("Y-m-d"),
                'id_us'=>$verificar->id,
                );
         /* se verifica la asistencia tomando el id del usuario y la fecha actual
            si el usuario ya tiene una asistencia no se permitira registrarla y 
            se mostrara un mensaje
         */  
       if($this->login_model->verificarasistencia($verificar->id,date("Y-m-d")))
        {
    		  /*se verifica que la fehca aun este vigen comparando la fecha actual con 
            la fehca de termino de membresia en caso contrario se despliega un mensaje
            haciendo sabel al usuario que termino su fecha
          */
          if($this->login_model->verificarfecha($nomus,$pass,date("Y-m-d"),$verificar->fecha_fin))
    		  {
                //para el registro de asistencia se pasa un array con los datos
    			      $this->login_model->tomarasistencia($data);
                $this->session->set_flashdata("mss","Su asistencia a sido registrada con exito bienvenido :)");  
                redirect(base_url()."login_controller");
    			
    		    }else
    	         	{
    			       $this->session->set_flashdata("mwrexp","Su membrecia a expirado comuniquese con el administrador");	
    			       //metodo en model que cambia el estado de usuario a 0(desabilitado)  por el termino de su membresia
                 $this->login_model->cambiarestado($nomus,$pass);
    			       redirect(base_url()."login_controller");
    		      }
          }else{
            $this->session->set_flashdata("mwr","Usted ya tomo asistencia por este dia");    
            redirect(base_url()."login_controller");
            
         }
    	}else
    	{
    		      $this->session->set_flashdata("mwrexp","Su membrecia a expirado comuniquese con el administrador");    
                  redirect(base_url()."login_controller");
    	}
    }else{
    	$this->session->set_flashdata("mer","El nombre de Usuario o Contraseña son incorrectos");
    	redirect(base_url()."login_controller");
    }
}

//metodo para loguearse como administrador
function autadmin($nomus,$pass)
{
    $admin=$this->login_model->logadmin($nomus,$pass);
   if($admin!= NULL)
   {
        $datos=array(
          "nombreadmin"=>$admin->nombre_admin,
          "nombre" => $admin->nombre,
          "rol"=>$admin->rol,
          "activo"=>TRUE
          );
        /*
          se llama al procedimiento almacenado que evalua los 
          registros  y compara sus fechas si  han expirado
          desabilita a los usuarios con fehcas expiradas cambia
          su estado a 0 (desabilitado)
        */
        $this->db->query("CALL actualizarestado()");
        $this->session->set_userdata($datos);
       redirect(base_url()."admin_controller");
   }else
   {
     $this->session->set_flashdata("mer","El nombre de Usuario o Contraseña son incorrectos");
      redirect(base_url()."login_controller");
   }
}

 //metodo para cerrar una session iniciada 
 function cerrarsession()
 {
  $this->session->sess_destroy();
  redirect(base_url()."login_controller");
 } 

}