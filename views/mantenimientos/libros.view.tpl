<section>
    <header>
        <h1>Trabajando con Libros</h1>
    </header>

    <main>
        <table>
            <thead>
                <tr>
                    <th>Código</th>
                    <th>Nombre</th>
                    <th>Autor</th>
                    <th>Estado</th>
                    <th> <button id="botNuevo">Añadir</button> </th>
                </tr>
            </thead>

            <tbody>
                {{foreach libros}}
                <tr>
                    <td>{{librocod}}</td>
                    <td>{{libronom}}</td>
                    <td>{{libroautor}}</td>
                    <td>{{libroest}}</td>
                    <td> 
                        <a href="index.php?page=libro&mode=UPD&librocod={{librocod}}">Editar</a> &nbsp;
                        <a href="index.php?page=libro&mode=DSP&librocod={{librocod}}">Ver</a> &nbsp;
                        <a href="index.php?page=libro&mode=DEL&librocod={{librocod}}">Eliminar</a> 
                    </td>
                </tr>
                {{endfor libros}}
            </tbody>
        </table>
    </main>
</section>

<script>
    var botNuevo = document.getElementById("botNuevo");

    botNuevo.addEventListener("click", function(e){

        e.preventDefault();
        e.stopPropagation();

        window.location.assign("index.php?page=libro&mode=INS&librocod=0");
    });
</script>