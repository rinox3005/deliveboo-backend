<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\DishOrder;

class GraphController extends Controller
{
    public function index(Request $request)
    {
        if(isset($request->month) && isset($request->year)){
            $result=Order::select(Order::raw('COUNT(*) as ordini, DAY(order_date_time) as day'))
                ->join('restaurants','orders.restaurant_id','=','restaurants.id')
                ->whereRaw('YEAR(order_date_time) ='.$request->year)
                ->whereRaw('MONTH(order_date_time) ='.$request->month)
                ->where('restaurant_id',$request->id)
                ->groupBy('day')
                ->get();
        }
        else if(isset($request->year))
        {
            $result=Order::select(Order::raw('COUNT(*) as ordini, MONTH(order_date_time) as month'))
                ->join('restaurants','orders.restaurant_id','=','restaurants.id')
                ->whereRaw('YEAR(order_date_time) ='.$request->year)
                ->where('restaurant_id',$request->id)
                ->groupBy('month')
                ->get();
        }
        else if(isset($request->month)){
            $result=Order::select(Order::raw('COUNT(*) as ordini, DAY(order_date_time) as day'))
                ->join('restaurants','orders.restaurant_id','=','restaurants.id')
                ->whereRaw('MONTH(order_date_time) ='.$request->month)
                ->where('restaurant_id',$request->id)
                ->groupBy('day')
                ->get();
        }
        else{
            $month=date('m');
            $result=Order::select(Order::raw('COUNT(*) as ordini, DAY(order_date_time) as day'))
                ->join('restaurants','orders.restaurant_id','=','restaurants.id')
                ->whereRaw('MONTH(order_date_time) ='.$month)
                ->where('restaurant_id',$request->id)
                ->groupBy('day')
                ->get();
        }

        return response()->json([
            'status' => true,
            'results' =>$result
        ]);
    }

    public function doughnut(Request $request)
    {
        $month=date('m');
        $result=DishOrder::select(DishOrder::raw('SUM(quantity) as ordini, dishes.name as piatto'))
            ->join('dishes','dish_order.dish_id','=','dishes.id')
            ->join('restaurants','dishes.restaurant_id','=','restaurants.id')
            ->join('orders','dish_order.order_id','=','orders.id')
            ->whereRaw('MONTH(orders.order_date_time) ='.$month)
            ->where('dishes.restaurant_id',$request->id)
            ->groupBy('piatto')
            ->orderByDesc('ordini')
            ->limit(5)
            ->get();

         return response()->json([
             'status' => true,
             'results' =>$result
         ]);
    }
}
