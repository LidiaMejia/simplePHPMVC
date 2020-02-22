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
                    <th> <button id="botAdd">Añadir</button> </th>
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

<script>
    var botAdd = document.getElementById("botAdd"); 

    botAdd.addEventListener("click", function(e)
    {
        e.preventDefault();
        e.stopPropagation();

        window.location.assign("index.php?page=color");
    });
</script>