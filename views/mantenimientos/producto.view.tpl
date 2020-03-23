<section>
    <header>
        <h1>{{modedsc}}</h1>
    </header>

    <main>
        <form action="index.php?page=producto&mode={{mode}}&codprd={{codprd}}" method="POST">
            <input type="hidden" name="codprd" value="{{codprd}}"/>
            <input type="hidden" name="mode" value="{{mode}}"/>
            <input type="hidden" name="token" value="{{token}}"/>

            <fieldset>
                <label>Código: &nbsp;</label>
                <input type="text" name="dummy" value="{{codprd}}" placeholder="Código" disabled readonly/>
            </fieldset>

            <fieldset>
                <label>Descripción Comercial: &nbsp;</label>
                <input type="text" name="dscprd" value="{{dscprd}}" maxlength="70" placeholder="Yuquitas" {{if isReadOnly}} disabled readonly {{endif isReadOnly}}/>
            </fieldset>

            <fieldset>
                <label>Descripción Corta: &nbsp;</label>
                <input type="text" name="sdscprd" value="{{sdscprd}}" maxlength="255" placeholder="Bolsa de churro Yuquitas" {{if isReadOnly}} disabled readonly {{endif isReadOnly}}/>
            </fieldset>

            <fieldset>
                <label>Descripción Larga: &nbsp;</label>
                <input type="text" name="ldscprd" value="{{ldscprd}}" placeholder="Unidad de bolsa de churro Yuquitas de 10mg" {{if isReadOnly}} disabled readonly {{endif isReadOnly}}/>
            </fieldset>

            <fieldset>
                <label>Código Interno: &nbsp;</label>
                <input type="text" name="skuprd" value="{{skuprd}}" maxlength=128 placeholder="YUQ123" {{if isReadOnly}} disabled readonly {{endif isReadOnly}}/>
            </fieldset>

            <fieldset>
                <label>Código de Barra: &nbsp;</label>
                <input type="text" name="bcdprd" value="{{bcdprd}}" maxlength="128" placeholder="012345678901" {{if isReadOnly}} disabled readonly {{endif isReadOnly}}/>
            </fieldset>

            <fieldset>
                <label>Stock: &nbsp;</label>
                <input type="number" name="stkprd" value="{{stkprd}}" min="1" placeholder="50" {{if isReadOnly}} disabled readonly {{endif isReadOnly}}/>
            </fieldset>

            <fieldset>
                <label>Tipo: &nbsp;</label>
                <select name="typprd" {{if isReadOnly}} disabled readonly {{endif isReadOnly}}>
                    <option value="RTL" {{typeRTLTrue}}>Retail</option>
                    <option value="SRV" {{typeSRVTrue}}>Servicio</option>
                    <option value="ISK" {{typeISKTrue}}>Infinite Stock</option>
                </select>
            </fieldset>

            <fieldset>
                <label>Precio: &nbsp;</label>
                <input type="text" name="prcprd" value="{{prcprd}}" maxlength="15" placeholder="10.00" {{if isReadOnly}} disabled readonly {{endif isReadOnly}}/>
            </fieldset>

            <fieldset>
                <label>URL imagen: &nbsp;</label>
                <input type="text" name="urlprd" value="{{urlprd}}" maxlength="255" placeholder="urlImagen" {{if isReadOnly}} disabled readonly {{endif isReadOnly}}/>
            </fieldset>

            <fieldset>
                <label>URL imagen pequeña: &nbsp;</label>
                <input type="text" name="urlthbprd" value="{{urlthbprd}}" maxlength="255" placeholder="urlPeqImagen" {{if isReadOnly}} disabled readonly {{endif isReadOnly}}/>
            </fieldset>
            
            <fieldset>
                <label>Estado: &nbsp;</label>
                <select name="estprd" {{if isReadOnly}} disabled readonly {{endif isReadOnly}}>
                    <option value="ACT" {{estACTTrue}}>Activo</option>
                    <option value="INA" {{estINATrue}}>Inactivo</option>
                    <option value="PLN" {{estPLNTrue}}>Planificación</option>
                    <option value="RET" {{estRETTrue}}>Retirado</option>
                    <option value="DSC" {{estDSCTrue}}>Descontinuado</option>
                </select>
            </fieldset>

            <fieldset>
                {{if hasAction}} <button type="submit" name="botGuardar">Guardar</button> &nbsp; {{endif hasAction}}
                <button type="submit" id="botCancelar">Cancelar</button>
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

        window.location.assign("index.php?page=productos");
    });
</script>