
<?php
// Überprüfen, ob eine Speise ausgewählt wurde
if(isset($_GET['speise'])) {
    $selected_speise = $_GET['speise'];
    echo "Danke, dass Sie $selected_speise gewählt haben!<br>";
    echo "<a href='index.php'>Retour</a>";
} else {
    echo "Bitte wählen Sie eine Speise aus.";
}
?>
