<?php 
ob_start();  
$options  = _WSH()->option();
$api_key = sh_set($options,'api_key');
$uniqid = uniqid('mapBox');

$lat = ( $lat ) ? $lat : '-37.801578';

$long = ( $long ) ? $long : '145.060508';

$mark_lat = ( $mark_lat ) ? $mark_lat : '23.820527';

$mark_long = ( $mark_long ) ? $mark_long : '90.413000';

$marker = ( $marker ) ? wp_get_attachment_url($marker) : get_template_directory_uri().'/images/map-marker.png';?>


<!-- Map Scripts-->

    <script src="https://maps.googleapis.com/maps/api/js?key=<?php echo $api_key; ?>&sensor=false"></script>

    <!-- Google Map -->

    <script type="text/javascript">
	
	//    google map start
    (function($) {
        "use strict";

        google.maps.event.addDomListener(window, 'load', init);

        var map;

        function init() {
            var mapOptions = {
                center: new google.maps.LatLng(<?php echo esc_attr($lat); ?>, <?php echo esc_attr($long); ?>),
                zoom: 15,
                zoomControl: true,
                zoomControlOptions: {
                    style: google.maps.ZoomControlStyle.DEFAULT,
                },
                panControl: false,
                disableDoubleClickZoom: false,
                mapTypeControl: false,
                mapTypeControlOptions: {
                    style: google.maps.MapTypeControlStyle.HORIZONTAL_BAR,
                },
                scaleControl: true,
                scrollwheel: false,
                streetViewControl: false,
                draggable : true,
                overviewMapControl: false,
                mapTypeId: google.maps.MapTypeId.ROADMAP,
//                styles: [ 
//                    { featureType: "administrative", elementType: "all", stylers: [ { visibility: "on" }, { saturation: -100 }, { lightness: 20 } ] },
//                    { featureType: "road", elementType: "all", stylers: [ { visibility: "on" }, { saturation: -100 }, { lightness: 40 } ] },
//                    { featureType: "water", elementType: "all", stylers: [ { visibility: "on" }, { saturation: -10 }, { lightness: 30 } ] },
//                    { featureType: "landscape.man_made", elementType: "all", stylers: [ { visibility: "simplified" }, { saturation: -60 }, { lightness: 10 } ] },
//                    { featureType: "landscape.natural", elementType: "all", stylers: [ { visibility: "simplified" }, { saturation: -60 }, { lightness: 60 } ] },
//                    { featureType: "poi", elementType: "all", stylers: [ { visibility: "off" }, { saturation: -100 }, { lightness: 60 } ] }, 
//                    { featureType: "transit", elementType: "all", stylers: [ { visibility: "off" }, { saturation: -100 }, { lightness: 60 } ] }
//                ]

            }

            var mapElement = document.getElementById('<?php echo esc_attr($uniqid); ?>');
            var map = new google.maps.Map(mapElement, mapOptions);
            
            var locations = [
                ['', <?php echo esc_js($mark_lat);?>, <?php echo esc_js($mark_long);?>]
            ];
            for (var i = 0; i < locations.length; i++) {
                var marker = new google.maps.Marker({
                    icon: '<?php echo esc_js($marker);?>',
//                    animation: google.maps.Animation.BOUNCE,
                    position: new google.maps.LatLng(locations[i][1], locations[i][2]),
                    map: map,
                });
            }
            
            var contentString = 
                '<div id="content">'+
                    '<div class="mapInfoWindowRowInner">'+
                        '<h5><?php echo esc_js($location_title);?></h5>'+
                        '<p><?php echo balanceTags($contents);?></p>'+
                    '</div>'+
                '</div>';

            var infowindow = new google.maps.InfoWindow({
                content: contentString
            });
            
            
//            google.maps.event.addListener(marker, 'click', function() {
//                infowindow.open(map,marker);
//            });
            
            infowindow.open(map,marker);
			
         google.maps.event.addListener(marker, 'click', (function(marker, i) {
		return function() {
		  infowindow.setContent(locations[i][0]);
		  infowindow.open(map, marker);
		}
	  })(marker, i)); }    
		
    })(jQuery);
//    google map end

</script>

<section id="googleMapRow" class="row">
	<div class="row m0" id="<?php echo esc_attr($uniqid); ?>"></div>
</section>



<?php return ob_get_clean(); ?>