<?php

class ShuffleController
{
    public function run($action)
    {
        $this->$action();
    }

    public function index()
    {
        echo 'hello';
    }
}
