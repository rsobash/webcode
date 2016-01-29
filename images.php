<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>Ensemble Forecast Viewer</title>
<meta http-equiv="content-type" content="text/html;charset=utf-8">
<link rel="stylesheet" type="text/css" href="main.css">
<link rel="stylesheet" href="jquery-ui.css">

<script src="jquery.min.js"></script>
<script src="jquery-ui.min.js"></script>
<script src="jquery.hotkeys.js"></script>
<script src="menus.js"></script>

<?php
// figure out the latest model run
//$today = gmdate('Ymd')."00";
//if (file_exists("./img/${today}/precipacc_mean_last.png")) $ts = gmmktime();
//else $ts = gmmktime() - 86400;
$ts        = gmmktime() - 86400;
$latestrun = gmdate('Ymd', $ts)."00";
$jsdate    = gmdate("Y-m-d", $ts+86400);

// GET VARIABLES FROM URL
$field   =  ($_GET['f']) ? $_GET['f'] : "speed250_mean";
$region  =  ($_GET['r']) ? $_GET['r'] : "CONUS"; 
$date    =  ($_GET['d']) ? $_GET['d'] : $latestrun;
$inter   =  ($_GET['i']) ? $_GET['i'] : 1;
$verif   =  ($_GET['v']) ? $_GET['v'] : 0;

// SET VARIOUS TIME & DATE VARIABLES USED WITHIN THIS PAGE
$inithr      = substr($date,8,2);
$timestamp   = gmmktime($inithr, 0, 0, substr($date, 4, 2), substr($date, 6, 2), substr($date, 0, 4));
$date_string = gmdate("H \U\T\C D d M Y", $timestamp);
$yyyymmddhh  = gmdate("YmdH", $timestamp);
?>

<script type="text/javascript">

$(document).ready(function() {
    // call showImage function when pressing certain buttons
    $(document).bind('keydown', 'left right . ,', showImage);    
    
    // initialize calendar to pick archived dates
    $( "#datepicker" ).datepicker({
        minDate: "00 UTC Tue 7 Apr 2015",
        maxDate: new Date("<?php echo $jsdate; ?>"),
        dateFormat: "00 UTC D d M yy", 
        onSelect: changeDate,
        buttonImage: "calendar_small.png",
        showOn: "button",
        buttonImageOnly: true
    });

    // preload images
    loadImages();

    // after page is loaded, loadImages will be called every 60 seconds if all images aren't initially available
    // (so, it will automatically load images as model is running without having to refresh)
    window.setInterval(function() {
        if (imagesLoaded.length != window.imagelist.length) loadImages();
    }, 60000);
});

function showImage(e) {
    imagesLoaded.sort(function(a, b){return a-b});
    thisIndex = jQuery.inArray(activehr, imagesLoaded);

    if (e.keyCode == 37 || e.keyCode == 188) nextIndex = thisIndex-1;
    else if (e.keyCode == 39 || e.keyCode == 190) nextIndex = thisIndex+1;

    if (nextIndex > imagesLoaded.length-1) nextIndex = 0;
    if (nextIndex < 0) nextIndex = imagesLoaded.length-1;

    activehr = imagesLoaded[nextIndex];
    var indx = (activehr-start)/interval;

    $("div.rollover ").removeClass("selected");
    $("div#"+activehr+".rollover").addClass("selected");
    $('img#mainimage').attr("src", window.imagelist[indx]);
}

