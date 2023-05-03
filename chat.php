<?php
$db = new SQLite3('chats.sq3'); 
$db->exec("CREATE TABLE IF NOT EXISTS chat(chattext text, tid varchar);");

if(isset($_POST["logout"]))
    {
        setcookie("userid", "kaka", time() - (600),'/');
        header("Location: DB02.php");
    }

?>

    <!DOCTYPE html>
    <html>
    <body>
    <center>
    <?php
        if (isset($_POST["postchat"])) 
    {
        if(!empty($_POST["postchat"]))
        {
        $date = date('Y-m-d H:i:s', time());
        $db->exec("INSERT into chat values('" .$_POST["chattext"]. "', '". $date. "');");
        } 

        $allInputQuery = "SELECT * FROM chat;";
        $chatboard = $db->query($allInputQuery); 
        while($row = $chatboard->fetchArray(SQLITE3_ASSOC))
        {
            echo ": " . $row['chattext']. " - : " . $row['tid'].  "<br>";
        }
    } 

    ?>
    <Body background="birdis.jpg"> 
    <h1> welcome to Birdi<h1>
    <form action="#" method="post">
    <input type="text" name="chattext"/><br /><h1>
    <input type="submit" name="postchat" value="post"/></form>

    <form action="#" method="post">
    <input type="submit" name="logout" value="logout"/>
    </form>
   
    </body>
    </center>
    </html>