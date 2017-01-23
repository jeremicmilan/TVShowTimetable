function follow(id)
{
    document.getElementById('loading').style.display = 'block';
    redirect('tvshow','follow', [id])
}