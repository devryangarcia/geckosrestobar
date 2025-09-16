<style>
    #product-entry {
        font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
        border-collapse: collapse;
        width: 100%;
    }

    #product-entry td,
    #product-entry th {
        border: 1px solid #ddd;
        padding: 8px;
    }

    #product-entry tr:nth-child(even) {
        background-color: #f2f2f2;
    }

    #product-entry tr:hover {
        background-color: #ddd;
    }

    #product-entry th {
        padding-top: 12px;
        padding-bottom: 12px;
        text-align: left;
        background-color: #36454F;
        color: white;
    }
</style>

<table id="product-entry" width="100%">
    <thead>
        <tr>
            <th>ID</th>
            <th>Products</th>
            <th>Supplier</th>
            <th>Qty</th>
            <th>Date</th>
        </tr>
    </thead>
    <?php $__currentLoopData = $incomingproducts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $incomingprod): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <tbody>
            <tr>
                <td><?php echo e($incomingprod->id); ?></td>
                <td><?php echo e($incomingprod->product->name); ?></td>
                <td><?php echo e($incomingprod->supplier->name); ?></td>
                <td><?php echo e($incomingprod->qty); ?></td>
                <td><?php echo e($incomingprod->date); ?></td>
            </tr>
        </tbody>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</table>
<?php /**PATH C:\Users\King Ryan\Music\InventoryMS\resources\views/pdfs/incomingproductALLPDF.blade.php ENDPATH**/ ?>