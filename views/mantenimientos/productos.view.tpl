<section>
    <header>
        <h1>Trabajar con Productos</h1>
    </header>

    <main class="row">
        <div class="col-12 col-md-10 col-offset-1">
            <table class="full-width">
                <thead>
                    <tr>
                        <th>Código</th>
                        <th>Descripción</th>
                        <th>Código Interno</th>
                        <th>Código de Barra</th>
                        <th>Stock</th>
                        <th>Tipo</th>
                        <th>Precio</th>
                        <th class="center">Imagen</th>
                        <th>Estado</th>
                        <th> <a href="" id="botAddNew" class="btn depth-1 s-margin"><span class="ion-plus-circled"></span></a> </th>
                    </tr>
                </thead>

                <tbody class="zebra">
                    {{foreach productos}}
                    <tr>
                        <td>{{codprd}}</td>
                        <td>{{dscprd}}</td>
                        <td>{{skuprd}}</td>
                        <td>{{bcdprd}}</td>
                        <td>{{stkprd}}</td>
                        <td>{{typprd}}</td>
                        <td>{{prcprd}}</td>

                        <td>
                            <!-- Si no hay imagen pequeña, se coloca el icono de agregar una a ese producto -->
                            {{ifnot urlthbprd}}
                                <a href="index.php?page=productoimg&codprd={{codprd}}" class="btn depth-1 s-margin"> <span class="ion-upload"></span> </a>
                            {{endifnot urlthbprd}}

                            <!-- Si ya hay una imagen pequeña para el producto, se muestra (se le da la url como source src en la img) y se le puede dar clic para modificarla -->
                            {{if urlthbprd}}
                                <a href="index.php?page=productoimg&codprd={{codprd}}" class="depth-1 s-margin"> <img src="{{urlthbprd}}" alt="{{codprd}} {{dscprd}}"/> </a>
                            {{endif urlthbprd}}
                        </td>

                        <td>{{estprd}}</td>
                        
                        <td>
                            <a href="index.php?page=producto&mode=UPD&codprd={{codprd}}" class="btn depth-1 s-margin"> <span class="ion-edit"></span> </a> <br/>
                            <a href="index.php?page=producto&mode=DSP&codprd={{codprd}}" class="btn depth-1 s-margin"> <span class="ion-eye"></span> </a> <br/>
                        </td>
                    </tr>
                    {{endfor productos}}
                </tbody>
            </table>
        </div>
    </main>
</section>

<script>
    var botAddNew = document.getElementById("botAddNew");

    botAddNew.addEventListener("click", function(e)
    {
        e.preventDefault();
        e.stopPropagation();

        window.location.assign("index.php?page=producto&mode=INS&codprd=0");
    });
</script>