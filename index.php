<?php

include 'header.php';

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

<div id="index-banner" class="parallax-container">
    <div class="section no-pad-bot">

        <div class="container">
            <br><br>
            <h1 class="header center teal-text one"><span class="timer count-title count-number" data-to="1248" data-speed="1200"></span> façons de découvrir</h1>
            <div class="row center">
                <h5 class="header col s12 light">Bienvenue sur le répertoire des musées de France</h5>
            </div>

            <div class="row center">
                <div class="nav-wrapper">
                    <form class="search" method="get" action="recherche.php?search=<?=$_GET["search"]?>">
                        <div class="input-field">
                            <input id="search" class="villes" type="search" placeholder="Veuillez entrer ici votre recherche" type="text" name="search" required>
                            <label class="label-icon" for="villes"><i class="material-icons">search</i></label>
                            <i class="material-icons cross">close</i>
                        </div>
                    </form>

                </div>
            </div>

            <br><br>

        </div>
    </div>
    <div class="parallax">
        <img src="img/background1.png" alt="Unsplashed background img 1">
    </div>
</div>

<div class="container result">
    <div class="section">
        <div class="row">

            <?php

    $ip = $_SERVER['REMOTE_ADDR']; // Recuperation de l'IP du visiteur
                          $query = @unserialize(file_get_contents('http://ip-api.com/php/'.$ip)); //connection au serveur de ip-api.com et recuperation des données
                          if($query && $query['status'] == 'success') {
                              $userCity = $query['city'];
                              try{
                                  $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password, array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));
                                  $stmt = $conn->prepare("SELECT * FROM musee WHERE ville LIKE :userCity LIMIT 3"); 
                                  $stmt->bindParam(':userCity', $userCity);
                                  $stmt->execute();
                                  $musees = $stmt->fetchAll();
                              }
                              catch(PDOException $e){
                                  $error["bdd"] =  "Error: " . $e->getMessage();
                              }

                              echo "<div class=container><h3>Les musées proches de vous...</h3></div>";

                          } else{

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

                              echo "<div class=container><h3>Quelques musées...</h3></div>";
                          }

                          foreach ($musees as $musee): 
            ?>




            <div class="col s12 m4 l4 xl4">
                <div class="card horizontal hap">
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
            </div>

            <?php endforeach; 
            ?>
        </div>
    </div>
</div>


<div class="parallax-container valign-wrapper">
    <div class="section no-pad-bot">
        <div class="container">
            <div class="row center">
                <h5 class="header col s12 light">1248 manières de se cultiver</h5>
            </div>
        </div>
    </div>
    <div class="parallax"><img src="img/background2.png" alt="Unsplashed background img 2"></div>
</div>

<div class="container">
    <div class="section">

        <div class="row">
            <div class="col s12 center">
                <h3><i class="mdi-content-send brown-text"></i></h3>
                <h4>Musées de France</h4>
                <p class="left-align light">Notre site référence, entre-autres, les Musées labellisés "Musée de France". C'est à dire les musées français dans la perspective d'un grand service public : les musées nationaux, les musées de l'État ayant un statut établi par décret, les anciens musées classés, ainsi que ceux qui sont reconnus comme musées de France par le ministre de la Culture.</p>
            </div>
        </div>

    </div>
</div>


<div class="parallax-container valign-wrapper">
    <div class="section no-pad-bot">
        <div class="container">
            <div class="row center">
                <h5 class="header col s12 light">1248 idées de sorties</h5>
            </div>
        </div>
    </div>
    <div class="parallax"><img src="img/background3.png" alt="Musées Pompidou à Metz"></div>
</div>

<?php

include 'footer.php';
?>