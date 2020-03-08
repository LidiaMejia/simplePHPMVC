<section>
    <header>
        <h1>Trabajando con Parqueos</h1>
    </header>

    <main>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Estado</th>
                    <th>Lote</th>
                    <th>Tipo</th>
                    <th> <button id="botAddNew">Nuevo</button> </th>
                </tr>
            </thead>

            <tbody>
                {{foreach parqueos}}
                <tr>
                    <td>{{parqueoId}}</td>
                    <td>{{parqueoEst}}</td>
                    <td>{{parqueoLot}}</td>
                    <td>{{parqueoTip}}</td> 
                    <td>
                        <a href="index.php?page=parqueo&mode=UPD&parqueoId={{parqueoId}}">Editar</a> &nbsp;
                        <a href="index.php?page=parqueo&mode=DSP&parqueoId={{parqueoId}}">Ver</a> &nbsp;
                        <a href="index.php?page=parqueo&mode=DEL&parqueoId={{parqueoId}}">Eliminar</a>
                    </td>
                </tr>
                {{endfor parqueos}}
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

        window.location.assign("index.php?page=parqueo&mode=INS&parqueoId=0");
    });
</script>