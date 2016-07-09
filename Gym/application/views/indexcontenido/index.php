  <div class="container">
	<div class="row">
<!-- mensajes estilizados con el plugin de javascript sweetalert-->
<!-- mensaja  de la clase login_controller/autus-->
<?php $er=validation_errors();
if($er){
  echo "<script>sweetAlert('Ningun campo puede estar vacio', 'favor de llenar todos los campos del fomulario', 'error');</script>";
}?>
<?php 
if($this->session->flashdata('mer')){
    echo "<script>sweetAlert('Usuario no existe ', 'nombre de usuario o contraseña incorrectos', 'error');</script>";
 	}?>
<?php 
if($this->session->flashdata('mss')){
  echo "<script>sweetAlert('Asistencia Registrada', 'Tu asistencia a sido Registrada Bienvenido', 'success');</script>";
 }
 ?>  

<?php 
if($this->session->flashdata('mwr')){
   echo "<script>sweetAlert('Asitencia ya fue registrada', 'Tu ya tomaste asistencia en este dia', 'warning');</script>";
 }?> 
 <?php 
if($this->session->flashdata('mwrexp')){
   echo "<script>sweetAlert('Su membresia expiro', 'Su membresia a expirado comuniquese con el administrador', 'warning');</script>";
 }?>			
	</div>
	<div class="row">
		<div id="loginModal">
  			<div class="modal-dialog">
  <div class="modal-content">
      <div class="modal-header">
        <h1 class="text-center"><img src="<?php echo base_url();?>assets/imagenes/logo.jpg"></h1>
      </div>
      <div class="modal-body">
   <form action="<?php echo base_url()?>login_controller/tipo" method="POST">
            <div class="form-group">
              <input type="text" name="nom" class="form-control input-lg" placeholder="Nombre de Usuario">
            </div>
            <div class="form-group">
              <input type="password" name="pas" class="form-control input-lg" placeholder="Password">
            </div>
            <div class="form-group">
            	<label>Rol</label>
              <select name="opciones" class="form-control">
            		<option value="0">Usuario</option>
            		<option value="1">Admin</option>
            	</select>
            </div>
            <div class="form-group">
              <button class="btn btn-primary btn-lg btn-block">Iniciar</button>

            </div>
          </form>
      </div>
      <div class="modal-footer">

      </div>
  </div>
  </div>
</div>

		</div>
		<div class="col-md-4"></div>
	</div>
</div>
					
