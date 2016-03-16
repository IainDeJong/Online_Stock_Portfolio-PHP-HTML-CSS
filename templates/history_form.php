    <table class = table-striped>
    <thead>
    <th>Transaction</th>
    <th>Time</th>
    <th>Symbol</th>
    <th>Amount</th>
    <th>Price</th>
    </thead>
    
    <tbody>
    <?php foreach ($hist as $row): ?>
    <tr>
    <td><?php $row["transaction"] ?></td>
    <td><?php $row["time"] ?></td>
    <td><?php $row["symbol"] ?></td>
    <td><?php $row["shares"] ?></td>
    <td><?php $row["price"] ?></td>
    </tr>
    <?php endforeach ?>
    </tbody>
    
    <!--<tbody>
    <?php
        foreach ($hist as $row)
        {
            print("<tr>");
            print("<td>" . $row["transaction"] . "</td>");
            print("<td>" . $row["time"] . "</td>");
            prin("<td>" . $row["symbols"] . "</td>");
            print("<td>" . $row["shares"] . "</td>");
            print("<td>" . $row["price"] . "</td>");
            print("</tr>");
        }
?>
</tbody>-->
</table>
