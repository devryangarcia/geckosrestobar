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
        <tbody>
            <tr>
                <td><?php echo e($incomingproduct->id); ?></td>
                <td><?php echo e($incomingproduct->product->name); ?></td>
                <td><?php echo e($incomingproduct->supplier->name); ?></td>
                <td><?php echo e($incomingproduct->qty); ?></td>
                <td><?php echo e($incomingproduct->date); ?></td>
            </tr>
        </tbody>
</table>
<?php /**PATH C:\Users\King Ryan\Music\InventoryMS\resources\views/pdfs/incomingproductPDF.blade.php ENDPATH**/ ?>