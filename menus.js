        var ddmenuitem = 0;
        var timeout = 250;
        var closetimer = 0;
        function show_div(divname)
        {
                document.getElementById("calendar").style.display= "none";
                document.getElementById("centerpoints").style.display= "none";
                document.getElementById(divname).style.display = "block";
        }

        function mopen(id)
        {
	        mcancelclosetime();
        	// close old layer 
	        if (ddmenuitem) ddmenuitem.style.visibility = 'hidden';
                // get new layer and show it
		ddmenuitem = document.getElementById(id);
                ddmenuitem.style.visibility = 'visible';
                ddmenuitem.style.zIndex = 30;
        }

        function mclose()
        {
                if (ddmenuitem) ddmenuitem.style.visibility = 'hidden';
        }
        
        function mclosetime()
        {
                closetimer = window.setTimeout(mclose, timeout);
        }
 
        function mcancelclosetime()
        {
                if(closetimer)
                {
                        window.clearTimeout(closetimer);
                        closetimer = null;
                }
        }
 
        document.onclick = mclose; 
