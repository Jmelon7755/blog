// Register

function showRegisterForm() {
    $("#main").load("html/register.html", function () {
        $("#register-form").submit(function (event) {
            register();
            event.preventDefault();
        });
        $("#login-register-btn").attr("href", "javascript: showRegisterForm()");
    });
    event.preventDefault();
}

function register() {
    var Name = $("#name").val();
    var Account = $("#account").val();
    var Password = $("#password").val();
    var PasswordConfirm = $("#password-confirm").val();

    var validation = true;
    if (Name.length <= 0 || Name.length > 15) {
        $("#name-warning").text("字元長度不合法!");
        validation = false;
    }

    if (!Account.match(/^[a-zA-Z0-9.!#$%&’*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/) && !Account.match(/^09\d{8}$/)) {
        $("#account-warning").text("字元不合法，手機請以「09」開頭");
        validation = false;
    }

    if (!Password.match(/^\w{6,15}$/)) {
        $("#password-warning").text('密碼長度介於6~15，只能使用大小字母、數字以及底線');
        validation = false;
    }

    if (Password != PasswordConfirm) {
        $("#password-confirm-warning").text('與密碼設定不符');
        validation = false;
    }

    if (validation) {
        $.post(
            "user/register",
            {
                "name": Name,
                "account": Account,
                "password": Password
            },
            function (data) {
                if (data === "success") {
                    showLoginForm();
                    alert("註冊成功，請登入");
                } else if (data === "format") {
                    $("#register-failed").text('欄位輸入不合法');
                } else if (data === "exist") {
                    $("#register-failed").text('已存在相同帳號');
                } else if (data === "fail") {
                    alert("註冊失敗!");
                }
            }
        ).fail(function () {
            alert("register fail");
        });
    }

    return false;
}

//login

function showLoginForm() {
    $("#main").load("html/login.html", function () {
        $("#login-form").submit(function (event) {
            login();
            event.preventDefault();
        });
        $("#login-register-btn").attr("href", "javascript: showRegisterForm()");
    });
    event.preventDefault();
}

function login() {
    var Account = $("#account").val();
    var Password = $("#password").val();

    var validation = true;

    if (!Account.match(/^[a-zA-Z0-9.!#$%&’*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/) && !Account.match(/^09\d{8}$/)) {
        $("#account-warning").text("字元不合法，手機請以「09」開頭");
        validation = false;
    }

    if (!Password.match(/^\w{6,15}$/)) {
        $("#password-warning").text('密碼長度介於6~15，只能使用大小字母、數字以及底線');
        validation = false;
    }

    if (validation) {
        $.post(
            "user/login",
            {
                "account": Account,
                "password": Password
            },
            function (data) {
                if (data === "success") {
                    reloadIndex("index");
                }
                else if (data === "format") {
                    $("#login-failed").text('帳號或密碼格式錯誤');
                }
                else if (data === "fail") {
                    $("#login-failed").text('帳號或密碼錯誤');
                }
                else
                    alert(data);
            }
        ).fail(function () {
            alert("login fail");
        });
    }

    return false;
}

//logout

function logoutConfirm() {
    showModal(
        "警告",
        "確定登出嗎?",
        false,
        "登出",
        logout
    );
    event.preventDefault();
}

function logout() {
    $.post(
        "user/logout",
        function (data) {
            if (data === "success") {
                location.reload();
            }
            else if (data === "fail") {
                alert("登出失敗");
            }
        }
    ).fail(function () {
        alert("logout fail");
    });
}