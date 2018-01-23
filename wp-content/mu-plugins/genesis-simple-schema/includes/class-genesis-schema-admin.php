<?php
/**
 * Registers a new admin page, providing content and corresponding menu item for the Schema Settings page.
 *
 * @since 0.9.0
 */
class Genesis_Schema_Admin extends Genesis_Admin_Boxes {

	/**
	 * Create an admin menu item and settings page.
	 *
	 * @since 1.8.0
	 *
	 * @uses GENESIS_SEO_SETTINGS_FIELD Settings field key.
	 * @uses \Genesis_Admin::create()   Create an admin menu item and settings page.
	 */
	function __construct() {

		$page_id = 'genesis-simple-schema';

		$menu_ops = array(
			'submenu' => array(
				'parent_slug' => 'genesis',
				'page_title'  => __( 'Genesis Simple Schema', 'genesis-simple-schema' ),
				'menu_title'  => __( 'Schema', 'genesis-simple-schema' )
			)
		);

		$page_ops = array(
			'save_button_text'  => __( 'Save Settings', 'genesis' ),
			'reset_button_text' => __( 'Reset Settings', 'genesis' ),
			'saved_notice_text' => __( 'Settings saved.', 'genesis' ),
			'reset_notice_text' => __( 'Settings reset.', 'genesis' ),
			'error_notice_text' => __( 'Error saving settings.', 'genesis' ),
		);

		$settings_field = GENESIS_SEO_SETTINGS_FIELD;

		$default_settings = apply_filters(
			'genesis_seo_settings_defaults',
			array(
				'semantic_headings'            => 0,

				'append_site_title'            => 0,
				'doctitle_sep'                 => '–',
				'doctitle_seplocation'         => 'right',

				'append_description_home'      => 1,
				'home_h1_on'                   => 'title',
				'home_doctitle'                => '',
				'home_description'             => '',
				'home_keywords'                => '',
				'home_noindex'                 => 0,
				'home_nofollow'                => 0,
				'home_noarchive'               => 0,

				'canonical_archives'           => 1,

				'head_adjacent_posts_rel_link' => 0,
				'head_wlwmanifest_link'        => 0,
				'head_shortlink'               => 0,

				'noindex_cat_archive'          => 1,
				'noindex_tag_archive'          => 1,
				'noindex_author_archive'       => 1,
				'noindex_date_archive'         => 1,
				'noindex_search_archive'       => 1,
				'noarchive_cat_archive'        => 0,
				'noarchive_tag_archive'        => 0,
				'noarchive_author_archive'     => 0,
				'noarchive_date_archive'       => 0,
				'noarchive_search_archive'     => 0,
				'noarchive'                    => 0,
				'noodp'                        => 1,
				'noydir'                       => 1,
			)
		);

		$this->create( $page_id, $menu_ops, $page_ops, $settings_field, $default_settings );

		add_action( 'genesis_settings_sanitizer_init', array( $this, 'sanitizer_filters' ) );

	}

	/**
	 * Register each of the settings with a sanitization filter type.
	 *
	 * @since 1.7.0
	 *
	 * @uses genesis_add_option_filter() Assign filter to array of settings.
	 *
	 * @see \Genesis_Settings_Sanitizer::add_filter() Add sanitization filters to options.
	 */
	public function sanitizer_filters() {

		// No filter: doctitle_seplocation, home_h1_on

		genesis_add_option_filter(
			'one_zero',
			$this->settings_field,
			array(
				'append_description_home',
				'append_site_title',
				'semantic_headings',
				'home_noindex',
				'home_nofollow',
				'home_noarchive',
				'head_adjacent_posts_rel_link',
				'head_wlwmanifest_link',
				'head_shortlink',
				'noindex_cat_archive',
				'noindex_tag_archive',
				'noindex_author_archive',
				'noindex_date_archive',
				'noindex_search_archive',
				'noarchive',
				'noarchive_cat_archive',
				'noarchive_tag_archive',
				'noarchive_author_archive',
				'noarchive_date_archive',
				'noarchive_search_archive',
				'noodp',
				'noydir',
			)
		);

		genesis_add_option_filter(
			'absint',
			$this->settings_field,
			array(
				'home_author',
			)
		);

		genesis_add_option_filter(
			'no_html',
			$this->settings_field,
			array(
				'home_doctitle',
				'home_description',
				'home_keywords',
				'doctitle_sep',
			)
		);

	}

