function redirect(controller, action = "index", params = [])
{
    var path = window.location.pathname;
    var app_name = "TVShowsTimetable";
    var paramsString = "";

    for (let index = 0; index < params.length; ++index)
    {
        if (index == 0)
        {
            paramsString = params[index];
        }
        else
        {
            paramsString = paramsString + "/" + params[index];
        }
    }

    path = path.substr(0, path.search(app_name) + app_name.length);

    var uri = "http://"+window.location.hostname + path + "/" + controller + "/" + action;

    if (params.length > 0)
    {
        uri += "/" + paramsString;
    }

    window.location = uri;
}
