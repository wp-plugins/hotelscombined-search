<?php
/*
Plugin Name: HotelsCombined Search Widget
Plugin URI: http://widgets.hotelscombined.com/
Description: Displays the HotelsCombined Search Widget on Your Sidebar
Version: 1.0
Author: Gary Young
Author URI: http://www.webnexsys.com

-----------------------------------------------------
Copyright 2010  Hotelscombined.com  (email : gary@webnexsys.com)

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
-----------------------------------------------------

See readme file for change-logs.
*/

// This gets called at the plugins_loaded action
function widget_hcsearch_init() {
	
	// Check for the required API functions
	if ( !function_exists('register_sidebar_widget') || !function_exists('register_widget_control') ){
		return;	
	}

	// This saves options and prints the widget's config form.
	function widget_hcsearch_control() {
		$options = $newoptions = get_option('widget_hcsearch');
		if ( $_POST['hcsearch-submit'] ) {
			$newoptions['title'] = $_POST['hcsearch-title'];
			$newoptions['a_aid'] = (int) $_POST['hcsearch-a_aid'];
			$newoptions['brand_id'] = (int) $_POST['hcsearch-brand_id'];			
			$newoptions['label'] = $_POST['hcsearch-label'];						
			$newoptions['city_idx'] = (int) $_POST['hcsearch-city_idx'];
			$newoptions['customurl'] = strtolower($_POST['hcsearch-customurl']);
		}

        $validCustomUrl = true;
        if($newoptions['customurl'] != ''){
            if(!preg_match('|^http(s)?://[a-z0-9-]+(.[a-z0-9-]+)*(:[0-9]+)?(/.*)?$|i', $newoptions['customurl'])){
                $validCustomUrl = false;
                unset($newoptions['customurl']);
            }
        }

		if ( $options != $newoptions ) {
			$options = $newoptions;
			update_option('widget_hcsearch', $options);
		}
		?>
		<div style="text-align:right">
		    <p style="text-align:left;"><label for="hcsearch-intro">HotelsCombined Search Widget</label></p>
			<label for="hcsearch-title" style="line-height:35px;display:block;">Title: <input type="text" id="hcsearch-title" name="hcsearch-title" value="<?php echo ($options['title']); ?>" /></label>
			<label for="hcsearch-width" style="line-height:35px;display:block;">Affiliate Id:<input style="width: 100px;" type="text" id="hcsearch-a_aid" name="hcsearch-a_aid" value="<?php echo ($options['a_aid']); ?>" /></label>
			<label for="hcsearch-width" style="line-height:35px;display:block;">Brand Id:<input style="width: 100px;" type="text" id="hcsearch-brand_id" name="hcsearch-brand_id" value="<?php echo ($options['brand_id']); ?>" /></label>
			<label for="hcsearch-width" style="line-height:35px;display:block;">Label:<input style="width: 100px;" type="text" id="hcsearch-label" name="hcsearch-label" value="<?php echo ($options['label']); ?>" /></label>
			<label for="hcsearch-height" style="line-height:35px;display:block;">Skin: 
			    <select name="hcsearch-city_idx" value="<?php echo ($options['city_idx']);?>">
<?php			    if($options['city_idx'] == '0'){ ?>
			        <option selected value="0">New York (Blue)</option>
<?php               } else { ?>
    		        <option value="0">New York (Blue)</option>
<?php               } ?>
<?php			    if($options['city_idx'] == '1'){ ?>
			        <option selected value="1">Bangkok (Bright Pink)</option>			        
<?php               } else { ?>
			        <option value="1">Bangkok (Bright Pink)</option>			        
<?php               } ?>
<?php			    if($options['city_idx'] == '2'){ ?>
			        <option selected value="2">Sydney (Light Blue)</option>			        			        
<?php               } else { ?>
			        <option value="2">Sydney (Light Blue)</option>			        			            
<?php               } ?>    			        
<?php			    if($options['city_idx'] == '3'){ ?>
			        <option selected value="3">Berlin (Orange)</option>			        			        			        
<?php               } else { ?>			        
			        <option value="3">Berlin (Orange)</option>    
<?php               } ?>    
<?php			    if($options['city_idx'] == '4'){ ?>
			        <option selected value="4">Dubai (Purple)</option>
<?php               } else { ?>			        			 
			        <option value="4">Dubai (Purple)</option>       
<?php               } ?>        
<?php			    if($options['city_idx'] == '5'){ ?>
			        <option selected value="5">Hong Kong (Light Blue)</option>
<?php               } else { ?>	
			        <option value="5">Hong Kong (Light Blue)</option>    
<?php               } ?>            			       
<?php			    if($options['city_idx'] == '6'){ ?> 
			        <option selected value="6">Paris (Orange)</option>
<?php               } else { ?>				        
			        <option value="6">Paris (Orange)</option>    
<?php               } ?>            			        
<?php			    if($options['city_idx'] == '7'){ ?>    
			        <option selected value="7">London (Blue)</option>
<?php               } else { ?>				        	
			        <option value="7">London (Blue)</option>    
<?php               } ?>            			            		        
			    </select>
			</label>
			<label for="hcsearch-width" style="line-height:35px;display:block;">Custom URL:<input style="width: 200px;" type="text" id="hcsearch-customurl" name="hcsearch-customurl" value="<?php echo ($options['customurl']); ?>" /></label>
			<?php 
			if(!$validCustomUrl){
?>
            <label style="line-height:17px;display:block;color:red;">Please enter a valid URL.</label>
<?php			    
			}
			?>
			<label style="line-height:17px;display:block;">Please enter custom URL if applicable. Otherwise, leave blank</label>
			<input type="hidden" name="hcsearch-submit" id="hcsearch-submit" value="1" />
		</div>
		<?php
	}

	// This prints the widget
	function widget_hcsearch($args) {	
		extract($args);
		$defaults = array('title' => 'HotelsCombined Search', 'a_aid' => '20032', 'brand_id' => '1', 'label' => '', 'city_idx' => '2', 'customurl' => '');
		$options = (array) get_option('widget_hcsearch');

		//If the user has not yet set the options or set them empty, take the defaults
		foreach ( $defaults as $key => $value ){
			if (!isset($options[$key])){
				$options[$key] = $defaults[$key];	
			}
		}
		
		$title = $options['title'];
		$a_aid = $options['a_aid'];
		$brand_id = $options['brand_id'];				
		$label = $options['label'];						
		$city_idx = $options['city_idx'];				
		$customurl = strtolower($options['customurl']);						
		$width = 204;
		$height = 222;
		if($label){
		    $url = 'http://static.hotelscombined.com.s3.amazonaws.com/widgets/WordPressSearch/wordpress_widget.html?city_idx=' . $city_idx . "&a_aid=" . $a_aid . "&brand_id=" . $brand_id . "&label=" . $label;		
		} else {
		    $url = 'http://static.hotelscombined.com.s3.amazonaws.com/widgets/WordPressSearch/wordpress_widget.html?city_idx=' . $city_idx . "&a_aid=" . $a_aid . "&brand_id=" . $brand_id;				    
		}
		if(($customurl != '') && (preg_match('|^http(s)?://[a-z0-9-]+(.[a-z0-9-]+)*(:[0-9]+)?(/.*)?$|i', $customurl))){
		    $url .= "&customurl=" . urlencode($customurl);
		}
		?>
		<?php echo $before_widget . $before_title . $title . $after_title; ?>
		<iframe style="overflow: hidden;" frameborder="0" scrolling=”no” marginwidth=”0” marginheight=”0” src="<?php echo $url; ?>" width="<?php echo $width; ?>px" height="<?php echo $height; ?>px"></iframe>
		<?php echo $after_widget; ?>
		<?php
	}

	// Tell Dynamic Sidebar about our new widget and its control
	register_sidebar_widget('HotelsCombined Search Widget', 'widget_hcsearch');
	register_widget_control('HotelsCombined Search Widget', 'widget_hcsearch_control');
}