	/**
	 * Contextual help content.
	 *
	 * @since 2.0.0
	 */
	public function help() {

		$screen = get_current_screen();

		$seo_settings_help =
			'<h3>' . __( 'SEO Settings', 'genesis' ) . '</h3>' .
			'<p>' .  __( 'Genesis SEO (search engine optimization) is polite, and will disable itself when most popular SEO plugins (e.g., All-in-One SEO, WordPress SEO, etc.) are active.', 'genesis' ) . '</p>' .
			'<p>' .  __( 'If you don’t see an SEO Settings sub menu, then you probably have another SEO plugin active.', 'genesis' ) . '</p>' .
			'<p>' .  __( 'If you see the menu, then opening that menu item will let you set the General SEO settings for your site.', 'genesis' ) . '</p>' .
			'<p>' .  __( 'Each page, post, and term will have its own SEO settings as well. The default settings are recommended for most users. If you wish to adjust your SEO settings, the boxes include internal descriptions.', 'genesis' ) . '</p>' .
			'<p>' .  __( 'Below you\'ll find a few succinct notes on the options for each box:', 'genesis' ) . '</p>';

		$doctitle_help =
			'<h3>' . __( 'Doctitle Settings', 'genesis' ) . '</h3>' .
			'<p>' .  __( '<strong>Append Site Description</strong> will insert the site description from your General Settings after the title on your home page.', 'genesis' ) . '</p>' .
			'<p>' .  __( '<strong>Append Site Name</strong> will put the site name from the General Settings after the title on inner page.', 'genesis' ) . '</p>' .
			'<p>' .  __( '<strong>Doctitle Append Location</strong> determines which side of the title to add the previously mentioned items.', 'genesis' ) . '</p>' .
			'<p>' .  __( 'The <strong>Doctitle Separator</strong> is the character that will go between the title and appended text.', 'genesis' ) . '</p>';

		$homepage_help =
			'<h3>' . __( 'Homepage Settings', 'genesis' ) . '</h3>' .
			'<p>' .  __( 'These are the homepage specific SEO settings. Note: these settings will not apply if a static page is set as the front page. If you\'re using a static WordPress page as your hompage, you\'ll need to set the SEO settings on that particular page.', 'genesis' ) . '</p>' .
			'<p>' .  __( 'You can also specify if the Site Title, Description, or your own custom text should be wrapped in an &lt;h1&gt; tag (the primary heading in HTML).', 'genesis' ) . '</p>' .
			'<p>' .  __( 'To add custom text you\'ll have to either edit a php file, or use a text widget on a widget enabled homepage.', 'genesis' ) . '</p>' .
			'<p>' .  sprintf( __( 'The home doctitle sets what will appear within the %1$s tags (unseen in the browser) for the home page.', 'genesis' ), '<code>&lt;title&gt;</code>' ) . '</p>' .
			'<p>' .  __( 'The home META description and keywords fill in the meta tags for the home page. The META description is the short text blurb that appear in search engine results.', 'genesis' ) . '</p>' .
			'<p>' .  __( 'Most search engines do not use Keywords at this time or give them very little consideration; however, it\'s worth using in case keywords are given greater consideration in the future and also to help guide your content. If the content doesn’t match with your targeted key words, then you may need to consider your content more carefully.', 'genesis' ) . '</p>' .
			'<p>' .  __( 'The Homepage Robots Meta Tags tell search engines how to handle the homepage. Noindex means not to index the page at all, and it will not appear in search results. Nofollow means do not follow any links from this page and noarchive tells them not to make an archive copy of the page.', 'genesis' ) . '</p>';

		$dochead_help =
			'<h3>' . __( 'Document Head Settings', 'genesis' ) . '</h3>' .
			'<p>' .  __( 'The Relationship Link Tags are tags added by WordPress that currently have no SEO value but slow your site load down. They\'re disabled by default, but if you have a specific need&#8212;for a plugin or other non typical use&#8212;then you can enable as needed here.', 'genesis' ) . '</p>' .
			'<p>' .  __( 'You can also add support for Windows Live Writer if you use software that supports this and include a shortlink tag if this is required by any third party service.', 'genesis' ) . '</p>';

		$robots_help =
			'<h3>' . __( 'Robots Meta Settings', 'genesis' ) . '</h3>' .
			'<p>' .  __( 'Noarchive and noindex are explained in the home settings. Here you can select what other parts of the site to apply these options to.', 'genesis' ) . '</p>' .
			'<p>' .  __( 'At least one archive should be indexed, but indexing multiple archives will typically result in a duplicate content penalization (multiple pages with identical content look manipulative to search engines).', 'genesis' ) . '</p>' .
			'<p>' .  __( 'For most sites either the home page or blog page (using the blog template) will serve as this index which is why the default is not to index categories, tags, authors, dates, or searches.', 'genesis' ) . '</p>';

		$screen->add_help_tab( array(
			'id'	=> $this->pagehook . '-seo-settings',
			'title'	=> __( 'SEO Settings', 'genesis' ),
			'content'	=> $seo_settings_help,
		) );
		$screen->add_help_tab( array(
			'id'	=> $this->pagehook . '-doctitle',
			'title'	=> __( 'Doctitle Settings', 'genesis' ),
			'content'	=> $doctitle_help,
		) );
		$screen->add_help_tab( array(
			'id'	=> $this->pagehook . '-homepage',
			'title'	=> __( 'Homepage Settings', 'genesis' ),
			'content'	=> $homepage_help,
		) );
		$screen->add_help_tab( array(
			'id'	=> $this->pagehook . '-dochead',
			'title'	=> __( 'Document Head Settings', 'genesis' ),
			'content'	=> $dochead_help,
		) );
		$screen->add_help_tab( array(
			'id'	=> $this->pagehook . '-robots',
			'title'	=> __( 'Robots Meta Settings', 'genesis' ),
			'content'	=> $robots_help,
		) );

		//* Add help sidebar
		$screen->set_help_sidebar(
			'<p><strong>' . __( 'For more information:', 'genesis' ) . '</strong></p>' .
			'<p><a href="http://my.studiopress.com/help/" target="_blank">' . __( 'Get Support', 'genesis' ) . '<span class="screen-reader-text">. ' .  __( 'Link opens in a new window.', 'genesis' ) . '</span></a></p>' .
			'<p><a href="http://my.studiopress.com/snippets/" target="_blank">' . __( 'Genesis Snippets', 'genesis' ) . '<span class="screen-reader-text">. ' .  __( 'Link opens in a new window.', 'genesis' ) . '</span></a></p>' .
			'<p><a href="http://my.studiopress.com/tutorials/" target="_blank">' . __( 'Genesis Tutorials', 'genesis' ) . '<span class="screen-reader-text">. ' .  __( 'Link opens in a new window.', 'genesis' ) . '</span></a></p>'
		);

	}

