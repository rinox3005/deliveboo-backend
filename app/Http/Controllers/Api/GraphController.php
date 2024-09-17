<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;

class GraphController extends Controller
{
    public function index(Request $request)
    {
        if(isset($request->month) && isset($request->year)){
            $projects=Order::select(Order::raw('COUNT(*) as ordini, DAY(order_date_time) as day'))
                ->join('restaurants','orders.restaurant_id','=','restaurants.id')
                ->whereRaw('YEAR(order_date_time) ='.$request->year)
                ->whereRaw('MONTH(order_date_time) ='.$request->month)
                ->where('restaurant_id',$request->id)
                ->groupBy('day')
                ->get();
        }
        else if(isset($request->year))
        {
            $projects=Order::select(Order::raw('COUNT(*) as ordini, MONTH(order_date_time) as month'))
                ->join('restaurants','orders.restaurant_id','=','restaurants.id')
                ->whereRaw('YEAR(order_date_time) ='.$request->year)
                ->where('restaurant_id',$request->id)
                ->groupBy('month')
                ->get();
        }
        else if(isset($request->month)){
            $projects=Order::select(Order::raw('COUNT(*) as ordini, DAY(order_date_time) as day'))
                ->join('restaurants','orders.restaurant_id','=','restaurants.id')
                ->whereRaw('MONTH(order_date_time) ='.$request->month)
                ->where('restaurant_id',$request->id)
                ->groupBy('day')
                ->get();
        }
        else{
            $month=date('m');
            $projects=Order::select(Order::raw('COUNT(*) as ordini, DAY(order_date_time) as day'))
                ->join('restaurants','orders.restaurant_id','=','restaurants.id')
                ->whereRaw('MONTH(order_date_time) ='.$month)
                ->where('restaurant_id',$request->id)
                ->groupBy('day')
                ->get();
        }

        return response()->json([
            'status' => true,
            'results' =>$projects
        ]);
    }
}
