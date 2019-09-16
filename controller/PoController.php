<?php

namespace JBlog\Controller;

class PoController extends Controller
{
    public function __construct(\JBlog\SQLTool $sqltool)
    {
        parent::__construct($sqltool);
        if (!UserController::loginCheck()) {
            return "notlogin";
        }
    }

    public function createPo()
    {
        $user_id = $_SESSION["user-id"];
        $po_textarea = htmlspecialchars($_POST["po-textarea"]);

        //驗證
        (!is_null($po_textarea) && !empty($po_textarea) && strlen($po_textarea) <= 1000) or exit("format");

        //寫入資料庫
        $this->sql_tool->sqlQueryPre("INSERT INTO po (`user_id`, `content`) VALUES (?, ?)", ['is', &$user_id, &$po_textarea]);
        if (is_null($this->sql_tool->result)) {
            return "db";
        }

        if (!($po_panel_html = file_get_contents("html/po_panel.html"))) {
            return "tpl";
        }

        $data = new \stdClass();
        $data->po_id = $this->sql_tool->mysqli->insert_id;
        $data->user_name = $_SESSION["user-name"];
        $data->content = $po_textarea;
        $data->po_panel_html = $po_panel_html;

        $this->sql_tool->close();

        return json_encode($data);
    }

    public function updatePo()
    {
        $user_id = $_SESSION["user-id"];
        $po_id = $_POST["po-id"];
        $po_text = $_POST["po-text"];

        //驗證
        if (is_null($po_text) || empty($po_text) || strlen($po_text) > 1000) {
            return "format";
        }

        //查詢po文的user_id
        $this->sql_tool->sqlQueryPre("SELECT `po`.`user_id` FROM `po` WHERE `po`.`id` = ?", ['i', &$po_id]);
        $result = $this->sql_tool->result;
        if (is_null($result) || !($row = $result->fetch_row()) || $row[0] !== $user_id) {
            return "permission";
        }

        //更新資料庫
        $this->sql_tool->sqlQueryPre("UPDATE `po` SET `po`.`content` = ? WHERE `po`.`id` = ?", ['si', &$po_text, &$po_id]);
        if (is_null($this->sql_tool->result)) {
            return "fail";
        }
            
        $this->sql_tool->close();

        return "success";
    }

    public function deletePo()
    {
        $user_id = $_SESSION["user-id"];
        $user_administrator = $_SESSION["user-administrator"];
        $po_id = $_POST["po-id"];

        //權限驗證
        if (!$user_administrator) {
            //查詢po文的user_id
            $this->sql_tool->sqlQueryPre("SELECT `po`.`user_id` FROM `po` WHERE `po`.`id` = ?", ['i', &$po_id]);
            $result = $this->sql_tool->result;
            if (is_null($result) || !($row = $result->fetch_row()) || $row[0] !== $user_id) {
                return "permission";
            }
        }

        //刪除資料庫
        $this->sql_tool->sqlQueryPre("DELETE FROM `po` WHERE `po`.`id` = ?", ['i', &$po_id]);

        if (is_null($this->sql_tool->result)) {
            return "fail";
        }

        $this->sql_tool->close();

        return "success";
    }
}
