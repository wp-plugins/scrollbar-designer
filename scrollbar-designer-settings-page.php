<?php 

add_action('admin_menu','scrollbar_designer_menu');

function scrollbar_designer_menu(){
	add_menu_page('Scrollbar Designer','Scrollbar Designer','administrator','st_option','scrollbar_designer_settings_form','', 16);
	add_action('admin_init', 'scrollbar_designer_register_settings');
}

function scrollbar_designer_register_settings(){

    register_setting('scrollbar-settings-group' , 'st_onoffswitch');
    register_setting('scrollbar-settings-group' , 'st_sb_color');
    register_setting('scrollbar-settings-group' , 'st_sb_width');
    register_setting('scrollbar-settings-group' , 'st_sb_border_size');
    register_setting('scrollbar-settings-group' , 'st_sb_border_style');
    register_setting('scrollbar-settings-group' , 'st_sb_border_color');
    register_setting('scrollbar-settings-group' , 'st_sb_border_radius');
    register_setting('scrollbar-settings-group' , 'st_rail_color_opacity');
    register_setting('scrollbar-settings-group' , 'st_onoffswitch_autohide');
    register_setting('scrollbar-settings-group' , 'st_sb_speed');
    register_setting('scrollbar-settings-group' , 'st_rail_align_switch');
    register_setting('scrollbar-settings-group' , 'st_sb_active_opacity');
    register_setting('scrollbar-settings-group' , 'st_sb_mouse_step');
    register_setting('scrollbar-settings-group' , 'st_smothscroll_switch');
    register_setting('scrollbar-settings-group' , 'st_bouncescroll_switch');
    register_setting('scrollbar-settings-group' , 'st_mouse_switch');
    

}

function scrollbar_custom_script() { 
    wp_enqueue_script('jquery');
    wp_register_script( 'script', plugins_url('js/jquery.nicescroll.min.js', __FILE__) );
    wp_enqueue_script( 'script', array('jquery') );
}add_action('wp_enqueue_scripts','scrollbar_custom_script');


function add_color_picker( $hook_suffix ) { //add colorpicker to options page
	wp_enqueue_script( 'wp-color-picker' );
	wp_enqueue_script( 'wp-color-picker-scripts', plugins_url( 'js/color-picker.js', __FILE__ ), array( 'jquery', 'wp-color-picker' ), false, true );
	wp_enqueue_style( 'wp-color-picker' );
}
add_action( 'admin_enqueue_scripts', 'add_color_picker' );

