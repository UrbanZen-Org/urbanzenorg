<?php
/**
 * Search Form Template
**/

?>
<form method="get" class="form-search" action="<?php echo home_url( '/' ); ?>">
	<div class="row">
		<div class="col-lg-12">
			<div class="input-group">
				<input type="text" class="form-control search-query" name="s" placeholder="<?php esc_attr_e('Search Site &hellip;', 'bonestheme'); ?>" />
				<span class="input-group-btn">
					<button type="submit" class="btn btn-primary" name="submit" id="searchsubmit" value="<?php esc_attr_e('Go', 'bonestheme'); ?>">Search</button>
				</span>
			</div>
		</div>
	</div>
</form>