	/**
 	 * Register meta boxes on the SEO Settings page.
 	 *
 	 * @since 1.0.0
 	 *
 	 * @see \Genesis_Admin_SEO_Settings::sitewide_box()      Callback for sitewide box.
 	 * @see \Genesis_Admin_SEO_Settings::homepage_box()      Callback for home page box.
 	 * @see \Genesis_Admin_SEO_Settings::document_head_box() Callback for document head box.
 	 * @see \Genesis_Admin_SEO_Settings::robots_meta_box()   Callback for robots meta box.
 	 */
	function metaboxes() {

		add_meta_box( 'genesis-seo-settings-sitewide', __( 'Sitewide Settings', 'genesis' ), array( $this, 'sitewide_box' ), $this->pagehook, 'main' );
		add_meta_box( 'genesis-seo-settings-homepage', __( 'Homepage Settings', 'genesis' ), array( $this, 'homepage_box' ), $this->pagehook, 'main' );
		add_meta_box( 'genesis-seo-settings-dochead', __( 'Document Head Settings', 'genesis' ), array( $this, 'document_head_box' ), $this->pagehook, 'main' );
		add_meta_box( 'genesis-seo-settings-robots', __( 'Robots Meta Settings', 'genesis' ), array( $this, 'robots_meta_box' ), $this->pagehook, 'main' );

	}

