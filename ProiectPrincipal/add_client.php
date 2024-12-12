<?php
session_start();

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'management') {
    echo "<script>
        alert('Trebuie să fii conectat ca manager pentru a accesa aceste informații!');
        window.location.href = 'login.php';
    </script>";
    session_destroy();
    exit;
}
?>
<?php
include 'config/database.php';
include 'includes/header.php';


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $client_name = $_POST['client_name'];
    $phone_number = $_POST['phone_number'];
    $email = $_POST['email'];
    $address = $_POST['address'];

    $stmt = $pdo->prepare("INSERT INTO clients (client_name, phone_number, email, address) VALUES ( ?, ?, ?, ?)");
    $stmt->execute([$client_name, $phone_number, $email, $address]);
    header("Location: clients.php");
    exit;
}
?>
<head><link rel="stylesheet" href="css/style1.css"></head>

<main>
<table>
    <h1>Adaugă Client</h1>
    <form method="POST">
        <input type="text" name="client_name" placeholder="Nume Client" required>
        <input type="text" name="phone_number" placeholder="Telefon">
        <input type="email" name="email" placeholder="Email">
        <textarea name="address" placeholder="Adresă"></textarea>
        <button type="submit">Adaugă</button>
    </form>
</table>
</main>

<?php include 'includes/footer.php'; ?>
