<div class="wrap">
	<h2><?php _e('Collected Posts', $this->text_domain); ?></h2>
<?php
 $this->list_table->prepare_items(); $this->list_table->views(); $page = filter_input( INPUT_GET, 'page', FILTER_SANITIZE_STRIPPED ); $paged = filter_input( INPUT_GET, 'paged', FILTER_SANITIZE_NUMBER_INT ); ?>
	<form id="posts-filter" action="" method="get">
		<input type="hidden" name="post_status" class="post_status_page" value="<?php echo !empty($_REQUEST['post_status']) ? esc_attr($_REQUEST['post_status']) : 'all'; ?>" />
		<input type="hidden" name="page" value="<?php echo $page; ?>" />
		<input type="hidden" name="paged" value="<?php echo $paged; ?>" />
		<!--<input type="hidden" name="post_type" class="post_type_page" value="<?php ?>" />-->
		<?php if ( ! empty( $_REQUEST['show_sticky'] ) ) : ?><input type="hidden" name="show_sticky" value="1" /><?php endif; ?>
<?php
 $this->list_table->search_box(__('Search Posts'), 'post'); $this->list_table->display(); ?>
	</form>
</div>