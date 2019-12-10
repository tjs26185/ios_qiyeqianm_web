function createXMLHttpRequest() {
	try {
		XMLHttpReq = new ActiveXObject("Msxml2.XMLHTTP");
	} catch(e) {
		try {
			XMLHttpReq = new ActiveXObject("Microsoft.XMLHTTP");
		} catch(e) {
			XMLHttpReq = new XMLHttpRequest();
		}
	}
}
function CheckGrade() {
        createXMLHttpRequest();
        XMLHttpReq.open("GET", "?iframe=ajax&ac=grade", true);
        XMLHttpReq.onreadystatechange = function() {
                if (XMLHttpReq.readyState == 4) {
                        if (XMLHttpReq.status == 200) {
                                var data = XMLHttpReq.responseText;
                                if (data.match(/^\d/)) {
                                        var grade = data > 0 ? "yes" : "no";
                                        $("grade").src = "static/admincp/css/show_" + grade + ".gif";
                                }
                        }
                }
        };
        XMLHttpReq.send(null);
}
function CheckBuild() {
        createXMLHttpRequest();
        XMLHttpReq.open("GET", "?iframe=ajax&ac=build", true);
        XMLHttpReq.onreadystatechange = function() {
                if (XMLHttpReq.readyState == 4) {
                        if (XMLHttpReq.status == 200) {
                                var data = XMLHttpReq.responseText;
                                if (data.match(/^\d+/)) {
                                        parent.$("build").innerHTML = data;
                                        parent.$("notice").style.display = "block";
                                }
                                CheckGrade();
                        }
                }
        };
        XMLHttpReq.send(null);
}