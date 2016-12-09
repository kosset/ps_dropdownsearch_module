<!DOCTYPE html>

<!-- Block doopdownsearch -->

<div id="dropdownsearch_block" class="block">
    <h2 class="title_block">Search it!</h2>
    <div class="block_content" style="">
        <form id="dropdownsearch_form">
            <div class="form-group">
                <select id="dropdownsearch_category" name="dropdownsearch_category">
                 <option value="" selected>CATEGORY</option>
                {foreach $dropdownsearch_categories as $category}
                <option value="{$category.name}">{$category.name}</option>
                {/foreach}
             </select>
            </div>
            <div class="form-group">
                <select id="dropdownsearch_manufacturer" name="dropdownsearch_manufacturer">
                  <option value="" selected>MANUFACTURER</option>
                  {foreach $dropdownsearch_manufacturers as $manufacturer}
                  <option value="{$manufacturer.name}">{$manufacturer.name}</option>
                  {/foreach}
              </select>
            </div>
            <div class="form-group">
                <label for="dropdownsearch_keyword" class="col-form-label">KEYWORDS:</label>
                <input class="form-control" type="search" placeholder="Enter your keyword..." id="dropdownsearch_keyword" name="dropdownsearch_keyword" onkeydown="if (event.keyCode == 13) return false;">
            </div>

            <input id="dropdownsearch_submit" name="Search" value="Search" type="button" class="btn btn-default button" onclick="dropdownsearch_submitSearch();">
            <input id="dropdownsearch_reset" name="Reset" type="reset" class="btn btn-default">
        </form>
    </div>
</div>
<!-- /Block doopdownsearch -->
