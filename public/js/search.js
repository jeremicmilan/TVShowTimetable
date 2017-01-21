function processSearchResults()
{
    if (this.readyState == 4 && this.status == 200)
    {
        var tvshows = JSON.parse(this.responseText);

        var omdb_results = document.getElementById("omdb_results");
        omdb_results.innerHTML = "";


        for (var i = 0; i < tvshows.length; ++i)
        {
            var div = document.createElement("div");
            var a = document.createElement("a");
            a.setAttribute("onclick", "redirect('tvshow','index', '" + tvshows[i].imdbID + "')");

            var colmd2 = document.createElement("div");
            colmd2.setAttribute("class", "col-md-2");
            var thumbnail = document.createElement("div");
            thumbnail.setAttribute("class", "thumbnail");
            var img = document.createElement("img");
            img.setAttribute("src", tvshows[i].Poster);
            img.setAttribute("width", 150);

            var caption = document.createElement("div");
            caption.setAttribute("class", "caption");
            var h4 = document.createElement("h4");
            h4.setAttribute("align", "center");
            h4.innerHTML = tvshows[i].Title

            thumbnail.appendChild(img);
            caption.appendChild(h4);
            colmd2.appendChild(thumbnail);
            colmd2.appendChild(caption);
            a.appendChild(colmd2)
            div.appendChild(a);
            omdb_results.appendChild(div);
        }
    }
};



