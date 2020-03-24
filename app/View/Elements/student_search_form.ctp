<form action="/students/search" class="form-horizontal" id="StudentSearchForm" method="get" accept-charset="utf-8" style="width: 100%; overflow:hidden;">
	<div style="display:none;">
	</div>
    <div style="width: 100%; overflow:hidden;">
        <div class="control-group" style="float:left;">
            <label for="StudentSearchType" class="control-label">First Search Criteria</label>
            <div class="controls">
                <select name="searchType" class="" style="width: 300px;" id="StudentSearchType">
                    <option value="searchName">Name</option>
                    <option value="School.name">School</option>
                    <option value="email">Email</option>
                    <option value="country">Country</option>
                    <option value="graduation_year">Graduation Year</option>
                </select>
            </div>
        </div>
        <div class="control-group" style="float:left;">
            <label for="StudentSearchString" class="control-label">Search String</label>
            <div class="controls">
                <input name="searchString" class="" style="width: 300px;" type="text" id="StudentSearchString"/>
            </div>
        </div>
    </div>

    <div style="width: 100%; overflow:hidden;">
        <div class="control-group" style="float:left;">
            <label for="StudentSearchType2" class="control-label">Second Search Criteria</label>
            <div class="controls">
                <select name="searchType2" class="" style="width: 300px;" id="StudentSearchType2">
                    <option value="searchName">Name</option>
                    <option value="School.name">School</option>
                    <option value="email">Email</option>
                    <option value="country">Country</option>
                    <option value="graduation_year">Graduation Year</option>
                </select>
            </div>
        </div>
        <div class="control-group" style="float:left;">
            <label for="StudentSearchString2" class="control-label">Search String</label>
            <div class="controls">
                <input name="searchString2" class="" style="width: 300px;" type="text" id="StudentSearchString2"/>
            </div>
        </div>
    </div>

	<div class="control-group" style="float:left;">
		<div class="controls" style="margin: 0px; margin-left:10px">
			<button type="submit" class="btn btn-success">
			Submit			
		</div>
	</div>

</form>