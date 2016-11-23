<!-- Block doopdownsearch -->


<div class="block v-megamenu-container">

<div class="v-megamenu-title bgcolor"><h3>FIND THE PART YOU NEED</h3></div>

  <div class="v-megamenu" style="background:#202020; padding:10px; color:#fff">

    <form id="dropdownsearch_form">

        <div class="form-group">

            <select id="dropdownsearch_make" class="selectProductSort form-control" name="dropdownsearch_make" onChange="dropdownsearch_getModels(this.value);">

                <option value="" selected>MAKE</option>

                <!-- Smarty Block here-->

                {foreach $dropdownsearch_makes as $make}

                <option value="{$make.id_attribute}">{$make.name}</option>

                {/foreach}

                <!----------------------->

            </select>

         </div>

        <div class="form-group">

            <select id="dropdownsearch_model" class="selectProductSort form-control" name="dropdownsearch_model" onChange="dropdownsearch_getTypes(this.value);" disabled>

                <option value="" selected>MODEL</option>

            </select>

         </div>

        <div class="form-group">

            <select id="dropdownsearch_type" class="selectProductSort form-control" name="dropdownsearch_type" disabled>

                <option value="" selected>TYPE</option>

            </select>

         </div>

         <div class="form-group">

             <select id="dropdownsearch_category" class="selectProductSort form-control" name="dropdownsearch_category">

                 <option value="" selected>CATEGORY</option>

                <!-- Smarty Block here-->

                {foreach $dropdownsearch_categories as $category}

                <option value="{$category.name}">{$category.name}</option>

                {/foreach}

                <!----------------------->

             </select>

          </div>

          <div class="form-group">

              <select id="dropdownsearch_manufacturer" class="selectProductSort form-control" name="dropdownsearch_manufacturer">

                  <option value="" selected>MANUFACTURER</option>

                  <!-- Smarty Block here-->

                  {foreach $dropdownsearch_manufacturers as $manufacturer}

                  <option value="{$manufacturer.name}">{$manufacturer.name}</option>

                  {/foreach}

                  <!----------------------->

              </select>

           </div>

           <div class="form-group">

              <label for="dropdownsearch_keyword" class="col-form-label" style="color:#ddd">KEYWORDS:</label>

              <input class="form-control" type="search" placeholder="Enter your keyword..." id="dropdownsearch_keyword" name="dropdownsearch_keyword" onkeydown="if (event.keyCode == 13) return false;">

          </div>



          <input id="dropdownsearch_submit" name="Search" value="Search" type="button" class="button btn btn-default button-medium" style="background:#ca3b2b" onclick="dropdownsearch_submitSearch();">

          <input id="dropdownsearch_reset" value="Reset" type="reset" class="button btn btn-default button-medium">

    </form>

    </div>

</div>

<!-- /Block doopdownsearch -->
