function reloadIndex() {
    event.preventDefault();
    window.location.replace("index");
}

function showModal(title, text, contenteditable, ok_name, onOK) {
    $(".modal-title").text(title);

    var modal_text;
    if(contenteditable)
    {
        $("#modal-p").hide();
        modal_text = $("#modal-text");
        modal_text.val(text);
        modal_text.show();
    }
    else
    {
        $("#modal-text").hide();
        modal_text = $("#modal-p");
        modal_text.text(text);
        modal_text.show();
    }
    
    modal_text.attr("contenteditable", contenteditable);

    var ok_btn = $("#modal-ok-btn");
    ok_btn.text(ok_name);
    ok_btn.off();
    ok_btn.click(onOK);
}

String.format = function () {
    var s = arguments[0];
    for (var i = 0; i < arguments.length - 1; i++) {
        var reg = new RegExp("\\{" + i + "\\}", "gm");
        s = s.replace(reg, arguments[i + 1]);
    }
    return s;
}

$(".navbar-brand").on("click", reloadIndex);
$("#navbar-login-btn").on("click", showLoginForm);
$("#navbar-register-btn").on("click", showRegisterForm);
$("#navbar-logout-btn").on("click", logoutConfirm);

$("#form-po-text").on("submit", createPo);

$(".edit-po-btn").on("click", editPo);
$(".delete-po-btn").on("click", deletePo);