<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StepikController extends Controller
{
    public function index(){
        return "Hello";
    }

    public function simpleSql()
    {
        //Получите всю информацию о товарах из таблицы products.
        //Получите название (name) и цену (price) всех товаров из таблицы products.
        $products = DB::table('products')->get();
        // foreach($products as $product){
        //     echo "Name:".$product->name." Count:".$product->count." Price:".$product->price.'<br/>';
        // }
        //Выберите из таблицы products все записи, в которых цена (price) меньше 3000.
        $products = DB::table('products')->where('price', '<', 3000)->get();
        // foreach($products as $product){
        //     echo "Name:".$product->name." Count:".$product->count." Price:".$product->price.'<br/>';
        // }
        //Выберите из таблицы products имена (name) и цены (price) всех товаров, стоимостью от 10 000 и выше.
        $products = DB::table('products')->where('price', '>=', 10000)->get();
        // foreach($products as $product){
        //     echo "Name:".$product->name." Count:".$product->count." Price:".$product->price.'<br/>';
        // }
        //Получите из таблицы products имена (name) товаров, которые закончились.
        $products = DB::table('products')->where('count', '=', 0)->get();
        // foreach($products as $product){
        //     echo "Name:".$product->name." Count:".$product->count." Price:".$product->price.'<br/>';
        // }
        //Выберите из таблицы products название (name) и цены (price) товаров, стоимостью до 4000 включительно.
        $products = DB::table('products')->where('price', '<=', 4000)->get();
        foreach($products as $product){
            echo "Name:".$product->name." Count:".$product->count." Price:".$product->price.'<br/>';
        }
        // dump($products);
        return "Stepik SQL";
    }
}
