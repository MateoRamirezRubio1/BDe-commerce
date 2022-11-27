<main>
    <h2>Carrito de compras</h2>

    <table>
        <thead>
            <tr>
                <th>SKU</th>
                <th>Nombre</th>
                <th>Precio</th>
                <th>Cantidad</th>
                <th>Acciones</th>
            </tr>
        </thead>

        <tbody>
            <?php foreach ($productosCarrito as $producto) :
                $totalCompra += $producto->price * $producto->quantity;
            ?>
                <tr>
                    <td><?php echo $producto->sku; ?></td>
                    <td><?php echo $producto->name; ?></td>
                    <td><?php echo $producto->price; ?></td>
                    <td><?php echo $producto->quantity; ?></td>

                    <?php if ($idEditar !== $producto->id) : ?>
                        <td>
                            <form method="POST" action="/BDe-commerce/ecommerceMVC/public/index.php/carrito/eliminar">

                                <input type="hidden" name="quantity" value="<?php echo $producto->quantity; ?>">
                                <input type="hidden" name="product_id" value="<?php echo $producto->product_id; ?>">

                                <input type="hidden" name="id" value="<?php echo $producto->id; ?>">
                                <input type="submit" value="Borrar">
                            </form>
                            <a href="/BDe-commerce/ecommerceMVC/public/index.php/carrito?id=<?php echo $producto->id; ?>">Editar</a>
                        </td>
                    <?php endif; ?>

                    <?php if ($idEditar && $idEditar === $producto->id) : ?>
                        <td>
                            <form method="POST" action="/BDe-commerce/ecommerceMVC/public/index.php/carrito/actualizar">
                                <input type="hidden" name="carrito[id]" value="<?php echo $_GET['id']; ?>">

                                <label for="cantidad">Nueva cantidad</label>
                                <input type="number" name="carrito[quantity]" id="cantidad" value=1>

                                <input type="submit" value="Guardar">
                            </form>
                        </td>
                    <?php endif; ?>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <?php if (!$productosCarrito) : ?>
        <p>No hay productos agregados al carrito</p>
    <?php endif; ?>

    <?php if ($productosCarrito) : ?>
        <p>Total compra: $<?php echo $totalCompra; ?>.</p>
        <br>
        <h3>Detalles finales pedido</h3>

        <form action="/BDe-commerce/ecommerceMVC/public/index.php/carrito/compras" method="POST">
            <fieldset>
                <legend>Información del Pedido</legend>

                <label for="SA">Shipping Address:</label>
                <input name="shipping_address" type="text" id="SA" placeholder="Dirección de envío">
            </fieldset>

            <input type="hidden" name="ammount" value="<?php echo $totalCompra; ?>">
            <br>
            <input type="submit" value="Realizar compra">
        </form>
    <?php endif; ?>

</main>