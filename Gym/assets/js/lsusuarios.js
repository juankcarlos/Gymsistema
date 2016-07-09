$(document).ready(function(){
	mostrar("",1);
  $("input[name=busca]").keyup(function(){
    dato=$("#buscar").val();
    mostrar(dato,1);
  });
  $("body").on("click",".paginacion li a",function(e){
    e.preventDefault();
    valor=$(this).attr("href");
    valorbuscar=$("input[name=busca]").val();
    mostrar(valorbuscar,valor);
  })
	
  $("body").on("click","#tbusuarios tr td a",function(e){
      e.preventDefault();
      id=$(this).parent().parent().children("td:eq(7)").text();
      $("#ids").val(id);
      lbnom=clave=$(this).parent().parent().children("td:eq(3)").text();
      lbclave=$(this).parent().parent().children("td:eq(2)").text();
      $("#lbclave").html(lbclave);
      $("#lbnom").html(lbnom);
      $('#myModal').modal('show'); 
  });
  $("body").on('click','#tbusuarios tr td button',function(e){
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

});

function mostrar(dato,pagina)
{
	$.ajax({
    url : "http://localhost/Gym/usuario_controller/listarus",
    type: "POST",
    data: {buscar:dato,nropagina:pagina,estado:1},
    dataType:"json",
    success:function(response){
      filas="";
      $.each(response.lsus,function(key,intem){
       filas+="<tr><td style='display:none;'>"+intem.tipomembrecia+"</td><td style='display:none;'>"+intem.paquete+"</td><td>"+intem.clave+"</td><td>"+intem.nombre+"</td><td>"+intem.nombre_us+"</td><td>"+formatearfecha(intem.fecha_inicio)+"</td><td>"+formatearfecha(intem.fecha_fin)+"</td><td style='display:none;'>"+intem.id+"</td><td><a class='btn btn-primary'><i class='fa fa-eye' aria-hidden='true'></i></a></td><td><button  class='btn btn-primary'><i class='fa fa-money' aria-hidden='true'></i></button></td></tr>";
      });
      $("#tbusuarios tbody").html(filas);
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
      $(".paginacion").html(paginador);
     }
   });
}

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