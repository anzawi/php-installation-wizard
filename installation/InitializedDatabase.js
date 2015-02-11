    /*
     * ajax script to create tables and other transaction
     */
    
    // after 3s page loade call ajax function
    setTimeout(function () {
        // call function and pass parameter ( tables ) -> look file (stepFour.php) to know why pass this param
        loadXMLDoc('tables');
    }, 3000);
    
    function loadXMLDoc(link) {
        // get page url
        var url = url = document.URL;
        //url = url.substring(0, url.indexOf('2') + 1);
        
        // check if parameter equal tables or tran to add url sum parameters
        if (link === 'tables') {
            url = url + '&tables';
        } else {
            url = url + '&tran';
        }

        var xmlhttp;

        if (window.XMLHttpRequest) {
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        } else {
            // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }

        xmlhttp.onreadystatechange = function () {
            if (xmlhttp.readyState === 4) {
                // if 200 . everything alright
                if (xmlhttp.status === 200) {
                    document.getElementById(link).className = '';// = xmlhttp.responseText;
                    // show success message
                    document.getElementById(link + "Div").innerHTML = '<span class="alert alert-success">Creating Tabels successfully </span>';
                    document.getElementById(link + "er").innerHTML = 'Complete';
                    if (link === 'tables') {
                        loadXMLDoc('othersql');

                    }
                    // If 400. got an error
                    else if (xmlhttp.status === 400) {
                        // show error message
                        document.getElementById(link + "Div").innerHTML = '<span class="alert alert-danger">Error Creating Tables Please Try Again </span>';
                        document.getElementById(link + "er").innerHTML = 'Error ......!!';
                    }
                    else {
                        // if everything alright redirect to next step
                        window.location.href = window.location.host+"/install.php?step=5";
                    }
                }
            }
        }
        // type GET, target url vaiable 
        xmlhttp.open("GET", url, true);
        // send request
        xmlhttp.send();
    }