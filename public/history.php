<?php

    // configuration
    require("../includes/config.php"); 

    //store history 
    $rows = query("SELECT * FROM history WHERE 'id' = ?", $_SESSION["id"]);
    if ($rows === false)
    {
    apologise("Sorry failed to read history.");
    }
    
      
    $hist = [];
    foreach ($rows as $row)
    {
    $hist[] = [
    "transaction" => $row["transaction"],
    "time" => $row["time"],
    "symbol" => $row["symbol"],
    "shares" => $row["shares"],
    "price" => $row["price"]
    ];
    }
    
    //render history table
   render("history_form.php", ["title" => "History", "hist" => $hist]);
   
   ?>
