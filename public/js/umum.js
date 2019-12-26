
$(document).ready(function() {
    var headers =  {
        'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')
    };
    // Select Rombel
	$('.selRombel').select2({
		ajax:{
			headers: headers,
			url: '/ajax/select/rombel',
			type: 'post',
			dataType: 'json',
			delay: 250,
			processResults: function(response) {
				return {
					results: response
				};
			},
			cache: true
		}
	})
	$('.selGuru').select2({
		ajax:{
			headers: headers,
			url: '/ajax/select/guru',
			type: 'post',
			dataType: 'json',
			delay: 250,
			processResults: function(response) {
				return {
					results: response
				};
			},
			cache: true
		}
	});

	var sekolah;
	$.ajax({
		url: '/ajax/getsekolah',
		type: 'post',
		headers: headers,
		dataType: 'json',
		success: function(res) {
			console.log(res);
			sekolah = res.data;  
			// getLocation(res.data);
			// initialize(res.data);
		}
	})

	// var x = document.getElementById("demo");
	// var long = 112.646883;
	// var lat = -8.034246;
	// 	function getLocation(sekolah) {
	// 		if (navigator.geolocation) {
	// 		navigator.geolocation.getCurrentPosition(function(pos){
	// 			// alert(pos.coords.latitude+', '+pos.coords.longitude);
	// 			var distance = distanceBetween(sekolah.lat, sekolah.long, pos.coords.latitude, pos.coords.longitude, "K");
	// 			// console.log("geo dis: " + distance);
	// 			// $("#demo").html("<h4>" + Math.round(distance) + "Km</h4>");
	// 			if ( distance > 0.5){
	// 				$('#demo').html('Pastikan Anda berada di area sekolah. Saat ini Anda berjarak kurang lebih '+Math.round(distance)+' Km dari sekolah. ;)'+pos.coords.latitude+', '+pos.coords.longitude+' Posisi Sekolah: '+sekolah.lat+', '+sekolah.long);
	// 			} else {
	// 				$('#demo').html('Silahkan masuk. Anda sudah berada di area sekolah.');
	// 			}
	// 		}, showError);
	// 		} else {
	// 		var status = document.getElementById("demo");
	// 		status.innerHTML = "Geolocation is not supported by this browser.";
	// 		}
	// 	}
	// 	function distanceBetween(lat1, lon1, lat2, lon2, unit) {

	// 		var rlat1 = Math.PI * lat1 / 180
	// 		var rlat2 = Math.PI * lat2 / 180
	// 		var rlon1 = Math.PI * lon1 / 180
	// 		var rlon2 = Math.PI * lon2 / 180
	// 		var theta = lon1 - lon2
	// 		var rtheta = Math.PI * theta / 180
	// 		var dist = Math.sin(rlat1) * Math.sin(rlat2) + Math.cos(rlat1) * Math.cos(rlat2) * Math.cos(rtheta);
	// 		dist = Math.acos(dist)
	// 		dist = dist * 180 / Math.PI
	// 		dist = dist * 60 * 1.1515
	// 		if (unit == "K") {
	// 		dist = dist * 1.609344
	// 		}
	// 		if (unit == "N") {
	// 		dist = dist * 0.8684
	// 		}
	// 		return dist
			
	// 	}
	// 	// show our errors for debuging
	// 	function showError(error) {
	// 		var x = document.getElementById("demo");
	// 		switch (error.code) {
	// 		case error.PERMISSION_DENIED:
	// 			x.innerHTML = "Mohon aktifkan lokasi untuk browser. :)"
	// 			break;
	// 		case error.POSITION_UNAVAILABLE:
	// 			x.innerHTML = "Location information is unavailable.";
	// 			break;
	// 		case error.TIMEOUT:
	// 			x.innerHTML = "The request to get location timed out.";
	// 			break;
	// 		case error.UNKNOWN_ERROR:
	// 			x.innerHTML = "An unknown error occurred :(";
	// 			break;
	// 		}
	// 	}
		
		
	// 	// Google Map
	// 	 // variabel global marker
	// 	 var marker;
	// 	 function taruhMarker(peta, posisiTitik) {
	// 		 if (marker) {
	// 			 // pindahkan marker
	// 			 marker.setPosition(posisiTitik);
	// 		 } else {
	// 			 // buat marker baru
	// 			 marker = new google.maps.Marker({
	// 				 position: posisiTitik,
	// 				 map: peta,
	// 			 });
	// 		 }
	// 		 // animasi sekali
	// 		 marker.setAnimation(google.maps.Animation.BOUNCE);
	// 		 setTimeout(function() {
	// 			 marker.setAnimation(null);
	// 		 }, 750);
	// 		 // kirim nilai koordinat ke input
	// 		 $("input[name=longitude]").val(posisiTitik.lat());
	// 		 $("input[name=latitude]").val(posisiTitik.lng());
	// 		 console.log($("input[name=longitude]").val() + "," + $("input[name=latitude]").val());
	// 	 }
	// 	 function initialize(sekolah) {
	// 		 var propertiPeta = {
	// 			 center: new google.maps.LatLng(sekolah.lat,sekolah.long),
	// 			 zoom: 19,
	// 			 mapTypeId: google.maps.MapTypeId.ROADMAP
	// 		 };
	// 		 var peta = new google.maps.Map(document.getElementById("google-maps"), propertiPeta);
	// 		 // even listner ketika peta diklik
	// 		 google.maps.event.addListener(peta, 'click', function(event) {
	// 			 taruhMarker(this, event.latLng);
	// 		 });
	// 		 // marker.setMap(peta);
	// 	 }
	// 	 // event jendela di-load
	// 	 google.maps.event.addDomListener(window, 'load', initialize);

	// 	 $(document).on('submit', '#form-lokasi-sekolah', function(e){
	// 		var newLat = $("input[name=longitude]").val();
	// 		var newLong = $("input[name=latitude]").val();

	// 		$.ajax({
	// 			url: '/ajax/update-lokasi-sekolah',
	// 			type: 'put',
	// 			headers: headers,
	// 			data: { lat : newLat, long: newLong},
	// 			success: function(res) {
	// 				Swal.fire('Info', res.msg,' info');
	// 			}
	// 		})
	// 	 });
});