//Converts all the occurances of [hcsearch][/hcsearch] to hcsearch HTML tags
function widget_hcsearch_on_page($text){
	$regex = '#\[hcsearch]((?:[^\[]|\[(?!/?hcsearch])|(?R))+)\[/hcsearch]#';
	if (is_array($text)) {
		//Read the AssociateID/CityIndex Parameters, if given
	    $param = explode(",", $text[1]);
		if(isset($param[0]) && !is_nan($param[0])){
			$a_aid = $param[0];
		} else {
		    $a_aid = '20032';
		}
		if(isset($param[1]) && !is_nan($param[1])){
			$city_idx = $param[1];
		} else {
		    $city_idx = '2';
		}
		
		$brand_id = false;
		if(isset($param[2]) && !is_nan($param[2])){
			$brand_id = $param[2];
		}
		
		$label = false;
		if(isset($param[3])){
			$label = $param[3];
		}
		
		$customurl = '';
		if(isset($param[4])){
			$customurl = strtolower($param[4]);
		}
		
		$width = 204;
		$height = 222;
		if($brand_id && $label){
		    $url = 'http://static.hotelscombined.com.s3.amazonaws.com/widgets/WordPressSearch/wordpress_widget.html?city_idx=' . $city_idx . "&a_aid=" . $a_aid . "&brand_id=" . $brand_id . "&label=" . $label;
		} else if($brand_id){
		    $url = 'http://static.hotelscombined.com.s3.amazonaws.com/widgets/WordPressSearch/wordpress_widget.html?city_idx=' . $city_idx . "&a_aid=" . $a_aid . "&brand_id=" . $brand_id;			
		} else {
		    $url = 'http://static.hotelscombined.com.s3.amazonaws.com/widgets/WordPressSearch/wordpress_widget.html?city_idx=' . $city_idx . "&a_aid=" . $a_aid;		    
		}
		if(($customurl != '') && (preg_match('|^http(s)?://[a-z0-9-]+(.[a-z0-9-]+)*(:[0-9]+)?(/.*)?$|i', $customurl))){
		    $url .= "&customurl=" . urlencode($customurl);
		}
		//generate the iframe tag
        $text = '<iframe style="overflow: none;" scrolling=”no” marginwidth=”0” marginheight=”0” frameborder="0" src="' . $url . '" width="' . $width . '" height="' . $height . '"></iframe>';
    }
	return preg_replace_callback($regex, 'widget_hcsearch_on_page', $text);
}

// Delay plugin execution to ensure Dynamic Sidebar has a chance to load first
add_action('plugins_loaded', 'widget_hcsearch_init');
add_filter('the_content', 'widget_hcsearch_on_page');
?>