	/**
	 * Callback for SEO Settings Sitewide meta box.
	 *
	 * @since 1.0.0
	 *
	 * @uses \Genesis_Admin::get_field_id()    Construct field ID.
	 * @uses \Genesis_Admin::get_field_name()  Construct field name.
	 * @uses \Genesis_Admin::get_field_value() Retrieve value of key under $this->settings_field.
	 *
	 * @see \Genesis_Admin_SEO_Settings::metaboxes() Register meta boxes on the SEO Settings page.
	 */
	function sitewide_box() {

		?>

		<table class="form-table">
		<tbody>

			<?php if ( genesis_html5() ) : ?>
			<tr valign="top">
				<th scope="row"><?php _e( 'Section Headings', 'genesis' ); ?></th>
				<td>
					<p>
						<label for="<?php $this->field_id( 'semantic_headings' ); ?>"><input type="checkbox" name="<?php $this->field_name( 'semantic_headings' ); ?>" id="<?php $this->field_id( 'semantic_headings' ); ?>" value="1" <?php checked( $this->get_field_value( 'semantic_headings' ) ); ?> />
						<?php _e( 'Use semantic HTML5 page and section headings throughout site?', 'genesis' ); ?></label>
					</p>
				</td>
			</tr>
			<?php endif; ?>

			<tr valign="top">
				<th scope="row"><?php _e( 'Document Title', 'genesis' ); ?></th>
				<td>
					<p>
						<label for="<?php $this->field_id( 'append_site_title' ); ?>"><input type="checkbox" name="<?php $this->field_name( 'append_site_title' ); ?>" id="<?php $this->field_id( 'append_site_title' ); ?>" value="1" <?php checked( $this->get_field_value( 'append_site_title' ) ); ?> />
						<?php printf( __( 'Add site name to %s on inner pages?', 'genesis' ), genesis_code( '<title>' ) ); ?> </label>
					</p>

					<p>
						<label for="<?php $this->field_id( 'doctitle_sep' ); ?>"><?php _e( 'Document Title Separator:', 'genesis' ); ?></label>
						<input type="text" name="<?php $this->field_name( 'doctitle_sep' ); ?>" class="small-text" id="<?php echo esc_attr( $this->get_field_id( 'doctitle_sep' ) ); ?>" value="<?php echo esc_attr( $this->get_field_value( 'doctitle_sep' ) ); ?>" /><br />
						<span class="description"><?php _e( 'If the title consists of two parts (original title and optional addition), then the separator will go in between them.', 'genesis' ); ?></span>
					</p>

				</td>
			</tr>

			<tr valign="top">
				<th scope="row"><?php _e( 'Document Title Order', 'genesis' ); ?></th>
				<td>
					<select name="<?php $this->field_name( 'doctitle_seplocation' ); ?>" id="<?php $this->field_id( 'doctitle_seplocation' ); ?>">
						<option value="left" <?php selected( $this->get_field_value( 'doctitle_seplocation' ), 'left' ); ?>><?php _e( 'Additions on left', 'genesis' ); ?></option>
						<option value="right" <?php selected( $this->get_field_value( 'doctitle_seplocation' ), 'right' ); ?>><?php _e( 'Additions on right', 'genesis' ); ?></option>
					</select>
					<p><span class="description"><?php _e( 'Determines which side the added title text will go on.', 'genesis' ); ?></span></p>
				</td>
			</tr>

		</tbody>
		</table>

		<?php

	}

