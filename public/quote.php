<?php

    // configuration
    require("../includes/config.php"); 

    // if user reached page via GET (as by clicking a link or via redirect)
    if ($_SERVER["REQUEST_METHOD"] == "GET")
     {
        // render form
        render("quote_form.php", ["title" => "Quote"]);
    }
    
    else
    {
        $stock = lookup($_POST["symbol"]);
        // validate submission
        if ($stock === false)
        {
            apologize("You must provide a correct stock symbol.");
        }
        
        else
        {
            render("quote_price.php",["stock" => $stock, "title" => "Quote"]);
        }
        
    }
    
?>
