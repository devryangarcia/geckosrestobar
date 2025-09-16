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
            <th>Suppliers</th>
            <th>Qty</th>
            <th>Date</th>
        </tr>
    </thead>
    @foreach ($incomingproducts as $incomingprod)
        <tbody>
            <tr>
                <td>{{ $incomingprod->id }}</td>
                <td>{{ $incomingprod->product->name }}</td>
                <td>{{ $incomingprod->supplier->name }}</td>
                <td>{{ $incomingprod->qty }}</td>
                <td>{{ $incomingprod->date }}</td>
            </tr>
        </tbody>
    @endforeach
</table>