	/**
	 * Callback for SEO Settings Home Page meta box.
	 *
	 * @since 1.0.0
	 *
	 * @uses \Genesis_Admin::get_field_id()    Construct field ID.
	 * @uses \Genesis_Admin::get_field_name()  Construct field name.
	 * @uses \Genesis_Admin::get_field_value() Retrieve value of key under $this->settings_field.
	 * @uses genesis_html5() Check for HTML5 support.
	 *
	 * @see \Genesis_Admin_SEO_Settings::metaboxes() Register meta boxes on the SEO Settings page.
	 */
	function homepage_box() {

		?>
		<table class="form-table">
		<tbody>

			<tr valign="top" <?php echo genesis_html5() ? 'id="genesis_seo_h1_wrap"' : '';?>>
				<th scope="row"><?php printf( __( 'Primary Title %s', 'genesis' ), genesis_code( 'h1' ) ); ?></th>
				<td>
					<fieldset>
						<legend class="screen-reader-text"><p><?php printf( __( 'Primary Title %s', 'genesis' ), genesis_code( 'h1' ) ); ?></p></legend>

						<p>
							<input type="radio" name="<?php $this->field_name( 'home_h1_on' ); ?>" id="<?php $this->field_id( 'home_h1_on_title' ); ?>" value="title" <?php checked( $this->get_field_value( 'home_h1_on' ), 'title' ); ?> />
							<label for="<?php $this->field_id( 'home_h1_on_title' ); ?>"><?php _e( 'Site Title', 'genesis' ); ?></label>
							<br />
							<input type="radio" name="<?php $this->field_name( 'home_h1_on' ); ?>" id="<?php $this->field_id( 'home_h1_on_description' ); ?>" value="description" <?php checked( $this->get_field_value( 'home_h1_on' ), 'description' ); ?> />
							<label for="<?php $this->field_id( 'home_h1_on_description' ); ?>"><?php _e( 'Site Description (Tagline)', 'genesis' ); ?></label>
							<br />
							<input type="radio" name="<?php $this->field_name( 'home_h1_on' ); ?>" id="<?php $this->field_id( 'home_h1_on_neither' ); ?>" value="neither" <?php checked( $this->get_field_value( 'home_h1_on' ), 'neither' ); ?> />
							<label for="<?php $this->field_id( 'home_h1_on_neither' ); ?>"><?php _e( 'I\'ll manually wrap my own text on the homepage', 'genesis' ); ?></label>
						</p>
					</fieldset>
				</td>
			</tr>

			<tr valign="top">
				<th scope="row"><label for="<?php $this->field_id( 'home_doctitle' ); ?>"><?php _e( 'Document Title:', 'genesis' ); ?></label></th>
				<td>
					<p>
						<input type="text" name="<?php $this->field_name( 'home_doctitle' ); ?>" class="large-text" id="<?php $this->field_id( 'home_doctitle' ); ?>" value="<?php echo esc_attr( $this->get_field_value( 'home_doctitle' ) ); ?>" /><br />
						<span class="description"><?php _e( 'If you leave the document title field blank, your site&#8217;s title will be used instead.', 'genesis' ); ?></span>
					</p>

					<p>
						<label for="<?php $this->field_id( 'append_description_home' ); ?>"><input type="checkbox" name="<?php $this->field_name( 'append_description_home' ); ?>" id="<?php $this->field_id( 'append_description_home' ); ?>" value="1" <?php checked( $this->get_field_value( 'append_description_home' ) ); ?> />
						<?php printf( __( 'Add site description (tagline) to %s on home page?', 'genesis' ), genesis_code( '<title>' ) ); ?></label>
					</p>
				</td>
			</tr>

			<tr valign="top">
				<th scope="row"><label for="<?php $this->field_id( 'home_description' ); ?>"><?php _e( 'Meta Description:', 'genesis' ); ?></label></th>
				<td>
					<p>
						<textarea name="<?php $this->field_name( 'home_description' ); ?>" class="large-text" id="<?php $this->field_id( 'home_description' ); ?>" rows="3" cols="70"><?php echo esc_textarea( $this->get_field_value( 'home_description' ) ); ?></textarea><br />
						<span class="description"><?php _e( 'The meta description can be used to determine the text used under the title on search engine results pages.', 'genesis' ); ?></span>
					</p>
				</td>
			</tr>

			<tr valign="top">
				<th scope="row"><label for="<?php $this->field_id( 'home_keywords' ); ?>"><?php _e( 'Meta Keywords:', 'genesis' ); ?></label></th>
				<td>
					<p>
						<input type="text" name="<?php $this->field_name( 'home_keywords' ); ?>" class="large-text" id="<?php $this->field_id( 'home_keywords' ); ?>" value="<?php echo esc_attr( $this->get_field_value( 'home_keywords' ) ); ?>" /><br />
						<span class="description"><?php _e( 'Keywords are generally ignored by Search Engines.', 'genesis' ); ?></span>
					</p>
				</td>
			</tr>

			<tr valign="top">
				<th scope="row"><?php _e( 'Robots Meta Tags:', 'genesis' ); ?></th>
				<td>
					<p>
						<label for="<?php $this->field_id( 'home_noindex' ); ?>"><input type="checkbox" name="<?php $this->field_name( 'home_noindex' ); ?>" id="<?php $this->field_id( 'home_noindex' ); ?>" value="1" <?php checked( $this->get_field_value( 'home_noindex' ) ); ?> />
						<?php printf( __( 'Apply %s to the homepage?', 'genesis' ), genesis_code( 'noindex' ) ); ?></label>
						<br />
						<label for="<?php $this->field_id( 'home_nofollow' ); ?>"><input type="checkbox" name="<?php $this->field_name( 'home_nofollow' ); ?>" id="<?php $this->field_id( 'home_nofollow' ); ?>" value="1" <?php checked( $this->get_field_value( 'home_nofollow' ) ); ?> />
						<?php printf( __( 'Apply %s to the homepage?', 'genesis' ), genesis_code( 'nofollow' ) ); ?></label>
						<br />
						<label for="<?php $this->field_id( 'home_noarchive' ); ?>"><input type="checkbox" name="<?php $this->field_name( 'home_noarchive' ); ?>" id="<?php $this->field_id( 'home_noarchive' ); ?>" value="1" <?php checked( $this->get_field_value( 'home_noarchive' ) ); ?> />
						<?php printf( __( 'Apply %s to the homepage?', 'genesis' ), genesis_code( 'noarchive' ) ); ?></label>
					</p>
				</td>
			</tr>

		</tbody>
		</table>

		<?php

	}

