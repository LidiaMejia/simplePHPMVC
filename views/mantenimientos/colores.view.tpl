<section>
    <header>
        <h1> Listado de Colores </h1> 
    </header>

    <main>
        <table>
            <thead>
                <tr>
                    <th>Código</th>
                    <th>Hexadecimal</th>
                    <th>Descripción</th>
                    <th>Lugar Sugerido</th>
                    <th> <button>Añadir</button> </th>
                </tr>
            </thead>

            <tbody>
                {{foreach colores}}
                <tr>
                    <td>{{colorcod}}</td>
                    <td>{{colorhxd}}</td>
                    <td>{{colordsc}}</td>
                    <td>{{colorobs}}</td>
                    <td>
                        <button>Editar</button>
                        <button>Borrar</button>
                        <button>Ver</button>
                    </td>
                </tr>
                {{endfor colores}} 
            </tbody>
        </table>
    </main>
</section>