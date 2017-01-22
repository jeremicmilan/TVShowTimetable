<div style="margin-top: 10px">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div id="custom-search-input">
                    <div class="col-md-3"></div>
                    <div class="input-group col-md-6">
                        <input id="search_keyword" onkeypress="enter(event)" type="text" class="form-control input-lg" placeholder="Search..." style="height:40px;"/>
                        <span class="input-group-btn">
                            <button id="search_button" class="btn btn-info btn-lg" type="button" onclick="redirect('search', 'index', [document.getElementById('search_keyword').value])">
                                <i class="glyphicon glyphicon-search"></i>
                            </button>
                        </span>
                    </div>
                    <div class="col-md-3"></div>
                </div>
            </div>
        </div>
    </div>
</div>
