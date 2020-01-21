<?php
$btnText = "Войти";
$loginForm = "";
$btnAct = 'showLoginForm()';
if (!$_SESSION['guest']) {
    $btnText = $_SESSION['username'];
    $btnAct = 'logout()';
} else {
    $loginForm =
        "<div id='loginForm' class='pageRootElem'>
            <label class='switch'>
                <input onchange='toggleRegister()' type='checkbox'>
                <span class='slider'></span>
            </label>
            <input id='loginIn' class='input loginInput' type='text' placeholder='логин'>
            <input id='passIn' class='input loginInput' type='password' placeholder='пароль'>
            <div onclick='submitLogReg()' class='btn'><span id='logBtnTitle'>Вход</span></div> 
        </div>";
}
?>


<img class="headLogo" src="/assets/svg/logo.svg" alt="ReTodo">
<div class="headerTitle">ReTodo</div>
<div id="loginBTN" onclick="<?php echo $btnAct?>" class="btn"><?php echo $btnText?></div>
<?php echo $loginForm?>
