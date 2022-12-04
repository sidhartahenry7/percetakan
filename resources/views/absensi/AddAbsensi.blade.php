@include('layouts.main')
    <style>
        table {
            font-family: arial, sans-serif;
            border-collapse: collapse;
            width: 100%;
        }

        td, th {
            border: 1px solid black;
            text-align: center;
            padding: 8px;
            color: black;
        }

        body {
            background-color: #f7f8f8;
        }

        #sidebar {
            background-color: #0b2357;
        }

        .form-control {
            border: 1px solid black;
        }

        label {
            color: black;
        }

    </style>
</head>
<body onload="startTime();">
    <div class="wrapper d-flex align-items-stretch">
        @include('partials.navbar')

        <!-- Page Content  -->
        <div id="content" class="p-4 p-md-5 pt-5">
            <div class="iq-card">
                <div class="iq-card-header d-flex justify-content-between">
                    <div class="iq-header-title">
                        <h4 class="card-title">Absensi</h4>
                    </div>
                </div>
                <hr style="height: 10px;">
                <div class="iq-card-body">
                    <br>
                    @if(session()->has('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @elseif(session()->has('fail'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            {{ session('fail') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif
                    <form action="/absensi" method="post">
                        @csrf
                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-3">
                                    <label style="color: black; font-weight: bold;" for="text">Pegawai</label>
                                    <input type="hidden" name="pegawai_id" value="{{ $pegawai->id }}">
                                    <input readonly="readonly" type="text" class="form-control" style="width:270px" id="pegawai_id" value="{{ $pegawai->nama_lengkap }}" required autofocus>
                                    {{-- @error('pegawai_id')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror --}}
                                </div>
                            </div>
                        </div>
                        @if(is_null($single_absensi))
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-sm-3">
                                        <label for="date">Tanggal Masuk</label>
                                        <br>
                                        <input readonly="readonly" type="date" class="form-control @error('tanggal_masuk') is-invalid @enderror" id="tanggal_masuk" name="tanggal_masuk" value="{{ date('Y-m-d') }}" required autofocus/>
                                        @error('tanggal_masuk')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="col-sm-3">
                                        <label for="text">Jam Masuk</label>
                                        <br>
                                        {{-- <div style="font-size: 50px;" id="jam" style="color:black;"></div> --}}
                                        <label for="text" id="jam"></label>
                                        {{-- <input readonly="readonly" type="time" class="form-control" id="jam_masuk" name="jam_masuk" value="{{ date('H:i:m') }}" required autofocus/> --}}
                                    </div>
                                </div>
                            </div>
                        @else
                            {{-- @foreach ($single_absensi as $absen) --}}
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-sm-3">
                                        <label for="date">Tanggal Masuk</label>
                                        <br>
                                            <input readonly="readonly" type="date" class="form-control" id="tanggal_masuk" name="tanggal_masuk" value="{{ $single_absensi->tanggal_masuk }}" required autofocus/>
                                    </div>
                                    <div class="col-sm-3">
                                        <label for="text">Jam Masuk</label>
                                        <br>
                                        <input readonly="readonly" type="time" class="form-control" name="jam_masuk" value="{{ $single_absensi->jam_masuk }}" required autofocus/>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-sm-3">
                                        <label for="date">Tanggal Keluar</label>
                                        <br>
                                        <input readonly="readonly" type="date" class="form-control @error('tanggal_keluar') is-invalid @enderror" id="tanggal_keluar" name="tanggal_keluar" value="{{ date('Y-m-d') }}" required autofocus/>
                                        @error('tanggal_keluar')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="col-sm-3">
                                        <label for="text">Jam Keluar</label>
                                        <br>
                                        <label for="text" id="jam"></label>
                                        {{-- <input readonly="readonly" type="time" class="form-control" id="jam_keluar" name="jam_keluar" value="{{ date('H:i:m') }}" required autofocus/> --}}
                                    </div>
                                </div>
                            </div>
                            {{-- @endforeach --}}
                        @endif
                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-3">
                                    <label for="text">Longitude</label>
                                    <br>
                                    <input type="text" class="form-control @error('longitude') is-invalid @enderror" id="longitude" name="longitude" required autofocus/>
                                    @error('longitude')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="col-sm-3">
                                    <label for="text">Latitude</label>
                                    <br>
                                    <input type="text" class="form-control @error('latitude') is-invalid @enderror" id="latitude" name="latitude" required autofocus/>
                                    @error('latitude')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        @if(is_null($single_absensi))
                            <button type="submit" class="btn btn-success" style="width: 130px;" name="tombol" value="check_in">
                                Check In
                            </button>
                        @elseif(is_null($single_absensi->tanggal_keluar))
                            <button type="cancel" class="btn btn-danger" style="width: 130px;" name="tombol" value="check_out">
                                Check Out
                            </button>
                        @endif
                    </form>
                    <div id="map" style="height:200px; width: 400px;" class="my-3"></div>
                    {{-- <script type="text/javascript">
                        function getLocation(){
                            if(navigator.geolocation) {
                                navigator.geolocation.getCurrentPosition(showPosition());
                            }
                        }
                        function showPosition(position){
                            document.querySelector('.myForm input[name = "longitude"]').value = postion.coords.longitude;
                            document.querySelector('.myForm input[name = "latitude"]').value = postion.coords.latitude;
                        }
                    </script> --}}
                </div>
            </div>
            
            <script async defer src="https://maps.googleapis.com/maps/api/js?key=&callback=initMap" type="text/javascript"></script>
            <script>
                let map, infoWindow;
                
                function initMap() {
                    map = new google.maps.Map(document.getElementById("map"), {
                        center: {  lat: 7.2813819, lng: 112.7052772 },
                        zoom: 14,
                    });
                    infoWindow = new google.maps.InfoWindow();
                
                    const locationButton = document.createElement("button");
                
                    locationButton.textContent = "Pin to Current Location";
                    locationButton.classList.add("custom-map-control-button");
                    map.controls[google.maps.ControlPosition.TOP_CENTER].push(locationButton);
                    locationButton.addEventListener("click", () => {
                        // Try HTML5 geolocation.
                        if (navigator.geolocation) {
                            navigator.geolocation.getCurrentPosition(
                                (position) => {
                                    const pos = {
                                        lat: position.coords.latitude,
                                        lng: position.coords.longitude,
                                    };
                                    $('#latitude').val(position.coords.latitude)
                                    $('#longitude').val(position.coords.longitude)
                                    infoWindow.setPosition(pos);
                                    infoWindow.setContent("Location found.");
                                    infoWindow.open(map);
                                    map.setCenter(pos);
                                },
                                () => {
                                    handleLocationError(true, infoWindow, map.getCenter());
                                }
                            );
                        } else {
                        // Browser doesn't support Geolocation
                            handleLocationError(false, infoWindow, map.getCenter());
                        }
                    });
                }
                        
                function handleLocationError(browserHasGeolocation, infoWindow, pos) {
                    infoWindow.setPosition(pos);
                    infoWindow.setContent(
                        browserHasGeolocation
                        ? "Error: The Geolocation service failed."
                        : "Error: Your browser doesn't support geolocation."
                    );
                    infoWindow.open(map);
                }
                window.initMap = initMap;
            </script>
        </div>
    </div>

    <script src="js/jquery.min.js"></script>
    <script src="js/popper.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/main.js"></script>
    <script>
        function startTime() {
            const today = new Date();
            let h = today.getHours();
            let m = today.getMinutes();
            let s = today.getSeconds();
            m = checkTime(m);
            s = checkTime(s);
            document.getElementById('jam').innerHTML =  h + ":" + m + ":" + s;
            // document.getElementById('jam_keluar').innerHTML =  h + ":" + m + ":" + s;
            setTimeout(startTime, 1000);
        }
        
        function checkTime(i) {
          if (i < 10) {i = "0" + i};  // add zero in front of numbers < 10
          return i;
        }
    </script>
</body>
</html>
