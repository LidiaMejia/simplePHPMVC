<header>
    <h1>Crear Nueva Cuenta</h1>
</header>

<main>
    <form action="index.php?page=register" method="post" class="row">
        <input type="hidden" name="token" value="{{token}}"/>
        
        <fieldset>
            <label>Correo Electrónico: &nbsp;</label>
            <input type="email" name="userEmail" id="userEmail" value="{{userEmail}}" placeholder="Correo"/>
        </fieldset>

        <fieldset>
            <label>Contraseña: &nbsp;</label>
            <input type="password" name="password" value="{{password}}" placeholder="Contraseña"/> &nbsp;
            <span><em>Mínimo 8 caracteres, un número, una mayúscula y un símbolo especial</em></span>
        </fieldset>

        <fieldset>
            <label>Confirmar Contraseña: &nbsp;</label>
            <input type="password" name="passwordCnf" value="{{passwordCnf}}" placeholder="Confirmar Contraseña"/>
        </fieldset>

        <fieldset>
            <button id="btnNuevaCuenta">Nueva Cuenta</button> &nbsp;
            <button>Iniciar Sesión</button>
        </fieldset>
    </form>
</main>

<script>
    var btnNuevaCuenta = document.getElementById("btnNuevaCuenta");

    btnNuevaCuenta.addEventListener("click", function(e)
    {
        e.preventDefault();
        e.stopPropagation();

        /* VALIDACIONES 

           En la carpeta Public / js / Se crea un js validators.js
        */

        /* Correo Valido a nivel de Cliente */
        email = $("#userEmail").val(); 
        alert(email);
    });
</script>