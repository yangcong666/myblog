<section class="ori-tools">
    <div class="toast">
        <button class="btn btn-clear float-right"></button>
        <p></p>
    </div>
    <div class="modal modal-sm">
        <a class="modal-overlay"></a>
        <div class="modal-container">
            <div class="modal-header">
                <div class="modal-title h5"></div>
            </div>
            <div class="modal-body">
                <div class="content"></div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-primary confirm"><?php echo __("确认", "origami"); ?></button>
                <button class="btn btn-link cancel"><?php echo __("取消", "origami"); ?></button>
            </div>
        </div>
    </div>
    <div id="toc-button" class="tools-item" title="<?php echo __("显示文章目录(点击显示或隐藏)", "origami"); ?>">
        <i class="fa fa-indent fa-2x" aria-hidden="true"></i>
        <div class="toc"></div>
    </div>
    <div id="qrcode" class="tools-item" title="<?php echo __("阅读转移", "origami"); ?>">
        <div id="qrcode-img"></div>
        <i class="fa fa-laptop fa-2x" aria-hidden="true"></i>
    </div>
    <div id="paper-plane" class="tools-item" title="<?php echo __("乘上通往云端的纸飞机吧", "origami") ?>">
        <i class="fa fa-paper-plane-o fa-2x"></i>
    </div>
    <div class="paper-plane-mask" title>
        <div class="paper-plane-content">
            <div class="paper-plane-title"><?php echo __("更换主题", "origami"); ?></div>
            <ul class="paper-plane-body grid-md"></ul>
            <button class="btn btn-primary btn-action s-circle left"><i class="icon icon-arrow-left"></i></button>
            <button class="btn btn-primary btn-action s-circle right"><i class="icon icon-arrow-right"></i></button>
            <button class="btn btn-link close"><i class="icon icon-cross"></i></button>
        </div>
        <div class="paper-plane-img">
            <img class="airplane" src="<?php echo get_template_directory_uri() .
              "/image/origami.png"; ?>">
        </div>
    </div>
    <div id="if-to-start">
        <span><?php echo __("已跳转到上次阅读的位置，从头阅读？", "origami"); ?></span>
        <a class="btn" href="javascript:notToStart();"><?php echo __("否", "oirgami"); ?></a>
        <a class="btn" href="javascript:toStart();"><?php echo __("是", "oirgami"); ?></a>
    </div>
    <div id="live-chat">
        <ul class="live-chat-list">
        </ul>
        <div class="live-chat-input">
            <i class="icon icon-arrow-left"></i>
            <input type="text" class="form-input" placeholder="<?php echo __("输入昵称与大佬们交流", "oirgami"); ?>">
            <button class="btn"><?php echo __("开始搞事", "oirgami"); ?></button>
        </div>
    </div>
</section>