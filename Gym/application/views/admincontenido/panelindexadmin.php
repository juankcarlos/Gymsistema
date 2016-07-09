<!-- vista principal del panel de administrador-->
<div class="container">
<div class="row">
  <div class="col-md-2"></div>
  <div class="col-md-8">
  	<div class="panel panel-default"> 
  	 <div class="panel-heading"><h1 align="center">Bienvenido</h1></div>	
    <div class="panel-body">
     <div class="row">
     	<div class="col-md-5"></div>
     	<div class="col-md-2"><img src="<?php echo base_url();?>assets/imagenes/logo.jpg"></div>
     	<div class="col-md-5"></div>
     </div>
     <div class="row">
     	<div class="col-md-4"><h4><label>Nombre</label>:  <?php echo $this->session->userdata('nombre');?></h4></div>
     	<div class="col-md-4"></div>
     	<div class="col-md-4"><h4><label>Nombre</label>:  <?php echo $this->session->userdata('nombreadmin');?></h4></div>
     </div>
     <div class="row">
     	<div class="col-md-4">
     		<?php if($this->session->userdata('rol')==1){ ?>
     		  <h4><label>Rol: </label>Super Administrador</h4>
            <?php }else{ ?>
            	<h4><label>Rol: </label>Administrador</h4>
            <?php } ?>
     	</div>
     	<div class="col-md-4"></div>
     	<div class="col-md-4"></div>
     </div>
    </div>
  </div>
  </div>
  <div class="col-md-2"></div>
</div>
</div>