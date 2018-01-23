<?php
/*
Plugin Name: StudioPress Clear Cache plugin
Plugin URI:  https//studiopress.com/
Description: Clear cache on StudioPress infraestructure.
Version:     0.0.0
Author:      Marcos A. Schratzenstaller
Author URI:  https://studiopress.com/
*/
if ( ! defined( 'ABSPATH' ) ) exit;

require_once( plugin_dir_path( __FILE__ ) . "sp-config.php" );
require_once( plugin_dir_path( __FILE__ ) . "lib/Curl.php" );

class StudioPressClearCache {
    public $domain = null;
    /**
     * Constructor.
     */
    public function __construct() {
        $this->domain = preg_replace('/https?:\/\//', '', get_site_url() );
        add_action( 'init', array( $this, 'init' ) );
    }

    /**
     * Init function.
     */
    public function init() {
	    add_action( 'admin_enqueue_scripts', array( $this, 'sp_add_styles' ) );
	    
	    // include in the front end if logged in
	    if( is_user_logged_in() )
	   		add_action( 'wp_enqueue_scripts', array( $this, 'sp_add_styles' ) );
	    
        add_action( 'admin_bar_menu', array( $this, 'sp_admin_bar' ), 100 );
        add_action( 'publish_post', array( $this, 'sp_clear_cache' ), 10, 2 );
        add_action( 'publish_page', array( $this, 'sp_clear_cache' ), 10, 2 );

        $this->_sp_flush_trigger();
    }

    /**
     * Get the caches servers.
     *
     * @param string $domain Domain name.
     *
     * @return array Cache servers.
     */
    public function sp_get_cache_servers( $domain ) {
        $servers = explode( ',', gethostbyaddr( gethostbyname( $domain ) ) );

        foreach( $servers as $s ) {
            if ( ! preg_match( '/(cs|s(p|v))e\d{2,}(-\d{1,})?.spsites.net/', $s ) ) {
                return false;
            }
        }

        return $servers;
    }
    
    /**
     * Queues custom CSS styles
     */
    public static function sp_add_styles() {
		
		wp_enqueue_style( 'sp-clear-cache', plugin_dir_url( __FILE__ ) . 'css/style.css' );
        
    }

    /**
     * Creates the menu bar.
     */
    public function sp_admin_bar() {
        global $wp_admin_bar;

        if ( ! is_super_admin() || ! is_admin_bar_showing() || ! current_user_can( 'manage_options') ) {
            return false;
        }

        $admin = ( is_admin() ) ? "" : admin_url();

        $icon = '<div id="sp-cache-icon" class="ab-item svg" style="background-image: url(data:image/svg+xml;base64,PHN2ZyBpZD0iTGF5ZXJfMSIgZGF0YS1uYW1lPSJMYXllciAxIiB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHZpZXdCb3g9IjAgMCAxNi43NyAxNS43NiI+PGRlZnM+PHN0eWxlPi5jbHMtMXtmaWxsOiM5ZWEzYTg7fTwvc3R5bGU+PC9kZWZzPjx0aXRsZT5zd2VlcGluZy1pY29uPC90aXRsZT48cGF0aCBjbGFzcz0iY2xzLTEiIGQ9Ik0xMC4xLDcuMDVsLS4zLS4zYTEuMDgsMS4wOCwwLDAsMSwwLTEuNTJMMTUuMywxLjE0bDEuNy41M0wxMS42Miw3LjA1QTEuMDgsMS4wOCwwLDAsMSwxMC4xLDcuMDVaIiB0cmFuc2Zvcm09InRyYW5zbGF0ZSgtMC4yMyAtMS4xNCkiLz48cGF0aCBjbGFzcz0iY2xzLTEiIGQ9Ik0xMi43MywxMGMuOC0uODIuMjYtMi42OC0uNTYtMy41TDEwLjQsNC43MmMtLjgxLS44MS0yLjcyLTEuNC0zLjU1LS42MVoiIHRyYW5zZm9ybT0idHJhbnNsYXRlKC0wLjIzIC0xLjE0KSIvPjxyZWN0IGNsYXNzPSJjbHMtMSIgeD0iNC43NSIgeT0iNy42OSIgd2lkdGg9IjguMzIiIGhlaWdodD0iMC41IiB0cmFuc2Zvcm09InRyYW5zbGF0ZSg3Ljk5IC01LjExKSByb3RhdGUoNDUpIi8+PHBhdGggY2xhc3M9ImNscy0xIiBkPSJNMTEuMDUsMTIsNS4xNyw2LjA5UzIuODEsOS4xMi4yNSw4LjY1QTYuMjgsNi4yOCwwLDAsMCwxLDEyQzMuMDcsMTIsNS4xNiwxMCw1LjE1LDEwYTYuMDUsNi4wNSwwLDAsMS0zLjU5LDMsOS44MSw5LjgxLDAsMCwwLDEuMDcsMS4zMSwxMSwxMSwwLDAsMCwxLC45LDcuNjYsNy42NiwwLDAsMCwzLjIxLTIuODUsNi4wNiw2LjA2LDAsMCwxLTIuMzQsMy40NCw2LjgsNi44LDAsMCwwLDQsMS4xMUM4LjEzLDE1LjMxLDExLjA1LDEyLDExLjA1LDEyWiIgdHJhbnNmb3JtPSJ0cmFuc2xhdGUoLTAuMjMgLTEuMTQpIi8+PGNpcmNsZSBjbGFzcz0iY2xzLTEiIGN4PSIxLjMzIiBjeT0iMy43MiIgcj0iMC42MiIvPjxjaXJjbGUgY2xhc3M9ImNscy0xIiBjeD0iMy4wOCIgY3k9IjEuNDYiIHI9IjEuMTMiLz48L3N2Zz4=);"></div>';

        $items[] = array(
            'id' => 'sp_menu_bar',
            'title' => $icon . 'Clear cache',
            'href' => $admin . '?sp_clear_cache'
        );

        foreach( $items as $item ) {
            $wp_admin_bar->add_node( $item );
        }
    }

