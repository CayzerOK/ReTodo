<div id="taskElem" class="pageRootElem">
    <div class="sortControl" >
        <div class="btn sortElem dataView" onclick="setSort('email')">email<span id="emailMark"></span></div>
        <div class="btn sortElem dataView" onclick="setSort('username')">логин<span id="usernameMark"></span></div>
        <div class="btn sortElem textView" onclick="setSort('text')">текст<span id="textMark"></span></div>
    </div>
    <div class="listWrapper" style="flex-grow: 1">

    </div>
    <div class="control" style="display: none;">
        <div onclick="prewPage()" id="prewPage" class="btn pageBTN">-</div>
        <div id="pageNum">*</div>
        <div onclick="nextPage()" id="nextPage" class="btn pageBTN">+</div>
    </div>
</div>

<div id="inputElem" class="pageRootElem">
    <input id="taskEmail" type="email" class="input taskInput" placeholder="email">
    <input id="taskUser" type="text" class="input taskInput" placeholder="логин">
    <textarea id="taskText" class="input taskInput taskTextArea" placeholder="текст"></textarea>
    <div onclick="addTask()" class="submitBTN">+ Добавить</div>
</div>
