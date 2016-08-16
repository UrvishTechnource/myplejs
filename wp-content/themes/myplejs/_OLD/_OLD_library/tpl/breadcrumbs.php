<div class="breadcrumbs">

	<span class="spanleft">
		<?php if(function_exists('bcn_display'))
	    {
	        bcn_display();
	    }?>
	</span>

	<span class="tillbaka"><a href="javascript:history.back();"><?php $currentlang = get_bloginfo('language'); if($currentlang=="en-US"):?>Back</a><?php else: ?>Tillbaka</a><?php endif; ?></span>

</div>