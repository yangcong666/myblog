<div id="search_form">
  <form role="search" method="get" id="searchform" class="searchform" action="<?php echo get_option('home'); ?>/">
    <div class="search_form_bg clearfix">
      <input type="text" value="<?php echo get_search_query();?>" name="s" id="s" placeholder="请输入关键词" x-webkit-speech>
      <input type="submit" id="searchsubmit" value="">
    </div>
  </form>
</div>
