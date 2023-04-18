var editor = top.tinymce.activeEditor,
    selection = editor.selection,
    dom = editor.dom;
		console.log(selection);
$(document).ready(function () {
    function b() {
        $(".btn_insert")
            .removeClass("btn_insert")
            .click(function () {
                var d = $(this).attr("href"),
                    a = $(this).text();
                "" == $("input[name=title]").val() && $("input[name=title]").val(a);
                $("input[name=link]").val(d);
                $("input[name=tab]").is(":checked") || $("input[name=tab]").click();
                $("input[name=index]").is(":checked") && $("input[name=index]").click();
                $("#frm_link").submit();
                return !1;
            });
    }
    $(".btn_open_hide").click(function () {
        $(this).parents(".parent").addClass("hide");
        $($(this).attr("href")).removeClass("hide").find("input[type=text]:eq(0)").focus();
        return !1;
    });
    $("#btn_search").click(function () {
        var a = $("input[name=k]").val(),
            c = $("select[name=category_id]").val();
        $.ajax({
            type: "POST",
            url: "?mod=ajax&act=searchNews",
            data: { keyword: a, category_id: c },
            dataType: "html",
            success: function (e) {
                $("#wrap_search").html(e);
                $(".scoller").slimScroll({ height: "146px" });
                b();
                $("#wrap_search")
                    .find("a.btn_loadmore")
                    .unbind()
                    .click(function () {
                        var e = $(this).attr("data-page");
                        $(this).attr("data-page", e + 1);
                        var f = $(this).parents("tr");
                        $.ajax({
                            type: "POST",
                            url: "?mod=ajax&act=searchNews&page=" + e,
                            data: { iClass: "news", keyword: a, category_id: c },
                            dataType: "html",
                            success: function (a) {
                                a ? (f.before(a), b(), $(".scoller").slimScroll({ height: "146px" })) : f.remove();
                            },
                        });
                        return !1;
                    });
            },
            error: function (a, d) {
                alert(" Can't do because: " + d);
            },
        });
        $(this).blur();
    });
    (function () {
        if (jQuery().uniform) {
            var a = $("input[type=checkbox]:not(.toggle), input[type=radio]:not(.toggle, .star)");
            0 < a.size() &&
                a.each(function () {
                    0 == $(this).parents(".checker").size() && ($(this).show(), $(this).uniform());
                });
        }
    })();
    var c = isOnlyTextSelected(),
        g = selection.getNode(),
        a = dom.getParent(g, "a[href]"),
        e = a ? a.innerText || a.textContent : selection.getContent({ format: "text" }),
        g = a ? dom.getAttrib(a, "href") : "";
    $("input[name=title]").val(e);
    $("input[name=link]").val(g);
    a && ("_blank" != dom.getAttrib(a, "target") && $("input[name=tab]").click(), "nofollow" != dom.getAttrib(a, "rel") && $("input[name=index]").click());
    $("#frm_link").submit(function () {
        var d = $("input[name=link]").val();
        if ("" == d) return editor.execCommand("unlink"), editor.windowManager.close(), !1;
        if ("mailto:" != d.substr(0, 7) && !isValidUrl(d)) return editor.windowManager.alert("B\u1ea1n nh\u1eadp li\u00ean k\u1ebft kh\u00f4ng \u0111\u00fang \u0111\u1ecbnh d\u1ea1ng. Vui l\u00f2ng nh\u1eadp l\u1ea1i."), !1;
        var b = null;
        $("input[name=tab]").is(":checked") && (b = "_blank");
        var f = null;
        $("input[name=index]").is(":checked") && (f = "nofollow");
        e = $("input[name=title]").val() ? $("input[name=title]").val() : e;
        d = { href: d, rel: f, target: b };
        a
            ? (editor.focus(), c && ("innerText" in a ? (a.innerText = e) : (a.textContent = e)), dom.setAttribs(a, d), selection.select(a), editor.undoManager.add())
            : c
            ? editor.insertContent(dom.createHTML("a", d, dom.encode(e)))
            : editor.execCommand("mceInsertLink", !1, d);
        editor.windowManager.close();
        return !1;
    });
});
function isValidUrl(b) {
    return /^(http|https|ftp):\/\/[a-z0-9]+([\-\.]{1}[a-z0-9]+)*\.[a-z]{2,5}(:[0-9]{1,5})?(\/.*)?$/i.test(b) ? !0 : !1;
}
function isOnlyTextSelected(b) {
    var c = selection.getContent();
    if (/</.test(c) && (!/^<a [^>]+>[^<]+<\/a>$/.test(c) || -1 == c.indexOf("href="))) return !1;
    if (b) {
        b = b.childNodes;
        if (0 === b.length) return !1;
        for (c = b.length - 1; 0 <= c; c--) if (3 != b[c].nodeType) return !1;
    }
    return !0;
}
