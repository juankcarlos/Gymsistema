<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_Controller extends CI_Controller {

	function __construct()
	{
		 parent::__construct();
		 //se carga el modelo admin
     $this->load->model('admin_model');
	}

   //metodo que carga la vista principal del administrador
  function index()
  {
  	 if($this->session->userdata("activo"))
  	 {
        $this->load->view('admincontenido/headadmin'); 
        $this->load->view('admincontenido/panelindexadmin'); 
        
  	 }else
  	 {
  	 	redirect(base_url()."login_controller");
  	 }
  }
   
  //metodo que obtiene todos los administradores y los muestra en la lista 
  function veradmin()
  {
      if($this->session->userdata("activo"))
     {
        $data['ls'] = $this->admin_model->alladim();
       $this->load->view('admincontenido/headadmin');
       $this->load->view('admincontenido/listaadmins',$data);
        
     }else
     {
       redirect(base_url()."login_controller");
    }
        

  }
  //metodo que recibe un id por ajax para eliminar un usuario
  function eliminarad()
  {
    $id=$this->input->post('id');
    $this->admin_model->eliminarad($id);
    echo "exito";
  }

//metodo para agregar a un nuevo administrador
  function agregaradmin()
  {
    if($this->session->userdata("activo"))
    {
      $nombre=$this->input->post('nombre');
      $nombreus=$this->input->post('nombre_usuario');
      $pass=$this->input->post('pass');
      $this->form_validation->set_rules('nombre','Nombre','required');
      $this->form_validation->set_rules('nombre_usuario','Nombre de Usuario','required');
      $this->form_validation->set_rules('pass','Contraseña','required');
      $this->form_validation->set_message('required','El campo  %s no puede estar vacio');
      if( $this->form_validation->run()==FALSE)
      {

        $this->load->view('admincontenido/headadmin');
        $this->load->view('admincontenido/anadirnuevoadmin');
      
      }else{
        
          $this->session->set_flashdata('mss','El nuevo Administrador a sido Agragado con exito');
          $this->admin_model->addadmin($nombre,$nombreus,$pass);
          redirect(base_url()."admin_controller/agregaradmin");
      }
    
    }else{
       redirect(base_url()."login_controller");
    }
  
  }


}	

