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

var updateUrl = function(t, delete_params_array) {
    var uri = location.pathname;
    var search = location.search;
    var hash = location.hash;
    var parameters = getGetParam(search);
    parameter = t.name;
    parameters[parameter] = t.options[t.selectedIndex].value;
    if (parameter === "set_id") {
        parameters[parameter] += hash;
    }

    if (typeof(delete_params_array) === "object") {
        $.each(delete_params_array, function(index, value) {
            delete parameters[value];
        });
    }

    var querystring = getQueryString(parameters);
    location = uri + querystring;
};
