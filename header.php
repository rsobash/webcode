<div id="header">

<script type="text/javascript">
  function changeDate(datetext, inst) {
      var jsdate = $.datepicker.parseDate("00 UTC D d M yy", datetext);
      console.log(jsdate);
      var yyyymmddhh = $.datepicker.formatDate("yymmdd00", jsdate);
      var path = window.location.pathname;
      var pagename = path.split('/').pop();
      console.log(pagename);
      if (pagename == 'images.php') window.location.href = "images.php?d="+yyyymmddhh+"&f="+field+"&r="+region+"&i="+interval;
      else window.location.href = "index.php?d="+yyyymmddhh;
  }
</script>

<style type="text/css">
#dropdown1       { margin-left: 332px; width: 425px; }
#dropdown2       { margin-left: 514px; width: 425px; }
#dropdown3       { margin-left: 656px; width: 395px; }
#dropdown-winter { margin-left: 798px; width: 375px; }
#dropdown4       { margin-left: 940px; width: 395px; }
#dropdown5       { margin-left: 1037px; width: 175px; }
div.dropdown dd.indent { padding-left: 25px; }
div.menuheader.title { width: 325px; }
</style>

<div class="menuheader title">
<a href="index.php">Ensemble Web Viewer</a><br/>
<span style="font-size: 13px;font-weight:normal;">Init:</span>
<input size="25" type="text" id='datepicker' value="<?php echo $date_string; ?>" readonly>
</div>

<div class="menuheader menu" style="width:150px;" onmouseover="mopen('dropdown1')" onmouseout="mclosetime()">Surface / Precip</div>
<div class="menuheader menu" style="width:110px;" onmouseover="mopen('dropdown2')" onmouseout="mclosetime()">Upper-Air</div>
<div class="menuheader menu" style="width:110px;" onmouseover="mopen('dropdown3')" onmouseout="mclosetime()">Severe</div>
<div class="menuheader menu" style="width:110px;" onmouseover="mopen('dropdown-winter')" onmouseout="mclosetime()">Winter</div>
<div class="menuheader menu" style="width:110px;" onmouseover="mopen('dropdown4')" onmouseout="mclosetime()">Hourly-Max</div>
<div class="menuheader menu" style="width:110px;" onmouseover="mopen('dropdown5')" onmouseout="mclosetime()">Domains</div>

<div id="dropdown1" class="dropdown" onmouseover="mcancelclosetime()" onmouseout="mclosetime()">
<dl>
<dt>Surface Conditions</dt>

<dd><b><u>2-m Temperature / 10-m Wind </u></b></dd>
<dd>
<a href="<?php echo "images.php?d=${date}&f=t2_mean&r=${region}";?>">Ens Mean</a> |
<a href="<?php echo "images.php?d=${date}&f=t2_max&r=${region}";?>">Ens Max</a> |
<a href="<?php echo "images.php?d=${date}&f=t2_min&r=${region}";?>">Ens Min</a> |
<a href="<?php echo "images.php?d=${date}&f=t2_var&r=${region}";?>">Ens Spread</a> |
<a href="<?php echo "images.php?d=${date}&f=t2_stamp&r=${region}";?>">Postage Stamps</a>
</dd>
<dd><a href="<?php echo "images.php?d=${date}&f=t2depart_mean&r=${region}";?>">Ens Mean Sfc T Anomaly</a> |
<a href="<?php echo "images.php?d=${date}&f=t2_problt_32.0&r=${region}";?>">Prob Sfc T < 32 F</a>
</dd>

<dd><b><u>2-m Dewpoint / 10-m Wind </u></b></dd>
<dd>
<a href="<?php echo "images.php?d=${date}&f=td2_mean&r=${region}";?>">Ens Mean</a> |
<a href="<?php echo "images.php?d=${date}&f=td2_max&r=${region}";?>">Ens Max</a> |
<a href="<?php echo "images.php?d=${date}&f=td2_min&r=${region}";?>">Ens Min</a> |
<a href="<?php echo "images.php?d=${date}&f=td2_var&r=${region}";?>">Ens Spread</a> |
<a href="<?php echo "images.php?d=${date}&f=td2_stamp&r=${region}";?>">Postage Stamps</a>
</dd>
<dd><a href="<?php echo "images.php?d=${date}&f=td2depart_mean&r=${region}";?>">Ens Mean Sfc Td Anomaly</a></dd>

</dl>
</div>

