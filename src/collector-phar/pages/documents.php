<div class="wrap">
	<h1>
		<?php _e('Help &amp; Documents', $this->text_domain); ?>
		<form class="alignright" id="search-docs-form" method="get">
			<input type="text" name="keyword" placeholder="<?php _e('What are you want?', $this->text_domain); ?>" value="" />
			<input type="submit" class="button button-primary" value="<?php _e('Search'); ?>" />
			<div id="search-results"><a href="#" class="close">x</a><ul></ul></div>
		</form>
	</h1>
	<form method="post" action="options.php" novalidate="novalidate">
		<div id="theme-maker-documents">
			<div id="theme-maker-document-content"></div>
			<?php  $this->documents = apply_filters( 'qqworld-collector-documents', $this->documents); $this->render_supports_docs($this->documents); ?>
			<!--
			<ul class="level">
				<li class="current has-children">
					<a href="#">sdfasdfa sdaf asdf asd </a>
					<ul class="sub-level">
						<li><a href="#">sdfasdfa sdaf asdf asd </a></li>
						<li class="has-children">
							<a href="#">sdfasdfa sdaf asdf asd </a>
							<ul class="sub-level">
								<li><a href="#">sdfasdfa sdaf asdf asd </a></li>
								<li><a href="#">sdfasdfa sdaf asdf asd </a></li>
								<li><a href="#">sdfasdfa sdaf asdf asd </a></li>
								<li><a href="#">sdfasdfa sdaf asdf asd </a></li>
							</ul>
						</li>
						<li><a href="#">sdfasdfa sdaf asdf asd </a></li>
						<li><a href="#">sdfasdfa sdaf asdf asd </a></li>
					</ul>
				</li>
				<li><a href="#">sdfasdfa sdaf asdf asd </a></li>
				<li><a href="#">sdfasdfa sdaf asdf asd </a></li>
				<li><a href="#">sdfasdfa sdaf asdf asd </a></li>
				<li><a href="#">sdfasdfa sdaf asdf asd </a></li>
			</ul>
			-->
		</div>
	</form>
</div>