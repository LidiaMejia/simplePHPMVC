<section>
    <header>
        <h1>Trabajando con Insert - Nuevo Color</h1>
    </header>

    <main>
        <form action="index.php?page=color" method="post">
            <fieldset>
                <label for="colorcod">Código: &nbsp;</label>
                <input type="text" name="colorcod" value="{{colorcod}}" placeholder="Codigo"/>
            </fieldset>

            <fieldset>
                <label for="colorhxd">Código Hexadecimal: &nbsp;</label>
                <input type="text" name="colorhxd" value="{{colorhxd}}" maxlength="7" placeholder="#FFFFFF"/>
            </fieldset>

            <fieldset>
                <label for="colordsc">Descripción: &nbsp;</label> 
                <input type="text" name="colordsc" value="{{colordsc}}" maxlength="70" placeholder="Blanco" />
            </fieldset>

            <fieldset>
                <label for="colorobs">Lugar Sugerido de Aplicación: &nbsp;</label>
                <input type="text" name="colorobs" value="{{colorobs}}" maxlength="128" placeholder="Pared de la Casa"/>
            </fieldset>

            <fieldset>
                <button type="submit" name="botGuardar">Guardar</button>
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