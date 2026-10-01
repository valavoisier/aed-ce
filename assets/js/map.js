/* ==============================================
MAP -->
=============================================== */
(function () {
    "use strict";

    var locations = [[
        '<div class="infobox"><h3 class="title"><a href="#">AED Centre équestre</a></h3><span>3 Rue de l\'Église, 02820 Goudelancourt-lès-Berrieux.</span><span> Tel: 03 23 22 40 49</span></div>',
        49.49683,
        3.84510,
        2
    ]];

    var mapElement = document.getElementById('map');
    if (!mapElement || typeof google === 'undefined' || !google.maps) return;

    var map = new google.maps.Map(mapElement, {
        zoom: 12,
        scrollwheel: false,
        navigationControl: true,
        mapTypeControl: false,
        scaleControl: false,
        draggable: true,
        center: new google.maps.LatLng(49.49683, 3.84510),
        mapTypeId: google.maps.MapTypeId.ROADMAP,
        styles: [
            {
                "featureType": "administrative",
                "elementType": "labels.text.fill",
                "stylers": [{ "color": "#444444" }]
            },
            {
                "featureType": "landscape",
                "elementType": "all",
                "stylers": [{ "color": "#f2f2f2" }]
            },
            {
                "featureType": "poi",
                "elementType": "all",
                "stylers": [{ "visibility": "off" }]
            },
            {
                "featureType": "road",
                "elementType": "all",
                "stylers": [
                    { "saturation": -100 },
                    { "lightness": 45 }
                ]
            },
            {
                "featureType": "road.highway",
                "elementType": "all",
                "stylers": [{ "visibility": "simplified" }]
            },
            {
                "featureType": "road.arterial",
                "elementType": "labels.icon",
                "stylers": [{ "visibility": "off" }]
            },
            {
                "featureType": "transit",
                "elementType": "all",
                "stylers": [{ "visibility": "off" }]
            },
            {
                "featureType": "water",
                "elementType": "all",
                "stylers": [
                    { "color": "#9A5736" },
                    { "visibility": "on" }
                ]
            }
        ]
    });

    var infowindow = new google.maps.InfoWindow();

    locations.forEach(function (location) {
        var marker = new google.maps.Marker({
            position: new google.maps.LatLng(location[1], location[2]),
            map: map,
            icon: 'images/aed-logo.png'
        });

        marker.addListener('click', function () {
            infowindow.setContent(location[0]);
            infowindow.open(map, marker);
        });
    });
})();