<div id="dropdown2" class="dropdown" onmouseover="mcancelclosetime()" onmouseout="mclosetime()">
<dl>
<dt>Ensemble Mean Fields</dt>
<dd>Wind/Height:
<a href="<?php echo "images.php?d=${date}&f=speed250_mean&r=${region}";?>">250 mb</a> | 
<a href="<?php echo "images.php?d=${date}&f=speed300_mean&r=${region}";?>">300 mb</a> | 
<a href="<?php echo "images.php?d=${date}&f=speed500_mean&r=${region}";?>">500 mb</a> | 
<a href="<?php echo "images.php?d=${date}&f=speed700_mean&r=${region}";?>">700 mb</a> | 
<a href="<?php echo "images.php?d=${date}&f=speed850_mean&r=${region}";?>">850 mb</a> |
<a href="<?php echo "images.php?d=${date}&f=speed925_mean&r=${region}";?>">925 mb</a></dd>

<dd>Temperature: 
<a href="<?php echo "images.php?d=${date}&f=temp250_mean&r=${region}";?>">250 mb</a> | 
<a href="<?php echo "images.php?d=${date}&f=temp300_mean&r=${region}";?>">300 mb</a> | 
<a href="<?php echo "images.php?d=${date}&f=temp500_mean&r=${region}";?>">500 mb</a> | 
<a href="<?php echo "images.php?d=${date}&f=temp700_mean&r=${region}";?>">700 mb</a> | 
<a href="<?php echo "images.php?d=${date}&f=temp850_mean&r=${region}";?>">850 mb</a> |
<a href="<?php echo "images.php?d=${date}&f=temp925_mean&r=${region}";?>">925 mb</a></dd>

<dd>Relative Humidity: <a href="<?php echo "images.php?d=${date}&f=rh700_mean&r=${region}";?>">700 mb </a> | 
<a href="<?php echo "images.php?d=${date}&f=rh850_mean&r=${region}";?>">850 mb </a> | 
<a href="<?php echo "images.php?d=${date}&f=rh925_mean&r=${region}";?>">925 mb </a></dd>

<dd>Dewpoint: <a href="<?php echo "images.php?d=${date}&f=td850_mean&r=${region}";?>">850 mb </a> | 
<a href="<?php echo "images.php?d=${date}&f=td925_mean&r=${region}";?>">925 mb </a></dd>

<dd>Absolute Vorticity: <a href="<?php echo "images.php?d=${date}&f=avo500_mean&r=${region}";?>">500mb</a></dd>
<dd>Potential Vorticity: <a href="<?php echo "images.php?d=${date}&f=pvort320k_mean&r=${region}";?>">320K PV</a></dd>

</dl>
</div>

<div id="dropdown3" class="dropdown" onmouseover="mcancelclosetime()" onmouseout="mclosetime()">
<dl>
<dt>Instability</dt>
<dd>
Ens Mean:
<a href="<?php echo "images.php?d=${date}&f=sbcape_mean&r=${region}";?>">SBCAPE</a> | 
<a href="<?php echo "images.php?d=${date}&f=mlcape_mean&r=${region}";?>">MLCAPE</a> | 
<a href="<?php echo "images.php?d=${date}&f=mucape_mean&r=${region}";?>">MUCAPE</a> |
<a href="<?php echo "images.php?d=${date}&f=liftidx_mean&r=${region}";?>">Lifted Index</a></dd>
<dd>Ens Max:
<a href="<?php echo "images.php?d=${date}&f=sbcape_max&r=${region}";?>">SBCAPE</a> | 
<a href="<?php echo "images.php?d=${date}&f=mlcape_max&r=${region}";?>">MLCAPE</a></dd>
<dd>Prob SBCAPE:
<a href="<?php echo "images.php?d=${date}&f=sbcape_prob_500.0&r=${region}";?>"> > 500</a> | 
<a href="<?php echo "images.php?d=${date}&f=sbcape_prob_1000.0&r=${region}";?>"> > 1000</a> |
<a href="<?php echo "images.php?d=${date}&f=sbcape_prob_2000.0&r=${region}";?>"> > 2000</a> |
<a href="<?php echo "images.php?d=${date}&f=sbcape_prob_3000.0&r=${region}";?>"> > 3000</a></dd>
<dd>Prob MLCAPE:
<a href="<?php echo "images.php?d=${date}&f=mlcape_prob_500.0&r=${region}";?>"> > 500</a> | 
<a href="<?php echo "images.php?d=${date}&f=mlcape_prob_1000.0&r=${region}";?>"> > 1000</a> |
<a href="<?php echo "images.php?d=${date}&f=mlcape_prob_2000.0&r=${region}";?>"> > 2000</a> |
<a href="<?php echo "images.php?d=${date}&f=mlcape_prob_3000.0&r=${region}";?>"> > 3000</a></dd>
<dd>Postage Stamps:
<a href="<?php echo "images.php?d=${date}&f=sbcape_stamp&r=${region}";?>">SBCAPE</a></dd>

</div>

<div id="dropdown-winter" class="dropdown" onmouseover="mcancelclosetime()" onmouseout="mclosetime()">
<dl>

