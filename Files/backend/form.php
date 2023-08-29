<?php
$host = 'localhost';
$db_name = 'introDB';
$username = 'introDBuser';
$password = 'introDBpassword';

try {
    $conn = new PDO("mysql:host=$host;dbname=$db_name", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    echo "Databaseverbinding mislukt: " . $e->getMessage();
}

if (isset($_POST['submit'])){
    $id = uniqid();
    $naam = $_POST['naam'];
    $achternaam = $_POST['achternaam'];
    $email = $_POST['email'];
    $vraag = $_POST['vraag'];

    $stmt = $conn->prepare("INSERT INTO form (naam, achternaam, email, vraag, id) VALUES (:naam, :achternaam, :email, :vraag, :id)");
    $stmt->bindParam(':naam', $naam);
    $stmt->bindParam(':achternaam', $achternaam);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':vraag', $vraag);
    $stmt->bindParam(':id', $id);

    $stmt->execute();

    echo "Bedankt voor het verzenden! Uw id is: $id als u wijzigingen wilt maken.";
    echo "<br>";

    echo "Uw naam: $naam";
    echo "<br>";
    echo "Uw achternaam: $achternaam";
    echo "<br>";
    echo "Uw e-mail: $email";
    echo "<br>";
    echo "Uw vraag: $vraag";
}
?>