<?php

require_once('connection.php');

    $success = 0 ;
    $error = "une erreur est survenue coté : script.php" ;
    $data = [];

    if (isset($_POST['confirm_register'])) {
        if (isset($_POST['identifiant']) AND isset($_POST['pseudo']) AND isset($_POST['password']) AND isset($_POST['password_confirm'])) {
            if (!empty($_POST['identifiant']) AND !empty($_POST['password']) AND !empty($_POST['password'] AND !empty($_POST['password']))) {
                
                $email = trim(htmlspecialchars($_POST['identifiant']));
                $pseudo = trim(htmlspecialchars($_POST['pseudo']));
                $password = trim(htmlspecialchars($_POST['password']));
                $password_confirm = trim(htmlspecialchars($_POST['password_confirm']));
                $password_crypted = password_hash($password, PASSWORD_DEFAULT, ['cost'=> 12 ]);

                if (strlen($email) <= 255) {
                       if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
                           if (strlen($pseudo) >= 3 AND strlen($pseudo) <= 255) {
                               if (strlen($password) >= 8 AND strlen($password) <= 255) {
                                   if ($password == $password_confirm) {
                                    
                                    $success = 1 ;
                                    $error = "Votre compte a bien été créé" ;

                                    $req = $db->prepare(" INSERT INTO users (email, pseudo, password) VALUES (?,?,?) ");
                                    $req->execute(array($email, $pseudo, $password_crypted));

                                    } else {
                                    $error = "Vos mots de passes ne sont pas identiques" ;
                                   }
                               } else {
                                $error = "Votre mot de passe doit faire moins de 255 caractères et plus de 3" ;
                               }
                           } else {
                            $error = "Votre pseudo doit comprendre entre 3 et 255 caractères" ;
                           }
                       } else {
                        $error = "Votre email est à un format indirect" ;
                    }
               } else {
                       $error = "Votre email doit faire moins de 255 caractères" ;
                   } 
            }  else {
                $error = "Veuillez remplir tout les champs";
            }      
        }
    };

    $res = ["success" => $success, "error" => $error] ;

    echo json_encode($res);

?>

