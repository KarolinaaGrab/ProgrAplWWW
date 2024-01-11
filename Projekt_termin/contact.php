<?php
//Funkcje obsługujące formularz kontaktowy

//Generuje i zwraca kod HTML formularza kontaktowego.
function PokazKontakt()
{
    // Struktura HTML formularza kontaktowego
    $wynik = '
    <h2>Wyślij wiadomość</h2>
    <form method="post" class="contact-form">
      <label for="temat">Temat:</label>
      <input type="text" id="temat" name="temat" required /><br />
      <label for="email">e-mail:</label>
      <input type="email" id="email" name="email" required /><br />
      <label for="message">Wiadomość:</label><br />
      <textarea id="message" name="tresc" rows="4" required></textarea><br />
      <input type="submit" name="send" value="Wyślij" />
      </form>
    <form method="post">
      <input type="submit" name="back" value="Powrot" />
    </form>
    ';
    return $wynik;
}

// Załączenie biblioteki PHPMailer do obsługi wysyłania e-maili
require 'phpmailer/includes/PHPMailer.php';
require 'phpmailer/includes/SMTP.php';
require 'phpmailer/includes/Exception.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

// Przetwarza i wysyła formularz kontaktowy jako e-mail.
function WyslijMainKontankt($odbiorca)
{
    // Walidacja danych z metody POST
    if (empty($_POST['temat']) || empty($_POST['tresc']) || empty($_POST['email'])) {
        echo '[nie_wypelniles_pola]';
    } else {
        // Dane e-maila
        $emailSubject = $_POST['temat'];
        $emailBody = "Email from: " . $_POST['email'] . "\n\nMessage:\n" . $_POST['tresc'];
        $senderEmail = $_POST['email'];

        // Utworzenie instancji PHPMailer
        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->Host = "smtp.gmail.com";
        $mail->SMTPAuth = true;
        $mail->SMTPSecure = "tls";
        $mail->Port = "587";
        $mail->Username = 'kontoprojekt9@gmail.com';
        $mail->Password = 'tjfo jzju zmxp mxbq';
        $mail->setFrom('kontoprojekt9@gmail.com');
        $mail->addAddress('kontoprojekt9@gmail.com');
        $mail->isHTML(false);
        $mail->Subject = $emailSubject;
        $mail->Body = $emailBody;

        // Wysyłanie e-maila
        if ($mail->send()) {
            echo '[wiadomosc_wyslana]';
        } else {
            echo "Message could not be sent. Mailer Error: " . $mail->ErrorInfo;
        }
        $mail->smtpClose();
    }
}

// Generuje i zwraca kod HTML formularza przypomnienia hasła.
function PrzypomnijHaslo()
{
    $wynik = '
    <h2>Przypomnienie hasła</h2>
    <form method="post" class="password-reminder-form">
      <label for="email">e-mail:</label>
      <input type="email" id="email" name="email" required /><br />
      <input type="submit" name="przypomnij_haslo" value="Przypomnij hasło" />
    </form>
    ';
    return $wynik;
}

// Przetwarza formularz przypomnienia hasła i wysyła e-mail z przypomnieniem.
function WyslijPrzypomnienieHasla()
{
    // Check if the form was submitted
    if (isset($_POST['przypomnij_haslo'])) {
        // Validate email
        if (empty($_POST['email'])) {
            echo '[nie_wypelniles_pola]';
        } else {
            $recipientEmail = $_POST['email'];
            $emailSubject = "Przypomnienie hasła";
            $emailBody = "Twoje hasło: admin";

            // Setup PHPMailer
            $mail = new PHPMailer();
            $mail->isSMTP();
            $mail->Host = "smtp.gmail.com";
            $mail->SMTPAuth = true;
            $mail->SMTPSecure = "tls";
            $mail->Port = "587";
            $mail->Username = 'kontoprojekt9@gmail.com';
            $mail->Password = 'tjfo jzju zmxp mxbq';
            $mail->setFrom('kontoprojekt9@gmail.com');
            $mail->addAddress($recipientEmail);
            $mail->isHTML(false);
            $mail->Subject = $emailSubject;
            $mail->Body = $emailBody;

            // Send the email
            if ($mail->send()) {
                echo '[haslo_wyslane]';
            } else {
                echo "Message could not be sent. Mailer Error: " . $mail->ErrorInfo;
            }
            $mail->smtpClose();
        }
    }
}
?>