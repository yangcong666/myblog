<?php
	$options[] = array( "name" => "Footer",
   						"sicon" => "footer.png",
						"type" => "heading");

    $options[] = array( "name" => "Footer Copyright Info",
    					"desc" => "You can change the footer copyright area.",
						"id" => $shortname."_copyright",
						"std" => "&copy; Copyright 2011 Diary/Notebook Theme by Site5.com. All Rights Reserved. ",
						"type" => "textarea");

    $options[] = array( "name" => "Stats",
    					"sicon" => "stats.png",
						"type" => "heading");

    $options[] = array( "name" => "Google Analytics code:",
    					"desc" => "You can use google analytics or other stats code in this area it will appear in the source.",
						"id" => $shortname."_analytics",
						"std" => "",
						"type" => "textarea");
?>