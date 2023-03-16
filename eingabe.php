<html>
    <head>
        <title>PLF1</title>
    </head>
    <body>
        <form action="eingabe.php" method="post">
            <?php
            $servername = "localhost";
            $username = "root";
            $password = "";
            $dbname = "3AI";

            try {
                $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);

                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                echo "<label for='speisen'>Kurzbeschreibung: </label>";
                echo "<input style='text-transform: uppercase;' type='text' name='kurzbeschreibung' id='kurzbeschreibung' minlength='2' maxlength='2'>";
                echo "<br> <br>";
                echo "<label for='speisen'>Langbeschreibung: </label>";
                echo "<input type='text' name='langbeschreibung' id='langbeschreibung'>";
                echo "<br><br>";
                echo "<input type='submit' name='submit' value='OK'>";

                if (isset($_POST['submit'])) {
                    $kurzbeschreibung = $_POST['kurzbeschreibung'];
                    $langbeschreibung = $_POST['langbeschreibung'];

                    $exists_sql = "SELECT * FROM Speisen_SCH WHERE Kurzbezeichnung=:kurzbezeichnung OR Langbeschreibung=:langbeschreibung";
                    $stmt = $conn->prepare($exists_sql);
                    $stmt->execute(['kurzbezeichnung' => $kurzbeschreibung, 'langbeschreibung' => $langbeschreibung]);

                    if ($stmt->rowCount() > 0) {
                        echo "<br><br>Die Kurz- oder Langbeschreibung existiert bereits in der Datenbank.";
                    } else {
                        $insert_sql = "INSERT INTO Speisen_SCH (Kurzbezeichnung, Langbeschreibung) VALUES (:kurzbezeichnung, :langbeschreibung)";
                        $stmt = $conn->prepare($insert_sql);
                        $stmt->execute(['kurzbezeichnung' => $kurzbeschreibung, 'langbeschreibung' => $langbeschreibung]);
                    }
                }
                echo "<br><br><a href='index.php'>Retour</a>";
            } catch(PDOException $e) {
                echo "Verbindung fehlgeschlagen: " . $e->getMessage();
            }

            $conn = null;
            ?>
        </form>
    </body>
</html>
