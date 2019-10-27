<?php 
	$searchFieldText = get_theme_mod('searchFieldText', esc_attr__( 'Type Keywords...', 'energytheme' )); 
?>
<div class="pm-search-container" id="pm-search-container">
    <!-- Search window -->
    <div class="pm-search-columns">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">                       
                    <div class="pm-search-box">
                       <i class="fa-search pm-search-submit" id="pm-search-submit"></i>
                        <form name="searchform" id="pm-searchform" method="get" action="<?php echo home_url( '/' ); ?>">
                            <input type="text" name="s" placeholder="<?php echo esc_attr($searchFieldText); ?>">
                        </form>
                    </div>
                </div>
            </div>
            <div class="row">                    
                <div class="col-lg-12">
                    <i class="fa fa-times pm-search-exit" id="pm-search-exit"></i>
                </div>
            </div>
        </div>
    </div>
    <!-- Search window end -->  
</div>
