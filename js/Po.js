function createPo() {
    event.preventDefault();

    var po_textarea = $("#po-textarea").val();
    if (po_textarea.length <= 1000) {
        $.post(
            "po/create-po",
            { "po-textarea": po_textarea },
            function (data) {
                if (data === "notlogin") {
                    alert("尚未登入");
                    reloadIndex();
                } else if (data === "format") {
                    alert("字元長度不合法");
                } else if (data === "db" || data === "tpl") {
                    alert("發布貼文失敗");
                } else {
                    try {
                        var data = JSON.parse(data);
                        po_panel_html = String.format(data.po_panel_html, data.po_id, data.user_name, data.content);
                        po_panel_jq = $(po_panel_html);
                        $("#po-panel-list").prepend(po_panel_jq);
                        $("#po-textarea").val("");

                        po_panel_jq.find(".edit-po-btn").on("click", editPo);
                        po_panel_jq.find(".delete-po-btn").on("click", deletePo);
                    } catch (error) {
                        alert(error);
                    }
                }
            }
        ).fail(function () {
            alert("poText fail");
        });
    }
    else {
        alert("字元長度不合法");
    }
}

function editPo() {
    var id = $(this).parent().siblings().first().val();
    var po_text = $("#po-panel-text-" + id).text();

    showModal(
        "編輯貼文",
        po_text,
        true,
        "更新",
        function () {
            var new_text = $("#modal-text").val();

            if (new_text.length > 0 && new_text.length <= 1000) {
                $.post(
                    "po/update-po",
                    {
                        "po-id": id,
                        "po-text": new_text,
                    },
                    function (data) {
                        var po_id = id;
                        if (data === "success") {
                            $("#po-panel-text-" + po_id).text(new_text);
                        } else if (data === "notlogin") {
                            alert("您尚未登入");
                            reloadIndex();
                        } else if (data === "permission") {
                            alert("您無權限編輯該文章");
                        } else if (data === "fail") {
                            alert("編輯文章失敗");
                        }
                    }
                ).fail(function () {
                    alert("editPo fail");
                });
            } else {
                alert("字元長度不合法");
            }
        }
    );
}

function deletePo() {
    var id = $(this).parent().siblings().first().val();

    showModal(
        "警告",
        "確定要刪除嗎?",
        false,
        "刪除",
        function () {
            $.post(
                "po/delete-po",
                { "po-id": id },
                function (data) {
                    //var po_id = id;
                    //alert()
                    if (data === "success") {
                        $("#" + "po-panel-" + id).remove();
                    } else if (data === "notlogin") {
                        alert("您尚未登入");
                        reloadIndex();
                    } else if (data === "permission") {
                        alert("您無權限刪除該文章");
                    } else if (data === "fail") {
                        alert("刪除文章失敗");
                    }
                }
            ).fail(function () {
                alert("deletePo fail");
            });
        }
    );
}
