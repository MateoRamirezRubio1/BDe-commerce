<main>
    <aside>
        <div>
            <h3>Filtros</h3>

            <form action="/" method="GET">
                <label for="">Buscar por nombre</label>
                <input type="text" placeholder="El: Martillo" name="buscar">

                <label for="">Precio</label>
                <input type="number" placeholder="Min" name="precioMinimo">
                <input type="number" placeholder="Max" name="precioMaximo">

                <p>Orden precio:

                    <input type="radio" name="orden" value="asc"> Ascendente
                    <input type="radio" name="orden" value="des"> Descendente
                </p>

                <input type="submit" value="Aplicar">
            </form>
        </div>


        <div>
            <h3>Categorias</h3>

            <nav>
                <?php foreach ($categorias as $categoria) : ?>
                    <a href="/?nombre=<?php echo $categoria->name ?>&categoria=<?php echo $categoria->id ?>"><?php echo $categoria->name; ?></a>
                <?php endforeach; ?>
            </nav>
        </div>
    </aside>

    <section>
        <?php if ($idCategoria == -1 || $idCategoria == null) : ?>
            <h2>Todos los Productos</h2>
        <?php
        endif;
        if ($idCategoria != -1 && $idCategoria != null) :
        ?>
            <h2>Productos de <?php echo $nombreCategoria ?></h2>
        <?php endif; ?>

        <?php foreach ($productosCategoria as $producto) :

            echo "SKU: " . $producto->sku;
            echo "<br>";
            echo $producto->name;
            echo "<br>";
            echo "Precio: " . $producto->price;
            echo "<br>";
        ?>
            <a href="/producto?producto=<?php echo $producto->id; ?>">Ver Producto</a>

            <?php if ($producto->stock > 0) : ?>
                <form action="/carrito" method="POST">
                    <input type="hidden" name="product_id" value="<?php echo $producto->id; ?>">

                    <label for="cantidad">Cantidad</label>
                    <input type="number" name="quantity" id="cantidad" value=1 min=1 max=<?php echo $producto->stock; ?>>

                    <input type="submit" value="Agregar al carrito">
                </form>
            <?php
            endif;
            if (!$producto->stock) :
                echo 'Producto sin stock';
            endif; ?>
            <hr>
        <?php endforeach; ?>
    </section>
</main>