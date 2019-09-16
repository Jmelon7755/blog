<?php

namespace JBlog\Controller;

class UserController extends Controller
{
    static public function loginCheck()
    {
        return session_start() && isset($_SESSION["user-id"]);
    }

    public function login()
    {
        if (self::loginCheck())
            return "logined";

        $Account = $_POST["account"];
        $Password = $_POST["password"];

        //驗證
        $invalid = false;
        if (preg_match("/^[a-zA-Z0-9.!#$%&’*+\/\=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/", $Account)) {
            //使用信箱登入
            $invalid |= strlen($Account) > 30;
            $AccountType = "`email`";
        } else {
            //使用手機號碼登入
            $invalid |= !preg_match("/^09\d{8}$/", $Account);
            $AccountType = "`phone`";
        }
        $invalid |= !preg_match("/^\w{6,15}$/", $Password);
        if ($invalid) {
            return "invalid";
        }

        $Password = md5($Password);

        $sql_tool = $this->sql_tool;

        $sql_tool->sqlQueryPre(
            "SELECT * FROM `user` WHERE $AccountType=? And `password`=?",
            ['ss', &$Account, &$Password]
        );

        $result = $sql_tool->result;
        if (!$result || !($user = $result->fetch_object("JBlog\Model\User"))) {
            $sql_tool->close();
            return "fail";
        }

        // $user->setType('issssb');
        // return gettype($user->id)." ".gettype($user->administrator);

        // 將資料存入session
        $_SESSION["user-id"] = $user->id;
        $_SESSION["user-name"] = $user->name;
        $_SESSION["user-administrator"] = $user->administrator;

        $sql_tool->close();

        return "success";
    }

    public function logout()
    {
        if (!session_start()) {
            return "fail";
        };
        session_unset();
        echo ("success");
    }

    public function register()
    {
        $Name = htmlspecialchars($_POST["name"]);
        $Account = $_POST["account"];
        $Password = $_POST["password"];

        //驗證
        if (!(strlen($Name) > 0 && strlen($Name) <= 15)) {
            return "format";
        }

        if (preg_match("/^[a-zA-Z0-9.!#$%&’*+\/\=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/", $Account)) {
            //使用信箱註冊
            if (strlen($Account) > 30) {
                return "format";
            }
            $AccountType = "`email`";
        } else {
            //使用手機號碼註冊
            if (!preg_match("/^09[0-9]{8}$/", $Account)) {
                return "format";
            }
            $AccountType = "`phone`";
        }

        if (!preg_match("/^\w{6,15}$/", $Password))
            return "format";

        $Password = md5($Password);

        $sql_tool = $this->sql_tool;

        //判斷有無相同的用戶註冊過
        $sql_tool->sqlQueryPre(
            "SELECT * FROM `user` WHERE $AccountType=?",
            ['s', &$Account]
        );
        $result = $sql_tool->result;
        if ($result && $result->fetch_row()) {
            return "exist";
        }

        //寫入資料庫
        $sql_tool->sqlQueryPre(
            "INSERT INTO user (`name`, $AccountType, `password`, `administrator`) VALUES (?, ?, ?, false)",
            ['sss', &$Name, &$Account, &$Password]
        );
        if (is_null($sql_tool->result)) {
            return "fail";
        }

        $sql_tool->close();

        return "success";
    }
}
