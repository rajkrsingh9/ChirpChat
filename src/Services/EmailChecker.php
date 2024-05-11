<?php
// Load Composer's autoloader.
// require 'vendor/autoload.php';

namespace App\Services;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

/**
 * Sending mail to user containing otp through php mailer.
 * 
 * @method emailSyntaxCheck().
 *   Check wheather email id is correct or not.
 * @method emailSending().
 *   Sending mails using PHPMailer.
 * @method emailSend().
 *   If the syntak of email Id is correct then it will send mail otherwise it
 *   will return false.
 * 
 * @property string $emailId
 *   Stores email address.
 * @property string $messageBody
 *   Stores message body.
 * @property string $messageSub
 *   Stores message subject.
 * @property string $userEmail
 *   Stores serving email id.
 * @property string $emailPass
 *   Stores serving email id password.
 * 
 * @author Deepak Pandey <deepak.pandey@innoraft.com>
 */
class EmailChecker
{
    /**
     * Stores email address.
     * @var string
     */
    private $emailId;

    /**
     * Stores message body.
     * @var string
     */
    private $messageBody;

    /**
     * Stores message subject.
     * @var string
     */
    private $messageSub;

    /**
     * Stores serving email id.
     * @var string
     */
    private $userEmail;

    /**
     * Stores serving email id password.
     * @var string
     */
    private $emailPass;

    /**
     * Initilizing the email id, message body and message subject.
     * 
     * @param string $emailId
     *   Stores email address.
     * @param string $messageBody
     *   Stores body content of mail.
     * @param string $messageSub
     *   Stores mail subject.
     * @param string $userEmail
     *   Stores serving email id.
     * @param string $emailPass
     *   Stores serving email id password.
     * 
     */
    public function __construct(string $emailId, string $messageBody, string $messageSub)
    {
        

        $this->userEmail = $_ENV['emailId'];
        $this->emailPass = $_ENV['emailPassword'];

        $this->emailId = $emailId;
        $this->messageBody = $messageBody;
        $this->messageSub = $messageSub;
    }

    /**
     * Check wheather email id is correct or not.
     * 
     * @return bool
     *   If email syntax is correct it will return true otherwise it will 
     *   return false
     */
    public function emailSyntaxCheck(string $email)
    {
        return preg_match('/^([a-zA-Z0-9\.]+@+[a-zA-Z]+(\.)+[a-zA-Z]{2,3})$/', $email);
    }

    /**
     * Sending mails.
     *
     * @param string $email
     *   Stores email id.
     * 
     * @return mixed
     *   If mails did not send then it will return false.
     */
    public function emailSending(string $email)
    {
        // Create an instance; passing `true` enables exceptions.
        $mail = new PHPMailer(TRUE);

        try {
            // Server settings.
            // Enable verbose debug output.
            // $mail->SMTPDebug = SMTP::DEBUG_SERVER;
            // Send using SMTP.
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            // Enable SMTP authentication.
            $mail->SMTPAuth = TRUE;
            // SMTP username.
            $mail->Username = $this->userEmail;
            // SMTP password.
            $mail->Password = $this->emailPass;
            // Enable implicit TLS encryption.
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
            // TCP port to connect to; use 587 if you have set.
            // SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS.
            $mail->Port = 465;

            // Recipients.
            $mail->setFrom($this->userEmail);
            // Add a recipient.
            $mail->addAddress($email);
            // Name is optional.
            $mail->addAddress($email);
            // Content.
            // Set email format to HTML.
            $mail->isHTML(TRUE);
            $mail->Subject = $this->messageSub;
            $mail->Body = $this->messageBody;
            $mail->AltBody = $this->messageBody;
            $mail->send();

        } 
        catch (Exception) {
            return FALSE;
        }
    }

    /**
     * If the syntax of email Id is correct then it will send mail otherwise it
     * will return false.
     * 
     * @return mixed
     *   If email id is correct then it will send mail otherwise it will 
     *   return false.
     */
    public function emailSend()
    {
        if (self::emailSyntaxCheck($this->emailId)) {
            self::emailSending($this->emailId);
            return TRUE;
        }
        return FALSE;

    }
}