<footer class="page-footer footer ">
    <div class="container">
      <div class="row">
        <div class="col l6 s12">
          <h5 class="deep-orange-text">Venez musarder !</h5>
          <p class="grey-text text-lighten-4">La France offre la plus grande diversité de musées au monde !  La peinture, la sculpture, la photographie, l’art contemporain, les sciences… et bien d’autres thématiques sont abordées dans plus de mille musées français. Difficile de faire son choix parmi une telle offre culturelle ! Pour ne pas passer à côté de l’essentiel nous les avons tous recensés!</p>
        </div>
            <div class="col l4 s12 offset-l2">
                <a href ="http://www.culturecommunication.gouv.fr/Aides-demarches/Protections-labels-et-appellations/Appellation-Musee-de-France" target="_blank"><img class="image" src="img/logoMuseeDeFrance.png"/></a>
            </div>
       <a href="#" class="go-top">Top</a>
      </div>
    </div>
    <div class="footer-copyright end">
      <div class="container">
      Made by <a class="deep-orange-text accent-4" href="http://materializecss.com">Alex, Cécile, Marine &amp; Samuel, 2017</a>
      </div>
    </div>
  </footer>

  <!--  Scripts-->
  <script src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
  <script src="js/materialize.js"></script>
  <script src="js/init.js"></script>
  <script src="js/compteur.js"></script>
  <script src="https://cdn.jsdelivr.net/algoliasearch/3/algoliasearchLite.min.js"></script>
<script>
function myMap() {
  var myCenter = new google.maps.LatLng(<?= $localisation["results"][0]["geometry"]["location"]["lat"] ?>, <?=  $localisation["results"][0]["geometry"]["location"]["lng"]?>);
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
    <script>
    $(document).ready(function() {
			// Show or hide the sticky footer button
			$(window).scroll(function() {
				if ($(this).scrollTop() > 200) {
					$('.go-top').fadeIn(200);
				} else {
					$('.go-top').fadeOut(200);
				}
			});
			
			// Animate the scroll to top
			$('.go-top').click(function(event) {
				event.preventDefault();
				
				$('html, body').animate({scrollTop: 0}, 300);
			})
		}); 
    </script>
  </body>
</html>
