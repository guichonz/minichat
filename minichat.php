<?php
session_start(); //démarrage de la session pour gérer la conservation du pseudo après le premier post
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title>Minichat</title>
    </head>
    <body>
        <form action="minichat_post.php" method="post">
            Pseudo : <input name="pseudo" <?php if(isset($_SESSION['nom'])){echo 'value='.$_SESSION['nom'];}?>>
            <br/>
            Message :<input name="message" id="message"/><br/>
            <input type="submit" value="Envoyer" />
        </form> 
        <script language="javascript"> //gestion du focus sur le champ message
            document.getElementById("message").focus();
        </script>
        
        <?php
            try
            {
                $bdd = new PDO('mysql:host=http://sql.free.fr;dbname=minichat;charset=utf8', '**', '**');
            }
            catch(Exception $e)
            {
                    die('Erreur : '.$e->getMessage());
            }

            $req = $bdd->prepare("SELECT DATE_FORMAT(date_creation, '%d-%m-%Y %Hh%i\'%s\'\'') AS date, pseudo, message FROM minichat ORDER BY ID DESC");
            $req->execute();
            while ($donnees = $req->fetch())
            {
                echo '<div>'
                        .'['
                        .$donnees['date']
                        .']'
                        .' <strong>'
                            . $donnees['pseudo']
                        . '</strong>'
                        . ' : '
                        . $donnees['message']
                . '</div>';
            }

            $req->closeCursor();  
        ?>
    </body>
</html>