<?php

$db = new SQLite3('accounts.sq3'); 
$db->exec("CREATE TABLE IF NOT EXISTS account(namn text, lösen text);");
if(isset($_COOKIE["userid"]))
    {
        echo "cookie is here";
    }
if(isset($_POST["submitlogin"]))
{
    $allInputQuery = "SELECT * FROM account;"; //selectar alla input fält i account
    $userlist = $db->query($allInputQuery); 
    while($row = $userlist->fetchArray(SQLITE3_ASSOC))// går igenom databasen för att få alla namn och lösen
    {
        if($row['namn'] == $_POST['loginName'])//jamför rowen på namn
        {
            if($row['lösen'] == $_POST['loginPassword'])//jamför rowen på password
            {
                setcookie("userid", "kaka", time() + (600),'/');
                header("Location: chat.php");//redirectad till chattboarden
                echo "aaaaaa";
            }
        }
        echo "no work";
    }
}

?>

    <!DOCTYPE html>
    <html>
    <body>
    <style>

    </style>
    <center>
    <?php
       if (isset($_POST["submit"])) {//kommer ifrån register.php
        if(!empty($_POST["name"]) && !empty($_POST["password"]))//kollar om någon av dom är tomma då genomförs det ej
        {
        $db->exec("INSERT into account values('" .$_POST["name"]. "', '". $_POST["password"]. "');");
        } 
    } 
    ?>
    <Body background="birdis.jpg"> 
        <h1 style="font-size:200px; color:pink; text-shadow:-7px -5px 0 #120"> Birdi</h1>
        <form action="#" method="post">
        <input type="text" name="loginName"/><br /><h1>
        <input type="password" name="loginPassword"/><br />
        <input type="submit" name="submitlogin" value="continue"/></form>
       <h1 style="color:white; text-shadow:-2px -2px 0 #000">If you dont have an account <a style="color:white; text-shadow:-1px -1px 0 #000"; class="ex5" href="register.php">Create account</a> <h1>
        </form>
        </center>
    </body>
    </html>