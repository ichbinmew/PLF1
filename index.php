<html>
    <head>
        <title>test</title>
    </head>
    <body>
        <a href="eingabe.php">Neue Speise hinzufügen</a>
        <br><br>
        <form action="index.php" method="post">
            <?php
            $servername = "localhost";
            $username = "root";
            $password = "";
            $dbname = "3AI";

            $conn = new mysqli($servername, $username, $password, $dbname);

            if ($conn->connect_error) {
                die("Verbindung fehlgeschlagen: " . $conn->connect_error);
            }

            $sql = "SELECT Langbeschreibung FROM Speisen_SCH";
            $result = $conn->query($sql);

            echo "<form action='weiter.php' method='POST'>";
            echo "<label for='speisen'>Speisen:</label>";
            echo "<select id='speisen' name='speise'>";
            while ($row = $result->fetch_assoc()) {
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
            echo "</form>";

            $conn->close();
            ?>
        </form>
    </body>
</html>
