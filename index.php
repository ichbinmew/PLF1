<html>
    <head>
        <title>PLF1</title>
    </head>
    <body>
        <a href="eingabe.php">Neue Speise hinzufügen</a>
        <br><br>
        <form action="index.php" method="POST">
            <?php
            $servername = "localhost";
            $username = "root";
            $password = "";
            $dbname = "3AI";

            try {
                $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
                // Set the PDO error mode to exception
                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                $sql = "SELECT Langbeschreibung FROM Speisen_SCH";
                $result = $conn->query($sql);

                echo "<label for='speisen'>Speisen:</label>";
                echo "<select id='speisen' name='speise'>";
                while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                    echo "<option value='" . $row["Langbeschreibung"] . "'>" . $row["Langbeschreibung"] . "</option>";
                }
                echo "</select>";
                echo "<br><br>";
                echo "<input type='submit' name='submit' value='OK'>";
                if (isset($_POST['submit'])) {
                    $selectedOption = $_POST['speise'];
                    $sql = "DELETE FROM Speisen_SCH WHERE Langbeschreibung='$selectedOption'";
                    $conn->query($sql);
                    header("Location: weiter.php?speise=$selectedOption");
                    exit;
                }

                $conn = null;
            } catch(PDOException $e) {
                echo "Verbindung fehlgeschlagen: " . $e->getMessage();
            }
            ?>
        </form>
    </body>
</html>
