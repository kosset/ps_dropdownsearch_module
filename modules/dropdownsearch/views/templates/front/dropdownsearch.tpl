<!-- Block doopdownsearch -->

<div id="dropdownsearch_block" class="block">
<h3>Welcome!</h3>
  <div class="block_content">
    <form id="dropdownsearch_form">
        <div class="form-group">
            <select id="dropdownsearch_make" name="dropdownsearch_make" onChange="dropdownsearch_getModels(this.value);">
                <option value="" selected>MAKE</option>
                <!-- Smarty Block here-->
                {foreach $dropdownsearch_makes as $make}
                <option value="{$make.id_attribute}">{$make.name}</option>
                {/foreach}
                <!----------------------->
            </select>
         </div>
        <div class="form-group">
            <select id="dropdownsearch_model" name="dropdownsearch_model" onChange="dropdownsearch_getTypes(this.value);" disabled>
                <option value="" selected>MODEL</option>
            </select>
         </div>
        <div class="form-group">
            <select id="dropdownsearch_type" name="dropdownsearch_type" disabled>
                <option value="" selected>TYPE</option>
            </select>
         </div>
         <div class="form-group">
             <select id="dropdownsearch_category" name="dropdownsearch_category">
                 <option value="" selected>CATEGORY</option>
                <!-- Smarty Block here-->
                {foreach $dropdownsearch_categories as $category}
                <option value="{$category.name}">{$category.name}</option>
                {/foreach}
                <!----------------------->
             </select>
          </div>
          <div class="form-group">
              <select id="dropdownsearch_manufacturer" name="dropdownsearch_manufacturer">
                  <option value="" selected>MANUFACTURER</option>
                  <!-- Smarty Block here-->
                  {foreach $dropdownsearch_manufacturers as $manufacturer}
                  <option value="{$manufacturer.name}">{$manufacturer.name}</option>
                  {/foreach}
                  <!----------------------->
              </select>
           </div>
           <div class="form-group">
              <label for="dropdownsearch_keyword" class="col-form-label">KEYWORDS:</label>
              <input class="form-control" type="search" placeholder="Enter your keyword..." id="dropdownsearch_keyword" name="dropdownsearch_keyword" onkeydown="if (event.keyCode == 13) return false;">
          </div>

          <input id="dropdownsearch_submit" name="Search" value="Search" type="button" class="btn btn-default" onclick="dropdownsearch_submitSearch();">
          <input id="dropdownsearch_reset" name="Reset" type="reset" class="btn btn-default">
    </form>
    </div>
</div>
<!-- /Block doopdownsearch -->
