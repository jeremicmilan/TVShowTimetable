function onloadSearch(keyword)
{
    if(keyword == undefined)
        return;

    getFromServer(processSearchResults, 'search', 'searchOmdbByTitle', [keyword]);
}

function search()
{
    document.getElementById('loading').style.display = 'block';
    getFromServer(processSearchResults, 'search', 'searchOmdbByTitle', [document.getElementById('search_keyword').value]);
    getFromServer(processSearchResults, 'search', 'searchOmdbByTitle', [document.getElementById('search_keyword').value]);
}

function processSearchResults()
{
    if (this.readyState == 4 && this.status == 200)
    {
        document.getElementById("omdb_results").innerHTML = this.responseText;
        console.log(this.responseText);
    }

    document.getElementById('loading').style.display = 'none';
};

function enter(event)
{
    if (event.keyCode == 13) {
        var element = document.getElementById('search_button');
        element.click();
    }
}
