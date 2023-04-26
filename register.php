<?php
$db = new SQLite3('accounts.sq3'); 
$db->exec("CREATE TABLE IF NOT EXISTS account(namn text, lösen text);");


?>

    <!DOCTYPE html>
    <html>
    <body>
    <center>
    <Body background="birdis.jpg"> 
    <br>
    <form action="db02.php" method ="post">
    <h1> 
    <input type="text" name="name"/><br /><h1>
    <input type="password" name="password"/><br />
    <input type="submit"  value="continue"/></form>
    </body>
    </center>
    </html>