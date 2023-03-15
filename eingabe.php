<html>
    <head>
        <title>test</title>
    </head>
    <body>
        <form action="eingabe.php" method="post">
            <?php
            // Stelle eine Verbindung zur Datenbank her
            $servername = "localhost";
            $username = "root";
            $password = "";
            $dbname = "3AI";

            $conn = new mysqli($servername, $username, $password, $dbname);

            if ($conn->connect_error) {
                die("Verbindung fehlgeschlagen: " . $conn->connect_error);
            }

            echo "<label for='speisen'>Kurzbeschreibung: </label>";
            echo "<input style='text-transform: uppercase; type='text' name='kurzbeschreibung' id='kurzbeschreibung' minlength='2' maxlength='2'>";
            echo "<br> <br>";
            echo "<label for='speisen'>Langbeschreibung: </label>";
            echo "<input type='text' name='langbeschreibung' id='langbeschreibung'>";
            echo "<br><br>";
            echo "<input type='submit' name='submit' value='OK'>";

            if(isset($_POST['submit'])) {
                $kurzbeschreibung = $_POST['kurzbeschreibung'];
                $langbeschreibung = $_POST['langbeschreibung'];

                $exists_sql = "SELECT * FROM Speisen_SCH WHERE Kurzbezeichnung='$kurzbeschreibung' OR Langbeschreibung='$langbeschreibung'";
                $result = $conn->query($exists_sql);

                if ($result->num_rows > 0) {
                    echo "<br><br>Die Kurz- oder Langbeschreibung existiert bereits in der Datenbank.";
                } else {
                    $insert_sql = "INSERT INTO Speisen_SCH (Kurzbezeichnung, Langbeschreibung) VALUES ('$kurzbeschreibung', '$langbeschreibung')";
                    $conn->query($insert_sql);
                }
            }
            echo "<br><br><a href='index.php'>Retour</a>";

            $conn->close();
            ?>
        </form>
    </body>
</html>
