<section>
    <header>
        <h1>Trabajar con Categorias</h1>
    </header>

    <main>
        <table>
            <thead>
                <tr>
                    <th>Codigo</th>
                    <th>Categoria</th>
                    <th>Estado</th>
                    <th> <button id="botAddNew">Add New</button> </th>
                </tr>
            </thead>

            <tbody>
                {{foreach categorias}} <!-- Metaetiqueta del id del array en controller -->
                <tr>
                    <td>{{ctgcod}}</td> <!-- SE MANDA A LLAMAR LOS NOMBRES DE LAS COLUMNAS EN LAS TABLAS -->
                    <td>{{ctgdsc}}</td>
                    <td>{{ctgest}}</td>
                    <td>
                        <a href="index.php?page=categoria&mode=UPD&ctgcod={{ctgcod}}">Editar</a> &nbsp;
                        <a href="index.php?page=categoria&mode=DSP&ctgcod={{ctgcod}}">Ver</a> &nbsp;
                        <a href="index.php?page=categoria&mode=DEL&ctgcod={{ctgcod}}">Eliminar</a>
                    </td>
                </tr>
                {{endfor categorias}}
            </tbody>
        </table>
    </main>
</section>

<!-- QUE CUANDO LE DE CLIC AL BOTON "Add New" LO REDIRIGA A LA PAGINA DE CREACION DE UNA NUEVA CATEGORIA -->
<script>

 /* SOLO COMENTAR DENTRO DEL SCRIPT CON MULTILINEA, SINO NO FUNCIONA!!!!!!!!!!!!!!!!!! */

 var botAddNew = document.getElementById("botAddNew");

 botAddNew.addEventListener("click", function(e)
 {
    e.preventDefault();
    e.stopPropagation();

    /* Con la variable mode estamos indicando que accion queremos realizar cuando se abra el form, 
       y cual es la variable con la que se identifican los registros de esa tabal den la BDD */
    window.location.assign("index.php?page=categoria&mode=INS&ctgcod=0");
 }); 

</script>

