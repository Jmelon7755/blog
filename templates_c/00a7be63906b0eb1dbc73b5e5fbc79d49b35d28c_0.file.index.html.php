<?php
/* Smarty version 3.1.33, created on 2019-09-16 04:38:14
  from 'C:\xampp\htdocs\blog\templates\index.html' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.33',
  'unifunc' => 'content_5d7ef596d49a42_48867783',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '00a7be63906b0eb1dbc73b5e5fbc79d49b35d28c' => 
    array (
      0 => 'C:\\xampp\\htdocs\\blog\\templates\\index.html',
      1 => 1568601298,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:main.html' => 1,
  ),
),false)) {
function content_5d7ef596d49a42_48867783 (Smarty_Internal_Template $_smarty_tpl) {
?><!DOCTYPE html>
<html lang="en">

<head>
    <title>JBlog</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="index.css">

    <?php echo '<script'; ?>
 src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"><?php echo '</script'; ?>
>
    <?php echo '<script'; ?>
 src="https://cdnjs.cloudflare.com/ajax/libs/jquery-cookie/1.4.1/jquery.cookie.min.js"><?php echo '</script'; ?>
>
    <?php echo '<script'; ?>
 src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"><?php echo '</script'; ?>
>
</head>

<body>
    <nav class="navbar navbar-default navbar-fixed" role="navigation">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">JBlog</a>
            <ul id="func-btn" class="nav navbar-nav navbar-right">
                <?php if ($_smarty_tpl->tpl_vars['account_type']->value === 'guest') {?>
                <li><a id="navbar-login-btn" href="#">登入</a></li>
                <li><a id="navbar-register-btn" href="#">註冊</a></li>
                <?php } else { ?>
                <li><a id="navbar-logout-btn" data-toggle='modal' href='#modal'>登出</a></li>
                <?php }?>
            </ul>
        </div>
    </nav>

    <div id="main" class="container">
        <?php if ($_smarty_tpl->tpl_vars['page_type']->value === 'main') {?>
        <?php $_smarty_tpl->_subTemplateRender('file:main.html', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
        <?php } elseif ($_smarty_tpl->tpl_vars['page_type']->value === 'register') {?>
        <?php echo 'register.html';?>

        <?php } else { ?>
        <?php echo 'login.html';?>

        <?php }?>
    </div>

    <?php echo '<script'; ?>
 src="js/User.js"><?php echo '</script'; ?>
>
    <?php echo '<script'; ?>
 src="js/Po.js"><?php echo '</script'; ?>
>
    <?php echo '<script'; ?>
 src="js/Index.js" defer><?php echo '</script'; ?>
>
</body>

</html><?php }
}
