<main class="contenedor seccion contenido-centrado">
    <h1>Crear Sesion</h1>
    <?php foreach($errores as $error): ?>
        <div class="alerta error">
            <?php echo $error; ?>
        </div>
    <?php endforeach; ?>
    <form method="POST" class="formulario" action="/crear" novalidate>
        <fieldset>
            <legend>Email y Password </legend>

            <label for="email">E-mail</label>
            <input type="email" name="email" placeholder="Tu Email" id="email" required>
        
            <label for="password">Password</label>
            <input type="password"  name="password" placeholder="Tu Password" id="password" required> 
        </fieldset>

        <input type="submit" value="Crear Sesion" class="boton boton-verde">
    </form>
</main>