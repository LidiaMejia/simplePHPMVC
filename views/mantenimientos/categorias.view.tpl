<section>
    <header>
        <h1>Trabajar con Categorias</h1>
    </header>

    <main>
        <table>
            <thead>
                <tr>
                    <th>Codigo</th>
                    <th>Categorias</th>
                    <th>Estado</th>
                    <th> <button>Add New</button> </th>
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