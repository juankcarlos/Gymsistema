<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Usuario_Controller extends CI_Controller {

	function __construct()
	{
		parent::__construct();
	  $this->load->model('usuario_model');
	   //cargamos la libreria html2pdf
    $this->load->library('html2pdf');
        
  }
      //vista para añadir un nuevo usuario
     function agregarus()
     {
        if($this->session->userdata("activo"))
         {  
     	      $this->load->view('admincontenido/headadmin');
     	      $this->load->view('admincontenido/anadirnuevousuario');
          }else{
            redirect(base_url()."login_controller");
          }
     }
     
     //metodo para añadir un usuario
     function addus()
     {
      
     	$nombre=$this->input->post('nombre');
     	$nombreus=$this->input->post('nombre_usuario');
     	$fechain=$this->input->post('min');
     	$fechafin=$this->input->post('mfin');
     	$clave=$this->input->post('clave');
      $paquete=$this->input->post('paquete');
      $membresia=$this->input->post('membresia');
      $precio=$this->input->post('precio');
     	$this->form_validation->set_rules('nombre','Nombre de Usuario','required');
     	$this->form_validation->set_rules('nombre_usuario','Nombre de Usuario','required');
     	$this->form_validation->set_rules('min','fecha de inicio','required');
     	$this->form_validation->set_rules('mfin','fecha de fin de membresia','required');
     	$this->form_validation->set_rules('clave','Clave','required');
      $this->form_validation->set_rules('precio','Pago de membresia','required');
     	$this->form_validation->set_message('required','El campo %s es obligatorio');
      if( $this->form_validation->run()==FALSE)
    	{
    		  $this->load->view('admincontenido/headadmin');
     	    $this->load->view('admincontenido/anadirnuevousuario');
    	}else{
    		 //si la clave existe no se permitira registrar el nuevo usuario
         if(!$this->usuario_model->comprobarclave($clave))
            { 
            
    		     //se inserta el nuevo usuario en  la base de datos pasando los parametro al modelo
             $this->usuario_model->nuevousuario($nombre,$nombreus,$fechain,$fechafin,$clave,$paquete,$membresia);
    		     //se genera el pdf  como comprobante pasando los siguientes parametros
             $this->generarpdfarg($nombre,$fechafin,$clave,$paquete,$membresia,$precio);
              redirect(base_url()."usuario_controller/agregarus");
             }else{
                 $this->session->set_flashdata('mser','La clave de usuario que quiere asignar ya existe');
                redirect(base_url()."usuario_controller/agregarus");
           }
    	}
     }
  //metodo para eliminar usuario 
  function eliminarusuarios()
  {
    if($this->input->is_ajax_request())
    {
       $id=$this->input->post('id');
       $this->usuario_model->eliminarusuario($id);
    }
  }
  //metodo para mostrar la vista de los usuarios
  function listausuarios()
  {
    if($this->session->userdata("activo"))
    { 
      $this->load->view('admincontenido/headadmin');
      $this->load->view('admincontenido/vistausuarios');
    }else{
            redirect(base_url()."login_controller");
    }  
  
  }
  //metodo para mostrar la vista los usuarios deudores
  function listausuariosdeudores()
  {
    if($this->session->userdata("activo"))
    { 
       $this->load->view('admincontenido/headadmin');
       $this->load->view('admincontenido/vistausuariosdeudores');
    }else{
            redirect(base_url()."login_controller");
    }     
  }

/*metodo que recibe datos por peticion ajax de lusuarios.js
  o lusuriosdeudores.js  y recibe como parametro  lo que
  se esta buscando el nmdepagina en el que actualmente se encuentra e usuario
   y  el estado
*/
  function listarus()
  {
    $b=$this->input->post("buscar");
    $numpagina=$this->input->post("nropagina");
    $cantidad=3;
    $estado=$this->input->post("estado");
    $inicio=($numpagina-1)*$cantidad;
    /*si estado es uno significa que es un usuario y no un usuario deudor
      por lo tanto cargara la accion de listrar de usuario_model en caso
      contrario es un usuario deudor y cargara la a accion de usuariodeudor
    */
    if($estado==1)
    {
    
      $data=array(
          'lsus'=>$this->usuario_model->listar($b,$inicio,$cantidad,$estado),
          'totalregistros'=>count($this->usuario_model->listar($b)),
          'cantidad'=>$cantidad,  
         );
     }else if($estado==0)
     {
          $data=array(
           'lsus'=>$this->usuario_model->listardeudores($b,$inicio,$cantidad,$estado),
            'totalregistros'=>count($this->usuario_model->listardeudores($b)),
            'cantidad'=>$cantidad,  
           );
     }
     //la respuesta sera un array y se devuelve en formato json
     echo json_encode($data);
  }

  function totalasis()
  {
     $id=$this->input->post('id');   
     $año=$this->input->post('sa');
     $mes=$this->input->post('sm');
     if($this->input->post('tpf')=='us') 
     {
      //se obtiene el total de dias
     $dias=$this->totaldias($mes,$año,$id);
     //se pasa como parametro el año mes y  dia y el id de usuario
     if($this->usuario_model->totoaldiasas($año,$mes,$dias,$id))
     {  
         //se toma la cantidad total de dias que devuelve  totoaldiasas
         $d=$this->usuario_model->totoaldiasas($año,$mes,$dias,$id);
          //se asigna el total a una variable de session y se redirige la vista
          $datos=array('s'=>$d->total);
          $this->session->set_flashdata('modals','ms');
          $this->session->set_userdata($datos);
          redirect(base_url()."usuario_controller/listausuarios");
     }
    }else
    {
      //se obtiene el total de dias
      $dias=$this->totaldias($mes,$año,$id);
      //se pasa como parametro el año mes y  dia y el id de usuario
     if($this->usuario_model->totoaldiasas($año,$mes,$dias,$id))
     {    //se toma la cantidad total de dias que devuelve  totoaldiasas
          $d=$this->usuario_model->totoaldiasas($año,$mes,$dias,$id);
          //se asigna el total a una variable de session y se redirige la vista
          $datos=array('s'=>$d->total);
          $this->session->set_flashdata('modals','ms');
          $this->session->set_userdata($datos);
          redirect(base_url()."usuario_controller/listausuariosdeudores");
     }
     
    }
   }

  
  /*metodo para leer cuantos dias tiene un mes 
    pasando como parametros año y mes retorna
    el total de dias de ese mes 
  */
  private function totaldias($Month,$Year)
  {
    return date("d",mktime(0,0,0,$Month+1,0,$Year));
  }

//se genera el pdf con los atributos dados
   function generarpdfarg($nombre,$fechafin,$clave,$paquete,$membresia,$precio)
  {
      $this->html2pdf->folder('./files/pdfs/');
      $this->html2pdf->filename('test.pdf');
      $this->html2pdf->paper('a4', 'portrait');  
       $data ['ls']= array(
            'clave'=>$clave,
            'nombre'=>$nombre,
            'fecha' => $fechafin,
            'monto' =>$precio,
            'membresia'=>$membresia,
            'paquete' =>$paquete,
        );

         $this->html2pdf->html(utf8_decode($this->load->view('admincontenido/vistapdf', $data, true)));
        if($this->html2pdf->create('save'))
          {
                $this->show($clave);
          }
  }

//se genera un pdf con los atributos que vienen pasados por post  en un formulario
function generarpdf()
  {
   
      $this->html2pdf->folder('./files/pdfs/');
      $this->html2pdf->filename('test.pdf');
      $this->html2pdf->paper('a4', 'portrait');      
     $data ['ls']= array(
            'clave'=>$this->input->post('clave'),
            'nombre'=>$this->input->post('nombre'),
            'fecha' => $this->input->post('mfecha'),
            'monto' =>$this->input->post('monto'),
            'membresia'=>$this->input->post('tipom'),
            'paquete' =>$this->input->post('paquete'),
        );
        $this->usuario_model->actualizarfecha($this->input->post('id'),$this->input->post('mfecha'));
        $this->html2pdf->html(utf8_decode($this->load->view('admincontenido/vistapdf', $data, true)));
        if($this->html2pdf->create('save'))
          {
                $this->show($this->input->post('clave'));
          }
          
}

//se carga el pdf para ser descargado
public function show($clave)
{
        if(is_dir("./files/pdfs"))
        {
            $filename = "test.pdf";
            $route = base_url("files/pdfs/test.pdf");
            if(file_exists("./files/pdfs/".$filename))
            {
                header('Content-type: application/pdf');
                header("Content-Disposition:attachment; filename='comprobante ".$clave."-".date("Y-m-d H:i:s").".pdf");
                readfile($route);
            }
        }

}

}

