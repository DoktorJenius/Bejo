function go_get_url(url) {
    var l = document.createElement("a");
    l.href = url;
    return l
};

function go_get_host_name(url) {
    var domain;
    if (typeof url === 'undefined' || url === null || url === '' || url.match(/^\#/)) {
        return ""
    }
    url = go_get_url(url);
    if (url.href.search(/^http[s]?:\/\//) !== -1) {
        domain = url.href.split('/')[2]
    } else {
        return ""
    }
    domain = domain.split(':')[0];
    return domain.toLowerCase()
}
document.addEventListener("DOMContentLoaded", function(event) {
    if (typeof go_url === 'undefined') {
        return
    }
    if (typeof id === 'undefined') {
        return
    }
    var advert_type = 2;

    var anchors = document.getElementsByTagName("a");
    if (typeof include !== 'undefined') {
        for (var i = 0; i < anchors.length; i++) {
            var hostname = go_get_host_name(anchors[i].getAttribute("href"));
            if (hostname.length > 0 && include.indexOf(hostname) > -1) {
                anchors[i].href = go_url + "/" + id + "/" + anchors[i].href
            } else {
                if (anchors[i].protocol === "magnet:") {
                    anchors[i].href = go_url + "/" + id + "/" + anchors[i].href
                }
            }
        }
        return
    }
    if (typeof exclude !== 'undefined') {
        for (var i = 0; i < anchors.length; i++) {
            var hostname = go_get_host_name(anchors[i].getAttribute("href"));
            if (hostname.length > 0 && exclude.indexOf(hostname) === -1) {
                anchors[i].href = go_url + "/" + id + "/" + anchors[i].href
            } else {
                if (anchors[i].protocol === "magnet:") {
                    anchors[i].href = go_url + "/" + id + "/" + anchors[i].href
                }
            }
        }
        return
    }
})