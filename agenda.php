<!---PRACTICA 5 - AGENDA.PHP -- MAR PALACIOS SEBASTIAN---!>
<?php
//Leo los datos cuando añadimos contacto
if (isset($_POST['enviar'])) {
    //Leo el nombres, 
    $nombre = $_POST[nombre];
      
    //Leo el telefono
    $telefono = $_POST[telefono];
    
    //Leo el array de nombres, 
    //La primera vez estará vacío
    $agenda = $_POST [agenda];
    
   //Agrego o actualizo el nombre y el telefono en el array
    $agenda[$nombre]=$telefono;
  }
  //CREO LA TABLA, SI ESTA LLENA LA MUESTRO, SINO MOSTRAMOS UN MENSAJE
        if(isset($agenda)){
            $tabla.="<table>\n";
            
            $tabla.="<tr><th>Nombre</th><th>Teléfono</th></tr>\n";
            
              //Visualizo el array (cada elemento
             //uno por cada elemento del array
            foreach($agenda as $nombre => $telefono){
                $tabla.="<tr><td>$nombre</td><td>$telefono</td></tr>\n";
            }
        $tabla.="</table>";}
        else{
           $mensaje="<p>Agenda sin contactos</p>";
        }

//BOTON ELIMINAR
if(isset($_POST['eliminar'])){
    unset($agenda[$nombre]);
}
        
//MUESTRO LA CANTIDAD DE NOMBRES DEL ARRAY AGENDA
$contactos=count($agenda);

//MUESTRO LOS ERRORES (No he conseguido hacerlos correctamente)
if (isset($_POST['enviar'])){
        if (empty($nombre)&& empty($telefono)) {
          $error1.="<p style=\"color:red\">Debes facilitar un nombre para crear el contacto</p>";
        }
        if(empty($telefono)){
           $error2.="<p style=\"color:red\">Debe facilitar un teléfono para el contacto $nombre</p>"; 
        }
        if(is_numeric($telefono)){
            
        }else{
            $error3="<p style=\"color:red\">El teléfono debe ser numérico y $telefono no lo es.</p>"; 
        }
    }
?>
<!DOCTYPE HTML>
<html>
<head>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <link rel="stylesheet" href="./style.css" type="text/css">
    <title> Agenda de contactos</title>
</head>
<header><?php if($contactos==0){ //MUESTRO EN EL HEADER LA CUENTA DE CONTACTOS(ELEMENTOS ARRAY)
                echo "Agenda de contactos: sin contactos actualmente";
                }
              else{
                echo "Agenda de contactos: $contactos actualmente";
                }?></header>
<body>

<div class="listado_contactos">
    <div class="center">LISTADO DE CONTACTOS</div>
    <hr>
        <div class="center">
            <?php echo $tabla;
                  echo $mensaje?>     
        </div>
</div>
<!-- Creamos el formulario para insertar los nuevos datos-->
<fieldset>
    <legend>Nuevo Contacto</legend>
    <form action="agenda.php" method="post">
        <br>
        <label for="nombre">Nombre</label><input type="text" name="nombre" size="15"/><br/>
        <label for="telefono">Teléfono </label><input type="text" name="telefono" size="15"/><br/>
        <input type="submit" value="Añadir contacto" name="enviar">
            <?php
            //Si el array esta vacío el botón de Eliminar estará deshabilitado, sino habilitado
            if (empty($agenda)) {
            $estadoboton='disabled';
            }
            else {
            $estadoboton='';
            }
        echo "<input type=\"submit\" value=\"Eliminar contacto\"$estadoboton name=\"eliminar\" >\n";
          ?>
        <!-- Metemos los contactos existentes  ocultos en el formulario-->
         <?php
    //Escribo inputs de tipo hidden
    //uno por cada elemento del array
    foreach ($agenda as $nombre => $telefono) {
       echo "\n<input type=hidden name=agenda[$nombre] value=$telefono />";
       }
    echo "\n"; //Los \n para que se vea bien el código html
    ?>
            </form>
</fieldset>
<div style="clear:both ">
    <hr/>
    </div>
<?php echo $error1; //MOSTRAMOS LOS ERRORES CREADOS ARRIBA, NO HE CONSEGUIDO HACERLOS BIEN
      echo $error2;
      echo $error3;?>

<!---CREO UN COMENTARIO PARA LA TAREA3 DE DAW---->
</body>
<!---CREO UNA LINEA PARA LA ÚLTIMA PARTE DEL EJERCICIO 4---->
</html>
