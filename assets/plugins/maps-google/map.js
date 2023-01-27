
$(function() {
    $("#map").googleMap({
      zoom: 20, // Initial zoom level (optional)
      coords: [-7.965907578986176, 112.60746002197266], // Map center (optional)
      type: "ROADMAP" // Map type (optional)
    });
  })
 $(function() {
    $("#map2").googleMap();
    $("#map2").addMarker({
      coords: [-7.965907578986176, 112.60746002197266], // Map center (optional)
      title: 'STIKI MALANG', // Title
      text:  'STIKI MALANG.' // HTML content
    });
  })
  $(function() {
    $("#map3").googleMap();
    
    // Marker 1
    $("#map3").addMarker({
    	 coords: [51.534287, -0.033580]
    });
  })
