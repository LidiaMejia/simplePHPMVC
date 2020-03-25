<section>
    <header>
        <h1>{{titulo_img}}</h1>
    </header>

    <br/>

    <main class="row">
        <form action="index.php?page=productoimg&codprd={{codprd}}" method="post" class="col-12 col-md-8 col-offset-2" enctype="multipart/form-data">
            <input type="hidden" name="codprd" value="{{codprd}}"/>
            <input type="hidden" name="token" value="{{token}}" />

            <fieldset>
                <label class="col-12 col-sm-4 col-md-3">Código Interno: &nbsp;</label>
                <input type="text" name="skuprd" value="{{skuprd}}" maxlength=128 placeholder="SKU" disabled readonly />
            </fieldset>

            <fieldset>
                <label class="col-12 col-sm-4 col-md-3">Descripción Comercial: &nbsp;</label>
                <input type="text" name="dscprd" value="{{dscprd}}" maxlength="70" placeholder="Descripción Comercial" disabled readonly />
            </fieldset>

            <!-- IMAGENES -->

            <!-- IMAGEN DE PORTADA -->
            <fieldset>
                <label class="col-12 col-sm-4 col-md-3">Imagen de Portada: &nbsp;</label>
                <!-- Si existe ya la imagen, la muestra -->
                {{if urlprd}}
                    <span class="col-12 col-sm-8 col-md-9 center"> <img src="{{urlprd}}" alt="Portada {{codprd}} {{dscprd}}" class="imgPrd" /> </span>
                {{endif urlprd}}
                
                <!-- Si no existe, se muestra la imagen de "No hay imagen disponible" -->
                {{ifnot urlprd}}
                <span class="col-12 col-sm-8 col-md-9 center"> <img src="public/imgs/noprod.png" alt="Portada {{codprd}} {{dscprd}}" class="imgPrd" /> </span>
                {{endifnot urlprd}}

                <!-- Input para subir la imagen. Type file para que aparezca la opcion de subir uno nuevo "Choose file" -->
                <input class="col-sm-12 col-md-6 col-offset-3" type="file" name="uploadUrlPrd" id="uploadUrlPrd" {{readonly}}/>

                <!-- Boton para guardar la imagen -->
                &nbsp;
                <button type="submit" name="btnGuardarUrlPrd" class="m-padding btn-primary">Guardar</button>

                <!-- Texto de instrucciones sobre que archivos se pueden subir -->
                <span class="center col-12 col-sm-12">Imagen jpg, png, o svg de 480 x 480 px y 115 dpi</span>
            </fieldset>


            <!-- IMAGEN DE CATALOGO -->
            <fieldset>
                <label class="col-12 col-sm-4 col-md-3">Imagen de Catálogo: &nbsp;</label>
                {{if urlthbprd}}
                    <span class="col-12 col-sm-8 col-md-9 center"> <img src="{{urlthbprd}}" alt="Catálogo {{skuprd}} {{dscprd}}" class="imgthumb" /> </span>
                {{endif urlthbprd}}

                {{ifnot urlthbprd}}
                    <span class="col-12 col-sm-8 col-md-9 center"> <img src="public/imgs/noprodthb.png" alt="Catálogo {{codprd}} {{dscprd}}" class="imgthumb" /> </span>
                {{endifnot urlthbprd}}

                <input class="col-sm-12 col-md-6 col-offset-3" type="file" name="uploadUrlThbPrd" id="uploadUrlThbPrd" {{readonly}}/> &nbsp;
                <button type="submit" name="btnGuardarUrlThbPrd" class="m-padding btn-primary">Guardar</button>
                <span class="center col-12 col-sm-12">Imagen jpg, png, o svg de 115 x 115 px y 115 dpi</span>
            </fieldset>

            <fieldset class="right">
                <button id="botCancelar" class="m-padding">Cerrar</button>
            </fieldset>
        </form> 
    </main>
</section>

<script>
    var botCancelar = document.getElementById("botCancelar");

    botCancelar.addEventListener("click", function (e) 
    {
        e.preventDefault();
        e.stopPropagation();
        window.location.assign("index.php?page=productos");
    });
</script>