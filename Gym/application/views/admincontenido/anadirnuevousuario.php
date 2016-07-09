<!-- Muestra los mensajes de error si no se paso la validacion-->   
<?php $er=validation_errors();
          if($er){
            echo "<div class='alert alert-danger'>
           <a href='' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
           <strong>Error en los siguientes campos</strong>".validation_errors()."</div>";
          }

    ?>

<!-- Muestra un mensaje de error si la clave ya existe-->   
<?php $ms=$this->session->flashdata('mser');
  if($ms){
     echo "<div class='alert alert-danger'>
       <a href='' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
        <strong>Clave no disponible</strong>".$ms.".
        </div>";
}?>
<div class="modal-dialog">
  <div class="modal-content">
      <div class="modal-header">
        <h1 class="text-center">Agregar nuevo usuario</h1><br>
        <h1 align="center"><i class="fa fa-user" aria-hidden="true" id="for"></i><h1>
      </div>
      <div class="modal-body">
   <form action="<?php echo base_url();?>usuario_controller/addus" method="POST"  >
             <div class="form-group">
              <input type="text" name="nombre" class="form-control input-lg" placeholder="Nombre Completo">
            </div>
            <div class="form-group">
              <input type="text" name="nombre_usuario" class="form-control input-lg" placeholder="Nombre de Usuario">
            </div>
            <div class="form-group">
                <div class="hero-unit">
                <input  type="text" class="form-control" placeholder="Fecha de inicio"  id="memin" name="min"></div>
             </div>
             <div class="form-group">
                <div class="hero-unit">
                <input  type="text" class="form-control " placeholder="Fecha fin de membresia"  id="memfin" name="mfin">
                </div>
             </div>
            <div class="form-group">
               <input type="number" name="clave" class="form-control input-lg" placeholder="clave de usuario">
            </div>
            <div class="form-group">
              <label>Paquete</label>
              <select name="paquete" class="form-control" placeholder="paquetes">
                <option value="estandar">Estandar</option>
                <option value="estudiante">Estudiante</option>
              </select> 
            </div>
            <div class="form-group">
             <label>Tipo de membresia</label>
              <select name="membresia" class="form-control" placeholder="paquetes">
                <option value="1">Semanal</option>
                <option value="2">Trimestral</option>
                <option value="3">Mensual</option>
                <option value="4">Semestral</option>
                <option value="5">Anual</option>
              </select> 
            </div>
            <div class="form-group">
               <input type="number" name="precio" class="form-control input-lg" placeholder="Precio de membresia">
            </div>
            <div class="form-group">
              <button class="btn btn-primary btn-lg btn-block" id="f">Agregar</button>
             
            </div>
          </form>
      </div>
<!--script que dan formato de fecha junto con la libreria datepicker-->      
<script type="text/javascript">
 $(document).ready(function () {
  $('#memin').datepicker({
    format: "yyyy/mm/dd",
  });  
  
$('#memfin').datepicker({
format: "yyyy/mm/dd",
    }); 
});

 
</script>

<script type="text/javascript">
$("#f").click(function(){
sweetAlert('Pago realizado', 'El pago de membresia fue realizado sactisfactoriamente', 'success');
$("#for")[0].reset();

});
</script>
