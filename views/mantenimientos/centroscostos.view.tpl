<section>
    <header>
        <h1>Centros de Costos</h1>
    </header>

    <main>
        <table>
            <thead>
                <tr>
                    <th>Código</th>
                    <th>Centro de Costo</th>
                    <th>Estado</th>
                    <th>Tipo</th>
                    <th><button id="botAddNew">Nuevo</button></th>
                </tr>
            </thead>

            <tbody>
                {{foreach centroscostos}}
                <tr>
                    <td>{{ccid}}</td>
                    <td>{{ccdsc}}</td>
                    <td>{{ccest}}</td>
                    <td>{{cctipo}}</td>
                    <td>
                        <a href="index.php?page=centrocostos&mode=UPD&ccid={{ccid}}}">Editar</a> &nbsp;
                        <a href="index.php?page=centrocostos&mode=DSP&ccid={{ccid}}}">Ver</a> &nbsp;
                        <a href="index.php?page=centrocostos&mode=DEL&ccid={{ccid}}}">Eliminar</a>
                    </td>
                </tr>
                {{endfor centroscostos}}
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
       
       window.location.assign("index.php?page=centrocostos&mode=INS&ccid=0");
    });
</script>