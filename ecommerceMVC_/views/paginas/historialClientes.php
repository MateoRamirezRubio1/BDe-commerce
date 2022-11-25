<main>
    <h2>Historial compras por cliente</h2>

    <?php if (!$ordenes) : ?>
        <p>No hay compras hechas por clientes por el momento</p>
    <?php endif; ?>

    <?php if ($ordenes) : ?>
        <?php foreach ($clientes as $cliente) : ?>
            <h3>Cliente: <?php echo $cliente->email;  ?></h3>
            <table>
                <thead>
                    <tr>
                        <th>Fecha</th>
                        <th>Monto</th>
                        <th>Dirección</th>
                        <th>Estado de orden</th>
                    </tr>
                </thead>

                <tbody>
                    <?php foreach ($ordenes as $orden) :
                        if ($cliente->id != $orden->customer_id) {
                            continue;
                        }
                    ?>
                        <tr>
                            <td><?php echo $orden->order_date; ?></td>
                            <td><?php echo $orden->ammount; ?></td>
                            <td><?php echo $orden->shipping_address; ?></td>
                            <td><?php echo $orden->order_status; ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <br>
            <br>
        <?php endforeach; ?>
    <?php endif; ?>

    <?php ?>
    <?php ?>
    <?php ?>
</main>