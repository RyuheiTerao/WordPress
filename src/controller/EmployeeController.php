<?php

class EmployeeController extends Controller
{
    public function index()
    {
        echo 'index';
        //データベースに接続
        //データベースからデータを抽出
        //indexのhtmlを表示
        // return $this->render([
        //     'title' => '社員の登録',
        //     'employees' => $employees,
        //     'errors' => [],
        // ]);
    }

    public function create()
    {
        if(!$this->request->isPost()){
            throw new HttpNotFoundException();
        }
        //データベースに接続
        // シャッフル

        // シャッフルした後indexのhtmlを表示
        // return $this->render([
        //     'title' => '社員の登録',
        //     'employees' => $employees,
        //     'errors' => $errors,
        // ], 'index');
    }
}