function loadImages() {
    // preload images here
    activehr = 0; 
    imagesLoaded = new Array();    
    window.images = new Array();

    for (var i = 0; i < window.imagelist.length; i++) {
        window.images[i]= new Image();               // initialize array of image objects
        window.images[i].onload = function() {

            // figure out which forecast hour just loaded by grabbing fhr from image name
            var indexes = this.src.match(/f\d\d\d/g);
            var index = indexes.pop();
            //var fhr  = this.src.substr(index.index+1, 3);
            var fhr  = index.substr(1, 3);

            // activate rollover based on the image that just loaded
            var thisrollover = $("div#"+parseInt(fhr, 10)+".rollover")

            // keep track of which images have loaded
            imagesLoaded.push(parseInt(fhr,10))

            // change class for the rollover of the image that just loaded
            thisrollover.addClass("loaded");

            // attach mouseover to the rollover of the image that just loaded
            thisrollover.mouseover(function() {
                var fcsthr = $( this ).attr('id');
                activehr = parseInt(fcsthr, 10);

                // change class for rollover
                $("div.rollover ").removeClass("selected");
                $( this ).addClass("selected");
                var indx = (activehr-start)/interval; 
                $('img#mainimage').attr("src", window.imagelist[indx])
            });
        };
        window.images[i].src = window.imagelist[i];    // src of image
    }
}

<?php
// SPLIT "f" STRING FROM URL
$field_parts = explode("_", $field);

$fields_start_nonzero = array('afhail');       # these fields don't start at forecast hour 0, so dont show hour 0 rollover
$fields_accum         = array('snowacc_mean'); # these fields have varying accum period (so filenames will be e.g. f007-f012,f013-f018,etc)
$fields_running       = array('hmuh_max');     # these fields start accum at (so filenames will be e.g. f001-f006, f001-f048,etc)

// DETERMINE START HOUR BASED ON ABOVE ARRAY AND INTERVAL
if (in_array($field_parts[0], $fields_start_nonzero)) {
     if ($inter == 6) $start = 6;
     elseif ($inter == 12) $start = 12;
     elseif ($inter == 24) $start = 24;
     else $start = 1;
}
else $start = 0;

echo "var yyyymmddhh = '$yyyymmddhh';\n";
echo "var field = '$field';\n";
echo "var region = '$region';\n";
echo "var start = '$start'\n";
echo "var interval = '$inter'\n";
echo "var verif = '$verif'\n";

$rollover_links = "";
$image_names = "";
$baseimgdir = "./img/${yyyymmddhh}";

// this loop outputs a list of image filenames and rollover links that are printed in the html for use by the javascript above
// if you want images at greater than hourly frequency, this will require some modification
$image_hrs = range($start, 24, $inter);
foreach ($image_hrs as $i) {
        $fhr2 = sprintf("%02d", $i); // two digits
        $fhr3 = sprintf("%03d", $i); // three digits

        // CONSTRUCT FORECAST HOUR STRING FOR GRAPHIC NAME
        if (in_array($field, $fields_accum) and $inter > 1) {
            $start_accum = sprintf("%03d", $fhr3 - $inter + 1);
            $fhr_string = "f${start_accum}-f${fhr3}";
       } else if (in_array($field, $fields_running) and $i != $start) {
            $fhr_string = "f001-f${fhr3}";
        } else { $fhr_string = "f$fhr3"; }

        // CONSTRUCT GRAPHIC NAME
        $thisimg = "${baseimgdir}/${field}_${fhr_string}_${region}.png";
        $image_names = $image_names . "'${thisimg}',\n";

        // CONSTRUCT ROLLOVER LINKS
        if ($i == $start) { $firstimage = $thisimg; $class = 'rollover selected'; }
        else { $class = 'rollover'; }
        $rollover_links = $rollover_links . "<div class=\"${class}\" id=\"$i\">${fhr2}</div>";
}

echo "var imagelist = [\n${image_names}];\n"; // print out imagelist array, used by javascript above to know which images to load
?>
</script>

</head>
<body>

<div id="maincontainer">

<?php require('header.php'); ?>

<div id="bodycontainer" style="clear: both;">

<div id="rolloverdiv">
<div id="rollovercenter">
<?php echo $rollover_links; ?>
<br style="clear:both;"/>
</div>
</div>
<div id="imagebox" style="position: relative; width: 100%">

<img id="mainimage" src="<?php echo $firstimage; ?>" style="display: block; margin: 0 auto;" alt='main image'/>

</div>

<div id="footer">
<span style="color: gray;">Footer goes here if desired</span>
<div class="clear"></div>
</div>

</div> <!-- end bodycontainer -->
</div> <!-- end maincontainer -->

</body>
</html>

