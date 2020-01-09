<?php

function page_admin_init() {

    //框体类型 repeatable、image、editor、textarea、text
		
		$page_custom_meta_fields = array(



			array( // 显示目的地中文名字
				'label'	=> esc_html__('SEO 信息', 'summerleaf'), // <label>
				'desc'	=> '为提高速度用一个字段保存。格式： SEO 标题||SEO 关键字||SEO 描述', // description
				'id'	=> 'seo_info', // field id and name
				'type'	=> 'textarea', // type of field
			),	
			

		
			
		);
		

	
		new custom_add_meta_box( 'page_custom_meta_fields', esc_html__('扩展信息', 'summerleaf'), $page_custom_meta_fields, 'page', true );
		

	}
	
	add_action( 'admin_init', 'page_admin_init' );