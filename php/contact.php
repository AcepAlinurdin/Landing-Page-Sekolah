<!--code untuk mengirim ke email mengguanakan PHPmailer dan pengiriman data ke database -->
<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../vendor/autoload.php';
require '../config/database.php';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = htmlspecialchars($_POST["name"]);
    $email = htmlspecialchars($_POST["email"]);
    $message = htmlspecialchars($_POST["message"]);

    try {
        $stmt = $conn->prepare("INSERT INTO messages (name, email, message) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $name, $email, $message);
        $stmt->execute();
        $stmt->close();
    } catch (Exception $e) {
        echo json_encode(["status" => "error", "message" => "Gagal menyimpan ke database: " . $e->getMessage()]);
        exit;
    }

    $mail = new PHPMailer(true);

    try {
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'tiktok22533@gmail.com'; 
        $mail->Password   = 'dvaw agxf lfju gnif'; 
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port       = 587;

        $mail->setFrom($email, $name);
        $mail->addAddress('tiktok22533@gmail.com'); 
        $mail->Subject = "Pesan dari $name";
        $mail->Body    = "Nama: $name\nEmail: $email\nPesan:\n$message";

        $mail->send();
        echo json_encode(["status" => "success", "message" => "Pesan berhasil dikirim dan disimpan!"]);
    } catch (Exception $e) {
        echo json_encode(["status" => "error", "message" => "Gagal mengirim pesan: " . $mail->ErrorInfo]);
    }
} else {
    echo json_encode(["status" => "error", "message" => "Metode pengiriman tidak valid."]);
}
?>
