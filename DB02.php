<?php

$db = new SQLite3('accounts.sq3'); 
$db->exec("CREATE TABLE IF NOT EXISTS account(username text, lösen text);");

if(isset($_POST["login"]))
{
   
}

?>

    <!DOCTYPE html>
    <html>
    <body>
    <style>

    </style>
    <center>
    <?php
       if (isset($_POST["submit"])) {
        if(!empty($_POST["accounts"]) && !empty($_POST["account"]))
        {
        $db->exec("INSERT into account values('" .$_POST["namn"]. "', '". $_POST["lösen"]. "');");
        } 
    } 
    ?>
    <Body background="birdis.jpg"> 
        <h1 style="font-size:200px; color:pink; text-shadow:-7px -5px 0 #120"> Birdi</h1>
        <form action="#" method="post">
       <h1 style="color:white; text-shadow:-2px -2px 0 #000"> Log in <input type="login" name="login" > <h1>
       <h1 style="color:white; text-shadow:-2px -2px 0 #000">If you dont have an account <a style="color:white; text-shadow:-1px -1px 0 #000"; class="ex5" href="register.php">Create account</a> <h1>

        </form>
        </center>
    </body>
    </html>