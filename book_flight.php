<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.html");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_id = $_SESSION['user_id'];
    $flight_id = $_POST['flight_id'];

    $conn = new PDO("pgsql:host=127.0.0.1; dbname=makemytrip", "postgres", "rp120604");

    // Check if flight exists
    $stmt = $conn->prepare("SELECT * FROM flights WHERE id = :flight_id");
    $stmt->execute(['flight_id' => $flight_id]);
    $flight = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$flight) {
        echo "<script>alert('Invalid flight selection.'); window.location.href='index.php';</script>";
        exit();
    }

    // Insert booking into database
    $stmt = $conn->prepare("INSERT INTO bookings (user_id, flight_id, booking_date) VALUES (:user_id, :flight_id, NOW())");
    $result = $stmt->execute(['user_id' => $user_id, 'flight_id' => $flight_id]);

    if ($result) {
        echo "<script>alert('Booking successful!'); window.location.href='index.php';</script>";
    } else {
        echo "<script>alert('Booking failed. Try again.'); window.history.back();</script>";
    }
}
?>