	/**
	 * Callback for SEO Settings Document Head meta box.
	 *
	 * @since 1.3.0
	 *
	 * @uses \Genesis_Admin::get_field_id()    Construct field ID.
	 * @uses \Genesis_Admin::get_field_name()  Construct field name.
	 * @uses \Genesis_Admin::get_field_value() Retrieve value of key under $this->settings_field.
	 *
	 * @see \Genesis_Admin_SEO_Settings::metaboxes() Register meta boxes on the SEO Settings page.
	 */
	function document_head_box() {

		?>

		<p><span class="description"><?php printf( __( 'By default, WordPress places several tags in your document %1$s. Most of these tags are completely unnecessary, and provide no <abbr title="Search engine optimization">SEO</abbr> value whatsoever; they just make your site slower to load. Choose which tags you would like included in your document %1$s. If you do not know what something is, leave it unchecked.', 'genesis' ), genesis_code( '<head>' ) ); ?></span></p>

		<table class="form-table">
		<tbody>

			<tr valign="top">
				<th scope="row"><?php _e( 'Relationship Link Tags', 'genesis' ); ?></th>
				<td>
					<p>
						<label for="<?php $this->field_id( 'head_adjacent_posts_rel_link' ); ?>"><input type="checkbox" name="<?php $this->field_name( 'head_adjacent_posts_rel_link' ); ?>" id="<?php $this->field_id( 'head_adjacent_posts_rel_link' ); ?>" value="1" <?php checked( $this->get_field_value( 'head_adjacent_posts_rel_link' ) ); ?> />
						<?php printf( __( 'Adjacent Posts %s link tags', 'genesis' ), genesis_code( 'rel' ) ); ?></label>
					</p>
				</td>
			</tr>

			<tr valign="top">
				<th scope="row"><?php _e( 'Windows Live Writer', 'genesis' ); ?></th>
				<td>
					<p>
						<label for="<?php $this->field_id( 'head_wlmanifest_link' ); ?>"><input type="checkbox" name="<?php $this->field_name( 'head_wlwmanifest_link' ); ?>" id="<?php $this->field_id( 'head_wlmanifest_link' ); ?>" value="1" <?php checked( $this->get_field_value( 'head_wlwmanifest_link' ) ); ?> />
						<?php printf( __( 'Include Windows Live Writer Support Tag?', 'genesis' ) ); ?></label>
					</p>
				</td>
			</tr>

			<tr valign="top">
				<th scope="row"><?php _e( 'Shortlink Tag', 'genesis' ); ?></th>
				<td>
					<p>
						<label for="<?php $this->field_id( 'head_shortlink' ); ?>"><input type="checkbox" name="<?php $this->field_name( 'head_shortlink' ); ?>" id="<?php $this->field_id( 'head_shortlink' ); ?>" value="1" <?php checked( $this->get_field_value( 'head_shortlink' ) ); ?> />
						<?php printf( __( 'Include Shortlink tag?', 'genesis' ) ); ?></label>
					</p>
					<p>
						<span class="description"><?php _e( '<span class="genesis-admin-note">Note:</span> The shortlink tag might have some use for 3rd party service discoverability, but it has no <abbr title="Search engine optimization">SEO</abbr> value whatsoever.', 'genesis' ); ?></span>
					</p>
				</td>
			</tr>

		</tbody>
		</table>

		<?php

	}

