<?php
$btnTXT = "Войти";
$loginForm = "";
if (!$_SESSION['guest']) {
    $btnTXT = $_SESSION['username'];
} else {
    $loginForm =
        "<div id='loginForm' class='pageRootElem'>
            <label class='switch'>
                <input onchange='toggleRegister()' type='checkbox'>
                <span class='slider'></span>
            </label>
            <input class='input loginInput' type='text' placeholder='логин'>
            <input class='input loginInput' type='password' placeholder='пароль'>
            <div onclick='submitLogReg()' class='btn'><span id='logBtnTitle'>Вход</span></div> 
        </div>";
}
?>


<img class="headLogo" src="/assets/svg/logo.svg" alt="ReTodo">
<div class="headerTitle">ReTodo</div>
<div id="loginBTN" onclick="loginBTN()" class="btn"><?php echo $btnTXT?></div>
<?php echo $loginForm?>
