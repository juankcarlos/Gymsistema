<!-- vista que sirve como cabecera para el resto de las vistas en el panel de administrador-->   
<html>
<head>
  <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/bootstrap.css">
  <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/datepicker.css">
  <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/alerts/sweetalert.css">
  <link href="<?php echo  base_url();?>assets/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
  <script type="text/javascript" src="<?php echo base_url();?>assets/js/jquery-1.11.3.min.js
  "></script>
  <script type="text/javascript" src="<?php echo base_url();?>assets/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url();?>assets/js/bootstrap-datepicker.js"></script>
  <script type="text/javascript" src="<?php  echo base_url();?>assets/alerts/sweetalert.min.js"></script>
 </head>
<body>
<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="<?php echo base_url()?>admin_controller/index">Power Gym</a>
    </div>
    <ul class="nav navbar-nav">
      
      <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#">Miembros<span class="caret"></span></a>
        <ul class="dropdown-menu">
          <li><a href="<?php echo base_url()?>usuario_controller/agregarus">Crear un nuevo Miembro</a></li>
          <li><a href="<?php echo base_url()?>usuario_controller/listausuarios">Ver lista de Miebros</a></li>
          <li><a href="<?php echo base_url()?>usuario_controller/listausuariosdeudores">Lista de Miembros Deudores</a></li>
        </ul>
      </li>
      <!--se verifica que el usuario este activo-->   
      <?php if($this->session->userdata("activo"))
      { 
      	?>
        <!-- si el rol es uno significa que es el superadministrador y muestra mas opciones en el panel de admin-->   
        <?php if($this->session->userdata("rol") == 1)
        { 
        	?>
      <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#">Administradores<span class="caret"></span></a>
      	<ul class="dropdown-menu">
          <li><a href="<?php echo base_url()?>admin_controller/agregaradmin">Crear un nuevo Administrador</a></li>
          <li><a href="<?php echo base_url()?>admin_controller/veradmin">Ver Administradores</a></li>
          
        </ul>
      </li>
       <?php } ?>
      <?php } ?>
    </ul>
    <!--si existe el usuario muestra su nombre-->   
    <?php if($this->session->userdata("activo")){?>
     <ul class="nav navbar-nav navbar-right">
      <li><a href="#"><span class="fa fa-user"></span><?php echo $this->session->userdata("nombreadmin"); ?></a></li>
      <li><a href="<?php echo base_url();?>login_controller/cerrarsession"><span class="fa fa-fw fa-power-off"></span>salir</a></li>
    </ul>
    <?php }else{?>
    <ul class="nav navbar-nav navbar-right">
      <li><a href="#"><span class="glyphicon glyphicon-user"></span> salir</a></li>
      <li><a href="#"><span class="glyphicon glyphicon-log-in"></span> ingresar</a></li>
    </ul>
    <?php } ?>
  </div>
</nav>

