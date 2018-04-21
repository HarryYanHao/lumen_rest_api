<?php

/**
 * Created by PhpStorm.
 * User: harry
 * Date: 2018/4/20
 * Time: 上午9:45
 */
namespace App\Console\Commands;
use App\Model\Artical;
use \Illuminate\Console\Command;
class SyncArtical extends Command{
    /**
     * 命令行执行命令
     * @var string
     */
    protected $signature = 'sync:artical';

    /**
     * 命令描述
     *
     * @var string
     */
    protected $description = '同步python获取的文章列表入库操作';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        //这里编写需要执行的动作
        $filename = '/tmp/data'.date('Y-m-d',time()).'.json';
        $handle = fopen($filename,'r');
        $artical = [];
        while (!feof($handle)){
            $_row = json_decode(trim(fgets($handle,4096)),true);
            if(!is_null($_row)){
                $_row['content'] = str_replace('(adsbygoogle=window.adsbygoogle||[]).push({});','',$_row['content']);
                $artical[] = $_row;
            }
        }
        fclose($handle);
        //通过文章标题筛选重复的数据，不进行插入操作
        $titleArr = array_column($artical,'title');
        $repeatAtrical = Artical::whereIn('title',$titleArr)->get()->toArray();
        if(!empty($repeatAtrical)){
            $repeatTitleArr = array_column($repeatAtrical,'title');
            foreach ($artical as $key => $value){
                if(in_array($value['title'],$repeatTitleArr)){
                    unset($artical[$key]);
                }
            }
        }
        Artical::insert($artical);
    }
}