<dt>Winter Precip</dt>
<dd><b><u>1-hr Accumulation</u></b></dd> 
<dd><a href="<?php echo "images.php?d=${date}&f=ptype_prob_0.01&r=${region}";?>">Dominant 1-hr Precipitation Type</a></dd>
<dd><a href="<?php echo "images.php?d=${date}&f=winter_prob_0.01&r=${region}";?>">1-hr Probability of Winter Precip</a></dd>
<dd> Snow: <a href="<?php echo "images.php?d=${date}&f=snow_mean&r=${region}";?>">Ens Mean</a> | <a href="<?php echo "images.php?d=${date}&f=snow_pmm&r=${region}";?>">Prob Match Mean</a> | <a href="<?php echo "images.php?d=${date}&f=snow_stamp&r=${region}";?>">Stamp</a></dd>
<dd> Snow Neighbor Probs: <a href="<?php echo "images.php?d=${date}&f=snow_neprob_1.0&r=${region}";?>">> 1"</a> |
<a href="<?php echo "images.php?d=${date}&f=snow_neprob_2.0&r=${region}";?>">> 2"</a> |
<a href="<?php echo "images.php?d=${date}&f=snow_neprob_3.0&r=${region}";?>">> 3"</a>

<dd> Freezing Rain: <a href="<?php echo "images.php?d=${date}&f=fzra_mean&r=${region}";?>">Ens Mean</a> | <a href="<?php echo "images.php?d=${date}&f=fzra_pmm&r=${region}";?>">Prob Match Mean</a> | <a href="<?php echo "images.php?d=${date}&f=fzra_stamp&r=${region}";?>">Stamp</a></dd>

</div>

<div id="dropdown4" class="dropdown" onmouseover="mcancelclosetime()" onmouseout="mclosetime()">
<dl>
<dt>Hourly-max Rotation</dt>
<dd>Ens Max: <a href="<?php echo "images.php?d=${date}&f=hmuh_max&r=${region}";?>">2 - 5 km AGL UH</a> | <a href="<?php echo "images.php?d=${date}&f=hmuh03_max&r=${region}";?>">0 - 3 km AGL UH</a></dd>
<dd>Ens Max: <a href="<?php echo "images.php?d=${date}&f=rvort1_max&r=${region}";?>">1km AGL Vorticity</a></dd>
<dd>Paintball:
<a href="<?php echo "images.php?d=${date}&f=hmuh_paintball_50.0&r=${region}";?>">UH > 50</a> |
<a href="<?php echo "images.php?d=${date}&f=hmuh_paintball_75.0&r=${region}";?>">UH > 75</a> |
<a href="<?php echo "images.php?d=${date}&f=hmuh_paintball_100.0&r=${region}";?>">UH > 100</a> |
<a href="<?php echo "images.php?d=${date}&f=hmuh_paintball_150.0&r=${region}";?>">UH > 150</a></dd>
<dd>Neighbor Prob:
<a href="<?php echo "images.php?d=${date}&f=hmuh_neprob_50.0&r=${region}";?>">UH > 50</a> |
<a href="<?php echo "images.php?d=${date}&f=hmuh_neprob_75.0&r=${region}";?>">UH > 75</a> |
<a href="<?php echo "images.php?d=${date}&f=hmuh_neprob_100.0&r=${region}";?>">UH > 100</a> |
<a href="<?php echo "images.php?d=${date}&f=hmuh_neprob_150.0&r=${region}";?>">UH > 150</a>
</dd>

</dl>
</div>

<div id="dropdown5" class="dropdown" onmouseover="mcancelclosetime()" onmouseout="mclosetime()">
<dl>
<a href="<?php echo "images.php?d=${date}&f=${field}&r=CONUS&i=${inter}";?>"><dd>CONUS</dd></a>
<a href="<?php echo "images.php?d=${date}&f=${field}&r=NGP&i=${inter}";?>"><dd>Northern Great Plains</dd></a>
<a href="<?php echo "images.php?d=${date}&f=${field}&r=CGP&i=${inter}";?>"><dd>Central Great Plains</dd></a>
<a href="<?php echo "images.php?d=${date}&f=${field}&r=SGP&i=${inter}";?>"><dd>Southern Great Plains</dd></a>
<a href="<?php echo "images.php?d=${date}&f=${field}&r=NE&i=${inter}";?>"><dd>Northeast</dd></a>
<a href="<?php echo "images.php?d=${date}&f=${field}&r=MATL&i=${inter}";?>"><dd>Mid-Atlantic</dd></a>
<a href="<?php echo "images.php?d=${date}&f=${field}&r=SE&i=${inter}";?>"><dd>Southeast</dd></a>
<a href="<?php echo "images.php?d=${date}&f=${field}&r=SW&i=${inter}";?>"><dd>Southwest</dd></a>
<a href="<?php echo "images.php?d=${date}&f=${field}&r=NW&i=${inter}";?>"><dd>Northwest</dd></a>
</dl>
</div>

</div> <!-- div#header end -->
