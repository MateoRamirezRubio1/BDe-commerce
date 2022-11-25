<main>
    <h2>Registrarse</h2>

    <?php foreach ($errores as $error) : ?>
        <div>
            <?php echo $error; ?>
        </div>
    <?php endforeach ?>

    <form method="POST" action="/register">
        <fieldset>
            <legend>Información Personal</legend>

            <label for="name">Full name</label>
            <input type="text" name="full_name" placeholder="Tu nombre" id="name">

            <label for="direccion">Billing Address</label>
            <input type="text" name="billing_address" placeholder="Tu dirección" id="direccion">

            <label for="pais">Country</label>
            <input type="text" name="country" placeholder="País de residencia" id="pais">

            <label for="telefono">Phone</label>
            <input type="number" name="phone" placeholder="Tu teléfono" id="telefono">

            <input type="hidden" name="default_shipping_address" value="oficina principal">
        </fieldset>

        <fieldset>
            <legend>Creación Email y Contraseña</legend>

            <label for="email">Email</label>
            <input type="email" name="email" placeholder="Tu email" id="email">

            <label for="password">Password</label>
            <input type="password" name="password" id="password" placeholder="Tu password">

        </fieldset>

        <input type="submit" value="Registrarse">
    </form>
</main>