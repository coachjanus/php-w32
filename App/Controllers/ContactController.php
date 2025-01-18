<?php

namespace App\Controllers;

use App\Core\Http\Response;
// require_once dirname(__DIR__, 2)."/app/Core/http/Response.php";

// require_once dirname(__DIR__)."/Core/Database/Connection.php";

class ContactController
{
    public $title;
    protected Response $response;
    protected $connect;

    public function __construct() {
        $this->connect = Connection::connect();
    }
    public function index(){
        if ($_POST) {
            $first_name = htmlspecialchars($_POST['first_name']);
            $last_name = htmlspecialchars($_POST['last_name']);
            $email = htmlspecialchars($_POST['email']);
            $message = htmlspecialchars($_POST['message']);
             
            $created_at = date('Y-m-d H:i:s');
            $sql = "INSERT INTO feedback (first_name, last_name, email, message, created_at) VALUES ('$first_name', '$last_name', '$email', '$message', '$created_at')";

            $stmt = $this->connect->prepare($sql);
            $stmt->execute();
        }
 
        $sql = "SELECT * FROM feedback";
        $stmt = $this->connect->prepare($sql);
        // var_export($stmt);
        $stmt->execute();
        
        $messages = $stmt->fetchAll(PDO::FETCH_CLASS);
        // var_export($messages);

        $this->title =  "Welcome to Contact page";
        $body = render('contact/index', ['title' => $this->title, 'messages'=>$messages]);

        $this->response = new Response($body);
        $this->response->send();
    }

}
