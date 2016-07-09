<div class="container">
  <div class="row">
  <div class="col-lg-offset-6">
    <div class="input-group">
      <input type="text" class="form-control " placeholder="Nombre" name="busca" id="buscar">
      <span class="input-group-btn">
        <button class="btn btn-default" type="button" ><i class="fa fa-search"></i></button>
      </span>
    </div>
  </div>
  </div><br>
<div class="row">
<table id="tbusuariosdeudores" class="table table-bordered">
              <thead>
                <tr>
                 <th>Clave</th>
                  <th>Nombre</th>
                  <th>Nombre de Usuario</th>
                  <th>Fecha de inicio</th>
                  <th>Fecha fin de Membrecia</th>
                  <th>Pagar Membresia</th>
                  <th>ver asistencias</th>
                  <th>Eliminar Usuario</th>
                  </tr>
              </thead>
              <tbody>
              </tbody>
            </table>
            <div class="text-center paginaciondeudores"></div>
</div>
<!-- Modal  para pago de membresia-->
<div class="modal fade" id="myModalpago" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Pago de Membresia</h4>
        </div>
        <div class="modal-body">
         <form action="<?php echo base_url();?>usuario_controller/generarpdf" method="POST" id="fdeudores">
         <div class="form-group">
                
                <input  type="date" class="form-control " placeholder="Fecha fin de membresia"   name="mfecha" required>
                
         </div>
          <div class="form-group">
              <input type="number" name="monto" placeholder="monto a pagar" class="form-control" required>
          </div>
             <input type="hidden" name="nombre" id="nm">
             <input type="hidden" name="clave" id="clave">
             <input type="hidden" name="paquete" id="pq">
             <input type="hidden" name="tipom" id="tm">
             <input type="hidden" name="id" id="id">
        </div>
        <div class="form-group">
         <div class="col-md-4"></div>
         <div class="col-md-4">
          <button class="btn btn-primary">pagar</button>
          </div>
          <div class="col-md-4"></div>
        </div>
        </form>
       <div class="modal-footer"></div>
      </div>
      
    </div>
    </div>
 <!-- Modal para ver asistencias en el mes -->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Asistencia de Usuario</h4>
        </div>
        <div class="modal-body">
         <form action="<?php echo base_url()?>usuario_controller/totalasis" method="POST">
          <input type="hidden" name="id" id="ids">
          <input type="hidden" name="tpf" value="deu">
          <div class="container">
            <div class="row">
              <div class="col-md-4"><label>Año</label></div>
              <div class="col-md-4"><label>Mes</label></div>
            </div>
            <div class="row">
              <div class="col-md-4">
                <select  name="sa">
                  <option>2016</option>
                  <option>2017</option>
                  <option>2018</option>
                  <option>2019</option>
                  <option>2020</option>
                  <option>2021</option>
                  <option>2022</option>
                  <option>2023</option>
                  <option>2024</option>
                  <option>2025</option>
                </select>
              </div>
              <div class="col-md-4">
                <select name="sm">
                  <option value="01">Enero</option>
                  <option value="02">Febrero</option>
                  <option value="03">Marzo</option>
                  <option value="04">Abril</option>
                  <option value="05">Mayo</option>
                  <option value="06">Junio</option>
                  <option value="07">Julio</option>
                  <option value="08">Agosto</option>
                  <option value="09">Septiembre</option>
                  <option value="10">Octubre</option>
                  <option value="11">Noviembre</option>
                  <option value="12">Diciembre</option>
                </select>
              </div>
            </div><br>
            <div class="row">
              <div class="col-md-4"><label>Clave</label></div>
              <div class="col-md-4"><label>Nombre</label></div>
            </div><br>
            <div class="row">
              <div class="col-md-4"><label id="lbclave"></label></div>
              <div class="col-md-4"><label id="lbnom"></label></div>
            </div><br>
            <button type="submit" class="btn btn-primary">ver Cantidad</button>
            <div id="mostrar"></div>
           </div>
        </form> 
        </div>
       
      </div>
      
    </div>
  </div>
  <!-- Modal que muestra el resultado de las asistencias totales -->
  <div class="modal fade" id="myModal2" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Asistencias totales en el mes</h4>
        </div>
        <div class="modal-body">
           <!--si el ms de modals que viene de  usuario_controller/totalasis-->
         <?php if($this->session->flashdata('modals')){
          ?>
           <!--muestra el total de asistencias de  la variable de session s que viene de suario_controller/totalasis -->
          <h1 align="center"><?php echo $this->session->userdata('s'); ?></h1>
          <?php } ?>
        </div>
       
      </div>
      
    </div>
  </div>
</div> 
 <!--si el ms de modals que viene de  usuario_controller/totalasis
     el cual permite mostrar el modal 
  --> 
<?php 
  if($this->session->flashdata('modals')){
    ?>
    <script type="text/javascript">
    
    $('#myModal2').modal('show'); 
    
    </script>
    
<?php } ?>  

<script src="<?php  echo base_url();?>assets/js/lsusuariosdeudores.js"></script>
<!--si el formulario es enviado y la operacion se realiza correctamente muestra el siguiente mensaje -->
<script type="text/javascript">
$("#fdeudores").submit(function(){
sweetAlert('Pago realizado', 'El pago de la membresia se a realizado sactisfactoriamente', 'success');
$("#fdeudores")[0].reset();
});
</script>
 </div>  