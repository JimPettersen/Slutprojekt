<?php
$db = new SQLite3('chats.sq3'); 
$db->exec("CREATE TABLE IF NOT EXISTS chat(chattext text, tid varchar);");

if(isset($_POST["logout"]))
    {
        setcookie("userid", "kaka", time() - (10),'/');//när  man loggar ut så ska kakan resetas
        header("Location: DB02.php");
    }

if (setcookie("userid", "kaka", time()) == null)
{
    header("Location: DB02.php");
}
?>

    <!DOCTYPE html>
    <html>
    <body>
    <center>
    <div style="height:400px;width:400px;font:16px Arial, Serif;overflow:auto;">
    <?php
        if (isset($_POST["postchat"])) 
    {
        $data = $_POST['chattext'];//lägger variabeln i data
        //hur många gånger en ord används
        $words = str_word_count($data, 1);
        $frequency = array_count_values($words);

        function filterArray($frequency){
            $bigword = $value.number > 6;
        };
        echo "$bigword";
        if(!empty($_POST["postchat"]))
        {
        $date = date('Y-m-d H:i:s', time());//spara tiden
        $sanitized_data = htmlspecialchars($data, ENT_QUOTES, 'UTF-8');//så att man inte ska taga texten från chat fönstret
        $db->exec("INSERT into chat values('" .$sanitized_data. "', '". $date. "');");//lägg in texten från formen och tidpunktden
        } 

        $allInputQuery = "SELECT * FROM chat;";
        $chatboard = $db->query($allInputQuery); 
        while($row = $chatboard->fetchArray(SQLITE3_ASSOC))//sedan ska postade chaten visas
        {
            echo ": " . $row['chattext']. " - : " . $row['tid'].  "<br>";
        }
    } 

    ?>
    </div>
    <Body background="birdis.jpg"> 
    <h1> welcome to Birdi<h1>
    <form action="#" method="post">
    <input type="text" name="chattext"/><br /><h1>
    <input type="submit" name="postchat" value="post"/>

    <form action="#" method="post">
    <input type="submit" name="logout" value="logout"/>
    </form>
   
    </body>
    </center>
    </html>