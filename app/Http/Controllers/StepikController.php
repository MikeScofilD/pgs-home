<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StepikController extends Controller
{
    public function index()
    {
        return "Hello";
    }

    public function simpleSql()
    {
        //1.1 Простые SQL запросы
        //Получите всю информацию о товарах из таблицы products.
        //Получите название (name) и цену (price) всех товаров из таблицы products.
        $products = DB::table('products')->get();

        //Выберите из таблицы products все записи, в которых цена (price) меньше 3000.
        $products = DB::table('products')->where('price', '<', 3000)->get();

        //Выберите из таблицы products имена (name) и цены (price) всех товаров, стоимостью от 10 000 и выше.
        $products = DB::table('products')->where('price', '>=', 10000)->get();

        //Получите из таблицы products имена (name) товаров, которые закончились.
        $products = DB::table('products')->where('count', '=', 0)->get();

        //Выберите из таблицы products название (name) и цены (price) товаров, стоимостью до 4000 включительно.
        $products = DB::table('products')->where('price', '<=', 4000)->get();
        // foreach($products as $product){
        //     echo "Name:".$product->name." Count:".$product->count." Price:".$product->price.'<br/>';
        // }

        //1.2 Простые SQL запросы
        //Выберите из таблицы orders все заказы кроме отмененных. У отмененных заказов status равен "cancelled".
        $orders = DB::table('orders')->where('status', '!=', 'cancelled')->get();
        // foreach($orders as $order)
        // {
        //     echo $order->status."<br/>";
        // }
        //Выберите из таблицы orders все заказы содержащие более 3 товаров (products_count).
        //Вывести нужно только номер (id) и сумму (sum) заказа.
        $orders = DB::table('orders')->where('products_count', '>', 3)->get();
        // foreach($orders as $order)
        // {
        //     echo $order->id." Sum:".$order->sum."<br/>";
        // }
        //Выберите из таблицы orders все отмененные заказы. У отмененных заказов status равен "cancelled".
        $orders = DB::table('orders')->where('status', '=', 'cancelled')->get();
        // foreach($orders as $order)
        // {
        //     echo $order->status."<br/>";
        // }
        //Выберите из таблицы orders все заказы, у которых сумма (sum) больше 3000 или количество товаров (products_count) от 3 и больше.
        $orders = DB::table('orders')->where('sum', '>', '3000')->orWhere('products_count', '>', 3)->get();
        // foreach($orders as $order)
        // {
        //     echo $order->sum." ".$order->products_count."<br/>";
        // }
        //Выберите из таблицы orders все заказы, у которых сумма (sum) от 3000 и выше, а количество товаров (products_count) меньше 3.
        $orders = DB::table('orders')->where('sum', '>', '3000')->orWhere('products_count', '<', 3)->get();
        // foreach($orders as $order)
        // {
        //     echo $order->sum." ".$order->products_count."<br/>";
        // }
        //Выберите из таблицы orders все отмененные (cancelled) и возвращенные (returned) товары.
        //Используйте IN.
        $orders = DB::table('orders')->whereIn('status', ['cancelled', 'returned'])->get();
        // foreach($orders as $order)
        // {
        //     echo $order->status."<br/>";
        // }
        //Выберите из таблицы orders все отмененные заказы исключая заказы стоимостью от 3000 до 10000 рублей включительно.
        $orders = DB::table('orders')->where('status', 'cancelled')->whereNotIn('sum', [3000, 10000])->get();
        // foreach($orders as $order)
        // {
        //     echo $order->status." ".$order->sum."<br/>";
        // }
        //Выберите из таблицы orders все отмененные заказы стоимостью от 3000 до 10000 рублей включительно.
        //Используйте BETWEEN.
        $orders = DB::table('orders')->where('status', 'cancelled')->whereBetween('sum', [3000, 10000])->get();
        // foreach($orders as $order)
        // {
        //     echo $order->status." ".$order->sum."<br/>";
        // }

        //1.4 Простые SQL запросы
        //Выберите из таблицы products все товары в порядке возрастания цены (price).
        $products = DB::table('products')->orderBy('price', 'asc')->get();
        //  foreach($products as $product)
        //  {
        //      echo $product->name." ".$product->price."<br/>";
        //  }
        //Выберите сотрудников из таблицы users с зарплатой (salary) меньше 30 000 рублей и отсортируйте данные по дате рождения (birthday).
        // Сотрудников с нулевой зарплатой выбирать не нужно.
        $employees = DB::table('users')->where('salary', '<', 30000)->where('salary', '!=', 0)->orderBy('birthday', 'asc')->get();
        // foreach($employees as $employee){
        //     echo $employee->first_name." ".$employee->last_name." Salary:".$employee->salary." Birthday:".$employee->birthday." Job:".$employee->job."</br>";
        // }

        //Выберите из таблицы users всех пользователей с зарплатой от 40 000 рублей и выше.
        // Данные нужно сначала отсортировать по убыванию зарплаты (salary), а затем в алфавитном порядке по имени (first_name).
        $employees = DB::table('users')->where('salary', '>=', 40000)->orderBy('salary', 'asc')->orderBy('first_name', 'asc')->get();
        // foreach ($employees as $employee) {
        //     echo $employee->first_name . " " . $employee->last_name . " Salary:" . $employee->salary . " Birthday:" . $employee->birthday . " Job:" . $employee->job . "</br>";
        // }
        //Выберите из таблицы products все товары в порядке убывания цены.
        //Выведите только имена (name) и цены (price).
        $products = DB::table('products')->orderBy('price', 'desc')->get();
        // foreach ($products as $product) {
        //     echo $product->name . " " . $product->price . "<br/>";
        // }
        //Выберите из таблицы products все товары стоимостью 5000 и выше в порядке убывания цены (price).
        $products = DB::table('products')->where('price', '>=', 5000)->orderBy('price', 'desc')->get();
        // foreach ($products as $product) {
        //     echo $product->name . " " . $product->price . "<br/>";
        // }
        //Выберите из таблицы products все товары стоимостью до 3000 рублей отсортированные в алфавитном порядке.
        // Вывести нужно только имя (name), количество (count) и цену (price).
        $products = DB::table('products')->where('price', '<=', 3000)->orderBy('name', 'asc')->get();
        // foreach ($products as $product) {
        //     echo $product->name . " " . $product->price." ".$product->count . "<br/>";
        // }
        //Выберите из таблицы users фамилии (last_name) и имена (first_name) всех пользователей.
        //Данные должны быть отсортированы сначала по фамилии, а затем по имени.
        $employees = DB::table('users')->orderBy('last_name', 'asc')->orderBy('first_name', 'asc')->get();
        // foreach ($employees as $employee) {
        //     echo $employee->first_name . " " . $employee->last_name . "</br>";
        // }

        //1.5 Простые SQL запросы
        //Выберите из таблицы orders три последних заказа (по дате date) стоимостью от 3000 рублей и выше.
        //Данные отсортируйте по дате в обратном порядке.
        $orders = DB::table('orders')->orderBy('date', 'desc')->limit(3)->where('sum','>=',3000)->get();
        // foreach ($orders as $order) {
        //    echo $order->sum." ".$order->date."<br/>";
        // }

        //Выберите из таблицы products название и цены трех самых дешевых товаров, которые есть на складе.
        $products = DB::table('products')->orderBy('price', 'asc')->limit(3)->where('count','>',0)->get();
        // foreach ($products as $product) {
        //     echo $product->name . " " . $product->price . "<br/>";
        // }
        //Сайт выводит товары по 5 штук.
        //Выберите из таблицы products товары, которые пользователи увидят на 3 странице каталога при сортировке в порядке возрастания цены (price).
        $products = DB::table('products')->orderBy('price', 'asc')->limit(5)->offset(3)->where('count','>',0)->get();
        // foreach ($products as $product) {
        //     echo $product->name . " " . $product->price . "<br/>";
        // }
        //Выберите из таблицы orders 5 самых дорогих заказов за всё время.
        //Данные нужно отсортировать в порядке убывания цены.
        //Отмененные заказы не учитывайте.
        $orders = DB::table('orders')->orderBy('sum', 'desc')->limit(5)->where('status','!=' ,'cancelled')->get();
        // foreach($orders as $order)
        // {
        //     echo $order->status." ".$order->sum."<br/>";
        // }

        //В таблице products 17 записей. Сайт выводит название (name) и цену (price) товаров в алфавитном порядке, по 6 записей на страницу.
        //Напишите SQL запрос для получения списка товаров для формирования последней страницы каталога.
        //Товары, которых нет на складе, выводить не надо (таких товаров 3).
        $products = DB::table('products')->orderBy('name', 'asc')->orderBy('price', 'asc')->limit(6)->offset(6)->where('count','>',0)->get();
        foreach ($products as $product) {
            echo $product->name . " " . $product->price . "<br/>";
        }

        return "Stepik SQL";
    }
}
