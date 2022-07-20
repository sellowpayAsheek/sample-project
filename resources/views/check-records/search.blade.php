<div class="container" style="padding-bottom: 20px">
    <div class="row">
        <div class="col-md-6"></div>
        <div class="col-md-6" style="display: flex">
            <div class="col-md-4">
                <label for="search-category">Search option</label>
                <select name="" id="search-category">
                    <option value="">All</option>
                    <option value="checkId">check id</option>
                    <option value="status">Status</option>
                    <option value="checkNumber">Check number</option>
                    <option value="term" selected >Global</option>
                </select>
            </div>
            <div class="col-md-4">
                <label for="search-term">Search term</label>
                <input type="text" id="search-term" style="padding: 6px;font-size:14px;">
            </div>

            <div class="col-md-4" style="padding: 15px;">
                <button type="button" onclick="searchCheck()" class="btn btn-success">Search</button>
            </div>
        </div>

    </div>
</div>
