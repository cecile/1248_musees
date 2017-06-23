<!DOCTYPE html>
<html lang="fr">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Les musées de France</title>
</head>

<body>
   <?php

        $servername = "localhost";
        $username = "jcecile";
        $password = "jcecile@2017";
        $dbname = "jcecile";

         try {
            $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password, array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));
            $stmt = $conn->prepare("select * from musee"); 
            $stmt->execute();
            $musees = $stmt->fetchAll();
        }


        catch(PDOException $e){
            $error["bdd"] =  "Error: " . $e->getMessage();
        }
    ?>
            
    
    <form class="search" method="get" action="recherche.php?search=<?=$_GET["search"]?>">
        <input type="text" name="search" required>
        <button>Rechercher</button>
    </form>
    
    <?php
    
        $rand_keys = array_rand($musees, 3);
          
          try{
              $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password, array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));
             $stmt = $conn->prepare("SELECT * FROM musee WHERE id=$rand_keys[0] OR id=$rand_keys[1] OR id=$rand_keys[2]"); 
             $stmt->execute();
             $musees = $stmt->fetchAll();
          }
           catch(PDOException $e){
            $error["bdd"] =  "Error: " . $e->getMessage();
        }
          
        foreach ($musees as $musee): 
    ?>
            

        
         <div class="row">
            <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
                <div class="post-preview">
                    <h2 class="post-title">
                        <?= $musee['nom_du_musee'] ?>
                    </h2>
                    <h3 class="post-subtitle">
                        <?= $musee['cp'].' '.$musee['ville'] ?>
                    </h3>
                    <p><img src='<?= $musee['lien_image']?>' alt=" image de'<?= $musee['nom_du_musee']?>'"></p>
                    <a class="waves-effect waves-light btn" href="result.php?id=<?=$musee['id']?>">En savoir plus</a>
                </div>
             </div>
        </div>
        <hr>
        
    <?php endforeach;
    ?>
    


</body>
</html>
