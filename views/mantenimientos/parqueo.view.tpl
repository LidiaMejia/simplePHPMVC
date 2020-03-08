<section>
    <header>
        <h1>{{modedsc}}</h1>
    </header>

    <main>
        <form action="index.php?page=parqueo&mode={{mode}}parqueoId={{parqueoId}}" method="POST">
            <input type="hidden" name="parqueoId" value="{{parqueoId}}"/>
            <input type="hidden" name="mode" value="{{mode}}"/> 
            <input type="hidden" name="token" value="{{token}}"/>

            <fieldset>
                <label>ID: &nbsp;</label>
                <input type="text" name="parqueoIdDummy" value="{{parqueoId}}" placeholder="ID" disabled readonly/>
            </fieldset>

            <fieldset>
                <label>Estado: &nbsp;</label>
                <select name="parqueoEst" {{if isReadOnly}} disabled readonly {{endif isReadOnly}}>
                    <option value="AVL" {{parqueoEstAVLTrue}}>Disponible</option>
                    <option value="OCP" {{parqueoEstOCPTrue}}>Ocupado</option>
                    <option value="RSV" {{parqueoEstRSVTrue}}>Reservado</option>
                </select>
            </fieldset>

            <fieldset>
                <label>Lote: &nbsp;</label>
                <input type="text" name="parqueoLot" value="{{parqueoLot}}" maxlength="75" placeholder="Biblioteca" {{if isReadOnly}} disabled readonly {{endif isReadOnly}}/>
            </fieldset>

            <fieldset>
                <label>Tipo: &nbsp;</label>
                <select name="parqueoTip" {{if isReadOnly}} disabled readonly {{endif isReadOnly}}>
                    <option value="MTO" {{parqueoTipMTOTrue}}>Moto</option>
                    <option value="CAR" {{parqueoTipCARTrue}}>Carro</option>
                    <option value="TRK" {{parqueoTipTRKTrue}}>Camión</option>
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

        window.location.assign("index.php?page=parqueos");
    });
</script>
