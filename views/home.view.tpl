<!-- Por cada producto se mostrara una cartita en el inicio de la pagina -->

<section class="cards row">
  {{foreach productos}}
    <section class="card depth-2 col-4 col-sm-6 col-md-3">
      <span class="col-sm-12 center depth-1">
        <!-- Si existe imagen pequeña la muestra -->
        {{if urlthbprd}}
          <img src="{{urlthbprd}}" alt="{{codprd}} {{dscprd}}" class="imgthumb center"/>
        {{endif urlthbprd}}
      </span>

      <!-- Mostrando codigo interno y descripcion del producto -->
      <span class="col-sm-12 center depth-1 m-padding">
        <span class="col-sm-12">{{skuprd}}</span> 
        <span class="col-sm-12">{{dscprd}}</span> 
      </span>

      <!-- Mostrando cantidad disponible del producto  -->
      <span class="col-sm-12 center depth-1 m-padding">
        <span class="col-sm-6">Disponibles</span>
        <span class="col-sm-6 center">{{stkprd}}</span>

        <!-- Boton para añadir a la carretilla -->
        <span class="col-sm-12 bold center m-padding">
          <a href="index.php?page=addtocart&codprd={{codprd}}" class="l-padding btn btn-primary"> L {{prcprd}} <span class="ion-plus-circled"></span> </a>
        </span>
      </span>
    </section> 
  {{endfor productos}} 
</section>
