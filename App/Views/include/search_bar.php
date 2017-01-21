<div style="margin-top: 10px">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div id="custom-search-input">
                    <div class="input-group col-md-6">
                        <input id="title" type="text" class="form-control input-lg" placeholder="Search..." />
                        <span class="input-group-btn">
                            <button class="btn btn-info btn-lg" type="button" onclick="redirect('timetable', 'addShowByTitle', [document.getElementById('title').value])">
                                <i class="glyphicon glyphicon-search"></i>
                            </button>
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>