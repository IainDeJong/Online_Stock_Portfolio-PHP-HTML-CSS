<?php

    // configuration
    require("../includes/config.php"); 

    // if user reached page via GET (as by clicking a link or via redirect)
    if ($_SERVER["REQUEST_METHOD"] == "GET")

    {
        //render sell form
        render("buy_form.php",["title" => "Buy"]); 
    }
    
    else
    
    {
        //check the symbol
        if ($_POST["symbol"] == NULL || lookup($_POST["symbol"]) === false)
        {
            apologize("Please enter a valid stock symbol.");
        }
        
        //check the amount
        else if ($_POST["amount"] == NULL)
        
        {
            apologize("Please enter an amount.");
        }
    
        else if (preg_match("/^\d+$/", $_POST["amount"]) == false)
        {
            apologize("Please enter a non-negative amount.");
        }
        
        // lookup share to gain price information
        $share = lookup($_POST["symbol"]);
                
        // multiply price and amount of shares
        $total = $_POST["amount"] * $share["price"];
      
        
      
        //check if not enough cash
        if (query("SELECT cash FROM users WHERE id = ?", $_SESSION["id"]) < $total)
        {
            apologize("Insufficient funds.");
        }
        
        //else capitalize symbol
        $_POST["symbol"] = strtoupper($_POST["symbol"]);
        
        //store transaction type
        $transaction = "BUY";
                
        // subtract total amount spent from cash and add stock to portfolio
        query("UPDATE users SET cash = cash - ? WHERE id = ?",$total, $_SESSION["id"]);
        
        query("INSERT INTO stocks (id, symbol, shares) VALUES(?, ?, ?) ON DUPLICATE KEY UPDATE shares = shares + VALUES(shares)", $_SESSION["id"], $_POST["symbol"], $_POST["amount"]);  
        
        //store history
        query("INSERT INTO history (id, transaction, time, symbol, shares, price) VALUES(?, ?, NOW(), ?, ?, ?)", $_SESSION["id"], $transaction, $_POST["symbol"], $_POST["amount"], $total);
        
        redirect ("/");
    }
    
