<?php
class ctrl_index {
    public function index() {
        TMP::add('index');
        TMP::exec();
    }
}
