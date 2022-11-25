<main>
    <h2>Historial de Compras</h2>

    <?php if (!$ordenes) : ?>
        <p>No hay compras hasta el momento</p>
    <?php endif; ?>

    <?php if ($ordenes) : ?>
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
                <?php foreach ($ordenes as $orden) : ?>
                    <tr>
                        <td><?php echo $orden->order_date; ?></td>
                        <td><?php echo $orden->ammount; ?></td>
                        <td><?php echo $orden->shipping_address; ?></td>
                        <td><?php echo $orden->order_status; ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>
</main>