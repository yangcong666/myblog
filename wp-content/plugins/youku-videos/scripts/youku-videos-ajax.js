jQuery(document).ready(function(jQuery){

	var cat = ykc.category,
		action_html = '<div class="alignleft actions"><select name="cat-actions" id="cat-actions" class="postform"><option value="-1">查看所有分类目录</option>';
		
	jQuery.each(cat, function(){
		var _ = jQuery(this)[0],
			t = ( jQuery("#myListTable").attr("cataction") == _.ID) ? ' selected="selected"' : "";

		action_html += '<option'+t+' value="'+_.ID+'">'+_.name+'</option>';
	});		
		
	action_html += 	'</select><input type="submit" name="ykc-return-to-cat" id="post-query-submit" class="button" value="筛选"></div>';	
	
	console.log(action_html);
	
	jQuery("div.tablenav.top .tablenav-pages").before(action_html);
	
	jQuery(".ykc-edit").click(function(e){
		
		jQuery(".ykc-edit-content").remove();
	
		jQuery("#the-list tr.ykchidden").first().removeClass("ykchidden").children().show();
	
		var _tr = jQuery(this).closest("tr"),
			cat_html = '<select id="ykc-youkucat" name="category">',
			cat_id = jQuery(this).attr("catid");
			
		jQuery.each(cat, function(){
			var _ = jQuery(this)[0],
				t = (cat_id == _.ID) ? ' selected="selected"' : "";
				console.log(_[0]);
			cat_html += '<option'+t+' value="'+_.ID+'">'+_.name+'</option>';
		});

		cat_html += '</select>';
			
		_tr.children().hide();
		
		var _t = jQuery('<div class="ykc-edit-content"><h4>快速编辑</h4><div class="clearfix"><label class="left"><span>标题</span><span class="input-text-wrap"><input type="text" name="post_title" id="ykc-youkutitle" class="regular-text code" value="'+jQuery(this).attr("yktitle")+'"></span></label></td><td class="column-category"><label class="left-cat-id left"><span>分类</span><span class="input-text-wrap">'+cat_html+'</span></label></div><p class="clearfix"><input type="hidden" id="ykc-youkuid" value="'+jQuery(this).attr("youkuid")+'" /><a accesskey="c" href="javascript:void(0);" class="button-secondary ykc-cancel alignleft">取消</a><span class="pding"></span><a accesskey="s" href="javascript:void(0);" class="button-primary ykc-save alignleft">更新</a><span class="ykc-loading"></span></p></div>').appendTo(_tr);
		
		
		
		_t.css({
			width: _tr.width() - 80
		});_tr.addClass("ykchidden");
	});
	
	jQuery("#the-list").on("click", ".ykc-cancel", function(){
		jQuery(".ykc-edit-content").remove();
	
		jQuery("#the-list tr.ykchidden").first().removeClass("ykchidden").children().show();		
	});
	
	
	jQuery("#the-list").on("click", ".ykc-save", function(){
		var cat_name = jQuery("#ykc-youkucat").find("option:selected").text(),
			title = jQuery("#ykc-youkutitle").val(),
			cat_id = jQuery("#ykc-youkucat").val(),
			video_id = jQuery("#ykc-youkuid").val();

		jQuery.ajax({
			url: ykc.ajax_url,
			data: {
				"action": "ykv-edit-video",
				"title": title,
				"video_id": video_id,
				"cat_id": cat_id
			},
			type: "POST",
			beforeSend: function(){
				jQuery(".ykc-loading").show()
			},
			success: function(){
				var a = jQuery("#the-list tr.ykchidden").first().find(".title.column-title"),
					b = jQuery("#the-list tr.ykchidden").first().find(".category.column-category"),
					c = a.children("span.title").children("a"),
					d = a.find(".ykc-edit");
				
				c.text(title);		
				b.text(cat_name);
				
				d.attr({
					"yktitle" : title,
					"catid" : cat_id
				});
				
				jQuery(".ykc-edit-content").remove();
				jQuery("#the-list tr.ykchidden").first().removeClass("ykchidden").children().show();					
			}
		});		
	});	
	
});