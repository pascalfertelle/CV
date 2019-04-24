<?php
// envoi d'un email à $_POST["user_mail"]
if (isset($_POST["user_mail"])) {
mail($_POST["user_mail"], "sujet", "test test test");
echo "mail de bienvenue";
}
else {
    echo "pas de mail";
}
?>