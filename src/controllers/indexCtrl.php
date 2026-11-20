<?php
require_once "models/User.php";

$error = [];

if (isset($_POST["register"])) {

    if (empty($_POST["firstname"])) {
        $error["firstname"] = "Le prénom est requis.";
    } else {
        if (strlen($_POST["firstname"]) > 10 || strlen($_POST["firstname"]) < 3) {
            $error["firstname"] =
                "Le prénom doit contenir entre 3 et 10 caractères.";
        }
    }

    if (empty($_POST["lastname"])) {
        $error["lastname"] = "Le nom est requis.";
    } else {
        if (strlen($_POST["lastname"]) > 10 || strlen($_POST["lastname"]) < 3) {
            $error["lastname"] =
                "Le nom doit contenir entre 3 et 10 caractères.";
        }
    }

    if (empty($_POST["email"])) {
        $error["email"] = "L'email est requis.";
    } else {
        if (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
            $error["email"] = "L'email n'est pas valide.";
        }
    }
    
    if (empty($_POST["password"])) {
        $error["password"] = "Le mot de passe est requis.";
    } else {
        if (empty($_POST["confirmPassword"])) {
            $error["confirmPassword"] =
                "La confirmation du mot de passe est requise.";
        } else {
            if ($_POST["password"] !== $_POST["confirmPassword"]) {
                $error["password"] = "Les mots de passe ne correspondent pas.";
            } elseif (getUserByEmail($_POST["email"])) {
                $error["email"] = "Cet email est déjà utilisé.";
            } elseif (empty($error)) {
                // On ne crée le compte que s'il n'y a aucune erreur
                $firstname = htmlspecialchars($_POST["firstname"]);
                $lastname = htmlspecialchars($_POST["lastname"]);
                $email = htmlspecialchars($_POST["email"]);
                $hash = password_hash($_POST["password"], PASSWORD_DEFAULT);
                if (createUser($firstname, $lastname, $email, $hash)) {
                    // Connexion automatique après la création
                    $_SESSION["email"] = $email;
                    header("Location: bookList.php");
                    exit();
                }
            }
        }
    }
}

if (isset($_POST["login"])) {
    if (empty($_POST["login_email"]) || empty($_POST["login_password"])) {
        $error["login"] = "L'email et le mot de passe sont requis.";
    } else {
        $user = getUserByEmail($_POST["login_email"]);
        if ($user && password_verify($_POST["login_password"], $user->password)) {
            $_SESSION["email"] = $user->email;
            header("Location: bookList.php");
            exit();
        }
        $error["login"] = "Email ou mot de passe incorrect.";
    }
}