    /**
     * Build notice to display on Dashboard.
     *
     * @param string $message Message to display.
     * @param string $status Message status used to colorize the message.
     */
    public function sp_admin_notice( $message = null, $status = null ) {
        if ( is_null( $status ) || is_null( $message ) ) {
            return false;
        }

        $status = ( $status == "fail" ) ?  "notice notice-error" : "updated";
        echo "<div class=\"" . $status . "\"><p> StudioPress Clear Cache - " . $message . "</p></div>";
        return array( $this, "sp_admin_notice" );
    }

    public function sp_clear_cache() {
        $servers = $this->sp_get_cache_servers( $this->domain );

        $messages = array();

        $referer = wp_get_referer();

        if ( sizeof( $servers ) > 0 ) {
            foreach( $servers as $server ) {
                $response = $this->_sp_clear_cache( $server );
                $messages[] = array( "<strong>Status for " . $server . ": " . $response['status'] . " - " . $response['status_extended'] . "</strong>", $response['status'] );
            }
        }

        if ( ! defined( 'DOING_AJAX' ) ) {
            wp_redirect( $referer );

            if ( sizeof( $messages ) > 0 ) {
                foreach( $messages as $message ) {
                    add_action( 'admin_notices', $this->sp_admin_notice( $message[0], $message[1] ) );
                }
            }
        }
    }

    /**
     * Action trigger.
     */
    private function _sp_flush_trigger() {
        if ( isset( $_GET['sp_clear_cache'] ) ) {
            $this->sp_clear_cache();
        }
    }

    /**
     * Clear cache on a specific server.
     *
     * @param string $cacheServer Server to clear the cache.
     *
     * @return json Response.
     */
    private function _sp_clear_cache( $cache_server ) {
       return $this->_call( $cache_server, "sitecloner", "action=clearcache&domain=" . $this->domain );
    }

    /**
     * Makes the call to the server.
     *
     * @param string $server Server to perform the call.
     * @param string $cgi CGI file.
     * @param string $queryString Query string.
     *
     * @retrun json Server response.
     */
    private function _call( $server, $cgi, $queryString ) {
        $response = json_decode( Curl::exec( "https://" . $server . ":8442/bulkwp/" . $cgi . ".cgi", $queryString, "POST", null, API_CBM_SERVER_CGI, 20, false ), true );

        return $response;
    }
}

global $sp_clear_cache;
$sp_clear_cache = new StudioPressClearCache();
