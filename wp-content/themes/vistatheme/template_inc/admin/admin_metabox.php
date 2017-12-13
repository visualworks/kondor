<?php		

 	$layers = array();
    // Get WPDB Object
    global $wpdb;
 
    // Table name
    $table_name = $wpdb->prefix . "layerslider";
 	if($wpdb->get_var("show tables like '$table_name' ") == $table_name) {
    // Get sliders
    	$sliders = $wpdb->get_results( "SELECT * FROM $table_name
                                        WHERE flag_hidden = '0' AND flag_deleted = '0'
                                        ORDER BY date_c ASC LIMIT 100" );

    
	    foreach($sliders as $key => $item) {
	 
	        $layers[$item->name] = $item->id-1;
	    }
	}



    $revsliders = array();
    // Get WPDB Object
    global $wpdb;
 
    // Table name
    $table_name = $wpdb->prefix . "revslider_sliders";
 
    if($wpdb->get_var("show tables like '$table_name' ") == $table_name) {
       

    $sliders = $wpdb->get_results( "SELECT * FROM $table_name
                                        
                                        ORDER BY id ASC LIMIT 100" );

    
    if(count($sliders) > 0):
	    foreach($sliders as $key => $item) {
	 
	        $revsliders[$item->title] = $item->alias;
	    }
    endif;
	}


$boxes = array( 
	array( 'title' =>  __('Layout', 'themeple'), 'id'=>'layout' , 'page'=>array('post','page', 'product'), 'context'=>'side', 'priority'=>'low' ),
    
    array( 'title' =>  __('Slideshow Options', 'themeple'), 'id'=>'slideshow_meta', 'page'=>array('page', 'portfolio'), 'context'=>'normal', 'priority'=>'high' ),
    array( 'title' =>  __('Page Header', 'themeple'), 'id'=>'page_header', 'page'=>array('page', 'product'), 'context'=>'normal', 'priority'=>'high' ),
    
	//array( 'title' =>  __('Slideshow Options', 'themeple'), 'id'=>'slideshow_meta_portfolio', 'page'=>array('portfolio'), 'context'=>'normal', 'priority'=>'high' ),
	array( 'title' =>  __('Portfolio SIngle Options', 'themeple'), 'id'=>'portfolio_single_options' , 'page'=>array('portfolio'), 'context'=>'normal', 'priority'=>'high' ),
	array( 'title' =>  __('Media - Add any number images and videos for the slider', 'themeple'), 'id'=>'media' , 'page'=>array('post','page','portfolio', 'gallery', 'projectslide'), 'context'=>'normal', 'priority'=>'high' ),					 
	array( 'title' =>  __('Media - Add any number images and videos for the slider', 'themeple'), 'id'=>'media_serv' , 'page'=>array('services'), 'context'=>'normal', 'priority'=>'high' ),
	array( 'title' => __('Project Info', 'themeple'), 'id'=>'project_info', 'page'=>array('projectslide'), 'context'=>'normal', 'priority'=>'high' ),
	array( 'title' => __('Testimonial Options', 'themeple'), 'id'=>'testimonial_options', 'page'=>array('testimonial'), 'context'=>'normal', 'priority'=>'high' ),
	array( 'title' =>  __('Social Links', 'themeple'), 'id'=>'social_links' , 'page'=>array('staff'), 'context'=>'normal', 'priority'=>'high' ),
	array( 'title' =>  __('Post Options', 'themeple'), 'id'=>'post_options' , 'page'=>array('post'), 'context'=>'normal', 'priority'=>'high' ),
	array( 'title' =>  __('Meta Fields', 'themeple'), 'id'=>'meta_fields' , 'page'=>array('staff'), 'context'=>'normal', 'priority'=>'high' ),
	array( 'title' => __('Position', 'themeple'), 'id'=>'staff_position', 'page'=>array('staff', 'testimonial'), 'context'=>'normal', 'priority'=>'high' ),
	array( 'title' =>  __('Services Options', 'themeple'), 'id'=>'services_options' , 'page'=>array('services'), 'context'=>'normal', 'priority'=>'high' ),
	array( 'title' =>  __('Faq Options', 'themeple'), 'id'=>'faq_options' , 'page'=>array('faq'), 'context'=>'normal', 'priority'=>'high' ),
	array( 'title' =>  __('Navigation Header', 'themeple'), 'id'=>'navigation_header' , 'page'=>array('page', 'post', 'portfolio'), 'context'=>'normal', 'priority'=>'high' ),
);

								
$elements = array(

				

				
				
array(	
					"slug"	=> "layout",
					"name" 	=> __("Select Page layout", 'themeple'),
					"desc" 	=> "",
					"id" 	=> "layout",
					"type" 	=> "select",
					"std" 	=> "",
					"hook" 	=> 'on_save_layout_dynamic_save',
					"no_first"=>true,
					"subtype" => array( 	
											'Predefined Templates' => array(
											'Use global default' => "",
											'Left sidebar' =>'sidebar_left',
											'Right sidebar'=>'sidebar_right',
											'Fullwidth'=>'fullsize'
											),
											
											'Dynamic Templates' => themeple_admin_get_dynamic_templates('dynamic_template-')
											
										)),		
				
		
		
		array(	
		"name" 	=> __("Which Slider do you want to use?", 'themeple'),
		"desc" 	=> "Select one of defined sliders. Default flexslider" ,
		"id" 	=> "_slideshow_type",
		"type" 	=> "select",
		"slug"  => "slideshow_meta",
		"subtype" => array('Layer Slider'=>'layer_slider', "Revolution Slider" => 'revolution', 'Flexslider'=>'flexslider','Swiper Slider' => 'swiper_slider', 'Image Thumbnails' => 'image_thumbnails', 'Vertical Slider' => 'vertical_slider', 'News Slider' => 'news_slider', 'Featured News' => 'featured_news')),
		
		array(	
		"name" 	=> __("Slideshow Layout", 'themeple'),
		"desc" 	=> "" ,
		"id" 	=> "_slideshow_layout",
		"type" 	=> "radioimage",
		"std" 	=> "fixed",
		"slug"  => "slideshow_meta",
		
		"subtype"           => array( 
                                                  array('name' => 'Fixed to page layout', 'value' =>'fixed', 'img' => 'boxed.png'),
                                                  array('name' => 'Full Width', 'value' =>'fullwidth', 'img' => '90x62/fullwidth.png')
                                    )
		),
		

		
		array(	
		"name" 	=> __("Do you want Padding from the top ?", 'themeple'),
		"desc" 	=> "" ,
		"id" 	=> "padding_slide",
		"type" 	=> "switchbutton",
		"std" 	=> "yes",
		"slug"  => "slideshow_meta",
		"required" => array("_slideshow_layout", 'fixed')
		
		
		),

		


		array(	
		"name" 	=> __("Select one of the sliders you have created", 'themeple'),
		"desc" 	=> "" ,
		"id" 	=> "_slideshow_layer_slider",
		"type" 	=> "select",
		"std" 	=> "flexslider",
		"slug"  => "slideshow_meta",
		"no_first" => true,
		"required" => array('_slideshow_type', 'layer_slider'),
		"subtype" => $layers),

		array(	
		"name" 	=> __("Select one of the sliders you have created", 'themeple'),
		"desc" 	=> "" ,
		"id" 	=> "_slideshow_revolution",
		"type" 	=> "select",
		"std" 	=> "flexslider",
		"slug"  => "slideshow_meta",
		"no_first" => true,
		"required" => array('_slideshow_type', 'revolution'),
		"subtype" => $revsliders),

		array(	
		"name" 	=> __("Do you want to add Nested Sliders?", 'themeple'),
		"id" 	=> "nested_bool",
		"type" 	=> "switchbutton",
		"std" 	=> "no",
		"slug"  => "slideshow_meta",
		"required" => array('_slideshow_type', 'swiper_slider'),
		),

		array(
			"name" => __("Nested Sliders", 'themeple'),

			"type" => "layout_section",

			"id" => "swiper_nested",

			"slug"  => "slideshow_meta",

			"removable" => "remove element",
			
			"required" => array('nested_bool', 'yes'),
			
			"subelements" => array(

				array(
						"desc" => __('Select the Page from where you want to get the images for this nested slider', 'themeple'),
						"name" => __('Select the Page', 'themeple'),
						"type" => "select",
						"subtype" => 'page',
						"required" => array('nested_bool', 'yes'),
						"id"	=> "page"

					),

				array(
						
						"name" => __('Change the Order', 'themeple'),
						"type" => "input_text",
						"std" => "2",
						"required" => array('nested_bool', 'yes'),
						"id"	=> "order"

					),

				array(
						
						"name" => __('Layout', 'themeple'),
						"type" => "select",
						"no_first" => true,
						"std" => "semi",
						"id"	=> "layout",
						"required" => array('nested_bool', 'yes'),
						"subtype" => array("Semi Column" => 'semi', 'Full Column' => 'full')

					)
			)
		),

	array(	
		"name" 	=> __("How much images (columns) to show in one row?", 'themeple'),
		"desc" 	=> "" ,
		"id" 	=> "vertical_col",
		"type" 	=> "select",
		"std" 	=> 2,
		"slug"  => "slideshow_meta",
		"no_first" => true,
		"required" => array('_slideshow_type', 'vertical_slider'),
		"subtype" => array("1" => 1, "2" => 2, "3" => 3 ) ),
	array(	
		"name" 	=> __("How much rows?", 'themeple'),
		"desc" 	=> "" ,
		"id" 	=> "vertical_row",
		"type" 	=> "select",
		"std" 	=> 4,
		"slug"  => "slideshow_meta",
		"no_first" => true,
		"required" => array('_slideshow_type', 'vertical_slider'),
		"subtype" => array( "2" => 2, "3" => 3, "4" => 4 ) ),

	array(	
		"name" 	=> __("Which Slider do you want to use?", 'themeple'),
		"desc" 	=> "Select one of defined sliders. Default flexslider" ,
		"id" 	=> "_slideshow_type",
		"type" 	=> "select",
		"slug"  => "slideshow_meta_portfolio",
		"no_first" => true,
		"subtype" => array( 'Flexslider'=>'flexslider')),
		

		array(	"name" 	=>  "Featured Media",
							"id" 	=>  "slideshow",
							"type" 	=> "upload_gallery",
							"slug"  => "media",
							"nodescription" => true,
							"label"	=> "Add to slideshow",
							"button_video"	=>"Add Video or Iframe by URL",
							'subelements' 	=> array(	
							
    							array(	"name" 	=> "Featured Media",
    							"desc" 	=> 	"",
    							"id" 	=>  "slideshow_image",
    							"type" 	=> "gallery_image",
    							"slug"  => "media",
    							"nodescription" => true,
    							"subtype" => "advanced",
    							"label"	=> "Insert"),
    							
    							array(	"name" 	=> "",
    							"desc" 	=> 	"",
    							"id" 	=>  "slideshow_video",
    							"type" 	=> "input_text",
    							"class"	=> "slideshow_video_input",
    							"slug"  => "media",
    							"simple"=> true,
    							"class"=> 'slideshow_video_input',
    							"nodescription" => true),
							array(	"name" 	=> "Animation First Caption",
    							"desc" 	=> 	"",
    							"id" 	=>  "slideshow_description",
    							"type" 	=> "input_text",
    							"class"	=> "",
    							"slug"  => "media",
    							"simple"=> true,
    							
    							"nodescription" => false),
							array(	"name" 	=> "Animation Second Caption",
    							"desc" 	=> 	"",
    							"id" 	=>  "slideshow_description_2",
    							"type" 	=> "input_text",
    							"class"	=> "",
    							"slug"  => "media",
    							"simple"=> true,
    							
    							"nodescription" => false),

							array(	"name" 	=> "Text Thumbnail Title",
    							"desc" 	=> 	"",
    							"id" 	=>  "text_thumb_title",
    							"type" 	=> "input_text",
    							"class"	=> "",
    							"slug"  => "media",
    							"simple"=> true,
    							"required" => array('_slideshow_type', 'flex_text_thumbnail'),
    							"nodescription" => false),

							array(	"name" 	=> "Text Thumbnail Desc",
    							"desc" 	=> 	"",
    							"id" 	=>  "text_thumb_desc",
    							"type" 	=> "textarea",
    							"class"	=> "",
    							"slug"  => "media",
    							"simple"=> true,
    							"required" => array('_slideshow_type', 'flex_text_thumbnail'),
    							"nodescription" => false),

							
							array(	"slug"	=> "media", "type" => "visual_group_start", "id" => "group1", "nodescription" => true),
								
								
								array(	"slug"	=> "media", "type" => "visual_group_start", "id" => "group1", "nodescription" => true,'name'=>'Default Options'),
	
								
								
										
								
							            
							    array(	"slug"	=> "media", "type" => "visual_group_end", "id" => "tab1_end", "nodescription" => true),
							    
							    
								
								
								
		    							    
							   
							   
							  array(	"slug"	=> "media", "type" => "visual_group_end", "id" => "tab_container_end", "nodescription" => true),
	
							)
						),
							

			
			
		array(	
		"name" 	=> __("Select the big featured post", 'themeple'),
		"desc" 	=> "" ,
		"id" 	=> "big_featured",
		"type" 	=> "select",
		"slug"  => "slideshow_meta",
		"no_first" => true,
		"required" => array('_slideshow_type', 'featured_news'),
		"subtype" => 'post' ),
		array(	
		"name" 	=> __("Select the first smallest box", 'themeple'),
		"desc" 	=> "" ,
		"id" 	=> "small_box_1",
		"type" 	=> "select",
		"slug"  => "slideshow_meta",
		"no_first" => true,
		"required" => array('_slideshow_type', 'featured_news'),
		"subtype" => 'post' ),
		array(	
		"name" 	=> __("Select the second smallest box", 'themeple'),
		"desc" 	=> "" ,
		"id" 	=> "small_box_2",
		"type" 	=> "select",
		"slug"  => "slideshow_meta",
		"no_first" => true,
		"required" => array('_slideshow_type', 'featured_news'),
		"subtype" => 'post' )
			
			
		
);

$elements[] = 	array(	"name" 	=>  "Featured Media",
							"id" 	=>  "slideshow",
							"type" 	=> "upload_gallery",
							"slug"  => "media_serv",
							"nodescription" => true,
							"label"	=> "Add to slideshow",
							"button_video"	=>"Add Video or Iframe by URL",
							'subelements' 	=> array(	
							
    							array(	"name" 	=> "Featured Media",
    							"desc" 	=> 	"",
    							"id" 	=>  "slideshow_image",
    							"type" 	=> "gallery_image",
    							"slug"  => "media_serv",
    							"nodescription" => true,
    							"subtype" => "advanced",
    							"label"	=> "Insert"),
    							
    							
							
							
								array(	"slug"	=> "media_serv", "type" => "visual_group_start", "id" => "group1", "nodescription" => true),
								
								
								array(	"slug"	=> "media_serv", "type" => "visual_group_start", "id" => "group2", "nodescription" => true,'name'=>'Default Options'),
	
								array(	
										"name" 	=> "Write here the link of video if you want to display a video on lightbox",
		    							"desc" 	=> 	"",
		    							"id" 	=>  "slideshow_video",
		    							"type" 	=> "input_text",
		    							"slug"  => "media_serv"
		    							),
								
										
								
							            
							    array(	"slug"	=> "media_serv", "type" => "visual_group_end", "id" => "group2_end", "nodescription" => true),
							    
							    
								
								
								
		    							    
							   
							   
							  	array(	"slug"	=> "media_serv", "type" => "visual_group_end", "id" => "group1_end", "nodescription" => true),
	
							)
						);

$elements[] =	array(
					"type" 			=> "input_text", 
					"id" 			=> "facebook_link", 
                    "name"          => __("Facebook Link", 'themeple'),
					"slug"			=> "social_links");

$elements[] =	array(
					"type" 			=> "input_text", 
					"id" 			=> "twitter_link", 
                    "name"          => __("Twitter Link", 'themeple'),
					"slug"			=> "social_links");
$elements[] =	array(
					"type" 			=> "input_text", 
					"id" 			=> "google_link", 
                    "name"          => __("Google Plus Link", 'themeple'),
					"slug"			=> "social_links");
$elements[] =	array(
					"type" 			=> "input_text", 
					"id" 			=> "linkedin_link", 
                    "name"          => __("Linkedin Link", 'themeple'),
					"slug"			=> "social_links");
$elements[] =	array(
					"type" 			=> "input_text", 
					"id" 			=> "pinterest_link", 
                    "name"          => __("Piterest Link", 'themeple'),
					"slug"			=> "social_links");  
$elements[] =	array(
					"type" 		=> "input_text", 
					"id" 			=> "mail_link", 
                    "name"          => __("Mail Address", 'themeple'),
					"slug"			=> "social_links");


$elements[] =	array(
					"type" 			=> "input_text", 
					"id" 			=> "staff_position_", 
                    "name"          => __("The position of the employer", 'themeple'),
					"slug"			=> "staff_position");
$elements[] =	array(
					"type" 			=> "input_text", 
					"id" 			=> "small_title", 
                    "name"          => __("Small Title @ TOP", 'themeple'),
					"slug"			=> "testimonial_options");

$elements[] =	array(
					"type" 			=> "radioimage", 
					"id" 			=> "service_image", 
                    "name"          => __("The position of the image you have selected as feature image", 'themeple'),
					"slug"			=> "services_options",
					"std" => "right",
					"subtype"           => array( 
                                                     array('name' => 'Left Side', 'value' =>'left', 'img' => '90x62/imageleft.png'),
                                                     array('name' => 'Right Side', 'value' =>'right', 'img' => '90x62/imageright.png'),
                                                )
);

$elements[] =	array(
					"type" 			=> "input_text", 
					"id" 			=> "header_top", 
                    "name"          => __("Header text on the top?", 'themeple'),
					"slug"			=> "header_options"
);

$elements[] =	array(
					"type" 			=> "select", 
					"id" 			=> "header_type", 
                    "name"          => __("Select the style that you want to display the content before the slideshow", 'themeple'),
					"slug"			=> "header_options",
					"subtype"		=> array("First Format" => 'v1', 'Second Format' => "v2", 'Only a colored line' => "v3")
					);

$elements[] =	array(
					"type" 			=> "input_text", 
					"id" 			=> "biggest_title", 
                    "name"          => __("Biggest Title", 'themeple'),
					"slug"			=> "header_options",
					"required"		=> array("header_type", "v1")
);

$elements[] =	array(
					"type" 			=> "input_text", 
					"id" 			=> "second_title", 
                    "name"          => __("Second Title", 'themeple'),
					"slug"			=> "header_options",
					"required"		=> array("header_type", "v1")
);

$elements[] =	array(
					"type" 			=> "textarea", 
					"id" 			=> "right_description", 
                    "name"          => __("Right Description", 'themeple'),
					"slug"			=> "header_options",
					"required"		=> array("header_type", "v1")
);

$elements[] =	array(
					"type" 			=> "input_text", 
					"id" 			=> "link_title", 
                    "name"          => __("Link Title", 'themeple'),
					"slug"			=> "header_options",
					"required"		=> array("header_type", "v1")
);

$elements[] =	array(
					"type" 			=> "input_text", 
					"id" 			=> "link_href", 
                    "name"          => __("Link", 'themeple'),
					"slug"			=> "header_options",
					"required"		=> array("header_type", "v1")
);

$elements[] =	array(
					"type" 			=> "input_text", 
					"id" 			=> "title_1", 
                    "name"          => __("Title 1", 'themeple'),
					"slug"			=> "header_options",
					"required"		=> array("header_type", "v2")
);

$elements[] =	array(
					"type" 			=> "iconset", 
					"id" 			=> "icon_1", 
                    "name"          => __("Icon 1", 'themeple'),
					"slug"			=> "header_options",
					"required"		=> array("header_type", "v2")
);




$elements[] =	array(
					"type" 			=> "input_text", 
					"id" 			=> "title_2", 
                    "name"          => __("Title 2", 'themeple'),
					"slug"			=> "header_options",
					"required"		=> array("header_type", "v2")
);

$elements[] =	array(
					"type" 			=> "iconset", 
					"id" 			=> "icon_2", 
                    "name"          => __("Icon 2", 'themeple'),
					"slug"			=> "header_options",
					"required"		=> array("header_type", "v2")
);



$elements[] =	array(
					"type" 			=> "input_text", 
					"id" 			=> "title_3", 
                    "name"          => __("Title 3", 'themeple'),
					"slug"			=> "header_options",
					"required"		=> array("header_type", "v2")
);

$elements[] =	array(
					"type" 			=> "iconset", 
					"id" 			=> "icon_3", 
                    "name"          => __("Icon 3", 'themeple'),
					"slug"			=> "header_options",
					"required"		=> array("header_type", "v2")
);


$elements[] =	array(
					"type" 			=> "input_text", 
					"id" 			=> "title_4", 
                    "name"          => __("Title 4", 'themeple'),
					"slug"			=> "header_options",
					"required"		=> array("header_type", "v2")
);

$elements[] =	array(
					"type" 			=> "iconset", 
					"id" 			=> "icon_4", 
                    "name"          => __("Icon 4", 'themeple'),
					"slug"			=> "header_options",
					"required"		=> array("header_type", "v2")
);



$elements[] =	array(
					"type" 			=> "switchbutton", 
					"id" 			=> "page_header_bool", 
					"std"			=> "yes",
                    "name"          => __("Do you want page Header?", 'themeple'),
					"slug"			=> "page_header");


$elements[] = 	array(
	                "type" 		    => "select", 
					"id" 			=> "header_type", 
					"std"			=> "image",
					"no_first"      => true,
                    "name"          => __("Background Color or Background Image ?", 'themeple'),
                    "subtype"		=> array('Background Color' => 'color', 'Background Image' => 'image'),
                    "required"      => array('page_header_bool', 'yes'),
					"slug"			=> "page_header");

$elements[] = 	array(
	                "type" 		    => "colorpicker", 
					"id" 			=> "color_pick", 
					"std"			=> "#f7f7f7",
                    "name"          => __("Select the color", 'themeple'),
                    "required"      => array('header_type', 'color'),
					"slug"			=> "page_header");


$elements[] = 	array(
	                "type" 		    => "upload", 
	                "btn_text"		=> "Upload",
					"id" 			=> "background_image", 
					"std"			=> THEMEPLE_BASE_URL."img/vista_page_header.png",
                    "name"          => __("Upload The Background", 'themeple'),
                    "required"      => array('header_type', 'image'),
					"slug"			=> "page_header");

$elements[] = 	array(
	                "type" 		    => "select", 
	                "subtype"		=> array("Centered" => 'centered', 'Full' => 'full'),
					"id" 			=> "centered", 
					"std"			=> "full",
                    "name"          => __("Centered or full?", 'themeple'),
                    "required"      => array('header_type', 'image'),
					"slug"			=> "page_header");

$elements[] = 	array(
	                "type" 		    => "colorpicker", 
					"id" 			=> "font_color", 
					"std"			=> "#818284",
                    "name"          => __("Select the font color", 'themeple'),
                    "required"      => array('page_header_bool', 'yes'),
					"slug"			=> "page_header");

$elements[] = 	array(
	                "type" 		    => "select", 
					"id" 			=> "header_overwrite", 
					"std"			=> "default",
                    "name"          => __("Overwrite the default header", 'themeple'),
                    "desc"			=> "Here you can overwrite the default header selected in Theme Options",
                    "no_first"		=> true,
                    "subtype"		=> array("Leave Default"=> 'default', "Header 1" => "header_1", "Header 2" => "header_2", "Header 3" => "header_3", "Header 4" => "header_4", "Header 5" => "header_5"),
					"slug"			=> "navigation_header");

$elements[] =	array(
					"type" 			=> "input_text", 
					"id" 			=> "author_project", 
					"std"			=> "",
                    "name"          => __("Project Author", 'themeple'),
					"slug"			=> "project_info");

$elements[] =	array(
					"type" 			=> "input_text", 
					"id" 			=> "post_author_name", 
					"std"			=> "",
                    "name"          => __("Post Author Name", 'themeple'),
					"slug"			=> "post_options");

$elements[] =	array(
					"type" 			=> "upload", 
					"id" 			=> "post_author_img", 
					"btn_text"      => "Upload",
					"std"			=> THEMEPLE_BASE_URL.'img/author_.png',
                    "name"          => __("Post Author Photo", 'themeple'),
					"slug"			=> "post_options");

$elements[] =	array(
					"type" 			=> "textarea", 
					"id" 			=> "post_author_desc", 
					"std"			=> "",
                    "name"          => __("Post Author Description", 'themeple'),
					"slug"			=> "post_options");



$portfolio_metas = themeple_get_option('portfolio-meta', array(array('meta'=>'Client'), array('meta'=>'Skills'), array('meta'=>'URL')));

$counter = 0;
foreach($portfolio_metas as $p_meta)
{
	if(!empty($p_meta['meta']))
	{

		$counter ++;
        $elements[] = array(    
                                   "name"    => $p_meta['meta'],
                                   "slug"    => "portfolio-meta",
                                   "desc"    => "",
                                   "id"      => "meta_$counter",
                                   "std"     => "",
                                   "type"    => "textarea");	
       
       	
        
      

	}
}
$elements[] = array(    
                                   "name"    => "Select Page Builder Template",
                                   "slug"    => "portfolio_single_options",
                                   "desc"    => "",
                                   "id"      => "dynamic_top",
                                   "std"     => "",
                                   "type"    => "select",
                                   "subtype" => themeple_admin_get_dynamic_templates('dynamic_template-'));
$boxes[]    = array( 'title' =>  __('Portfolio Meta Information', 'themeple'), 'id'=>'portfolio-meta' , 'page'=>array('portfolio'), 'context'=>'normal', 'priority'=>'high' );

