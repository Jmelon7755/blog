<?php

require_once("SQLTool.php");

require_once("model/Model.php");
require_once("controller/Controller.php");

require_once('C:/xampp/htdocs/libs/smarty-3.1.33/libs/Smarty.class.php');

const HOST = "127.0.0.1";
const USER_NAME = "melon_liao";
const PASSWORD = "ilovecyg";

$sql_tool = new JBlog\SQLTool(new \mysqli(HOST, USER_NAME, PASSWORD));

$smarty = new Smarty();
$smarty->left_delimiter = '{{';
$smarty->right_delimiter = '}}';

$URL = $_GET['URL'];

if ($URL === "index") {
    require_once("model/Po.php");

    session_start();

    $account_type = "guest";
    $my_user_id = 0;
    $user_name = "";
    $user_administrator = false;

    if (isset($_SESSION["user-id"])) {
        //判斷身分
        $my_user_id = $_SESSION["user-id"];
        $user_administrator = $_SESSION["user-administrator"];
        if ($user_administrator) {
            $account_type = "administrator";
        } else {
            $account_type = "member";
        }
    }
    if (isset($_SESSION["user-name"])) {
        $user_name = $user_administrator ? "Administrator" : $_SESSION["user-name"];
    }

    // SELECT `po`.`id`, `user`.`name`, `po`.`user_id`, `po`.`content` FROM `user` RIGHT JOIN `po` ON `user`.`id` = `po`.`user_id` LIMIT 2
    $sql_tool->sqlQuery("SELECT `po`.`id`, `user`.`name`, `po`.`user_id`, `po`.`content` FROM `user` RIGHT JOIN `po` ON `user`.`id` = `po`.`user_id`");

    $smarty->assign("page_type", "main");
    $smarty->assign("account_type", $account_type);
    $smarty->assign("my_user_id", $my_user_id);
    $smarty->assign("user_name", $user_name);
    
    if ($sql_tool->result) {
        $posts = $sql_tool->fetchObjectAll("JBlog\Model\Po", "iis", true);
        $smarty->assign("posts", $posts);
    } else {
        $smarty->assign("posts", []);
    }

    $sql_tool->close();

    $smarty->display("index.html");
}

if (preg_match("/^user/", $URL)) {
    require_once("model/User.php");
    require_once("controller/UserController.php");

    $user_controller = new JBlog\Controller\UserController($sql_tool);

    switch ($URL) {
        case 'user/register':
            exit($user_controller->register());
            // no break
        case 'user/login':
            exit($user_controller->login());
            // no break
        case 'user/logout':
            exit($user_controller->logout());
            // no break
        default:
            exit("404");
    }
} else if (preg_match("/^po/", $URL)) {
    require_once("model/Po.php");
    require_once("controller/UserController.php");
    require_once("controller/PoController.php");

    $po_controller = new JBlog\Controller\PoController($sql_tool);

    switch ($URL) {
        case 'po/create-po':
            exit($po_controller->createPo());
            // no break
        case 'po/update-po':
            exit($po_controller->updatePo());
            // no break
        case 'po/delete-po':
            exit($po_controller->deletePo());
            // no break
        default:
            exit("404");
    }
}
