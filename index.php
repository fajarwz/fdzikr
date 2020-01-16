<!DOCTYPE HTML>
<html>

<head>
    <title>App Dzikir Sederhana</title>
    <meta http-equiv="X-UA-Compatible" content="IE=Edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="style.css">

    <style>
        .table>thead>tr>th {
            padding: 60px;
        }
    </style>


</head>

<body onload="loadCatatan();">

    <div class="col-xs-12 col-md-8 col-md-offset-2" ng-controller="listContactCtrl">
        <div class="page-header">
            <h1 align="center">
                Aplikasi Dzikir Sederhana 
            </h1>
            <ul class="nav nav-pills">
                <li><a id="nav-history-dzikir" href="javascript:void(0);" onclick="gantiMenu('history-dzikir');">History Dzikir</a></li>
                <li><a id="nav-mulai-dzikir" href="javascript:void(0);" onclick="gantiMenu('mulai-dzikir');">Mulai Dzikir</a></li>
            </ul>

        </div>
        <div id="mulai-dzikir" class="well" style="display:none;">
            <form id="form-data">
                <!--<div id="bacaan-group" class="form-group">
                    <label>Bacaan:</label>
                    <input type="text" class="form-control" id="bacaan" name="bacaan">
                </div>-->
                
                <div class="form-group">
                    <input type="button" onclick="incrementValue()" class="btn btn-success btn-lg btn-block btn-dzikir" value="Tap untuk dzikir" />
                </div>
                <div class="form-group">
                    <input class="input-lg input-dzikir" type="text" id="jumlah" value="0" disabled/>
                </div>

                <div class="form-group">
                    <!--<input type="button" value="Simpan" onclick="simpanData();" class="btn btn-success btn-small" />-->
                    <!--<a class="btn btn-success btn-block" href="javascript:void(0)" onclick="simpanDzikir(\'' + list_data[i].id_data + '\')">Hapus</a>-->
                    <input type="button" value="Simpan" onclick="simpanDzikir()" class="btn btn-success btn-block" />
                </div>
                <div class="form-group">
                    <!--<input type="button" value="Simpan" onclick="simpanData();" class="btn btn-success btn-small" />-->
                    <input type="reset" value="Reset" onclick="" class="btn btn-warning btn-block" />
                </div>

                <!--<div id="agenda-group" class="form-group">
                    <label>Keterangan:</label>
                <textarea class="form-control" id="keterangan" name="keterangan"></textarea>
                </div>-->
            </form>
        </div>

        <div id="ket-dialog" class="well" style="display:none;">
            <form id="ketform-data">

                <input type="hidden" id="ketwaktu" name="waktu" value="<?php date_default_timezone_set("Asia/Jakarta"); echo date('d/m/Y | H:i:s');?>">
                <div id="jumlah-group" class="form-group">
                    <label>Jumlah:</label>
                    <input type="text" class="form-control" id="ketjumlah" name="jumlah" disabled/>
                </div>
                <div id="bacaan-group" class="form-group">
                    <label>Bacaan:</label>
                    <input type="text" class="form-control" id="ketbacaan" name="bacaan" placeholder="Mis: Subhanallah, Alhamdulillah">
                </div>
                <div id="ket-group" class="form-group">
                    <label>Keterangan:</label>
                    <input type="text" class="form-control" id="ketketerangan" name="keterangan"><br/>
                </div>
                <input type="button" value="Simpan" onclick="okDzikir();" class="btn btn-success btn-small" />
            </form>
        </div>

        <div id="history-dzikir" class="well">
            Pilih menu History Dzikir untuk melihat dzikir yang sudah dilakukan.
        </div>

        <!--Konten LIFF v2-->

        <div id="liffAppContent">
            <!-- ACTION BUTTONS -->
            <div class="buttonGroup">
                <div class="buttonRow">
                    <button id="openWindowButton" class="btn btn-success btn-small">Buka di window eksternal</button>
                </div>

            </div>

            <!-- LIFF DATA -->
            <div id="liffData">
                <h3 id="liffDataHeader" class="textLeft">Informasi:</h3>
                <table>
                    <tr>
                        <th>Dibuka di client : </th>
                        <td id="isInClient" class="textLeft"></td>
                    </tr>
                    <tr>
                        <th>Login : </th>
                        <td id="isLoggedIn" class="textLeft"></td>
                    </tr>
                </table>
            </div>
            <!-- LOGIN LOGOUT BUTTONS -->
            <div class="buttonGroup">
                <button id="liffLoginButton" class="btn btn-success btn-small">Log in</button>
                <button id="liffLogoutButton" class="btn btn-warning btn-small">Log out</button>
            </div>
            <div id="statusMessage">
                <div id="isInClientMessage"></div>
                <div id="apiReferenceMessage">
                    <p>Available LIFF methods vary depending on the browser you use to open the LIFF app.</p>
                    <p>Please refer to the <a
                            href="https://developers.line.biz/en/reference/liff/#initialize-liff-app">API reference
                            page</a> for more information.</p>
                </div>
            </div>
        </div>
        <!-- LIFF ID ERROR -->
        <div id="liffIdErrorMessage" class="hidden">
            <p>You have not assigned any value for LIFF ID.</p>
            <p>If you are running the app using Node.js, please set the LIFF ID as an environment variable in your
                Heroku account follwing the below steps: </p>
            <code id="code-block">
                <ol>
                    <li>Go to `Dashboard` in your Heroku account.</li>
                    <li>Click on the app you just created.</li>
                    <li>Click on `Settings` and toggle `Reveal Config Vars`.</li>
                    <li>Set `MY_LIFF_ID` as the key and the LIFF ID as the value.</li>
                    <li>Your app should be up and running. Enter the URL of your app in a web browser.</li>
                </ol>
            </code>
            <p>If you are using any other platform, please add your LIFF ID in the <code>index.html</code> file.</p>
            <p>For more information about how to add your LIFF ID, see <a
                    href="https://developers.line.biz/en/reference/liff/#initialize-liff-app">Initializing the LIFF
                    app</a>.</p>
        </div>
        <!-- LIFF INIT ERROR -->
        <div id="liffInitErrorMessage" class="hidden">
            <p>Something went wrong with LIFF initialization.</p>
            <p>LIFF initialization can fail if a user clicks "Cancel" on the "Grant permission" screen, or if an error occurs in the process of <code>liff.init()</code>.
        </div>
        <!-- NODE.JS LIFF ID ERROR -->
        <div id="nodeLiffIdErrorMessage" class="hidden">
            <p>Unable to receive the LIFF ID as an environment variable.</p>
        </div>

    </div>
</body>
<!-- Integrasi LIFF SDK dan konfigurasi aplikasi dzikir sederhana -->
<script src="https://static.line-scdn.net/liff/edge/2.1/sdk.js"></script>
<script src="fdzikr-config.js"></script>
<script src="liff-starter.js"></script>
<script type="text/javascript">
    var n = 0;
    function incrementValue() {
        //var value = parseInt(document.getElementById('number').value, 10);
        //value = isNaN(value) ? 0 : value;
        if(document.getElementById('jumlah').value == 0) {
            n = 0;
        }
        n++;
        document.getElementById('jumlah').value = n;
    }
    
</script>

</html>