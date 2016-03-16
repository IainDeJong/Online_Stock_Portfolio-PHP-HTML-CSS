<?php

    // configuration
    require("../includes/config.php"); 

    // if user reached page via GET (as by clicking a link or via redirect)
    if ($_SERVER["REQUEST_METHOD"] == "GET")

    {
        //query his portfolio
        $rows = query("SELECT * FROM stocks WHERE id = ?", $_SESSION["id"]);
        
        //make array to store symbols
        $symbols = [];
        
        foreach ($rows as $row)
        {
            $stock = lookup($row["symbol"]);
            if ($stock !== false)
            {
                $symbols[] = [
                    "symbol" => $row["symbol"]
                ];
            }  
        }
        
        //render sell form
        render("sell_form.php",["symbols" => $symbols, "title" => "Sell"]); 
     
    }
    
    else
    {
        //query amount of shares being sold
        $amount_shares = query("SELECT shares FROM stocks WHERE id = ? AND symbol = ?", $_SESSION["id"], $_POST["symbol"]);
                
        // lookup share to gain price information
        $share = lookup($_POST["symbol"]);
                
        // multiply price and amount of shares
        $total = $amount_shares[0]["shares"] * $share["price"];
        
        $transaction = "SELL";
         
        // add total amount made to cash and delete sold stock
        query("UPDATE users SET cash = cash + ? WHERE id =?",$total, $_SESSION["id"]);
        query("DELETE FROM stocks WHERE symbol = ? AND id = ?",$_POST["symbol"], $_SESSION["id"]);  
        
         //store history
        query("INSERT INTO history (id, transaction, time, symbol, shares, price) VALUES(?, ?, ?, ?, ?, ?)", $_SESSION["id"], $transaction, 'CURRENT_TIMESTAMP', $_POST["symbol"], $amount_shares[0]["shares"], $total);
        
        redirect ("/");
    }
    
