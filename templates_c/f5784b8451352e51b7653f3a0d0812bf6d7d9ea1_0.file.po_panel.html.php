<?php
/* Smarty version 3.1.33, created on 2019-09-11 10:21:48
  from 'C:\xampp\htdocs\blog\templates\po_panel.html' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.33',
  'unifunc' => 'content_5d78ae9cbdc5d3_87612569',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'f5784b8451352e51b7653f3a0d0812bf6d7d9ea1' => 
    array (
      0 => 'C:\\xampp\\htdocs\\blog\\templates\\po_panel.html',
      1 => 1568190094,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5d78ae9cbdc5d3_87612569 (Smarty_Internal_Template $_smarty_tpl) {
?><div id="po-panel-<?php echo $_smarty_tpl->tpl_vars['po']->value->id;?>
" class="clear-right">
    <br />
    <div class="panel panel-default">
        <div class="panel-body">
            <?php if ($_smarty_tpl->tpl_vars['account_type']->value === "administrator" || $_smarty_tpl->tpl_vars['my_user_id']->value === $_smarty_tpl->tpl_vars['po']->value->user_id) {?>
            <div class="dropdown float-right">
                <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown"><span
                        class="caret"></span></button>
                <ul class="dropdown-menu dropdown-menu-right">
                    <input type="hidden" value="<?php echo $_smarty_tpl->tpl_vars['po']->value->id;?>
">
                    <?php if ($_smarty_tpl->tpl_vars['my_user_id']->value === $_smarty_tpl->tpl_vars['po']->value->user_id) {?>
                    <li><a class="edit-po-btn" data-toggle="modal" href="#modal">編輯</a></li>
                    <?php }?>
                    <li><a class="delete-po-btn" data-toggle="modal" href="#modal">刪除</a></li>
                </ul>
            </div>
            <?php }?>
            <p class="panel-title"><?php echo $_smarty_tpl->tpl_vars['po']->value->name;?>
說:</p>
            <br />
            <p id="po-panel-text-<?php echo $_smarty_tpl->tpl_vars['po']->value->id;?>
" class="panel-title clear-right"><?php echo $_smarty_tpl->tpl_vars['po']->value->content;?>
</p>
        </div>
    </div>
</div><?php }
}
