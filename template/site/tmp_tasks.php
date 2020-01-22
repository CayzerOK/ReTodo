<div class="tasksWrapper">
    <?php
    if(!empty($content)) {
        foreach ($content as $id=>$value) {
            $checkMark = '';
            $value[4] ? $checkMark = '✓': $checkMark = '';

            if ($_SESSION['admin']) {
                $checkarg = "onclick='check($value[0])' style='cursor: pointer'";
                $textarg = "onclick='editText($value[0])' style='border: 1px solid #cc685175; cursor: pointer'";
            } else {
                $checkarg = "";
                $textarg = "";
            }

            echo "<div class='task'>
                <div class='dataView taskField'>$value[2]</div>
                <div class='dataView taskField'>$value[1]</div>
                <div $textarg class='textView taskField '>$value[3]</div>
                <div $checkarg class='taskCheck'>$checkMark</div>
            </div>";
        }
    }
    ?>
</div>
