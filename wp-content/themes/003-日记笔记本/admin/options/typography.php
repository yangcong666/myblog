<?php
    $options[] = array( "name" => "Typography",
    					"sicon" => "font.png",
						"type" => "heading");
																															
	$options[] = array( "name" => "Blog Main Font Family:",
						"desc" => "You can set the blog main font",
                        "id" => $shortname."_main_font",
                        "std" => "",
                        "type" => "select",
						"options" => $defaultfonts_array);
						
	$options[] = array( "name" => "Blog Main Font Google Font Link:",
						"desc" => "If you use custom google fonts for main body this will be overwrite all main body fonts. Ex: &lt;link href='http://fonts.googleapis.com/css?family=Miniver' rel='stylesheet' type='text/css'&gt; Get it from <a href='http://www.google.com/webfonts'>Google Fonts</a>",
                        "id" => $shortname."_main_font_link",
                        "std" => "",
                        "type" => "textarea");
						
	$options[] = array( "name" => "Blog Main Google Font Family",
                        "desc" => "Ex: font-family: 'Droid Sans', sans-serif",
                        "id" => $shortname."_main_font_family",
                        "std" => "",
						"class" => "sectionlast",
                        "type" => "text");
																														
	$options[] = array( "name" => "Blog Title/ Logo Google Font Link:",
						"desc" => "Ex: &lt;link href='http://fonts.googleapis.com/css?family=Miniver' rel='stylesheet' type='text/css'&gt; Get it from <a href='http://www.google.com/webfonts'>Google Fonts</a>",
                        "id" => $shortname."_font_title_link",
                        "std" => "<link href='http://fonts.googleapis.com/css?family=Calligraffitti' rel='stylesheet' type='text/css'>",
                        "type" => "textarea");
						
	$options[] = array( "name" => "Blog Title/ Logo Google Font Family",
                        "desc" => "Ex: font-family: 'Droid Sans', sans-serif",
                        "id" => $shortname."_font_title_font",
                        "std" => "font-family: 'Calligraffitti', cursive;",
                        "type" => "text");
						
	$options[] = array( "name" => "Blog Title/ Logo Font size:",
						"desc" => "Leave blank for default, 40px",
                        "id" => $shortname."_font_title_size",
                        "std" => "40",
						"class" => "sectionlast",
                        "type" => "text");
						
	$options[] = array( "name" => "Post Date Google Font Link:",
						"desc" => "Ex: &lt;link href='http://fonts.googleapis.com/css?family=Miniver' rel='stylesheet' type='text/css'&gt; Get it from <a href='http://www.google.com/webfonts'>Google Fonts</a>",
                        "id" => $shortname."_font_date_link",
                        "std" => "",
                        "type" => "textarea");
						
	$options[] = array( "name" => "Post Date Google Font Family",
                        "desc" => "Ex: font-family: 'Droid Sans', sans-serif",
                        "id" => $shortname."_font_date_font",
                        "std" => "",
                        "type" => "text");
						
	$options[] = array( "name" => "Post Date Font size:",
						"desc" => "Leave blank for default, 26px",
                        "id" => $shortname."_font_date_size",
                        "std" => "26",
						"class" => "sectionlast",
                        "type" => "text");
												
	$options[] = array( "name" => "Post Read More Google Font Link:",
						"desc" => "Ex: &lt;link href='http://fonts.googleapis.com/css?family=Miniver' rel='stylesheet' type='text/css'&gt; Get it from <a href='http://www.google.com/webfonts'>Google Fonts</a>",
                        "id" => $shortname."_font_more_link",
                        "std" => "",
                        "type" => "textarea");
						
	$options[] = array( "name" => "Post Read More Google Font Family",
                        "desc" => "Ex: font-family: 'Droid Sans', sans-serif",
                        "id" => $shortname."_font_more_font",
                        "std" => "",
                        "type" => "text");
	
	$options[] = array( "name" => "Post Read More Font size:",
						"desc" => "Leave blank for default, 26px",
                        "id" => $shortname."_font_more_size",
                        "std" => "26",
						"class" => "sectionlast",
                        "type" => "text");
																	
	$options[] = array( "name" => "Post/Page Heading Google Font Link:",
						"desc" => "Ex: &lt;link href='http://fonts.googleapis.com/css?family=Miniver' rel='stylesheet' type='text/css'&gt; Get it from <a href='http://www.google.com/webfonts'>Google Fonts</a>",
                        "id" => $shortname."_font_heading_link",
                        "std" => "",
                        "type" => "textarea");

	$options[] = array( "name" => "Post/Page Heading Google Font Family",
                        "desc" => "Ex: font-family: 'Droid Sans', sans-serif",
                        "id" => $shortname."_font_heading_font",
                        "std" => "",
                        "type" => "text");
	
	$options[] = array( "name" => "Post/Page Heading Font size:",
						"desc" => "Leave blank for default, 28px",
                        "id" => $shortname."_font_heading_size",
                        "std" => "28",
						"class" => "sectionlast",
                        "type" => "text");	

	$options[] = array( "name" => "Sidebar Headings (H3) Google Font Link:",
						"desc" => "Ex: &lt;link href='http://fonts.googleapis.com/css?family=Miniver' rel='stylesheet' type='text/css'&gt; Get it from <a href='http://www.google.com/webfonts'>Google Fonts</a>",
                        "id" => $shortname."_font_sideheading_link",
                        "std" => "",
                        "type" => "textarea");
						
	$options[] = array( "name" => "Sidebar Headings (H3) Google Font Family",
                        "desc" => "Ex: font-family: 'Droid Sans', sans-serif",
                        "id" => $shortname."_font_sideheading_font",
                        "std" => "",
                        "type" => "text");
	
	$options[] = array( "name" => "Sidebar Headings (H3) Font size:",
						"desc" => "Leave blank for default, 16px",
                        "id" => $shortname."_font_sideheading_size",
                        "std" => "16",
                        "type" => "text");
										

?>