function scrollbar_designer_settings_form(){?>

<style>

    .onoffswitch {
        position: relative; width: 90px;
        -webkit-user-select:none; -moz-user-select:none; -ms-user-select: none;
    }
   td .onoffswitch-checkbox {
        display: none;
    }
    .onoffswitch-label {
        display: block; overflow: hidden; cursor: pointer;
        border: 2px solid #999999; border-radius: 20px;
    }
    .onoffswitch-inner {
        display: block; width: 200%; margin-left: -100%;
        transition: margin 0.1s ease-in 0s;
    }
    .onoffswitch-inner:before, .onoffswitch-inner:after {
        display: block; float: left; width: 50%; height: 30px; padding: 0; line-height: 30px;
        font-size: 14px; color: white; font-family: Trebuchet, Arial, sans-serif; font-weight: bold;
        box-sizing: border-box;
    }
    .onoffswitch-inner:before {
        content: "Yes";
        padding-left: 10px;
        background-color: #34A7C1; color: #FFFFFF;
    }
    .onoffswitch-inner:after {
        content: "No";
        padding-right: 10px;
        background-color: #EEEEEE; color: #999999;
        text-align: right;
    }
    .onoffswitch-switch {
        display: block; width: 18px; margin: 6px;
        background: #FFFFFF;
        position: absolute; top: 0; bottom: 0;
        right: 56px;
        border: 2px solid #999999; border-radius: 20px;
        transition: all 0.1s ease-in 0s; 
    }
    .onoffswitch-checkbox:checked + .onoffswitch-label .onoffswitch-inner {
        margin-left: 0;
    }
    .onoffswitch-checkbox:checked + .onoffswitch-label .onoffswitch-switch {
        right: 0px; 
    }


    .wrap th
 {
    color :#000000;
    font-size: 1em;
    padding-left: 10px;
    
 }


 .wrap td
 {
    padding-left: 40px;
 }


        *{
            box-sizing:inherit;
        }
        html{
            box-sizing:border-box;
        }

       html,
        body{
            margin: 0;
            padding: 0;
           /* font-family:sans-serif;
            font-weight:600;
            color:slategrey;*/
        }
        input[type=radio],
      input[type=checkbox] {
          display: none;
          visibility: hidden;
      }
     /* label{
        text-transform:uppercase;
      }*/
      label, label:before, .radio-switch, .radio-switch:before{
        -webkit-transition:all 140ms ease-in-out;
        transition:all 140ms ease-in-out;
          cursor:pointer;
          top: -16px;
      }
      ::selection{ background-color: transparent;}
    ::moz-selection{ background-color: transparent;}
    ::webkit-selection{ background-color: transparent;}
      .radio-group,
      .check-group {
          position: relative;
          padding: 5px;
      }
      .radio-group label {
          position: absolute;
          width: 120px;
          height: 44px;
          line-height:45px;
      }
      input[type=radio]:checked + label {
          z-index: -1;
      }
      /*
      input[type=radio] + label:first-of-type {
        color:#fa4;
      }
      input[type=radio] + label:last-of-type {
        color:#4af;
      }*/
      input[type=radio]:checked + label:first-of-type {
        color:#fa4;
      }
      input[type=radio]:checked + label:last-of-type {
        color:#4af;
      }
      .radio-group label:first-of-type span {
          float: left;
      }
      .radio-group label:last-of-type {
        margin-left:40px;
          float: right;
          text-align:right;
      }
      .radio-switch {
          position: absolute;
          z-index: -1;
          width: 80px;
          height: 44px;
          margin-left: 40px;
          border-radius: 30px;
          background-color: #fa4;
          padding: 2px;
      }
      .radio-switch:before {
          position: absolute;
          top: 2px;
          display: block;
          width: 40px;
          height: 40px;
          content: '';
          border-radius: 30px;
          background-color: #FFF;
      }
      input#cat:checked ~ .radio-switch {
          background-color: #4af;
      }
      input#cat:checked ~ .radio-switch:before {
          right: 2px;
      }


      input#cat1:checked ~ .radio-switch {
          background-color: #4af;
      }
      input#cat1:checked ~ .radio-switch:before {
          right: 2px;
      }

      input#cat2:checked ~ .radio-switch {
          background-color: #4af;
      }
      input#cat2:checked ~ .radio-switch:before {
          right: 2px;
      }

      input#cat3:checked ~ .radio-switch {
          background-color: #4af;
      }
      input#cat3:checked ~ .radio-switch:before {
          right: 2px;
      }

      input#cat4:checked ~ .radio-switch {
          background-color: #4af;
      }
      input#cat4:checked ~ .radio-switch:before {
          right: 2px;
      }



 .wrap h1
 {  text-align: center;
  padding-top: 20px;
  font-size: 4em;
  
 }
 .wrap h3
 {
  font-size: 1.7em;
  padding-top: 5px;
  padding-left: 10px;
 }

</style>

