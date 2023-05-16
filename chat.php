<?php
$db = new SQLite3('chats.sq3'); 
$db->exec("CREATE TABLE IF NOT EXISTS chat(chattext text, tid varchar);");

if(isset($_POST["logout"]))
    {
        setcookie("userid", "kaka", time() - (600),'/');//när  man loggar ut så ska kakan resetas
        header("Location: DB02.php");
    }
if($_COOKIE['userid'] == false)
{ 
    header("Location: DB02.php");
}   

if (isset($_POST['chattext'])) //chat texten skickas hit först för att kollar om kundjävel är nöjd
{
$data = $_POST['chattext'];
$wordArray = array_count_values(str_word_count(strtolower($data), 1));//skapar en array med orden och konsekvensen för orden

foreach($wordArray as $word=>$count);//skapar word och count för varder ord
if($count > 7)//skapar fråge knapp
{
    //frågar om du verkligen vill skicka
    echo"<h1> Ett ord använd mer än 7 gånger </h1>
    <form action=\"#\" method=\"POST\">
    <input type=\"hidden\" name=\"chattextdata\" value=\"".$data."\">
    <input type=\"submit\" name=\"notSend\" value=\"Do not send\"/> 
    <input type=\"submit\" name=\"Send\" value=\"Send\"/>
    </form>
    ";
}
else
{
    echo"
    <form action=\"#\" method=\"POST\">
    <input type=\"hidden\" name=\"chattextdata\" value=\"".$data."\">
    <input type=\"submit\" name=\"Send\" value=\"confirm send\"/>
    </form>
    ";
}

} 
    
?>

    <!DOCTYPE html>
    <html>
    <body>
    <center>
    <div style="height:400px;width:400px;font:16px Arial, Serif;overflow:auto;">
    <?php
    if(isset($_POST['Send']))
    {
        $textdata = $_POST['chattextdata'];
        $date = date('Y-m-d H:i:s', time());//spara tiden
        $sanitized_data = htmlspecialchars($textdata, ENT_QUOTES, 'UTF-8');//så att man inte ska taga texten från chat fönstret

        $db->exec("INSERT into chat values('" .$sanitized_data. "', '". $date. "');");//lägg in texten från formen och tidpunktden
        if ($date != $db->query("SELECT * FROM chat ORDER BY tid DESC LIMIT 1;"))
        {
            $allInputQuery = "SELECT * FROM chat;";
            $chatboard = $db->query($allInputQuery); 
            while($row = $chatboard->fetchArray(SQLITE3_ASSOC))//sedan ska postade chaten visas
            {
                echo ": " . $row['chattext']. " - : " . $row['tid'].  "<br>";
            }
        }

    }
    ?>
    </div>
    <Body background="birdis.jpg"> 
    <h1> welcome to Birdi</h1>
    <form action="#" method="post">
    <input type="text" name="chattext"/>
    <br></br>
    <input type="submit" name="postchat" value="post"/>
    <br></br>
    </form>
    <form action="#" method="post">
    <input type="submit" name="logout" value="logout"/>
    </form>
   
    </body>
    </center>
    </html>