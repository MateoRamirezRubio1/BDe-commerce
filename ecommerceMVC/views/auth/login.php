<main>
    <h2>Iniciar Sesión</h2>

    <?php foreach ($errores as $error) : ?>
        <div>
            <?php echo $error; ?>
        </div>
    <?php endforeach ?>

    <form method="POST" action="/BDe-commerce/ecommerceMVC/public/index.php/login" novalidate>
        <fieldset>
            <legend>Email y Password</legend>

            <label for="email">Email</label>
            <input type="email" name="email" placeholder="Tu email" id="email">

            <label for="password">Password</label>
            <input type="password" name="password" id="password" placeholder="Tu password">
        </fieldset>

        <input type="submit" value="Login">
    </form>

    <p>Si no tienes cuenta</p>
    <a href="/BDe-commerce/ecommerceMVC/public/index.php/register">Regitrarse</a>
</main>
