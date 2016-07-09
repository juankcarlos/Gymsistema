$(document).ready(function(){
	mostrar("",1)
 /*funcion para atrapar lo que venga del campo buscar nombre
  para ir filtrando dentro de la aplicacion
 */
 $("input[name=busca]").keyup(function(){
    dato=$("#buscar").val();
    mostrar(dato,1);
  });	
 
  $("body").on("click",".paginaciondeudores li a",function(e){
    e.preventDefault();
    valor=$(this)
    .attr("href");
    valorbuscar=$("input[name=busca]").val();
    mostrar(valorbuscar,valor);
  })
  /*funcion que captura los parametros de los td para 
  mandarlos a un formulario moda  en los campos hidden*/
 $("body").on('click','#tbusuariosdeudores tr td a',function(e){
    e.preventDefault();
    tpm=$(this).parent().parent().children("td:eq(0)").text();
    paquete =$(this).parent().parent().children("td:eq(1)").text();
    clave=$(this).parent().parent().children("td:eq(2)").text();
    nombre =$(this).parent().parent().children("td:eq(3)").text();
    id=$(this).parent().parent().children("td:eq(7)").text();
    $("#nm").val(nombre);
    $("#clave").val(clave);
    $("#pq").val(paquete);
    $("#tm").val(tpm);
    $("#id").val(id);
    $('#myModalpago').modal('show');
  });
 $("body").on('click','#tbusuariosdeudores tr td button',function(e){
  e.preventDefault();
/*se atrapa el atributo del boton para saber
  a cual boton pertenece y realizar lass acciones
  correspondientes
*/
op=$(this).attr('href');
if(op=='borrar')
{ 
  
  val=$(this).attr("value");
   //script del pligin sweet alert
   swal({ title: "¿Esta seguro de eliminar este usuario?",
                text: "",
                type: "warning",   showCancelButton: true,   confirmButtonColor: "#DD6B55",
                confirmButtonText: "Si Eliminar",
                closeOnConfirm: false }, function(){eliminarusuarios(val);
                  swal("Borrado", "El usuario fue Eliminado", "success"); });
}else{
      id=$(this).parent().parent().children("td:eq(7)").text();
      $("#ids").val(id);
      lbnom=clave=$(this).parent().parent().children("td:eq(3)").text();
      lbclave=$(this).parent().parent().children("td:eq(2)").text();
      $("#lbclave").html(lbclave);
      $("#lbnom").html(lbnom);
      $('#myModal').modal('show'); 

}

});

});
/*funcion que muestra todos los registros paginados*/
function mostrar(dato,pagina)
{
	$.ajax({
    url : "http://localhost/Gym/usuario_controller/listarus",
    type: "POST",
    data: {buscar:dato,nropagina:pagina,estado:0},
    dataType:"json",
    success:function(response){
       filas="";
      $.each(response.lsus,function(key,intem){
      	 filas+="<tr><td style='display:none;'>"+intem.tipomembrecia+"</td><td style='display:none;'>"+intem.paquete+"</td><td>"+intem.clave+"</td><td>"+intem.nombre+"</td><td>"+intem.nombre_us+"</td><td>"+formatearfecha(intem.fecha_inicio)+"</td><td>"+ formatearfecha(intem.fecha_fin)+"</td><td style='display:none;'>"+intem.id+"</td><td><a class='btn btn-primary' href="+intem.id+"><i class='fa fa-money' aria-hidden='true'></i></a></td><td><button class='btn btn-primary' href='asistencias'><i class='fa fa-eye' aria-hidden='true'></i></button></td>><td><button class='btn btn-danger' value="+intem.id+" href='borrar'><i class='fa fa-trash-o' aria-hidden='true'></i></button></td></tr>";
      });
      $("#tbusuariosdeudores tbody").html(filas);

     linkseleccionado=Number(pagina);
    //total de registros
    totalresgistros=response.totalregistros;
    //cantidad de registros por pagina
    cantidadregistros=response.cantidad;
    //
    numerolinks = Math.ceil(totalresgistros/cantidadregistros);
    paginador ="<ul class='pagination'>";
    if(linkseleccionado>1)
      {
        paginador+="<li><a href='1'>&laquo;</a></li>";
        paginador+="<li><a href='"+(linkseleccionado-1)+"' '>&lsaquo;</a></li>";

      }
      else
      {
        paginador+="<li class='disabled'><a href='#'>&laquo;</a></li>";
        paginador+="<li class='disabled'><a href='#'>&lsaquo;</a></li>";
      }
    //muestro de los enlaces 
      //cantidad de link hacia atras y adelante
      cant = 2;
      //inicio de donde se va a mostrar los links
      pagInicio = (linkseleccionado > cant) ? (linkseleccionado - cant) : 1;
      //condicion en la cual establecemos el fin de los links
      if (numerolinks > cant)
      {
        //conocer los links que hay entre el seleccionado y el final
        pagRestantes = numerolinks - linkseleccionado;
        //defino el fin de los links
        pagFin = (pagRestantes > cant) ? (linkseleccionado + cant) :numerolinks;
      }
      else 
      {
        pagFin = numerolinks;
      }

    for (var i = 1; i <=numerolinks; i++) {
       if (i==linkseleccionado)
         paginador +="<li class='active'><a href='javascript:void(0)'>"+i+"</a></li>"
       else
        paginador +="<li><a href='"+i+"'>"+i+"</a></li>"
    }    

      if(linkseleccionado<numerolinks)
      {
        paginador+="<li><a href='"+(linkseleccionado+1)+"' >&rsaquo;</a></li>";
        paginador+="<li><a href='"+numerolinks+"'>&raquo;</a></li>";

      }
      else
      {
        paginador+="<li class='disabled'><a href='#'>&rsaquo;</a></li>";
        paginador+="<li class='disabled'><a href='#'>&raquo;</a></li>";
      }

      paginador +="</ul>";
      $(".paginaciondeudores").html(paginador);
     }

   });
}
//metodo para eliminar un usuario por ajax con un id dado
function eliminarusuarios(id)
{
  $.ajax({
    url:'http://localhost/Gym/usuario_controller/eliminarusuarios',
    type:"POST",
    data:{id:id},
     success:function(respuesta)
    {
      mostrar("",1)
    }
  });
}

//metodo para dar formato ala fecha
function formatearfecha(fecha)
{
   var meses = new Array ("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
   var f=new Date();
   var splfecha=fecha.split("-");
   var mesel=Number(splfecha[1])-1;
   if(mesel < 0)
   {
     mesel=0;
   }
   var mes=meses[mesel];
   var dia=splfecha[2];
   var año=splfecha[0]; 
   return dia+" de "+mes+" del "+año;
}

