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
                        <button>Edit</button>
                        <button>Delete</button>
                        <button>View</button>
                    </td>
                </tr>
                {{endfor categorias}}
            </tbody>
        </table>
    </main>
</section>

<!-- QUE CUANDO LE DE CLIC AL BOTON "Add New" LO REDIRIGA A LA PAGINA DE CREACION DE UNA NUEVA CATEGORIA -->
<script>

 var botAddNew = document.getElementById("botAddNew");

 botAddNew.addEventListener("click", function(e)
 {
    e.preventDefault();
    e.stopPropagation();

    window.location.assign("index.php?page=categoria");
 }); 

</script>

