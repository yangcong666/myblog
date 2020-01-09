<?php

if( ! class_exists( 'WP_List_Table' ) ) {
    require_once( ABSPATH . 'wp-admin/includes/class-wp-list-table.php' );
}

class YKV_List_Table extends WP_List_Table {

    function __construct(){
		global $status, $page;

			parent::__construct( array(
				'ajax'      => false        //does this table support ajax?
		) );         

    }

  function no_items() {
    _e( '该分类下暂无视频' );
  }

  function column_default( $item, $column_name ) {
   global $YKV;
	$category = $YKV->category; 
	$cat_id = $item["category"] ? $item["category"] : 1;
	$cat_name = $category[$cat_id]["name"];	
    switch( $column_name ) { 
        case 'title':
			return sprintf( '<a href="%s" target="_blank">%s</a>', $video_link, $item[ $column_name ] );
			break;
		case 'strtime':
            return $item[ $column_name ];
			break;
		case 'category':
			return $YKV->the_cat_link($cat_name, $cat_id);
			break;
		case 'created':  
			return date("Y-m-d G:i", $item[ $column_name ]);
			break;			
        default:
            return sprintf( $item, true ) ; //Show the whole array for troubleshooting purposes
    }
  }

function get_sortable_columns() { 
  $sortable_columns = array(
    'title'  => array('title',false),
	'category'  => array('category',false),
    'created' => array('created',false),
	'strtime' => array('strtime',false)
  );
  return $sortable_columns;
}

function get_columns(){
        $columns = array(
            'cb'        => '<input type="checkbox" />',
            'title' => __( '视频标题' ),
			'category' => __( '视频分类' ),
            'created'    => __( '发布时间' ),
            'strtime'      => __( '视频时长' )
        );
        return $columns;
    }
	
function usort_reorder( $a, $b ) {
  // If no sort, default to title
  $orderby = ( ! empty( $_GET['orderby'] ) ) ? $_GET['orderby'] : 'title';
  // If no order, default to asc
  $order = ( ! empty($_GET['order'] ) ) ? $_GET['order'] : 'asc';
  // Determine sort order
  $result = strcmp( $a[$orderby], $b[$orderby] );
  // Send final sort direction to usort
  return ( $order === 'asc' ) ? $result : -$result;
}

function column_title($item){
	global $YKV;
	$cat_id = $item['category'] ? $item['category'] : 0;
	$video_id = $item["ID"];
	$video_hash = $item["youkuid"];
	$video_link = $YKV->the_video_link($video_id, $video_hash);
  $actions = array(
	'delete'=> sprintf('<a href="?page=%s&action=%s&videoid=%s">删除</a>', $_REQUEST['page'], 'ykv-delete', $item['ID']),
	'edit' => sprintf('<a href="javascript:void(0);" class="ykc-edit" yktitle="%s" youkuid="%s" catid="%s">快速编辑</a>', $item['title'], $item['ID'], $cat_id)
	);
  return sprintf('<span class="title"><a href="%1$s" target="_blank">%2$s</a></span> %3$s', $video_link, $item['title'], $this->row_actions($actions) );
}

function get_bulk_actions() {
  $actions = array(
    'ykv-delete'    => '删除'
  );
  return $actions;
}

function column_cb($item) {
        return sprintf(
            '<input type="checkbox" name="videoid[]" value="%s" />', $item['ID']
        );    
    }

function prepare_items($catid) {
  global $YKV;

  $videos = $YKV->the_video($catid);
  $total_items = count($videos);
   
  $columns  = $this->get_columns();

  $hidden   = array();
  $sortable = $this->get_sortable_columns();
  $this->_column_headers = array( $columns, $hidden, $sortable );
  usort( $this->example_data, array( &$this, 'usort_reorder' ) );
  
  $per_page = 10;
  $current_page = $this->get_pagenum();


  // only ncessary because we have sample data
  $this->found_data =  array_slice( $videos,( ( $current_page-1 )* $per_page ), $per_page );
  
  $this->set_pagination_args( array(
    'total_items' => $total_items,                  //WE have to calculate the total number of items
    'per_page'    => $per_page                     //WE have to determine how many items to show on a page
  ) );
  $this->items = $this->found_data;
}

} //class