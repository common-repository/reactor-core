<?php


if ( !class_exists( 'Reactor_Theme_Switcher' ) ) {
	/**
	 * Main Reactor_Theme_Switcher Class
	 *
	 * Tap tap tap... Is this thing on?
	 *
	 * @since Reactor (1.0)
	 */
	class Reactor_Theme_Switcher {

		var $reactor;

		/** Functions *************************************************************/

		/**
		 * The main Reactor_Theme_Switcher loader
		 *
		 * @since Reactor_Theme_Switcher (10)
		 *
		 */
		public function __construct() {
			$this->setup_actions();
		}


		/**
		 * Setup the default hooks and actions
		 *
		 * @since Reactor_Theme_Switcher (1.0)
		 * @access private
		 *
		 */
		private function setup_actions() {

			$this->detectReactor();
						
			add_filter( 'template', array(&$this, 'get_template') );
			add_filter( 'stylesheet', array(&$this, 'get_stylesheet') );

			register_theme_directory( dirname( __FILE__ ) . '/theme' );
			
			
		}
			

		/**
		 * detect if we need the reactor theme
		 *
		 * @since Reactor_Theme_Switcher (1.0)
		 * @access private
		 *
		 */
		private function detectReactor() {

			if( $_GET['reactor'] === 'true' || $_COOKIE['reactor'] === 'true' ){
				$this->reactor = true;
							
				setcookie( 'reactor', 'true', time() + ( 86400 * 7 ), '/' ); // 86400 = 1 day
				add_filter( 'show_admin_bar', '__return_false' );
			}
			
			if( $_GET['reactor'] === 'false' ) {
				setcookie('reactor', '', time() - 3600);
			}

		}

		/**
		 * filter the theme stylesheet
		 *
		 * @since Reactor_Theme_Switcher (1.0)
		 * @access public
		 *
		 */
		public function get_stylesheet( $stylesheet ) {
			if ( $this->reactor ) {
				return 'reactor';
			} else {
				return $stylesheet;
			}
		}

		/**
		 * filter the theme template
		 *
		 * @since Reactor_Theme_Switcher (1.0)
		 * @access public
		 *
		 */
		public function get_template( $template ) {
			if ( $this->reactor ) {
				return 'reactor';
			} else {
				return $template;
			}
		}

	}
	//$reactorthemeswitcher = new Reactor_Theme_Switcher ;

}