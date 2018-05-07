<?php

/**
 * Created by PhpStorm.
 * User: harry
 * Date: 2018/4/20
 * Time: 上午9:45
 */
namespace App\Console\Commands;
use App\Model\Artical;
use App\Model\Goods;
use \Illuminate\Console\Command;
class SyncGoods extends Command{
    /**
     * 命令行执行命令
     * @var string
     */
    protected $signature = 'sync:goods';

    /**
     * 命令描述
     *
     * @var string
     */
    protected $description = '同步python获取的商品信息入库操作';

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
        $goods = [];
        while (!feof($handle)){
            $_row = json_decode(trim(fgets($handle,4096)),true);
            if(!is_null($_row)){
                $_format = [];
               $_row['image'] = current($_row['image']);
               $_format['goods_name'] = $_row['goodsName'];
               $_format['goods_number'] = $_row['goodsNumber'];
               $_format['price'] = $_row['price'];
               $_format['image'] = $_row['image'];
               $goods[] = $_format;
            }
        }
        fclose($handle);
        //通过文章标题筛选重复的数据，不进行插入操作
        $goodsNumber = array_column($goods,'goodsNumber');
        $repeatGoods = Goods::whereIn('goods_number',$goodsNumber)->get()->toArray();
        if(!empty($repeatGoods)){
            $repeatGoodsNumberArr = array_column($repeatGoods,'goodsNumber');
            foreach ($goods as $key => $value){
                if(in_array($value['title'],$repeatGoodsNumberArr)){
                    unset($goods[$key]);
                }
            }
        }
        Goods::insert($goods);
    }
}