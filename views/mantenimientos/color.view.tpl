<section>
    <header>
        <h1>{{modedsc}}</h1>
    </header>

    <main>
        <form action="index.php?page=color&mode={{mode}}&colorcod={{colorcod}}" method="post">

            <input type="hidden" name="colorcod" value="{{colorcod}}"/>
            <input type="hidden" name="mode" value="{{mode}}"/>
            <input type="hidden" name="token" value="{{token}}"/>

            <fieldset>
                <label for="colorcod">Código: &nbsp;</label>
                <input type="text" name="colorcoddummy" value="{{colorcod}}" placeholder="Codigo" disabled readonly/>
            </fieldset>

            <fieldset>
                <label for="colorhxd">Código Hexadecimal: &nbsp;</label>
                <input type="text" name="colorhxd" value="{{colorhxd}}" maxlength="7" placeholder="#FFFFFF" {{if isReadOnly}} disabled readonly {{endif isReadOnly}}/>
            </fieldset>

            <fieldset>
                <label for="colordsc">Descripción: &nbsp;</label> 
                <input type="text" name="colordsc" value="{{colordsc}}" maxlength="70" placeholder="Blanco" {{if isReadOnly}} disabled readonly {{endif isReadOnly}}/>
            </fieldset>

            <fieldset>
                <label for="colorobs">Lugar Sugerido de Aplicación: &nbsp;</label>
                <input type="text" name="colorobs" value="{{colorobs}}" maxlength="128" placeholder="Pared de la Casa" {{if isReadOnly}} disabled readonly {{endif isReadOnly}}/>
            </fieldset>

            <fieldset>
                <label for="colorest">Estado: &nbsp;</label>
                <select name="colorest" {{if isReadOnly}} disabled readonly {{endif isReadOnly}}>
                    <option value="ACT" {{colorEstACTTrue}}>Activo</option>
                    <option value="INA" {{colorEstINATrue}}>Inactivo</option> 
                </select>
            </fieldset>

            <fieldset>
                {{if hasAction}} <button type="submit" name="botGuardar">Guardar</button> {{endif hasAction}}
                &nbsp; &nbsp;
                <button type="submit" name="botCancelar">Cancelar</button>
            </fieldset>
        </form>
    </main>
</section>

<script>
    var botCancelar = document.getElementsByName("botCancelar")[0];

    botCancelar.addEventListener("click", function(e)
    {
        e.preventDefault();
        e.stopPropagation();

        window.location.assign("index.php?page=colores");
    });
</script>