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
            <th>Waitress ID</th>
            <th>Name</th>
            <th>Drinks Today</th>
            <th>Record Date</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($waitressStats as $stat)
            <tr>
                <td>{{ $stat->waitress->id ?? 'N/A' }}</td>
                <td>{{ $stat->waitress->name ?? 'Unknown' }}</td>
                <td>{{ $stat->total_drinks }}</td>
                <td>{{ $stat->record_date }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
