
<style>
  .tab-content {
    padding: 15px;
  }

  .btnupdate {
    padding: 5px 10px;
    width: 90px;
    text-align: center;
    margin-left: 15px;
  }

  .link {
    width: calc(100% - 105px);
    float: left;
  }

  .text-search {
    width: calc(100% - 105px);
    float: left;
  }

  #btn_search {
    width: 90px;
    margin-left: 15px;
  }

  #wrap_search {
    overflow: auto;
    width: auto;
    height: 146px;
  }
</style>

<div class="tab-content">
  <div id="menu2" class="tab-pane fade in active">
    <form role="form" action="" method="post" id="frm_link" class="parent">
      <div class="box-body">
        <div class="form-group">
          <input type="text" class="form-control" name="title" placeholder="Tiêu đề">
        </div>
        <div class="form-group">
          <label for="exampleInputPassword1">Liên kết</label>
          <div style="clear: both;"></div>
          <input type="text" class="form-control link" name="link" placeholder="http://example.com">
          <button type="submit" class="btn btn-primary btnupdate">Cập nhật</button>
        </div>

        <div class="checkbox">
          <label>
            <input type="checkbox" name="tab"> Mở liên kết trong tab mới(Target _blank)
          </label>
        </div>

        <div class="checkbox">
          <label>
            <input type="checkbox" name="index"> Chặn Google index link này (nofollow)
          </label>
        </div>
      </div>
    </form>
    <br>
    <a data-toggle="tab" href="#menu3">+ Liên kết bài viết có sẵn</a>
  </div>
  <div id="menu3" class="tab-pane fade">
    <div class="control-group">
      <div class="controls">
        <input type="text" class="m-wrap text-search form-control" name="k" placeholder="Từ khóa ..." />
        <button id="btn_search" type="button" class="btn btn-primary btntk">Tìm kiếm</button>
        <div style="clear: both;"></div>
      </div>
      <br>
      <div id="wrap_search" class="scoller"></div>
    </div>
    <br>
    <a data-toggle="tab" href="#menu2">+ Nhập địa chỉ đích</a>
  </div>
</div>


<script>

var editor = top.tinymce.activeEditor, selection = editor.selection, dom = editor.dom;
$(document).ready(function(){

    $('.btn_open_hide').click(function(){
        $(this).parents('.parent').addClass('hide');
        $($(this).attr('href')).removeClass('hide').find('input[type=text]:eq(0)').focus();
        return false;
    });

    $('#btn_search').click(function(){
        var keyword = $('input[name=k]').val();
        $.ajax({
    		type: "GET",
    		url: "/tinymce/search-news",
    		data:  {keyword: keyword},
    		dataType: "html",
    		success: function(msg){
    			$('#wrap_search').html(msg);
                js_event();

                $('#wrap_search').find('a.btn_loadmore').unbind().click(function(){
                    var page = $(this).attr('data-page'); $(this).attr('data-page', parseInt(page)+1);
                    var _this = $(this).parents('tr');
                    $.ajax({
                		type: "GET",
                		url: "/tinymce/search-news",
                		data:  { keyword: keyword, page: page},
                		dataType: "html",
                		success: function(msg){
                			if(msg) { _this.before(msg); js_event();}
                            else _this.remove();
                		}
                	});
                    return false;
                });

    		},
            error: function(request,error) {alert ( " Can't do because: " + error );}
    	});
        $(this).blur();
    });

    var handleUniform = function () {
        if (!jQuery().uniform) {
            return;
        }
        var test = $("input[type=checkbox]:not(.toggle), input[type=radio]:not(.toggle, .star)");
        if (test.size() > 0) {
            test.each(function () {
                if ($(this).parents(".checker").size() == 0) {
                    $(this).show();
                    $(this).uniform();
                }
            });
        }
    }
    handleUniform();

    var onlyText = isOnlyTextSelected();
    var selectedElm = selection.getNode();
    var anchorElm = dom.getParent(selectedElm, 'a[href]');
    var data_text = anchorElm ? (anchorElm.innerText || anchorElm.textContent) : selection.getContent({format: 'text'});
    var data_href = anchorElm ? dom.getAttrib(anchorElm, 'href') : '';
    $('input[name=title]').val(data_text);
    $('input[name=link]').val(data_href);

    if(anchorElm) {
        if(dom.getAttrib(anchorElm, 'target')!='_blank') $('input[name=tab]').click();
        if(dom.getAttrib(anchorElm, 'rel')!='nofollow') $('input[name=index]').click();
	}

    $('#frm_link').submit(function(){
        var link = $('input[name=link]').val(); if(link=='') {editor.execCommand('unlink'); editor.windowManager.close(); return false;}
        if(link.substr(0, 7)=='mailto:') {}
        else if(!isValidUrl(link)) {editor.windowManager.alert('Bạn nhập liên kết không đúng định dạng. Vui lòng nhập lại.'); return false;}
        var tab = null; if($('input[name=tab]').is(":checked")) tab = '_blank';
        var index = null; if($('input[name=index]').is(":checked")) index = 'nofollow';
        data_text = $('input[name=title]').val() ? $('input[name=title]').val() : data_text;

        var linkAttrs = {
			href: link,
            rel: index,
            target: tab
		};

        if(anchorElm) {
			editor.focus();
			if(onlyText) {
				if("innerText" in anchorElm) anchorElm.innerText = data_text;
                else anchorElm.textContent = data_text;
			}
			dom.setAttribs(anchorElm, linkAttrs);
			selection.select(anchorElm);
			editor.undoManager.add();
		}
        else {
            if(onlyText) editor.insertContent(dom.createHTML('a', linkAttrs, dom.encode(data_text)));
            else editor.execCommand('mceInsertLink', false, linkAttrs);
        }
        editor.windowManager.close();
        return false;
    });

    function js_event() {
        $('.btn_insert').removeClass('btn_insert').click(function(){
            var href = $(this).attr('href');
            var title = $(this).text();
            if($('input[name=title]').val()=='') $('input[name=title]').val(title);
            $('input[name=link]').val(href);
            if(!$('input[name=tab]').is(":checked")) $('input[name=tab]').click();
            if($('input[name=index]').is(":checked")) $('input[name=index]').click();
            $('#frm_link').submit();
            return false;
        });
    }

});
function isValidUrl(url){if(/^(http|https|ftp):\/\/[a-z0-9]+([\-\.]{1}[a-z0-9]+)*\.[a-z]{2,5}(:[0-9]{1,5})?(\/.*)?$/i.test(url)) return true;else return false;}
function isOnlyTextSelected(anchorElm) {
    var html = selection.getContent();if (/</.test(html) && (!/^<a [^>]+>[^<]+<\/a>$/.test(html) || html.indexOf('href=') == -1)) {return false;}
    if(anchorElm) {
        var nodes = anchorElm.childNodes, i;if (nodes.length === 0) {return false;}
        for (i = nodes.length - 1; i >= 0; i--) {if (nodes[i].nodeType != 3) {return false;}}
    }
    return true;
}


</script>
