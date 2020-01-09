/**
 * File navigation.js.
 *
 * Handles toggling the navigation menu for small screens
 */
( function() {
	var container, button_menu, button_search, menu, links, i, len;

	// 获取容器
	container = document.body.querySelector( '#site-navigation' );
	if ( ! container ) {
		return;
	}

	// 获取菜单按钮和搜索按钮
	button_menu = container.querySelector( '.menu-toggle' );
	button_search = container.querySelector( '.search-toggle' );
	if ( 'undefined' === typeof button_menu || 'undefined' === typeof button_search ) {
		return;
	}

	// 获取菜单界面和搜索界面
	menu = container.querySelector( '.blog-menu' );
	search = container.querySelector( '.blog-search' );

	// 如果菜单界面和搜索界面都为空或者函数提前返回，则隐藏菜单按钮和搜索按钮
	if ( 'undefined' === typeof menu || 'undefined' === typeof search ) {
		button_menu.style.display = 'none';
		button_search.style.display = 'none';
		return;
	}

	// 易用性
	menu.setAttribute( 'aria-expanded', 'false' );
	search.setAttribute( 'aria-expanded', 'false' );

	// 菜单按钮事件
	button_menu.onclick = function() {
		if ( -1 !== container.className.indexOf( 'search-toggled' ) ) {
			container.className = container.className.replace( ' search-toggled', '' );
		}
		if ( -1 !== container.className.indexOf( 'menu-toggled' ) ) {
			container.className = container.className.replace( ' menu-toggled', '' );
			button_menu.setAttribute( 'aria-expanded', 'false' );
			menu.setAttribute( 'aria-expanded', 'false' );
		} else {
			container.className += ' menu-toggled';
			button_menu.setAttribute( 'aria-expanded', 'true' );
			menu.setAttribute( 'aria-expanded', 'true' );
		}
	};

 	// 搜索按钮事件
	button_search.onclick = function() {
		if ( -1 !== container.className.indexOf( 'menu-toggled' ) ) {
			container.className = container.className.replace( ' menu-toggled', '' );
		}
		if ( -1 !== container.className.indexOf( 'search-toggled' ) ) {
			container.className = container.className.replace( ' search-toggled', '' );
			button_search.setAttribute( 'aria-expanded', 'false' );
			search.setAttribute( 'aria-expanded', 'false' );
		} else {
			container.className += ' search-toggled';
			button_search.setAttribute( 'aria-expanded', 'true' );
			search.setAttribute( 'aria-expanded', 'true' );
		}
	};

} )();
