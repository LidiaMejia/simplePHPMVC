<section>
    <header>
        <h1>Trabajando con Insert</h1>
    </header>

    <main>
        <form action="index.php?page=categoria" method="post"> <!-- action desde el index de la URL -->
            <!-- Se toman los datos a llenar respetando el tamanio del dato en la base. COMO NAME LOS MISMOS NOMBRES DE LA BASE -->
            <fieldset>
                <label>Codigo: &nbsp;</label>
                <input type="text" name="ctgcod" value="{{ctgcod}}" placeholder="Codigo"/>
            </fieldset>

            <fieldset>
                <label>Categoria: &nbsp;</label>
                <input type="text" name="ctgdsc" value="{{ctgdsc}}" maxlength="70" placeholder="Descripcion de la Categoria"/>
            </fieldset>

            <fieldset>
                <label>Estado: &nbsp;</label>
                <select name="ctgest">
                    <option value="ACT" {{ctgEstACTTrue}}>Activo</option> 
                    <option value="INA" {{ctgEstINATrue}}>Inactivo</option>
                </select>
            </fieldset>

            <fieldset>
                <button type="submit" name="btnConfirmar">Guardar</button>
                &nbsp;
                <button type="submit" name="btnCancelar" id="botCancel">Cancelar</button> 
            </fieldset>
        </form>
    </main>
</section>

<!-- QUE CUANDO LE DE CLIC A CANCELAR LE DEVUELVA A LAS CATEGORIAS -->
<script>

var botCancel = document.getElementById("botCancel"); 

botCancel.addEventListener("click", function(e)
{
    e.preventDefault();
    e.stopPropagation();

    window.location.assign("index.php?page=categorias");
});

</script>

