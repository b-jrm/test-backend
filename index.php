<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <link type="text/css" rel="stylesheet" href="css/materialize.min.css"  media="screen,projection"/>
  <link type="text/css" rel="stylesheet" href="css/customColors.css"  media="screen,projection"/>
  <link type="text/css" rel="stylesheet" href="css/ion.rangeSlider.css"  media="screen,projection"/>
  <link type="text/css" rel="stylesheet" href="css/ion.rangeSlider.skinFlat.css"  media="screen,projection"/>
  <link type="text/css" rel="stylesheet" href="css/index.css"  media="screen,projection"/>
  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Formulario</title>
</head>

<body>

  <?php
    $bienesDisponibles = file_get_contents("db/data-1.json");
    $bienes = json_decode($bienesDisponibles, true);
  ?>

  <video src="img/video.mp4" id="vidFondo"></video>

  <div class="contenedor">
    <div class="card rowTitulo">
      <h1>Bienes Intelcost</h1>
    </div>
    <div class="colFiltros">
      <form action="#" method="post" id="formulario">
        <div class="filtrosContenido">
          <div class="tituloFiltros">
            <h5>Filtros</h5>
          </div>
          <div class="filtroCiudad input-field">
            <p><label for="selectCiudad">Ciudad:</label><br></p>
            <select name="ciudad" id="selectCiudad">
              <option value="" selected>Elige una ciudad</option>
              <?php
                $repetidos = array(); 
                foreach ($bienes as $bien) {
                  if(!in_array(trim($bien['Ciudad']), $repetidos)){
                    echo '<option value="'.trim($bien['Ciudad']).'">'.trim($bien['Ciudad']).'</option>';
                    array_push($repetidos, trim($bien['Ciudad']));
                  }
                }
                unset($repetidos);
              ?>
            </select>
          </div>
          <div class="filtroTipo input-field">
            <p><label for="selecTipo">Tipo:</label></p>
            <br>
            <select name="tipo" id="selectTipo">
              <option value="">Elige un tipo</option>
              <?php
                $repetidos = array(); 
                foreach ($bienes as $bien) {
                  if(!in_array(trim($bien['Tipo']), $repetidos)){
                    echo '<option value="'.trim($bien['Tipo']).'">'.trim($bien['Tipo']).'</option>';
                    array_push($repetidos, trim($bien['Tipo']));
                  }
                }
                unset($repetidos);
              ?>
            </select>
          </div>
          <div class="filtroPrecio">
            <label for="rangoPrecio">Precio:</label>
            <input type="text" id="rangoPrecio" name="precio" value="" />
          </div>
          <div class="botonField">
            <input type="submit" class="btn white" value="Buscar" id="submitButton">
          </div>
        </div>
      </form>
    </div>
    <div id="tabs" style="width: 75%;">
      <ul>
        <li><a href="#tabs-1">Bienes disponibles</a></li>
        <li><a href="#tabs-2">Mis bienes</a></li>
      </ul>
      <div id="tabs-1">
        <div class="colContenido" id="divResultadosBusqueda">
          <div class="tituloContenido card" style="justify-content: center;">
            <h5>Resultados de la búsqueda:</h5>
            <div class="divider"></div>
            <?php foreach ($bienes as $bien) { ?>
              <div class="itemMostrado" id="card_<?php echo trim($bien['Id']); ?>">
                <img src="img/home.jpg">
                <div class="card-stacked">
                  <span hidden class="text_tipo"><?php echo trim($bien['Tipo']); ?></span>
                  <span hidden class="text_ciudad"><?php echo trim($bien['Ciudad']); ?></span>
                  <span class="text_precio"><?php echo str_replace(' ', '', str_replace('$', '', str_replace(',', '', $bien['Precio']))); ?></span>
                  <small><b>Direcci&oacute;n:</b>&nbsp;<?php echo trim($bien['Direccion']); ?></small><br>
                  <small><b>Ciudad:</b>&nbsp;<?php echo trim($bien['Ciudad']); ?></small><br>
                  <small><b>Tel&eacute;fono:</b>&nbsp;<?php echo trim($bien['Telefono']); ?></small><br>
                  <small><b>Codigo Postal:</b>&nbsp;<?php echo trim($bien['Codigo_Postal']); ?></small><br>
                  <small><b>Tipo:</b>&nbsp;<?php echo trim($bien['Tipo']); ?></small><br>
                  <small class="precioTexto"><b>Precio:</b>&nbsp;<?php echo trim($bien['Precio']); ?></small>
                </div>
              </div>
            <?php } ?>
          </div>
        </div>
      </div>
      
      <div id="tabs-2" >
        <div class="colContenido" id="divResultadosBusqueda">
          <div class="tituloContenido card" style="justify-content: center;">
            <h5>Bienes guardados:</h5>
            <div class="divider"></div>
          </div>
        </div>
      </div>
    </div>


    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    
    <script type="text/javascript" src="js/ion.rangeSlider.min.js"></script>
    <script type="text/javascript" src="js/materialize.min.js"></script>
    <script type="text/javascript" src="js/index.js"></script>
    <script type="text/javascript" src="js/buscador.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script type="text/javascript">
      $( document ).ready(function() {
          $( "#tabs" ).tabs();
      });

      $("#formulario").on('submit',function(e){
        e.preventDefault();
        let data = $("#formulario").serializeArray();
        console.log('data_form',data);

        let ciudad = data[0].value;
        let tipo = data[1].value;
        let rangoPrecio = data[2].value.split(';');
        let rangoinicial = parseInt(rangoPrecio[0]);
        let rangofinal = parseInt(rangoPrecio[1]);

          console.log('ciudad',ciudad);
          console.log('tipo',tipo);
          console.log('rango',rangoPrecio);
        console.log('rangoinicial',rangoinicial);
        console.log('rangofinal',rangofinal);
        $('.itemMostrado').fadeOut();

        $('.itemMostrado').each(() => {
          let text_ciudad = $(this).find('.text_ciudad').text();
          let text_tipo = $(this).find('.text_tipo').text();
          let text_precio = $(this).find('.text_precio').text();
          console.log('text_ciudad',text_ciudad);
          console.log('text_tipo',text_tipo);
          console.log('text_precio',text_precio);
          if(ciudad == text_ciudad || tipo == text_tipo || (rangoinicial <= text_precio && rangofinal >= text_precio)){
            $(this).fadeIn();
          }
        });
      });
    </script>
  </body>
  </html>
