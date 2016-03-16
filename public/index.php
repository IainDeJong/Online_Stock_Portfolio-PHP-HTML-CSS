<?php

    // configuration
    require("../includes/config.php"); 
    
       
    //query his portfolio via user id 
    $rows = query("SELECT * FROM stocks WHERE id = ?", $_SESSION["id"]);
    
    $positions = [];
    
    //make new array with all relevant info
    
    foreach ($rows as $row)
    
    {
        $position = lookup($row["symbol"]);
        $position["shares"] = $row["shares"];
        $position["value"] = $position["price"] * $position["shares"];
        $positions[] = $position;
    }
    
    $cash = query ("SELECT * FROM users WHERE id = ?", $_SESSION["id"]);
   
    //display menu (i have found a better way)
    //render("menu.php", ["title" => "Menu"]);
   
    // render portfolio
    render("portfolio.php", ["title" => "Portfolio", "positions" => $positions, "cash" => $cash]);
    
    
?>
