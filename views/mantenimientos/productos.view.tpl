<section>
    <header>
        <h1>Productos</h1>
    </header>

    <main>
        <table>
            <thead>
                <tr>
                    <th>Código</th>
                    <th>Descripción Comercial</th>
                    <th>Descripción Corta</th>
                    <th>Descripción Larga</th>
                    <th>Código Interno</th>
                    <th>Código de Barra</th>
                    <th>Stock</th>
                    <th>Tipo</th>
                    <th>Precio</th>
                    <th>URL Imagen</th>
                    <th>URL Imagen Pequeña</th>
                    <th>Estado</th>
                    <th> <button id="botAddNew">Nuevo</button> </th>
                </tr>
            </thead>

            <tbody>
                {{foreach productos}}
                <tr>
                    <td>{{codprd}}</td>
                    <td>{{dscprd}}</td>
                    <td>{{sdscprd}}</td>
                    <td>{{ldscprd}}</td>
                    <td>{{skuprd}}</td>
                    <td>{{bcdprd}}</td>
                    <td>{{stkprd}}</td>
                    <td>{{typprd}}</td>
                    <td>{{prcprd}}</td>
                    <td>{{urlprd}}</td>
                    <td>{{urlthbprd}}</td>
                    <td>{{estprd}}</td>
                    <td>
                        <a href="index.php?page=producto&mode=UPD&codprd={{codprd}}">Editar</a> <br/>
                        <a href="index.php?page=producto&mode=DSP&codprd={{codprd}}">Ver</a> <br/>
                        <a href="index.php?page=producto&mode=DEL&codprd={{codprd}}">Eliminar</a>
                    </td>
                </tr>
                {{endfor productos}}
            </tbody>
        </table>
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