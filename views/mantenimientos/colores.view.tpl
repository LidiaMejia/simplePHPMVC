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
                    <th>Estado</th>
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
                    <td>{{colorest}}</td>
                    <td>
                        <a href="index.php?page=color&mode=UPD&colorcod={{colorcod}}">Editar</a> &nbsp;
                        <a href="index.php?page=color&mode=DSP&colorcod={{colorcod}}">Ver</a> &nbsp;
                        <a href="index.php?page=color&mode=DEL&colorcod={{colorcod}}">Eliminar</a>
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

        window.location.assign("index.php?page=color&mode=INS&colorcod=0");
    });
</script>