<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;
class ContatoController extends Controller
{
    public function index()
    {
        $dados = array();

        $this->carregarViews('contato', $dados);
    }

    public function enviarEmail()
    {

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $nome = filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_SPECIAL_CHARS);
            $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
            $fone = filter_input(INPUT_POST, 'fone', FILTER_SANITIZE_NUMBER_INT);
            $assunto = filter_input(INPUT_POST, 'assunto', FILTER_SANITIZE_SPECIAL_CHARS);
            $msg = filter_input(INPUT_POST, 'msg', FILTER_SANITIZE_SPECIAL_CHARS);

            $status = 'Pendente';

            date_default_timezone_set('America/Sao_Paulo');
            $dataHora = date('Y-m-d / H:i:s');

            //echo 'Nome: '. $nome . ' - Email: '. $email . ' - Fone: '. $fone . ' - Assunto: '. $assunto . ' - Msg: '. $msg;
            //echo 'Status: '. $status . ' - Data e Hora: '. $dataHora;

            if ($nome && $email && $msg) {

                $contatoModel = new Contato();

                $salvar = $contatoModel->salvarEmail($nome, $email, $fone, $assunto, $msg, $status, $dataHora);

                if ($salvar) {

                    require 'vendor/email/Exception.php';
                    require 'vendor/email/PHPMailer.php';
                    require 'vendor/email/SMTP.php';

                    //-------------------------INICIO DO PHP MAILER------------------
                    //Create an instance; passing `true` enables exceptions
                    $mail = new PHPMailer();

                    try {
                        //Server settings
                        $mail->SMTPDebug  = 0;                      // *Enable verbose debug output
                        $mail->isSMTP();                                            //Send using SMTP
                        $mail->Host       = EMAIL_HOST;                  // *Set the SMTP server to send through
                        $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
                        $mail->Username   = EMAIL_USER; // *SMTP username
                        $mail->Password   = EMAIL_PASS;                         // *SMTP password
                        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
                        $mail->Port       = EMAIL_PORT;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

                        //Recipients
                        $mail->setFrom(EMAIL_USER, 'Transforme seu Conhecimento com a FuturEdu'); // Quem mandou o email
                        $mail->addAddress('felipetremetreme111@gmail.com', 'Felipe');     // Quem recebe o email

                        //Attachments
                        // $mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
                        // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

                        //Content - corpo da mensagem
                        $mail->isHTML(true);                                  //Set email format to HTML
                        $mail->Subject = $assunto;
                        $mail->msgHTML("

                            Nome: $nome <br>
                            Email: $email <br>
                            Telefone $fone <br>
                            Mensagem: $msg <br> 
                            ");

                        $mail->AltBody = "

                            Nome: $nome \n
                            Email: $email \n
                            Telefone: $fone \n
                            Mensagem: $msg \n";

                        $mail->send();

                        $dados = array(
                            'mensagem' => 'Obrigado pelo seu contato, em breve responderei!',
                            'status'   => 'contato'
                        );

                        $this->carregarViews('contato', $dados);


                    } catch (Exception $e) {

                        $dados = array(
                            'mensagem' => 'Não foi possivel enviar sua mensagem!',
                            'status'   => 'contato',
                            'nome'     => $nome,
                            'email'    => $email,
                        );

                        error_log('Erro ao enviar o email' . $mail->ErrorInfo);

                        $this->carregarViews('contato', $dados);

                        // echo "Erro ao enviar a Mensagem!: {$mail->ErrorInfo}";

                    }


                    //-------------------------FIM DO PHP MAILER--------------

                }

            }


        }else{
            $dados = array();
            $this->carregarViews('contato', $dados);
            echo 'Deu errado ai';
            
        }
    }

}