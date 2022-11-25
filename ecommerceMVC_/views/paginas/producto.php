<main>
    <hr>
    <h2><?php echo $producto->name; ?></h2>

    <p>SKU: <?php echo $producto->sku; ?></p>

    <p>Precio venta: $<?php echo $producto->price; ?></p>
    <br>
    <h3>Descripción</h3>
    <p><?php echo $producto->description; ?></p>

    <a href="/">Mirar más productos</a>
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
</main>