<div class='wrap'>
	<h1> <?php _e('Scrollbar Designer')?></h1>
	<h3> <?php _e('Get rid of boring scrollbar and make your own Custom Scrollbar for your website.  ')?></h3>
  <h3> <?php _e('My other plugin<a target="_blank" href="https://wordpress.org/plugins/login-page-styler">Login Page Styler</a> Recommended Plugin ')?></h3>

	<?php settings_errors(); ?>
       <form method="post" action="options.php" >
           <?php settings_fields('scrollbar-settings-group');?>
           <div id="headings-data">

           	<div id="hed3"><h3><?php _e('Scrollbar Settings') ?></h3></div>

           <table class="form-table">



		    <tr valign='top'>
				<th scope='row'><?php _e('Enable Plugin :');?></th>
				<td>
				    <div class="onoffswitch">
                     <input type="checkbox" name="st_onoffswitch" class="onoffswitch-checkbox"  id="myonoffswitch" value='1'<?php checked(1, get_option('st_onoffswitch')); ?> />
                     <label class="onoffswitch-label" for="myonoffswitch">
                     <span class="onoffswitch-inner"></span>
                     <span class="onoffswitch-switch"></span>
                     </label>
                    </div>


				</td>
			</tr>

            <tr vlaign='top'>
                <th scope='row'><?php _e('Scrollbar Cursor Color');?></th>
                <td><label for='st_sb_color'>
                    <input type='text' class='color_picker' id='st_sb_color' name='st_sb_color' value='<?php echo get_option('st_sb_color' ); ; ?>'/>
                    <p class="description"><?php _e('Change scrollbar color'); ?></p>
                </label>
                </td>
            </tr>

            <tr valign="top">
              <th scope="row"><?php _e('Scrollbar Cursor Width'); ?></th>
              <td><label for='st_sb_width'>
                  <input type='st_sb_width'  id='st_sb_width' name='st_sb_width' value='<?php echo get_option('st_sb_width') ;?> ' size='9'/>
                  <p class="description"><?php _e( 'Insert Scrollbar width. Default is 8px'); ?></p>
                 </lable>
             </td>
            </tr>

            <tr valign="top">
              <th scope="row"><?php _e('Scrollbar Cursor Border Style'); ?></th>
              <td><label for='st_sb_border_size'>
                  <input type='st_sb_border_size'  id='st_sb_border_size' name='st_sb_border_size' value='<?php echo get_option('st_sb_border_size') ;?> ' size='4'/>
                  <p class="description"><?php _e( ' Add Scrollbar Cursor Border width, Default is 1px'); ?></p>

                  </label></br>

                  <label for='st_sb_border_style'>
                  <select name='st_sb_border_style'>
                         <option value='none'   <?php selected( get_option('st_sb_border_style'),'none'); ?>   >None</option>
                         <option value='solid'  <?php selected( get_option('st_sb_border_style'),'solid'); ?>  >Solid</option>
                         <option value='dashed' <?php selected( get_option('st_sb_border_style'),'dashed'); ?> >Dashed</option>
                         <option value='dotted' <?php selected( get_option('st_sb_border_style'),'dotted'); ?> >Dotted</option>
                         <option value='double' <?php selected( get_option('st_sb_border_style'),'double'); ?> >Double</option>
                  </select>
                  <p class="description"><?php _e( 'Select Scrollbar Cursor Boarder Style.'); ?></p>
                  </label></br>
                  
                  <label for='st_sb_border_color'>
                  <input type='text' class='color_picker' id='st_sb_border_color' name='st_sb_border_color' value='<?php echo get_option('st_sb_border_color' ); ; ?>'/>
                  <p class="description"><?php _e( 'Select Scrollbar Cursor Border Color.'); ?></p>
                 </lable></br>
             </td>
            </tr>

             <tr valign="top">
              <th scope="row"><?php _e('Scrollbar Cursor Border Radius'); ?></th>
              <td><label for='st_sb_border_radius'>
                  <input type='st_sb_border_radius'  id='st_sb_border_radius' name='st_sb_border_radius' value='<?php echo get_option('st_sb_border_radius') ;?> ' size='9'/>
                  <p class="description"><?php _e( 'Insert Scrollbar border-radius. Default value is 1px'); ?></p>
                 </lable>
             </td>
            </tr>

            <tr>
                <th scope='row'><?php _e('Rail Color with Opacity');?></th>
                <td><label for='st_rail_color_opacity'>
                    <input type='text' id='st_rail_color_opacity' name='st_rail_color_opacity' value='<?php echo get_option('st_rail_color_opacity') ; ?>'/>
                    <p class='description'> <?php _e( 'Add RGBA color value eg: 255 , 255 , 255 ,0.5 last value in decimal is the Opacity .');?></p>
                    <p class='description'> <?php _e( 'Get RGBA color value here: <a href="http://www.css3-generator.de/rgba.html" target="_blank">RGBA Colors</a> .');?></p>
                </label>
                </td>
            </tr>


            <tr valign='top'>

                <th scope='row'><?php _e(' Auto Hide On Inactive');?></th>
                <td>
                 
                 <div class="radio-group">
                      <input type="radio" name="st_onoffswitch_autohide" id="dog" required checked value='false' <?php checked('false',get_option('st_onoffswitch_autohide')) ?> />
                      <label for="dog"><span>NO</span></label>
                      <input type="radio" name="st_onoffswitch_autohide" id="cat" value='true' <?php checked('true',get_option('st_onoffswitch_autohide')) ?> />
                      <label for="cat"><span>YES</span></label>
                      <div class="radio-switch"></div>

                 </div>
                     
                </td>
            </tr>


            <tr>
                <th scope='row'><?php _e('Scroll Speed');?></th>
                <td><label for='st_sb_speed'>
                    <input type='text' id='st_sb_speed' name='st_sb_speed' value='<?php echo get_option('st_sb_speed') ; ?>'/>
                    <p class='description'> <?php _e( 'Set scrollbar speed value , Default value is 60');?></p>
                </label>
                </td>
            </tr>


           <tr valign='top'>

                <th scope='row'><?php _e(' Scrollbar Rail Position');?></th>
                <td>
                 
                 <div class="radio-group">
                      <input type="radio" name="st_rail_align_switch" id="dog1"  value='left' <?php checked('left',get_option('st_rail_align_switch')) ?> />
                      <label for="dog1"><span>Left</span></label>
                      <input type="radio" name="st_rail_align_switch" id="cat1" required checked value='right' <?php checked('right',get_option('st_rail_align_switch')) ?> />
                      <label for="cat1"><span>Right</span></label>
                      <div class="radio-switch"></div>

                 </div>
                     
                </td>
            </tr>


             <tr>
                <th scope='row'><?php _e('Scrollbar Opacity When Active');?></th>
                <td><label for='st_sb_active_opacity'>
                    <input type='text' id='st_sb_active_opacity' name='st_sb_active_opacity' value='<?php echo get_option('st_sb_active_opacity') ; ?>'/>
                    <p class='description'> <?php _e( 'Set scrollbar speed value ,Range from 1 to 0  ,Default value is 1');?></p>
                </label>
                </td>
            </tr>


            <tr>
                <th scope='row'><?php _e('Mouse Scroll Step');?></th>
                <td><label for='st_sb_mouse_step'>
                    <input type='text' id='st_sb_mouse_step' name='st_sb_mouse_step' value='<?php echo get_option('st_sb_mouse_step') ; ?>'/>
                    <p class='description'> <?php _e( 'Set Mouse whele Scroll Step, Default is : 20 ');?></p>
                </label>
                </td>
            </tr>


            <tr valign='top'>

                <th scope='row'><?php _e(' Smoth Scroll');?></th>
                <td>
                 
                 <div class="radio-group">
                      <input type="radio" name="st_smothscroll_switch" id="dog2" required checked value='false' <?php checked('false',get_option('st_smothscroll_switch')) ?> />
                      <label for="dog2"><span>No</span></label>
                      <input type="radio" name="st_smothscroll_switch" id="cat2" value='true' <?php checked('true',get_option('st_smothscroll_switch')) ?> />
                      <label for="cat2"><span>Yes</span></label>
                      <div class="radio-switch"></div>

                 </div>
                     
                </td>
            </tr>


             <tr valign='top'>

                <th scope='row'><?php _e('Bounc Scroll');?></th>
                <td>
                 
                 <div class="radio-group">
                      <input type="radio" name="st_bouncescroll_switch" id="dog3" required checked value='false' <?php checked('false',get_option('st_bouncescroll_switch')) ?> />
                      <label for="dog3"><span>No</span></label>
                      <input type="radio" name="st_bouncescroll_switch" id="cat3" value='true' <?php checked('true',get_option('st_bouncescroll_switch')) ?> />
                      <label for="cat3"><span>Yes</span></label>
                      <div class="radio-switch"></div>

                 </div>
                     
                </td>
            </tr>



            <tr valign='top'>

                <th scope='row'><?php _e('Mouse Whele Scroll');?></th>
                <td>
                 
                 <div class="radio-group">
                      <input type="radio" name="st_mouse_switch" id="dog4"  value='false' <?php checked('false',get_option('st_mouse_switch')) ?> />
                      <label for="dog4"><span>No</span></label>
                      <input type="radio" name="st_mouse_switch" id="cat4" required checked value='true' <?php checked('true',get_option('st_mouse_switch')) ?> />
                      <label for="cat4"><span>Yes</span></label>
                      <div class="radio-switch"></div>

                 </div>
                     
                </td>
            </tr>


           </table>
            <p class="submit">
            <input type="submit" class="button-primary" value="<?php _e( 'Save Changes' ); ?>" />
        </p>
        </form>    

</div>


<?php }

function st_action_links( $links, $file ) {
  if ( $file == plugin_basename( dirname(__FILE__).'/scrollbar-designer.php' ) ) {
    $links[] = '<a href="' . get_bloginfo('url') . '/wp-admin/admin.php?page=st_option">Settings</a>';;
  }
  return $links;
}
add_filter('plugin_action_links','st_action_links' ,10,2);
 ?>