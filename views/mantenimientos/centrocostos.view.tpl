<section>
    <header>
        <h1>{{modedsc}}</h1>
    </header>

    <main>
        <form action="index.php?page=centrocostos&mode={{mode}}&ccid={{ccid}}" method="post">
            <input type="hidden" name="ccid" value="{{ccid}}"/>
            <input type="hidden" name="mode" value="{{mode}}"/>
            <input type="hidden" name="token" value="{{token}}" />

            <fieldset>
                <label>Código: &nbsp;</label>
                <input type="text" name="ccidDummy" value="{{ccid}}" placeholder="Código" disabled readonly/>
            </fieldset>

            <fieldset>
                <label>Centro de Costos: &nbsp;</label>
                <input type="text" name="ccdsc" value="{{ccdsc}}" maxlength="75" placeholder="Sucursal Tegucigalpa" {{if isReadOnly}} disabled readonly {{endif isReadOnly}}/>
            </fieldset>

            <fieldset>
                <label>Estado: &nbsp;</label>
                <select name="ccest" {{if isReadOnly}} disabled readonly {{endif isReadOnly}}>
                    <option value="ACT" {{ccestACTTrue}}>Activo</option>
                    <option value="INA" {{ccestINATrue}}>Inactivo</option>
                </select>
            </fieldset>

            <fieldset>
                <label>Tipo: &nbsp;</label>
                <select name="cctipo" {{if isReadOnly}} disabled readonly {{endif isReadOnly}}>
                    <option value="NAC" {{cctipoNACTrue}}>Nacional</option>
                    <option value="INT" {{cctipoINTTrue}}>Internacional</option>
                    <option value="MUN" {{cctipoMUNTrue}}>Mundial</option>
                </select>
            </fieldset>

            <fieldset>
                {{if hasAction}} <button type="submit">Guardar</button> &nbsp; {{endif hasAction}}
                <button tyoe="submit" id="botCancelar">Cancelar</button>
            </fieldset>
        </form>
    </main>
</section>

<script>
    var botCancelar = document.getElementById("botCancelar");

    botCancelar.addEventListener("click", function(e)
    {
        e.preventDefault();
        e.stopPropagation();

        window.location.assign("index.php?page=centroscostos");
    });
</script>