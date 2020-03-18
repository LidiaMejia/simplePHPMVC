<header>
    <h1>Crear Nueva Cuenta</h1>
</header>

<main class="row">
</br>
    <form action="index.php?page=register" method="post" id="formRegister" class="col-8 col-offset-2"> <!-- Se le coloca id al form -->
        {{if hasErrors}}
            <div class="alert alert-danger">
                <ul>
                    {{foreach errors}}
                        <li>{{this}}</li>
                    {{endfor errors}}
                </ul>
            </div>
        {{endif hasErrors}}

        <input type="hidden" name="token" value="{{token}}"/>
        
        <fieldset class="row">
            <label class="col-4">Correo Electrónico: &nbsp;</label>
            <input class="col-8" type="email" name="userEmail" id="userEmail" value="{{userEmail}}" placeholder="correo@electronico.com"/>
            <span id="userEmailError"></span>
        </fieldset>

        <fieldset class="row">
            <label class="col-4">Contraseña: &nbsp;</label>
            <input class="col-8" type="password" name="password" id="password" value="{{password}}" placeholder="Contraseña"/>
            <span id="passwordError"></span>
        </fieldset>

        <fieldset class="row">
            <label class="col-4">Confirmar Contraseña: &nbsp;</label>
            <input class="col-8" type="password" name="passwordCnf" id="passwordCnf" value="{{passwordCnf}}" placeholder="Confirmar Contraseña"/>
            <span id="passwordCnfError"></span>
            <span class="col-8 col-offset-4"><em>Mínimo 8 caracteres, un número, una mayúscula y un simbolo especial</em></span>
        </fieldset>

        <fieldset class="row right">
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

        /* VALIDACIONES A NIVEL DE CLIENTE

           Cuando se da clic al boton se verifican cada uno de los campos ingresados.

           En la carpeta Public / js / Se crea un js validators.js QUE SE LLAMA EN EL CONTROLADOR PARA PODER USAR SUS FUNCIONES AQUI
        */

        /*
            - Se guardan los valores de cada campo. 
            - Se remueve estilo al error de cada campo.
        */

        email = $("#userEmail").val();     
        $("#userEmailError").html('').removeClass("error col-8 col-offset-4");

        password = $("#password").val();
        $("#passwordError").html('').removeClass("error col-8 col-offset-4");

        passwordCnf = $("#passwordCnf").val();
        $("#passwordCnfError").html('').removeClass("error col-8 col-offset-4");

        /* Al inicio NO hay ningun error */
        errors = false;

        /*
            - Se verifica si hay error en cada campo con las funciones de validators.js
            - Si hay un error, se pone true y se agrega la descripcion con estilo al error PARA QUE SEA MOSTRADA.
        */

        if(!isEmailOk(email)) 
        {
            errors = true;
            $("#userEmailError").html('Correo en formato incorrecto').addClass("error col-8 col-offset-4");
        }

        if(!isNotEmpty(email))
        {
            errors = true;
            $("#userEmailError").html('Correo vacío').addClass("error col-8 col-offset-4");
        }

        /*if (!isPasswordOk(password)) 
        {
            errors = true;
            $("#passwordError").html('Contraseña en formato incorrecto').addClass("error col-8 col-offset-4");
        }*/ 

        if(!isNotEmpty(password))
        {
            errors = true;
            $("#passwordError").html('Contraseña vacía').addClass("error col-8 col-offset-4");
        }

        if(password !== passwordCnf) /* Si la contraseña esta vacia para que no tome como que ambas vacias son iguales */
        {
            errors = true;
            $("#passwordCnfError").html('Las contraseñas no coinciden').addClass("error col-8 col-offset-4");
        }

        /* SI NO HAY ERRORES, SE MANDA EL FORMULARIO */
        if(!errors)
        {
            $("#formRegister").submit();
        }
        else
        {
            alert("Tiene errores. Intente de nuevo");
        }

    });
</script>