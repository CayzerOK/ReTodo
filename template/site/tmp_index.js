let page = 1;
let sort = 'id';
let desc = false;

function editText(id) {
    let value = window.prompt("Введите новое значение:","");
    if (value.length<1) {
        alert("Некорректное значение!");
        return false;
    }

    $.post("/tasks/editTask",
        {
            id:id,
            value:value
        },
        function(ret) {
            ret = JSON.parse(ret);
            if (ret.done) {
                loadTasks();
            } else alert("Error: "+ret.info);
        });
}

function setSort(type) {
    $('#'+sort+'Mark').text('');

    if (sort === type) {
        desc = !desc;
    }
    sort = type;
    page = 1;
    loadTasks()
}

function nextPage() {
    page++;
    loadTasks();

}
function prewPage() {
    page--;
    loadTasks();
}

function check(id) {
    $.post("/tasks/checked",
        {id:id},
        function(ret) {
            ret = JSON.parse(ret);
            if (ret.done) {
                loadTasks();
            }
        });
}


function addTask() {
    let email = $('#taskEmail');
    let user = $('#taskUser');
    let text = $('#taskText');
    let data = {
        email: email.val(),
        user: user.val(),
        text: text.val(),
    };

    for (item in data) {
        if(data[item].length<1) {
            alert('Incorrect field: '+item);
            return false;
        }
    }

    $.post("/tasks/addTask",
        data,
        function(ret) {
            ret = JSON.parse(ret);
            if (ret.done) {
                loadTasks();
                email.val('');
                user.val('');
                text.val('');
                alert("Задача добавлена!")
            } else {
                alert("Произошла ошибка: "+ ret.info)
            }
        });
}

function loadTasks() {
    let data = {
        page: page,
        sort: sort,
        desc: desc
    };
    $.post("/tasks/getTasks",
        data,
        function(ret) {
            $('.listWrapper').html(ret);

            if ($('.tasksWrapper>.task').length<3) {
                $('#nextPage').hide();
            } else {
                $('.control').show();
                $('#nextPage').show();
            }

            if (page <= 1) {
                $('#prewPage').hide();
            } else {
                $('#prewPage').show();
            }
            $('#pageNum').text(page);

            let mark = $('#'+sort+'Mark');
            if (desc) {
                mark.text('↑')
            } else {
                mark.text('↓')
            }
        });
}

let my = new Konami(function () {
    $('.listWrapper').html('<img src="/assets/img/qr-code.png" style="margin: 20px auto;width: 90%;display: block;">')
});

$( document ).ready(function () {
    $('#pageNum').text(page);
    loadTasks();
});