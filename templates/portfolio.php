<div>
    <table>
        <?php foreach ($positions as $position): ?>
            
            <tr>
                <td><?= $position["symbol"] ?></td>
                <td><?=number_format($position["price"], 2)?> </td>
                <td><?= $position["shares"] ?></td>
                <td><?= $position["value"] ?></td>
            </tr>
            
        <?php endforeach ?>
    </table>
    
    <?=number_format($cash[0]["cash"], 2)?>
    
</div>
<div>
    <a href="logout.php">Log Out</a>
</div>
