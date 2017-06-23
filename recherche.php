<?php 

        $motCle = $_GET["search"];

if(!empty($motCle)){

        $servername = "localhost";
        $username = "jcecile";
        $password = "jcecile@2017";
        $dbname = "jcecile";
    
    
    if(isset($_GET['p'])){
        $cPage = $_GET['p'];
    }
    else{
        $cPage =1;
    }
        
        $perPage = 6;
        $count = ($cPage-1)*$perPage;


    
         try {
            $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password, array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));
            $stmt = $conn->prepare("SELECT COUNT(id) as nbr FROM musee WHERE cp LIKE CONCAT('%', :motcle , '%') OR ville LIKE CONCAT('%', :motcle , '%') OR nom_reg LIKE CONCAT('%', :motcle , '%') OR nom_dep LIKE CONCAT('%', :motcle , '%') OR nom_du_musee LIKE CONCAT('%', :motcle , '%')");
            $stmt->bindParam(':motcle', $motCle);
            $stmt->execute();
            $result = $stmt->fetch();
             
            $totalEnregistrement = $result['nbr'];
            $nbrPage = ceil($totalEnregistrement/$perPage);
             
            $stmt = $conn->prepare("SELECT * FROM musee WHERE cp LIKE CONCAT('%', :motcle , '%') OR ville LIKE CONCAT('%', :motcle , '%') OR nom_reg LIKE CONCAT('%', :motcle , '%') OR nom_dep LIKE CONCAT('%', :motcle , '%') OR nom_du_musee LIKE CONCAT('%', :motcle , '%') LIMIT :count, :perPage");
            $stmt->bindParam(':motcle', $motCle);
            $stmt->bindParam(':count', $count, PDO::PARAM_INT);
            $stmt->bindParam(':perPage', $perPage, PDO::PARAM_INT);
            $stmt->execute();
            $musees = $stmt->fetchAll();
        }


        catch(PDOException $e){
            $error["bdd"] =  "Error: " . $e->getMessage();
        }

    
    
            echo "<h2> Il y a ".$totalEnregistrement." résultats.";
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
    
        for($i=1; $i<=$nbrPage; $i++){
            if($i == $cPage){
            echo "$i / ";
            }
            else{
            echo " <a href=\"recherche.php?search=$motCle&p=$i\">$i</a> /";
        }

    }
}

    else{
        
         header('Location: index.php');
    }

?>