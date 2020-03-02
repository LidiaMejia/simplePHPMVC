<section>
    <header>
        <h1>{{modedsc}}</h1>
    </header>

    <main>
        <form action="index.php?page=libro&mode={{mode}}&librocod={{librocod}}" method="post">

            <input type="hidden" name="librocod" value="{{librocod}}"/>
            <input type="hidden" name="mode" value="{{mode}}"/>
            <input type="hidden" name="token" value="{{token}}" />

            <fieldset>
                <label>Código: &nbsp;</label>
                <input type="text" name="librocoddummy" value="{{librocod}}" placeholder="Código" disabled readonly/>
            </fieldset>

            <fieldset> 
                <label>Nombre: &nbsp;</label>
                <input type="text" name="libronom" value="{{libronom}}" maxlength="100" placeholder="Nombre del Libro" {{if isReadOnly}} disabled readonly {{endif isReadOnly}}/>
            </fieldset>

            <fieldset>
                <label>Autor: &nbsp;</label>
                <input type="text" name="libroautor" value="{{libroautor}}" maxlength="100" placeholder="Autor del Libro" {{if isReadOnly}} disabled readonly {{endif isReadOnly}}/>
            </fieldset>

            <fieldset>
                <label>Estado: &nbsp;</label>
                <select name="libroest" {{if isReadOnly}} disabled readonly {{endif isReadOnly}}>
                    <option value="DIS" {{libroEstDISTrue}}>Disponible</option>
                    <option value="NOD" {{libroEstNODTrue}}>No Disponible</option>
                </select>
            </fieldset>

            <fieldset>
                {{if hasAction}} <button type="submit" name="botGuardar">Guardar</button> {{endif hasAction}}
                &nbsp;
                &nbsp;
                <button type="submit" name="botCancelar">Cancelar</button>
            </fieldset>
        </form>
    </main>
</section>

<script>
    var botCancelar = document.getElementsByName("botCancelar")[0];

    botCancelar.addEventListener("click", function(e){

        e.preventDefault();
        e.stopPropagation();

        window.location.assign("index.php?page=libros");
    });
</script>