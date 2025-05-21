<section style="padding-bottom: 0px; padding-top: 20px;">
<div class="container<?if($re['t6']==''){echo '-fluid';}?> main-map" style="height: 400px; <?if($re['t6']==''){echo 'padding:0px;';}?>" id="map">
        <style>
	#wpsl-stores .wpsl-store-thumb {height:45px !important; width:45px !important;}
	#wpsl-gmap {height:350px !important;}
	#wpsl-stores, #wpsl-direction-details {height:auto !important;}	#wpsl-gmap .wpsl-info-window {max-width:225px !important;}
	.wpsl-input label, #wpsl-radius label, #wpsl-category label {width:95px;}
	#wpsl-search-input  {width:300px;}
</style>
<div id="wpsl-wrap" class="wpsl-store-below">
	<style>
    #map_canvas {
           width: 100%;
           height: 400px;
           border:solid 0px #ccc;
           margin: 0 auto;
       }
    </style>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA7o8q-wRL6v4-S5uFSXC08RQ6BQRNddkM"></script>
    <script>
        function initialize() {
            var myLatlng = new google.maps.LatLng(<?=$re['t1']?>);
            var mapOptions = {
                zoom: 15,
                center: myLatlng
            };
 
            var map = new google.maps.Map(document.getElementById('map_canvas'), mapOptions);
 
            var contentString = "<table><tr><th style='border:0;font-size: 1.5em;color: #00865d;'><i class='fa fa-flag'></i> <?=$re['t2']?></th></tr><tr><td style='border:0'><i class='fa fa-home'></i> Địa chỉ: <?=$re['t3']?></td></tr><tr><td style='border:0'><i class='fa fa-phone'></i>  Phone: <?=$re['t4']?> - <i class='far fa-envelope'></i> Email: <?=$re['t5']?></td></tr></table>";
 
            var infowindow = new google.maps.InfoWindow({
                content: contentString
            });
 
            var marker = new google.maps.Marker({
                position: myLatlng,
                map: map,
                title: '<?=$re['t1']?>'
            });
            infowindow.open(map, marker);
        }
 
        google.maps.event.addDomListener(window, 'load', initialize);
 
 
    </script>
    <div id="map_canvas"></div>
</div>
</div>
    </section>