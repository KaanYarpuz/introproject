<?php

$host = 'localhost';
$db_name = 'introDB';
$username = 'introDBuser';
$password = 'introDBpassword';

try {
    $conn = new PDO("mysql:host=$host;dbname=$db_name", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $naam = $_POST['naam'];
    $achternaam = $_POST['achternaam'];
    $email = $_POST['email'];
    $vraag = $_POST['vraag'];

    echo "ID: " . $id . "<br>";
    echo "Naam: " . $naam . "<br>";
    echo "Achternaam: " . $achternaam . "<br>";
    echo "Email: " . $email . "<br>";
    echo "Vraag: " . $vraag . "<br>";

    $stmt = $conn->prepare("UPDATE form SET naam = :naam, achternaam = :achternaam, email = :email, vraag = :vraag WHERE id = :id");
    $updateform = $stmt->fetch(PDO::FETCH_ASSOC);
    $stmt->bindParam(':naam', $naam);
    $stmt->bindParam(':achternaam', $achternaam);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':vraag', $vraag);
    $stmt->bindParam(':id', $id);
    $stmt->execute();

}
?>

<!DOCTYPE html>
<html>
<head>
</head>
<body>
<form action="" method="POST">
    ID: <input type="text" name="id" value="<?php echo $updateform['id']; ?>"><br>
    Naam: <input type="text" name="naam" value="<?php echo $updateform['naam']; ?>"><br>
    Achternaam: <input type="text" name="achternaam" value="<?php echo $updateform['achternaam']; ?>"><br>
    Email: <input type="email" name="email" value="<?php echo $updateform['email']; ?>"><br>
    Vraag: <input type="text" name="vraag" value="<?php echo $updateform['vraag']; ?>"><br>
    <input type="submit" name="submit" value="Opslaan">
</form>
</body>
</html>
