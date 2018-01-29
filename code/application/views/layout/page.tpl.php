<div>

    <div class="pagination">
        <span class="pagination-list left mg-r">共有<?php e($page['count']) ?>条，每页显示：<?php e($page['pagenums']) ?>条</span>
        <?php if ($page['curr'] != 1) { ?>
            <span class="pagination-list left">
                                      <a href="#" onclick="ChangeParam('page',<?php e($page['curr'] - 1) ?>)">
                                          <i class="fa fa-angle-double-left" aria-hidden="true"></i>
                                      </a>
                                  		</span>
        <?php }
        for ($i = 1; $i <= $page['pages']; $i++) { ?>
            <span class="pagination-list left"><a <?php if ($i == $page['curr']) e('class="paging"'); ?> href="#"
                                                                                                         onclick="ChangeParam('page',<?php e($i) ?>)"><?php e($i) ?></a></span>
        <?php }
        if ($page['curr'] != $page['pages']) { ?>
            <span class="pagination-list left">
                                      <a href="#" onclick="ChangeParam('page',<?php e($page['curr'] + 1) ?>)">
                                          <i class="fa fa-angle-double-right" aria-hidden="true"></i>
                                      </a>
                                  		</span>
        <?php } ?>
    </div>
</div>
<script>
    function ChangeParam(name, value) {
        var url = window.location.href;
        var newUrl = "";
        var reg = new RegExp("(^|)" + name + "=([^&]*)(|$)");
        var tmp = name + "=" + value;
        if (url.match(reg) != null) {
            newUrl = url.replace(eval(reg), tmp);
        }
        else {
            if (url.match("[\?]")) {
                newUrl = url + "&" + tmp;
            }
            else {
                newUrl = url + "?" + tmp;
            }
        }
        location.href = newUrl;
    }
</script>