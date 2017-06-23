<?php

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
<head>
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
</head>
        <div>
            <div>
                <div>
                    <h2>
                        <?= $musee['0']['nom_du_musee'] ?>
                    </h2>
                    <p><img src='<?= $musee['0']['lien_image']?>' alt=" image de'<?= $musee['0']['nom_du_musee']?>'">
                    </p>
                    <h3>Adresse</h3>
                    <p>
                        <?= $musee['0']['adresse'] ?>
                    </p>
                    <p>
                        <?= $musee['0']['cp'].' '.$musee['0']['ville'] ?>
                    </p>
                    <h3>Téléphone</h3>
                    <p> 
                        <?= $musee['0']['telephone'] ?>
                    </p>
                    <h3>Site Web</h3>
                    <a href='http://<?= $musee['0']['site_web'] ?>' target="_blank"><?= $musee['0']['site_web'] ?></a>
                    <h3>Période d'ouverture</h3>                      
                    <p>
                        <?= $musee['0']['periode_ouverture'] ?>
                    </p>
                    <h3>Période de fermeture</h3>
                    <p>
                        <?= $musee['0']['fermeture_annuelle'] ?>
                    </p>
                  <?php
                        $adresse=$musee['0']['adresse']." ".$musee['0']['cp'].' '.$musee['0']['ville'];
                        $localisation=geocode($adresse);
                       /* echo "latitude: ".$localisation[0];
                        echo "longitude: ".$localisation[1];*/
    ?>
                </div>
             </div>
        </div>
   <div id="map"></div>

<script>
function myMap() {
  var myCenter = new google.maps.LatLng(<?= $localisation[0] ?>, <?= $localisation[1]?>);
  var mapCanvas = document.getElementById("map");
  var mapOptions = {
      center: myCenter, 
      zoom: 15,
      styles : [
  {
    "elementType": "geometry",
    "stylers": [
      {
        "color": "#f5f5f5"
      }
    ]
  },
  {
    "elementType": "labels.icon",
    "stylers": [
      {
        "visibility": "off"
      }
    ]
  },
  {
    "elementType": "labels.text.fill",
    "stylers": [
      {
        "color": "#616161"
      }
    ]
  },
  {
    "elementType": "labels.text.stroke",
    "stylers": [
      {
        "color": "#f5f5f5"
      }
    ]
  },
  {
    "featureType": "administrative.land_parcel",
    "elementType": "labels.text.fill",
    "stylers": [
      {
        "color": "#bdbdbd"
      }
    ]
  },
  {
    "featureType": "poi",
    "elementType": "geometry",
    "stylers": [
      {
        "color": "#eeeeee"
      }
    ]
  },
  {
    "featureType": "poi",
    "elementType": "labels.text.fill",
    "stylers": [
      {
        "color": "#757575"
      }
    ]
  },
  {
    "featureType": "poi.park",
    "elementType": "geometry",
    "stylers": [
      {
        "color": "#e5e5e5"
      }
    ]
  },
  {
    "featureType": "poi.park",
    "elementType": "labels.text.fill",
    "stylers": [
      {
        "color": "#9e9e9e"
      }
    ]
  },
  {
    "featureType": "road",
    "elementType": "geometry",
    "stylers": [
      {
        "color": "#ffffff"
      }
    ]
  },
  {
    "featureType": "road.arterial",
    "elementType": "geometry.fill",
    "stylers": [
      {
        "color": "#ffaa55"
      }
    ]
  },
  {
    "featureType": "road.arterial",
    "elementType": "labels.text.fill",
    "stylers": [
      {
        "color": "#757575"
      }
    ]
  },
  {
    "featureType": "road.highway",
    "elementType": "geometry",
    "stylers": [
      {
        "color": "#dadada"
      }
    ]
  },
  {
    "featureType": "road.highway",
    "elementType": "geometry.fill",
    "stylers": [
      {
        "color": "#ff8000"
      }
    ]
  },
  {
    "featureType": "road.highway",
    "elementType": "labels.text.fill",
    "stylers": [
      {
        "color": "#616161"
      }
    ]
  },
  {
    "featureType": "road.local",
    "elementType": "geometry.fill",
    "stylers": [
      {
        "color": "#ffcd9b"
      }
    ]
  },
  {
    "featureType": "road.local",
    "elementType": "labels.text.fill",
    "stylers": [
      {
        "color": "#9e9e9e"
      }
    ]
  },
  {
    "featureType": "transit.line",
    "elementType": "geometry",
    "stylers": [
      {
        "color": "#e5e5e5"
      }
    ]
  },
  {
    "featureType": "transit.station",
    "elementType": "geometry",
    "stylers": [
      {
        "color": "#eeeeee"
      }
    ]
  },
  {
    "featureType": "water",
    "elementType": "geometry",
    "stylers": [
      {
        "color": "#c9c9c9"
      }
    ]
  },
  {
    "featureType": "water",
    "elementType": "geometry.fill",
    "stylers": [
      {
        "color": "#49edf5"
      }
    ]
  },
  {
    "featureType": "water",
    "elementType": "geometry.stroke",
    "stylers": [
      {
        "color": "#49edf5"
      }
    ]
  },
  {
    "featureType": "water",
    "elementType": "labels.text.fill",
    "stylers": [
      {
        "color": "#9e9e9e"
      }
    ]
  }
]
  };
  var map = new google.maps.Map(mapCanvas, mapOptions);
  var marker = new google.maps.Marker({position:myCenter});
  marker.setMap(map);
    
}
</script>

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDTbCZbT3cIAfDu1fzsvA6TIvs1Q6hisjk&callback=myMap"></script>
<!--
To use this code on your website, get a free API key from Google.
Read more at: https://www.w3schools.com/graphics/google_maps_basic.asp
-->
