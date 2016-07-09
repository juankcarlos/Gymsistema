 <!-- vista para crear el pdf--> 
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <title>Provincias españolas en pdf</title>
    <style type="text/css">
        body {
         
         margin: 40px;
         font-family: Lucida Grande, Verdana, Sans-serif;
         font-size: 14px;
         color: #4F5155;
         border-style: dotted;
         border-color: black;
        }
        
        #datos
        {
          margin-top: 30px;
        }
        #membresia
        {
          margin-top: 40px;
        }
        #vigencia{
           margin-top: 40px;
        }
        #footer
        {
           margin-top: 110px;
        }
        .tm
        {
          width: 100%;
          border:2px;
        }
        input[type="text"]
        {
          width: 350px;
          height: 30px;
          background-color:#A9F5F2; 
        }
        .ccelda
        {
          background: #2E9AFE;
        }
        label
        {
          font-family: Arial;
          font-size: 10px;
        }
    </style>
   
</head>
<body>
<table class="tm">
  <tr >
    <td rowspan="10" colspan="3">
      <table>
       <tr>
        <td class="ccelda">Fecha</td>
      </tr>
      <tr>
        <td><?php echo date("d/m/y");?></td>
      </tr>
      </table>
    </td>
    <td rowspan="10" colspan="3"><img src="assets/imagenes/logo.jpg"></td>
    <td rowspan="10" colspan="3">
      <table >
       <tr>
        <td class="ccelda">Folio</td>
      </tr>
      <tr>
        <td><?php echo $rand = rand(1,5000); ?></td>
      </tr>
      </table>

    </td>
  </tr>
  </table>
<table id="datos" class="tm">
  <tr>
    <th colspan="4">Datos del Cliente</th>
   </tr>
  <tr>
    <td class="ccelda" colspan="2">Nombre</td>
    <td colspan="2"><input type="text" value="<?php echo $ls['nombre'];?>"/></td>
    </tr>
    <tr>
     <td class="ccelda" colspan="2">Numero de socio</td>
    <td colspan="2"><input type="text" value="<?php echo $ls['clave'];?>"/></td>
    </tr>
    <tr>
     <td  class="ccelda" colspan="2">Paquete</td>
    <td colspan="2"><input type="text" value="<?php echo $ls['paquete'];?>"/></td>
    </tr>
</table>

<table id="membresia" class="tm">
 <tr>
    <th colspan="6">Tipo de membresia</th>
 </tr>
 <?php if($ls['membresia'] == 1){ ?>
 <tr>
    <td colspan="2"><label>Semanal</label><input type="checkbox" checked></td>
    <td colspan="2"><label>Trimestral</label><input type="checkbox" ></td>
    <td colspan="2"><label>Mensual</label><input type="checkbox" ></td>
  </tr>
   <tr>
    <td colspan="2"></td>
    <td colspan="2"><label>Semestral</label><input type="checkbox" ></td>
    <td colspan="2"><label>Anual</label><input type="checkbox" ></td>
   </tr>
   <?php }else if($ls['membresia'] == 2){ ?>
 <tr>
    <td colspan="2"><label>Semanal</label><input type="checkbox" ></td>
    <td colspan="2"><label>Trimestral</label><input type="checkbox" checked></td>
    <td colspan="2"><label>Mensual</label><input type="checkbox" ></td>
  </tr>
   <tr>
    <td colspan="2"></td>
    <td colspan="2"><label>Semestral</label><input type="checkbox" ></td>
    <td colspan="2"><label>Anual</label><input type="checkbox" ></td>
   </tr>
    <?php }else if($ls['membresia'] == 3){ ?>
 <tr>
    <td colspan="2"><label>Semanal</label><input type="checkbox"></td>
    <td colspan="2"><label>Trimestral</label><input type="checkbox" ></td>
    <td colspan="2"><label>Mensual</label><input type="checkbox" checked ></td>
  </tr>
   <tr>
    <td colspan="2"></td>
    <td colspan="2"><label>Semestral</label><input type="checkbox" ></td>
    <td colspan="2"><label>Anual</label><input type="checkbox" ></td>
   </tr>
</table>
<table id="vigencia" class="tm">

<?php }else if($ls['membresia'] == 4){ ?>
 <tr>
    <td colspan="2"><label>Semanal</label><input type="checkbox" ></td>
    <td colspan="2"><label>Trimestral</label><input type="checkbox" ></td>
    <td colspan="2"><label>Mensual</label><input type="checkbox" ></td>
  </tr>
   <tr>
    <td colspan="2"></td>
    <td colspan="2"><label>Semestral</label><input type="checkbox" checked></td>
    <td colspan="2"><label>Anual</label><input type="checkbox" ></td>
   </tr>
  <?php }else if($ls['membresia'] == 5){ ?>
 <tr>
    <td colspan="2"><label>Semanal</label><input type="checkbox" ></td>
    <td colspan="2"><label>Trimestral</label><input type="checkbox" ></td>
    <td colspan="2"><label>Mensual</label><input type="checkbox" ></td>
  </tr>
   <tr>
    <td colspan="2"></td>
    <td colspan="2"><label>Semestral</label><input type="checkbox" ></td>
    <td colspan="2"><label>Anual</label><input type="checkbox" checked></td>
   </tr> 
   <?php } ?>
</table>
<table  id="vigencia">
 <tr>
  <td class="ccelda" colspan="2">Vigencia</td>
  <td colspan="2"><input type="text" value="<?php echo $ls['fecha'];?>"/></td>
</tr>
</table>
<table id="footer" class="tm">
   <tr>
    <td rowspan="16">
     <label>RFC AAAH780213T48</label><br>
     <label>Buenavista Qro</label><br>
     <label>Calle allende esquina</label><br>
     <label>con Francisco I Madero</label><br>
     <img src="assets/imagenes/logo.png"><label>RFC AAAH780213T48</label><br>
    </td>
    <td rowspan="16">
     <h5>importe</h5>
     <h5>IVA</h5>
     <h5>TOTAL</h5>
    </td>
    <td rowspan="16">
      <h1><?php echo "$ ".$ls['monto'];?></h1>
    </td>
    </tr>
</table>
</body>
</html>
