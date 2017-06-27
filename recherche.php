<?php
    include 'header.php';
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
?>

<div id="index-banner" class="parallax-container ">
    <div class="section no-pad-bot">
      <div class="container">
        <br><br>
        <h1 class="header center teal-text one">1248 Façons de découvrir</h1>
        <div class="row center">
          <h5 class="header col s12 light">Il y a <?= $totalEnregistrement ?> résultats.</h5>
        </div>
                
        <br><br>

      </div>
    </div>
    <div class="parallax">
        <img src="img/background1.png" alt="Unsplashed background img 1">
    </div>
  </div>
  <div class="container">
        <div class="row">
    
<?php 

            foreach ($musees as $musee): 
    ?>
            

        
      
                   <div class="card horizontal col s12 m4 l4 xl4 hop">
                      <div class="card-stacked hoverable">
                        <div class="card-content">
                    <h2 class="hc">
                        <?= $musee['nom_du_musee'] ?>
                    </h2>
                    
                            <p><?= $musee['cp'].' '.$musee['ville'] ?></p>
                            <p><img src='<?= $musee['lien_image']?>' alt=" image de'<?= $musee['nom_du_musee']?>'"></p>
                        </div>
                        <div class="card-action">  
                            <a href="result.php?id=<?=$musee['id']?>">En savoir plus</a>
                        </div>
                    </div>
                </div>
            
        
    <?php endforeach; ?>
    
     </div>
     <ul class="pagination">
            
     <?php
    
        for($i=1; $i<=$nbrPage; $i++){
            if($i == $cPage){
            echo "<li class='active'>$i</li>";
            }
            else{
            echo " <li class='waves-effect'><a href=\"recherche.php?search=$motCle&p=$i\">$i</a></li>";
        }

    }
    ?>
    
    
    </ul>
</div>
     
    
    <?php
}

    else{
        
         header('Location: index.php');
    }

?>


<?php
    include 'footer.php';
?>