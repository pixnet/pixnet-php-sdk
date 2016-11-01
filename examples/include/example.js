var getGetParam = function(search) {
    if ('' === search) {
        return [];
    }
    var querystring = search.substr(1);
    var querys = querystring.split('&');
    var obj = [];
    for (var i = 0; i < querys.length; i++) {
        var query = querys[i].split('=');
        obj[query[0]] = query[1];

    }

    return obj;
};

var getQueryString = function(array) {
    var querystring = '';
    for (var key in array) {
        if ('' === querystring) {
            querystring = key + '=' + array[key];
            continue;
        }
        querystring = querystring + '&' + key + '=' + array[key];
    }

    return '?' + querystring;
};