	/**
	 * Callback for SEO Settings Robots meta box.
	 *
	 * Variations of some of the settings contained in this meta box were first added to a 'Search Engine Indexing' meta
	 * box, added in 1.0.0.
	 *
	 * @since 1.3.0
	 *
	 * @uses \Genesis_Admin::get_field_id()    Construct field ID.
	 * @uses \Genesis_Admin::get_field_name()  Construct field name.
	 * @uses \Genesis_Admin::get_field_value() Retrieve value of key under $this->settings_field.
	 *
	 * @see \Genesis_Admin_SEO_Settings::metaboxes() Register meta boxes on the SEO Settings page.
	 */
	function robots_meta_box() {

		?>

		<table class="form-table">
		<tbody>

			<tr valign="top">
				<th scope="row"><?php _e( 'Indexing', 'genesis' ); ?></th>
				<td>
					<p>
						<label for="<?php $this->field_id( 'noindex_cat_archive' ); ?>"><input type="checkbox" name="<?php $this->field_name( 'noindex_cat_archive' ); ?>" id="<?php $this->field_id( 'noindex_cat_archive' ); ?>" value="1" <?php checked( $this->get_field_value( 'noindex_cat_archive' ) ); ?> />
						<?php printf( __( 'Apply %s to Category Archives?', 'genesis' ), genesis_code( 'noindex' ) ); ?></label>
						<br />
						<label for="<?php $this->field_id( 'noindex_tag_archive' ); ?>"><input type="checkbox" name="<?php $this->field_name( 'noindex_tag_archive' ); ?>" id="<?php $this->field_id( 'noindex_tag_archive' ); ?>" value="1" <?php checked( $this->get_field_value( 'noindex_tag_archive' ) ); ?> />
						<?php printf( __( 'Apply %s to Tag Archives?', 'genesis' ), genesis_code( 'noindex' ) ); ?></label>
						<br />
						<label for="<?php $this->field_id( 'noindex_author_archive' ); ?>"><input type="checkbox" name="<?php $this->field_name( 'noindex_author_archive' ); ?>" id="<?php $this->field_id( 'noindex_author_archive' ); ?>" value="1" <?php checked( $this->get_field_value( 'noindex_author_archive' ) ); ?> />
						<?php printf( __( 'Apply %s to Author Archives?', 'genesis' ), genesis_code( 'noindex' ) ); ?></label>
						<br />
						<label for="<?php $this->field_id( 'noindex_date_archive' ); ?>"><input type="checkbox" name="<?php $this->field_name( 'noindex_date_archive' ); ?>" id="<?php $this->field_id( 'noindex_date_archive' ); ?>" value="1" <?php checked( $this->get_field_value( 'noindex_date_archive' ) ); ?> />
						<?php printf( __( 'Apply %s to Date Archives?', 'genesis' ), genesis_code( 'noindex' ) ); ?></label>
						<br />
						<label for="<?php $this->field_id( 'noindex_search_archive' ); ?>"><input type="checkbox" name="<?php $this->field_name( 'noindex_search_archive' ); ?>" id="<?php $this->field_id( 'noindex_search_archive' ); ?>" value="1" <?php checked( $this->get_field_value( 'noindex_search_archive' ) ); ?> />
						<?php printf( __( 'Apply %s to Search Archives?', 'genesis' ), genesis_code( 'noindex' ) ); ?></label>
					</p>
				</td>
			</tr>

		</tbody>
		</table>

		<table class="form-table">
		<tbody>

			<tr valign="top">
				<th scope="row"><?php _e( 'Archiving', 'genesis' ); ?></th>
				<td>
					<p>
						<label for="<?php $this->field_id( 'noarchive' ); ?>"><input type="checkbox" name="<?php $this->field_name( 'noarchive' ); ?>" id="<?php $this->field_id( 'noarchive' ); ?>" value="1" <?php checked( $this->get_field_value( 'noarchive' ) ); ?> />
						<?php printf( __( 'Apply %s to Entire Site?', 'genesis' ), genesis_code( 'noarchive' ) ); ?></label>
					</p>

					<p>
						<label for="<?php $this->field_id( 'noarchive_cat_archive' ); ?>"><input type="checkbox" name="<?php $this->field_name( 'noarchive_cat_archive' ); ?>" id="<?php $this->field_id( 'noarchive_cat_archive' ); ?>" value="1" <?php checked( $this->get_field_value( 'noarchive_cat_archive' ) ); ?> />
						<?php printf( __( 'Apply %s to Category Archives?', 'genesis' ), genesis_code( 'noarchive' ) ); ?></label>
						<br />
						<label for="<?php $this->field_id( 'noarchive_tag_archive' ); ?>"><input type="checkbox" name="<?php $this->field_name( 'noarchive_tag_archive' ); ?>" id="<?php $this->field_id( 'noarchive_tag_archive' ); ?>" value="1" <?php checked( $this->get_field_value( 'noarchive_tag_archive' ) ); ?> />
						<?php printf( __( 'Apply %s to Tag Archives?', 'genesis' ), genesis_code( 'noarchive' ) ); ?></label>
						<br />
						<label for="<?php $this->field_id( 'noarchive_author_archive' ); ?>"><input type="checkbox" name="<?php $this->field_name( 'noarchive_author_archive' ); ?>" id="<?php $this->field_id( 'noarchive_author_archive' ); ?>" value="1" <?php checked( $this->get_field_value( 'noarchive_author_archive' ) ); ?> />
						<?php printf( __( 'Apply %s to Author Archives?', 'genesis' ), genesis_code( 'noarchive' ) ); ?></label>
						<br />
						<label for="<?php $this->field_id( 'noarchive_date_archive' ); ?>"><input type="checkbox" name="<?php $this->field_name( 'noarchive_date_archive' ); ?>" id="<?php $this->field_id( 'noarchive_date_archive' ); ?>" value="1" <?php checked( $this->get_field_value( 'noarchive_date_archive' ) ); ?> />
						<?php printf( __( 'Apply %s to Date Archives?', 'genesis' ), genesis_code( 'noarchive' ) ); ?></label>
						<br />
						<label for="<?php $this->field_id( 'noarchive_search_archive' ); ?>"><input type="checkbox" name="<?php $this->field_name( 'noarchive_search_archive' ); ?>" id="<?php $this->field_id( 'noarchive_search_archive' ); ?>" value="1" <?php checked( $this->get_field_value( 'noarchive_search_archive' ) ); ?> />
						<?php printf( __( 'Apply %s to Search Archives?', 'genesis' ), genesis_code( 'noarchive' ) ); ?></label>
					</p>
				</td>
			</tr>

		</tbody>
		</table>


		<table class="form-table">
		<tbody>

			<tr valign="top">
				<th scope="row"><?php _e( 'Directories', 'genesis' ); ?></th>
				<td>
					<p>
						<label for="<?php $this->field_id( 'noodp' ); ?>"><input type="checkbox" name="<?php $this->field_name( 'noodp' ); ?>" id="<?php $this->field_id( 'noodp' ); ?>" value="1" <?php checked( $this->get_field_value( 'noodp' ) ); ?> />
						<?php printf( __( 'Apply %s to your site?', 'genesis' ), genesis_code( 'nooodp' ) ) ?></label>
						<br />
						<label for="<?php $this->field_id( 'noydir' ); ?>"><input type="checkbox" name="<?php $this->field_name( 'noydir' ); ?>" id="<?php $this->field_id( 'noydir' ); ?>" value="1" <?php checked( $this->get_field_value( 'noydir' ) ); ?> />
						<?php printf( __( 'Apply %s to your site?', 'genesis' ), genesis_code( 'noydir' ) ) ?></label>
					</p>
				</td>
			</tr>

		</tbody>
		</table>

		<?php

	}

}
