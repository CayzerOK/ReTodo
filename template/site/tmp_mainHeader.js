let register = false;

function loginBTN() {
    $('#loginForm').show();
}

function submitLogReg() {
$.ajax()
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