<?php

$session = null;

if ($_GET['a'] == "logout") {
    setcookie("SESSION_ID","",time()-3600);
    header("Location: ../home.php?a=logout");
}
if (!$_COOKIE['SESSION_ID']) { die("You are not logged in, <a href='../CLogin.php'>click here</a> to login."); }

$query = "SELECT username FROM userInfo WHERE sessionID = \"" . $_COOKIE['SESSION_ID'] . "\"";
$con = mysql_connect("localhost", "root", "Br%4#!+^PQ#*qRzOxtp%");
if (!$con) { die("Could not connect to database."); }
if (!mysql_select_db("ProjectDonationdb", $con)) { die("Could not select database."); }
$result = mysql_query($query, $con);
while ($row = mysql_fetch_array($result)) {
    if ($row['username']) {
        $un = $row['username'];


        ?>



<!DOCTYPE HTML>

<html lang="en">
<head>
<link rel="stylesheet" type="text/css" href="main.css" />
<!-- Force latest IE rendering engine or ChromeFrame if installed -->
<!--[if IE]>
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<![endif]-->
<meta charset="utf-8">
<title>Donation Home</title>
<meta name="description" content="Simply drag and drop your wiki videos or browse and search!">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<!-- Bootstrap styles -->
<link rel="stylesheet" href="../main.css">
<link rel="stylesheet" href="css/bootstrap.min.css">
<!-- Generic page styles -->
<!-- <link rel="stylesheet" href="css/style.css">
blueimp Gallery styles -->
<link rel="stylesheet" href="css/blueimp-gallery.min.css">
<!-- CSS to style the file input field as button and adjust the Bootstrap progress bars -->
<link rel="stylesheet" href="css/jquery.fileupload.css">
<link rel="stylesheet" href="css/jquery.fileupload-ui.css">
<!-- CSS adjustments for browsers with JavaScript disabled -->
<noscript><link rel="stylesheet" href="css/jquery.fileupload-noscript.css"></noscript>
<noscript><link rel="stylesheet" href="css/jquery.fileupload-ui-noscript.css"></noscript>
<style>
/* Hide Angular JS elements before initializing */
.ng-cloak {
    display: none;
}
</style>
</head>
<body>
<?php
echo "<span class=\"loginLink\"><b>$un</b>
    <b> ( <a href='index.php?a=logout'>Log out</a> ) </b></span>";
?>
    <div class="container">
    <h1></h1><img src="../banner.png">
    <h2 class="lead"><i></i></h2>
    <ul class="nav nav-tabs">
        <li class="active"><a href="">Upload Form</a></li>
        <li><a href="home.html"><b>Home</b></a></li>
        <li><a href="index.html">Edit Listing</a></li>
        <li ><a href="help.html">Help</a></li>
        <li><a href="logout.html">Contact Us</a></li>
    </ul>
    <br>
    <blockquote>
        <p><font size=3 color=grey><i>Drag images or videos of your donation here! You may drag over multiple files. Alternatively, click browse.</i></font></p>
    </blockquote>
    <br>
    <!-- The file upload form used as target for the file upload widget -->
    <form id="fileupload" action="" method="POST" enctype="multipart/form-data" data-ng-app="demo" data-ng-controller="DemoFileUploadController" data-file-upload="options" data-ng-class="{'fileupload-processing': processing() || loadingFiles}">
        <!-- Redirect browsers with JavaScript disabled to the origin page -->
        <noscript><input type="hidden" name="redirect" value="">You need javascript.</noscript>
        <!-- The fileupload-buttonbar contains buttons to add/delete files and start/cancel the upload -->
        <div class="row fileupload-buttonbar">
            <div class="col-lg-7">
                <!-- The fileinput-button span is used to style the file input field as button -->
                <span class="btn btn-success fileinput-button" ng-class="{disabled: disabled}">
                    <i class="glyphicon glyphicon-plus"></i>
                    <span>Browse...</span>
                    <input type="file" name="files[]" multiple ng-disabled="disabled">
                </span>
                <button type="button" class="btn btn-primary start" data-ng-click="submit()">
                    <i class="glyphicon glyphicon-upload"></i>
                    <span>Start upload</span>
                </button>
                <button type="button" class="btn btn-warning cancel" data-ng-click="cancel()">
                    <i class="glyphicon glyphicon-ban-circle"></i>
                    <span>Cancel upload</span>
                </button>
                <!-- The global file processing state -->
                <span class="fileupload-process"></span>
            </div>
            <!-- The global progress state -->
            <div class="col-lg-5 fade" data-ng-class="{in: active()}">
                <!-- The global progress bar -->
                <div class="progress progress-striped active" data-file-upload-progress="progress()"><div class="progress-bar progress-bar-success" data-ng-style="{width: num + '%'}"></div></div>
                <!-- The extended global progress state -->
                <div class="progress-extended">&nbsp;</div>
            </div>
        </div>
        <!-- The table listing the files available for upload/download -->
        <table class="table table-striped files ng-cloak">
            <tr data-ng-repeat="file in queue" data-ng-class="{'processing': file.$processing()}">

                <td colspan="4" data-ng-switch data-on="!!file.thumbnailUrl">
                    <img id='myImg' height="50" width="50" src="{{file.url}}" data-ng-hide="file.$cancel">
                    <bork></bork>
                    <div class="preview" data-ng-switch-when="true">
                        <a data-ng-href="{{file.url}}" title="{{file.name}}" download="{{file.name}}" data-gallery><img data-ng-src="{{file.thumbnailUrl}}" alt=""></a>
                    </div>
                    <div class="preview" data-ng-switch-default data-file-upload-preview="file"></div>
                </td>
                <td>
                    <p class="name" data-ng-switch data-on="!!file.url">
                        <span data-ng-switch-when="true" data-ng-switch data-on="!!file.thumbnailUrl">
                            <a data-ng-switch-when="true" data-ng-href="{{file.url}}" title="{{file.name}}" download="{{file.name}}" data-gallery>{{file.name}}</a>
                            <a data-ng-switch-default data-ng-href="{{file.url}}" title="{{file.name}}" download="{{file.name}}">{{file.name}}</a>



                        </span>

                        <span data-ng-switch-default>{{file.name}}</span>
                    </p>
                    <strong data-ng-show="file.error" class="error text-danger">{{file.error}}</strong>
                </td>
                <td>
                    <p class="size">{{file.size | formatFileSize}}</p>
                    <div class="progress progress-striped active fade" data-ng-class="{pending: 'in'}[file.$state()]" data-file-upload-progress="file.$progress()"><div class="progress-bar progress-bar-success" data-ng-style="{width: num + '%'}"></div></div>
                </td>
                <td>
                    <button type="button" class="btn btn-primary start" data-ng-click="file.$submit()" data-ng-hide="!file.$submit || options.autoUpload" data-ng-disabled="file.$state() == 'pending' || file.$state() == 'rejected'">
                        <i class="glyphicon glyphicon-upload"></i>
                        <span>Start</span>
                    </button>
                    <button type="button" class="btn btn-warning cancel" data-ng-click="file.$cancel()" data-ng-hide="!file.$cancel">
                        <i class="glyphicon glyphicon-ban-circle"></i>
                        <span>Cancel</span>
                    </button>
                    <button type="button" class="btn btn-listing label-listing" onclick="EditListing(this);" data-ng-hide="file.$cancel">
                        <div style="display: none;">{{file.url}}</div>
                        <i class="glyphicon glyphicon-pencil"></i>
                        <span>Edit Listing</span>
                    </button>
                    <button data-ng-controller="FileDestroyController" type="button" class="btn btn-danger destroy" data-ng-click="file.$destroy()" data-ng-hide="!file.$destroy">
                        <i class="glyphicon glyphicon-trash"></i>
                        <span>Delete</span>
                    </button>
                </td>

            </tr>
        </table>
    </form>
        <script>
            alert(document.getElementById('myURL').innerHTML);
        </script>

        <script>
            var myThis;
            var oldHTML;
            var fileURL;
            function EditListing($this) {
                fileURL = $this.childNodes[1].innerHTML;
                $this.id="ass";
                myThis = $this;
                oldHTML = $this.parentNode.innerHTML;
                ifuck();
                document.getElementById("ass").disabled = true;
                //document.getElementById("ass").parentNode.innerHTML = oldHTML;
                //$this.disabled = true;

                //myThis.disabled = false
                //myThis.disabled = true;
                //alert(oldHTML);
                //alert(myThis);
                //myThis.disabled = false;
                //ifuck();
                //FinishEditListing(myThis);
            }
            function ifuck() {
                myThis.parentNode.innerHTML += "<br>&nbsp;<br><div id='bannerQuote' width='500px;'><br>" +
                    "<table>" +
                    "<tr>" +
                    "<td align=left style='vertical-align:top'>Name of item</td><td align=left style='padding-bottom: 10px;'> <input type=text></td>" +
                    "</tr><tr>" +
                    "<td align=left style='vertical-align:top'>Extra comments</td><td style='padding-bottom: 10px;'><textarea rows=10 cols=50></textarea></td>" +
                    "</tr>" +
                    "</table>" +
                    "<center><button type=\"button\" onclick='FinishEditListing(document.getElementById(\"ass\"));' class=\"btn btn-primary start\"><i class=\"glyphicon glyphicon-saved\"></i><span>Save</span></button></center>" +
                    "</div><br>&nbsp;";
            }
            function FinishEditListing($stillThis) {
                alert(fileURL);
                $stillThis.parentNode.innerHTML = oldHTML;
                $stillThis.disabled = false;





            }

        </script>
    <br>
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">Notes</h3>
        </div>
        <div class="panel-body">
            <ul>
                <li>Remember to edit your listing/donation after uploading<strong></strong>!</li>
                <li>Only video files and image giles allowed.</li>
                <li>Compressed formats <strong>(TAR, ZIP, etc..</strong>) are allowed and encouraged.</li>
                <li><strong>Remember</strong> to edit your listing<b>!</b></li>
                <li>If you see an error insure the filesize is less than 25MB.</li>
                <li>Oh yeah, <b>remember</b> to edit your listing!</li>
            </ul>
        </div>
    </div>
</div>
<!-- The blueimp Gallery widget -->
<div id="blueimp-gallery" class="blueimp-gallery blueimp-gallery-controls" data-filter=":even">
    <div class="slides"></div>
    <h3 class="title"></h3>
    <a class="prev">‹</a>
    <a class="next">›</a>
    <a class="close">×</a>
    <a class="play-pause"></a>
    <ol class="indicator"></ol>
</div>
<script src="/jquery-1.11.0.min.js"></script>
<script src="js/angular.min.js"></script>
<!-- The jQuery UI widget factory, can be omitted if jQuery UI is already included -->
<script src="js/vendor/jquery.ui.widget.js"></script>
<!-- The Load Image plugin is included for the preview images and image resizing functionality -->
<script src="js/load-image.min.js"></script>
<!-- The Canvas to Blob plugin is included for image resizing functionality -->
<script src="js/canvas-to-blob.min.js"></script>
<!-- Bootstrap JS is not required, but included for the responsive demo navigation -->
<script src="js/bootstrap.min.js"></script>
<!-- blueimp Gallery script -->
<script src="js/jquery.blueimp-gallery.min.js"></script>
<!-- The Iframe Transport is required for browsers without support for XHR file uploads -->
<script src="js/jquery.iframe-transport.js"></script>
<!-- The basic File Upload plugin -->
<script src="js/jquery.fileupload.js"></script>
<!-- The File Upload processing plugin -->
<script src="js/jquery.fileupload-process.js"></script>
<!-- The File Upload image preview & resize plugin -->
<script src="js/jquery.fileupload-image.js"></script>
<!-- The File Upload audio preview plugin -->
<script src="js/jquery.fileupload-audio.js"></script>
<!-- The File Upload video preview plugin -->
<script src="js/jquery.fileupload-video.js"></script>
<!-- The File Upload validation plugin -->
<script src="js/jquery.fileupload-validate.js"></script>
<!-- The File Upload Angular JS module -->
<script src="js/jquery.fileupload-angular.js"></script>
<!-- The main application script -->
<script src="js/app.js"></script>
</body>
</html>
    <?php
    } else { die("You are not logged in, <a href='../CLogin.php'>click here</a> to login."); }
}

mysql_close($con);

?>


