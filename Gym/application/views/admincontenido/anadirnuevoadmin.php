<!-- muestra los campos en cual la validacion mostro como errores-->
<?php $er=validation_errors();
          if($er){
            echo "<div class='alert alert-danger'>
           <a href='' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
           <strong>Error en los siguientes campos</strong>".validation_errors()."</div>";
          }

    ?>
<!-- Muestra un mensaje de usuario agregado-->    
<?php $ms=$this->session->flashdata('mss');
  if($ms){
     echo "<div class='alert alert-success'>
       <a href='' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
        <strong>Administrador Agregado</strong>".$ms.".
        </div>";
}?>    
<div class="modal-dialog">
  <div class="modal-content">
      <div class="modal-header">
        <h1 class="text-center">Agregar Nuevo Administrador</h1>
        <h1 align="center"><i class="fa fa-user"></i></h1>
      </div>
      <div class="modal-body">
   <form action="<?php echo base_url();?>admin_controller/agregaradmin" method="POST">
             <div class="form-group">
              <input type="text" name="nombre" class="form-control input-lg" placeholder="Nombre Completo">
            </div>
            <div class="form-group">
              <input type="text" name="nombre_usuario" class="form-control input-lg" placeholder="Nombre de Usuario">
            </div>
            <div class="form-group">
               <input type="password" name="pass" class="form-control input-lg" placeholder="contraseña ">
            </div>
            
            <div class="form-group">
              <button class="btn btn-primary btn-lg btn-block">Agregar</button>

            </div>
          </form>
      </div>
      <div class="modal-footer">

      </div>
  </div>
  </div>
  