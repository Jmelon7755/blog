<?php
/* Smarty version 3.1.33, created on 2019-09-11 10:24:10
  from 'C:\xampp\htdocs\blog\templates\main.html' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.33',
  'unifunc' => 'content_5d78af2a5124c5_68624124',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '501776deddab39b5a87672fc74c6ab1c09ff724f' => 
    array (
      0 => 'C:\\xampp\\htdocs\\blog\\templates\\main.html',
      1 => 1568190248,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:po_text.html' => 1,
    'file:po_panel.html' => 1,
  ),
),false)) {
function content_5d78af2a5124c5_68624124 (Smarty_Internal_Template $_smarty_tpl) {
?><h4 id="hello">
    <?php if ($_smarty_tpl->tpl_vars['account_type']->value != 'guest') {?>
    Hi, <?php echo $_smarty_tpl->tpl_vars['user_name']->value;?>

    <?php }?>
</h4>
<br />
<div id="po-text-html">
    <?php if ($_smarty_tpl->tpl_vars['account_type']->value != 'guest') {?>
    <?php $_smarty_tpl->_subTemplateRender('file:po_text.html', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
    <?php }?>
</div>
<div id="po-panel-list">
    <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['posts']->value, 'po');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['po']->value) {
?>
    <?php $_smarty_tpl->_subTemplateRender('file:po_panel.html', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('po'=>$_smarty_tpl->tpl_vars['po']->value,'account_type'=>$_smarty_tpl->tpl_vars['account_type']->value,'my_user_id'=>$_smarty_tpl->tpl_vars['my_user_id']->value), 0, true);
?>
	<?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
</div>
<br />
<ul id="main-pagination" class="pagination"></ul>

<div class="modal fade" id="modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title"></h4>
            </div>
            <div class="modal-body">
                <p id="modal-p"></p>
                <textarea id="modal-text" class="form-control" rows="6" required="required"></textarea>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
                <button type="button" class="btn btn-primary" data-dismiss="modal" id="modal-ok-btn"></button>
            </div>
        </div>
    </div>
</div><?php }
}
