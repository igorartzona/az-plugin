<?php
/*
Plugin Name: az-plugin
Plugin URI: http://artzona.org
Description: Чистая заготовка для плагина. Версия develop. Март 2019.
Author: jvj ( Игорь )
Author URI: http://artzona.org
Version: 0.1
*/

/*
	1. 	Локализация
	2.	Действия при активации и деинсталляции
	3. 	Регистрация стилей
	4. 	Регистрация скриптов
	5.	Страница настроек плагина
	6. 	Ссылка на настройки плагина
	7.	Обработка POST запросов
	8.	Лицензия GPL
*/

if ( ! defined( 'ABSPATH' ) ) exit;

/**	1.	-------------------------------------------------------------------------**/
	//локализация
	add_action( 'plugins_loaded', 'load_azplugin_languages' );
	function load_azplugin_languages() {
		load_plugin_textdomain( 'az-plugin', false, dirname( plugin_basename( __FILE__ ) ) . '/languages/' );
	}	
/**-------------------------------------------------------------------------**/

/**	2.	-------------------------------------------------------------------------**/
	//действия при установке и деинсталляции плагина
	register_activation_hook( __FILE__, 'azplugin_activate' );
	register_uninstall_hook( __FILE__ , 'azplugin_uninstall');
	
	function azplugin_activate(){
		$option = get_option('azplugin-option');
		if (!$option) add_option('azplugin-option','default_value');
	}
	
	function azplugin_uninstall(){
		delete_option( 'azplugin-option' );
	}	
/**-------------------------------------------------------------------------**/

/**	3.	-------------------------------------------------------------------------**/
	// регистрируем стили
	add_action( 'wp_enqueue_scripts', 'register_azplugin_styles' ); // - frontend
	//add_action( 'admin_enqueue_scripts', 'register_azplugin_styles' ); - backend
	function register_azplugin_styles() {
		wp_register_style( 'az-plugin-css', plugins_url( 'az-plugin/css/az-plugin-css.css' ) );
		wp_enqueue_style( 'az-plugin-css' );
	}	
/**-------------------------------------------------------------------------**/

/**	4.	-------------------------------------------------------------------------**/
	// регистрируем скрипты
	add_action( 'wp_enqueue_scripts', 'add_azplugin_admin_scripts' );	// - frontend
	// add_action( 'admin_enqueue_scripts', 'add_azplugin_admin_scripts' ); - backend
	function add_azplugin_admin_scripts( $hook ){
		wp_enqueue_script('az-plugin-script', plugins_url('az-plugin/js/az-plugin-script.js') );
	}
/**-------------------------------------------------------------------------**/


/**	5.	-------------------------------------------------------------------------**/
	// регистрируем страницу настроек плагина
	add_action( 'admin_menu', 'register_azplugin_page' );
	function register_azplugin_page(){
		add_menu_page( 
			'azplugin options', 'AZ plugin', 'manage_options', 'az-plugin/az-plugin-admin-page.php', '', '', 6 
		);
	}	
/**-------------------------------------------------------------------------**/ 

/**	6.	-------------------------------------------------------------------------**/
	// добавляем ссылку на настройки плагина
	add_filter( 'plugin_action_links_' . plugin_basename(__FILE__), 'add_azplugin_links' );
	function add_azplugin_links ( $links ) {
		$mylinks = array(
			'<a href="'
				. admin_url( 'admin.php?page=az-plugin/az-plugin-admin-page.php' ) .'">'
				. __( 'Settings' , 'az-plugin' ) .'</a>',
		);
		return array_merge( $links, $mylinks );
	}	
/**-------------------------------------------------------------------------**/ 

/**	7.	-------------------------------------------------------------------------**/ 
	//Обработка POST запросов
	if($_SERVER['REQUEST_METHOD'] == 'POST'){

	}
/**-------------------------------------------------------------------------**/


/*  Copyright 2017  igor.artzona  (email: igor.artzona@gmail.com)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation; either version 2 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/ 
?>