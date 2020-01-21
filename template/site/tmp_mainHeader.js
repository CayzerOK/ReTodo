let register = false;

function showLoginForm() {
    $('#loginForm').show();
}

function submitLogReg() {
    let action = (register? 'register' : 'login');
    let data = {
        login: $('#loginIn').val(),
        password: $('#passIn').val()
    };
    $.post("/auth/"+action,
        data,
        function(ret) {
            ret = JSON.parse(ret);
            if (ret.done) {
                window.location.href = '/'
            } else alert(ret.info);
        });
}

function logout() {
    $.post("/auth/logout",
        function(){
            window.location.href = '/'
        });
}


function toggleRegister(event) {
    register = !register;
    if(register) {
        $('#logBtnTitle').text("Регистрация");
    } else {
        $('#logBtnTitle').text("Вход");
    }
}


$(document).mouseup(function (e){
    var div = $("#loginForm");
    if (!div.is(e.target)
        && div.has(e.target).length === 0) {
        div.hide();
    }
});