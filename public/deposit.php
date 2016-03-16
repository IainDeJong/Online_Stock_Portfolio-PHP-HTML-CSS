<?php

    // configuration
    require("../includes/config.php"); 

    if ($_SERVER["REQUEST_METHOD"] == "GET")
    {
    // render deposit form
    render("deposit_form.php",["title" => "Deposit"]);
    }
    
    else
    {
    // add money to his total
    query("UPDATE users SET cash = cash + ? WHERE id = ?",$_POST["amount"], $_SESSION["id"]);
    //redirect
    redirect ("/");
    }

?>
