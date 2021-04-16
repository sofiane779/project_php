<?php
session_start();
require_once './vendor/autoload.php';
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;
class PublicController{

    private $pubom;
    private $pubcm;
    private $pubm;

    public function __construct()
    {
        $this->pubom = new adminOrdiModel();
        $this->pubcm = new AdminCategorieModel();
        $this->pubm = new PublicModel();

    }

    public function getPubOrdinateurs(){
        
        if(isset($_GET['id']) && !empty($_GET['id'])){
            if( isset($_POST['soumis']) && !empty($_POST['search'])){
                $search = trim(htmlspecialchars(addslashes($_POST['search'])));
                $tabCat = $this->pubcm->getCategories();
                $computeurs = $this->pubom->getOrdinateurs($search);
                require_once('./views/public/accueil.php');
            }
            $id = trim(htmlentities(addslashes($_GET['id'])));
            $o = new Ordinateur();
            $o->getCategorie()->setId_cat($id);
            $tabCat = $this->pubcm->getCategories();
            $computeurs = $this->pubm->findOrdiByCat($o);
            require_once('./views/public/ordiCat.php');
      
        }else{
            if( isset($_POST['soumis']) && !empty($_POST['search'])){
                $search = trim(htmlspecialchars(addslashes($_POST['search'])));
                $tabCat = $this->pubcm->getCategories();
                $computeurs = $this->pubom->getOrdinateurs($search);
                require_once('./views/public/accueil.php');
            }
            $tabCat = $this->pubcm->getCategories();
            $computeurs = $this->pubom->getOrdinateurs();

        require_once('./views/public/accueil.php');
        }
    }

    public function recap(){

        if(isset($_POST['envoi']) && !empty($_POST['marque']) && !empty($_POST['prix'])){
            $marque = htmlspecialchars(addslashes($_POST['marque']));
            $id = htmlspecialchars(addslashes($_POST['id']));
            $modele = htmlspecialchars(addslashes($_POST['modele']));
            $image = htmlspecialchars(addslashes($_POST['image']));
            $prix = htmlspecialchars(addslashes($_POST['prix']));
            $nb = htmlspecialchars(addslashes($_POST['quantite']));

            require_once('./views/public/ordiItem.php');
        }
    }
    public function orderOrdi(){
        if(isset($_GET['id']) && !empty($_GET['id'])){
            $id = addslashes(htmlspecialchars($_GET['id']));
            require_once('./views/public/orderForm.php');
        }
    }

    public function payement(){

        if(isset($_POST) && !empty($_POST['email']) && !empty($_POST['quantite'])){
         \Stripe\Stripe::setApiKey('sk_test_51Id9H1LPA37e67Fk1U40rikyEKvGFrQrYld1NfDbg7qCCRmGBi5RrEWt4Q9ioBJ77DZSEIg2C2nJbQinYzWpCUzF00a0SCEdsR');
 
         header('Content-Type: application/json');
 
         $checkout_session = \Stripe\Checkout\Session::create([
         'payment_method_types' => ['card'],
         'line_items' => [[
             'price_data' => [
             'currency' => 'eur',
             'unit_amount' => $_POST['prix']*100,
             'product_data' => [
                 'name' => $_POST['marque']."-".$_POST['modele'],
                 'images' => ["./assets/images/14P1.png"],
             ],
             ],
             'quantity' => $_POST['quantite'],
         ]],
         'customer_email' => $_POST['email'],
         'mode' => 'payment',
         'success_url' => 'http://localhost/php/Eval/auto/index.php?action=success',
         'cancel_url' => 'http://localhost/php/Eval/auto/index.php?action=cancel',
         ]);
 
         $_SESSION['pay'] = $_POST;
         echo json_encode(['id' => $checkout_session->id]);
        }
     }

    public function confirmation(){

        $newStock = (int)$_SESSION['pay']['nb'] - (int)$_SESSION['pay']['quantite'];
        $ordniateur = new Ordinateur();
        $ordniateur->setId_ordi($_SESSION['pay']['id']);
        $ordniateur->setQuantite($newStock);

        $nbLine = $this->pubm->updateStock($ordniateur);

        if($nbLine > 0){
           
            $email = $_SESSION['pay']['email'];
            $marque = $_SESSION['pay']['marque'];
            $prix = $_SESSION['pay']['prix'];
         
            //Load Composer's autoloader
            // require 'vendor/autoload.php';

            //Instantiation and passing `true` enables exceptions
            $mail = new PHPMailer(true);

            try {
                //Server settings
                $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
                $mail->isSMTP();                                            //Send using SMTP
                $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
                $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
                $mail->Username   = 'dwwm94@gmail.com';                     //SMTP username
                $mail->Password   = 'mziyzxforjcwijpo';                               //SMTP password
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         //Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
                $mail->Port       = 587;                                    //TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

                //Recipients
                $mail->setFrom('dwwm94@gmail.com', 'Buy-HighTech');
                $mail->addAddress("$email", 'Mr/Mme');     //Add a recipient
                // $mail->addAddress('ellen@example.com');               //Name is optional
                // $mail->addReplyTo('info@example.com', 'Information');
                // $mail->addCC('cc@example.com');
                // $mail->addBCC('bcc@example.com');

                //Attachments
                // $mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
                // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

                //Content
                $mail->isHTML(true);                                  //Set email format to HTML
                $mail->Subject = 'Here is the subject';
                $mail->Body    = "
                    <h2>Merci </h2> 
                    <p>Votre achat à été pris en compte !</p>
                    <div>
                    <b> Marque: </b>".$marque."
                    
                    <b> Prix: </b>".$prix."
                    </div>
                ";
                //$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

                $mail->send();
                echo 'Message has been sent';
            } catch (Exception $e) {
                echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
            }
                    }
                    require_once('./views/public/success.php');
                }
                public function annuler(){
                    require_once('./views/public/cancel.php');
                }

                public function apropos() {
                    require_once('./views/public/apropos.php');
                }
             
                 public function contact() {
                    require_once('./views/public/contact.php');
                }
            
                 public function validate() {
                    require_once('./views/public/validate.php');
                }
            }