<?php
/*
Plugin Name: Required Registration Fields
Plugin URI: http://carbolowdrates.com
Description: Makes the user enter certain fields on registration
Version: 0.1
Author: Dave Preece
Author URI: http://www.scumonline.co.uk
License: GPL

Copyright YEAR  PLUGIN_AUTHOR_NAME  (email : dangerous@scumonline.co.uk)

This program is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License, version 2, as 
published by the Free Software Foundation.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/
add_filter('registration_errors', 'required_fields_registration_errors', 10, 3);
add_action('register_form','required_fields_register_form');
add_action('user_register', 'required_fields_user_register');

function required_fields_registration_errors($errors, $sanitized_user_login, $user_email) {
	var_dump($_POST);
	if (empty( $_POST['first_name'] )){
          $errors->add( 'first_name_error', __('<strong>ERROR</strong>: You must include a first name.') );
	}
	
	if (empty( $_POST['last_name'] )){
          $errors->add( 'last_name_error', __('<strong>ERROR</strong>: You must include a last name.') );
	}
	   return $errors;
   }



    
 function required_fields_register_form (){
     $first_name = ( isset( $_POST['first_name'] ) ) ? stripslashes($_POST['first_name']) : '';
	  $last_name = ( isset( $_POST['first_name'] ) ) ? stripslashes($_POST['first_name']) : '';
     ?>
     <p>
         <label for="first_name"><?php _e('First Name') ?><br />
         <input type="text" name="first_name" id="first_name" class="input" value="<?php echo esc_attr($first_name); ?>" size="25" /></label>
     </p>
	 
     <p>
         <label for="last_name"><?php _e('Last Name') ?><br />
         <input type="text" name="last_name" id="last_name" class="input" value="<?php echo esc_attr($last_name); ?>" size="25" /></label>
     </p>
     <?php
 }
	 
	 
    
      
function required_fields_user_register ($user_id) {
           if ( isset( $_POST['first_name'] ) ){
               update_user_meta($user_id, 'first_name', $_POST['first_name']);
		   }
		   
           if ( isset( $_POST['last_name'] ) ){
               update_user_meta($user_id, 'last_name', $_POST['last_name']);
		   }
       }