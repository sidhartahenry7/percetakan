<!DOCTYPE html>
<html lang="en">
<head>
    <title>Form Cabang</title>
    <meta charset="utf-8" />
    <meta
        name="viewport"
        content="width=device-width, initial-scale=1, shrink-to-fit=no"
    />

    <link
        href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900"
        rel="stylesheet"
    />

    <link
        rel="stylesheet"
        href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"
    />
    <link rel="stylesheet" href="css/style.css" />
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
<body>
    <div class="wrapper d-flex align-items-stretch">
        @include('partials.navbar');

        <!-- Page Content  -->
        <div id="content" class="p-4 p-md-5 pt-5">
            <div class="iq-card">
                <div class="iq-card-header d-flex justify-content-between">
                    <div class="iq-header-title">
                        <h4 class="card-title">Cabang</h4>
                    </div>
                </div>
                <hr style="height: 10px;">
                <div class="iq-card-body">
                    <form>
                        <div class="form-group">
                            <label style="color: black; font-weight: bold;" for="text">ID Cabang</label>
                            <input type="text" class="form-control" id="cabang" />
                        </div>
                        <div class="form-group">
                            <label for="manager">Manager</label>
                            <select class="form-control" id="manager">
                                <option selected="" disabled="">
                                    -- Pilih Manager --
                                </option>
                                <option>Manager 1</option>
                                <option>Manager 2</option>
                                <option>Manager 3</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="text">Alamat</label>
                            <input type="text" class="form-control" id="alamat" />
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-3">
                                    <label for="text">Longitude</label>
                                    <br>
                                    <input type="text" class="form-control" id="longitude" />
                                </div>
                                <div class="col-sm-3">
                                    <label for="text">Latitude</label>
                                    <br>
                                    <input type="text" class="form-control" id="latitude" />
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="text">No Telp</label>
                            <input type="number" class="form-control" id="no_telp" />
                        </div>
                        <button type="cancel" class="btn btn-danger">
                            Cancel
                        </button>
                        <button type="submit" class="btn" style="background-color: #29a4da; color: white;">
                            Submit
                        </button>
                    </form>
                </div>
            </div>
            <br>
            <!--Tabel-->
            <table>
                <tr>
                    <th>ID Cabang</th>
                    <th>Manager</th>
                    <th>Alamat</th>
                    <th>Longitude</th>
                    <th>Latitude</th>
                    <th>No Telepon</th>
                    <th>Jumlah Pegawai</th>
                </tr>
                <tr>
                    <td>C123</td>
                    <td>John</td>
                    <td>Jln api</td>
                    <td>longitude</td>
                    <td>latitude</td>
                    <td>086565443213</td>
                    <td>1</td>
                </tr>
                <tr>
                    <td>D112</td>
                    <td>Doe</td>
                    <td>Jln air</td>
                    <td>longitude</td>
                    <td>latitude</td>
                    <td>087677543999</td>
                    <td>2</td>
                </tr>
            </table>
        </div>

  
      
    </div>

    <script src="js/jquery.min.js"></script>
    <script src="js/popper.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/main.js"></script>
</body>
</html>
