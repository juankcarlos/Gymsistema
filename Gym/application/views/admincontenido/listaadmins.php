<!--si la variable no es nula muestra lo siguiente-->   
<?php if(isset($ls)) {?>
<div class="container">
<div class="row">
<table id="tbclientes" class="table table-bordered">
	<thead>
		<tr>
			<th>Nombre</th>
			<th>Nombre de usuario</th>
			<th>Eliminar</th>
		</tr>
	</thead>
	<tbody>
   <!-- foreach que recorre  todos los objeteos de tipo admin obtenidos 
   en la consulta y se almacena en la variable ls que viene de admin_controller/veradmin -->    
	<?php foreach($ls as $sd): ?>
	<tr><td><?php echo $sd->nombre; ?></td><td><?php echo $sd->nombre_admin; ?></td><td><a   class="bte btn btn-danger"  value="<?php echo $sd->id_admin;?>"><i class="fa fa-trash-o" aria-hidden="true"></i></a></td><tr>
   <?php endforeach; ?>
	</tbody>
</table>

</div>
</div>
<?php }else{ ?>
<div class='alert alert-warning'>
      <a href='' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
      <strong></strong>No existen Administradores para mostrar</div>;
<?php } ?>
<!-- metodo con jquery y el plugin de javascript sweetalert para alaertas,permite eliminar un administrador al dar click en el boton que contiene la clase bte -->
<script type="text/javascript">
$(".bte").click(function(e){
 e.preventDefault();	
 id=$(".bte").attr("value");
  swal({ title: "¿Esta seguro de eliminar este Administrador?",
                text: "",
                type: "warning",   showCancelButton: true,   confirmButtonColor: "#DD6B55",
                confirmButtonText: "Si Eliminar",
                closeOnConfirm: false }, function(){eliminar(id);
                  swal("Borrado", "El Administrador fue Eliminado", "success"); });
});

//metodo para eliminar un usuario pasando como parametro el id 
function eliminar(id)
{
	$.ajax({
    url : "http://localhost/Gym/admin_controller/eliminarad",
    type: "POST",
    data: {id:id},
    success:function(response){
    location.reload();  
    }
    });
}
</script>