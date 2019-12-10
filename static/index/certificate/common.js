function save(url, formname, submitbtn, alerttext, reloadurl, waitingtext, reloadself) {
    var btntext = $('#' + submitbtn).text();
    $.ajax({
        type : "POST",
        url  : url,
        data : $('#' + formname).serialize(),
        dataType: 'json',
        beforeSend: function( xhr ) {
            $('#' + submitbtn).text(waitingtext).addClass('btn-u-default').attr('disabled', 'disabled');
        },
        success : function(result, textStatus, jqXHR) {
            code = result.code;
            if (code == 0) {
            // alert(alerttext);
            } else {
                alert(result.message);
            }
            $('#' + submitbtn).text(btntext).removeClass('btn-u-default').removeAttr('disabled');
            if(reloadurl && code == 0){
                if (reloadself) {
                    location.reload();
                } else {
                    window.location = reloadurl;
                }
            }
        },
        error : function(jqXHR, textStatus, errorThrown) {
            $('#' + submitbtn).text(btntext).removeClass('btn-u-default').removeAttr('disabled');
        }
    });
}
function parseURL(url) {
    var parser = document.createElement('a'),
        searchObject = {},
        queries, split, i;
    // Let the browser do the work
    parser.href = url;
    // Convert query string to object
    queries = parser.search.replace(/^\?/, '').split('&');
    for( i = 0; i < queries.length; i++ ) {
        split = queries[i].split('=');
        searchObject[split[0]] = split[1];
    }
    return {
        protocol: parser.protocol,
        host: parser.host,
        hostname: parser.hostname,
        port: parser.port,
        pathname: parser.pathname,
        search: parser.search,
        searchObject: searchObject,
        hash: parser.hash
    };
}
