<header class="py-3 boder shadow mb-4" style="background-color: black;">
    <div class="container">
        <div class="row" style="background-color: black;">
            <div class="col-4 text-light">
                <samp style="font-size:45px;">Nobita Home</samp>
            </div>
            <div class="col-4 mt-4">
                <div class="input-group">
                    <span class="input-group-addon"><ion-icon name="search-outline"></ion-icon></span>
                    <input id="msg" type="text" class="form-control" name="msg" placeholder="Search...">
                </div>
            </div>
            <div class="col-4 d-flex justify-content-end align-item-center">
                @section('status')
                @show
            </div>
        </div>
    </div>
</header>