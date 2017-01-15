function redirect(controller, action = "index")
{
    var path = window.location.pathname;
    var app_name = "TVShowsTimetable";

    path = path.substr(0, path.search(app_name) + app_name.length);

    window.location = "http://"+window.location.hostname + path + "/" + controller + "/" + action;
}
