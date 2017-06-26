<?php
    
    include 'header.php';

    $servername = "localhost";
    $username = "jcecile";
    $password = "jcecile@2017";
    $dbname = "jcecile";

    try {
            $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password, array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));
            $stmt = $conn->prepare("SELECT * FROM musee WHERE id=".$_GET['id']);
            $stmt->execute();
            $musee = $stmt->fetchAll();
     }

     catch(PDOException $e){
            $error["bdd"] =  "Error: " . $e->getMessage();
     }

    include("geocode.php");

?>
<!--<head>
   <meta name="viewport" content="initial-scale=1.0, user-scalable=no"/>
        <style>
			html, body {
				height: 100%;
				margin: 0;
				padding: 0
			}
        
			#map {
                height: 20em;
                width: 40em;
                border-radius: 70px 70px 70px 70px  ;
				
			}
		</style>
</head>-->
       <div id="index-banner" class="parallax-container ">
    <div class="section no-pad-bot">
      <div class="container">
        <br><br>
        <h1 class="header center teal-text one"><?= $musee['0']['nom_du_musee'] ?></h1>
                
        <br><br>

      </div>
    </div>
    <div class="parallax">
        <img src="img/background1.png" alt="Unsplashed background img 1">
    </div>
  </div>

       
        <div class="container flexresult">
                    <div class="flex2">
            
                    <p><img src='<?= $musee['0']['lien_image']?>' alt=" image de'<?= $musee['0']['nom_du_musee']?>'">
                    </p>
                    <h3>Adresse</h3>
                    <p>
                        <?= $musee['0']['adresse'] ?>
                    </p>
                    <p>
                        <?= $musee['0']['cp'].' '.$musee['0']['ville'] ?>
                    </p>
                    </div>
                    
                    <div class="flex2">
                    <h3>Site Web</h3>
                    <a href='http://<?= $musee['0']['site_web'] ?>' target="_blank"><?= $musee['0']['site_web'] ?></a>
                    </div>
                    
                    <div class="flex2">
                    <h3>Téléphone</h3>
                    <p> 
                        <?= $musee['0']['telephone'] ?>
                    </p>
                    </div>
                    
                    <div class="flex2">
                    <h3>Période d'ouverture</h3>                      
                    <p>
                        <?= $musee['0']['periode_ouverture'] ?>
                    </p>
                    </div>
                    
                    <div class="flex2">
                    <h3>Période de fermeture</h3>
                    <p>
                        <?= $musee['0']['fermeture_annuelle'] ?>
                    </p>
                    </div>
                  <?php
                        $adresse=$musee['0']['adresse']." ".$musee['0']['cp'].' '.$musee['0']['ville'];
                        $localisation=geocode($adresse);
                       /* echo "latitude: ".$localisation[0];
                        echo "longitude: ".$localisation[1];*/
    ?>
            </div>
            
            <div class="row">
             <div id="map" class="col s12 m12 l8 xl8 center"></div>
        </div>
   

<?php
    include 'footer.php';
?>
