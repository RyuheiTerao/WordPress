<?php

class ShuffleController extends Controller
{
    public function index()
    {

        //データベースに接続
        //データベースからデータを抽出
        //indexのhtmlを表示
        return $this->render([
            //必要な引数を渡す
            'index'
        ]);
    }

    public function create()
    {
        if(!$this->request->isPost()){
            throw new HttpNotFoundException();
        }
        //データベースに接続
        // シャッフル
        // シャッフルした後indexのhtmlを表示

        $employee = $this->databaseManager->get('Employee')->fetchAllNames();

        return $this->render([
            'create'
        ],'index');
    }
}
