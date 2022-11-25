<fieldset>
    <legend>Información General</legend>

    <label for="sku">SKU:</label>
    <input name="producto[sku]" type="number" id="sku" placeholder="SKU Producto" value="<?php echo sanitizar($producto->sku); ?>">

    <label for="name">Name:</label>
    <input type="text" id="name" name="producto[name]" placeholder="Nombre Producto" value="<?php echo sanitizar($producto->name); ?>">

    <label for="price">Price:</label>
    <input name="producto[price]" type="number" id="price" placeholder="Precio Producto" value="<?php echo sanitizar($producto->price); ?>">

    <label for="description">Description:</label>
    <textarea id="description" name="producto[description]"><?php echo sanitizar($producto->description); ?></textarea>
</fieldset>

<fieldset>
    <legend>Información Producto</legend>

    <label for="stock">Stock:</label>
    <input name="producto[stock]" type="number" id="stock" placeholder="Ej: 3" min="0" value="<?php echo sanitizar($producto->stock); ?>">

    <label for="category">Category:</label>
    <select name="producto[category_id]" id="category">
        <option selected value="">-- Seleccione --</option>
        <?php foreach ($categorias as $categoria) : ?>
            <option <?php echo $producto->category_id === $categoria->id ? 'selected' : '' ?> value="<?php echo sanitizar($categoria->id); ?>"><?php echo sanitizar($categoria->name); ?></option>
        <?php endforeach; ?>
    </select>
</fieldset>