<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\OrderHandleService;
class OrderController extends Controller
{
    private $orderService;
    public function __construct(OrderHandleService $orderService)
    {
        $this->orderService=$orderService;
    }
    public function adminPendingOrders()
    {
        $pendingOrder=$this->orderService->adminPendingOrders();
        // dd($pendingOrder);
        return view('pages.admin.orders.pendingOrder',compact('pendingOrder'));
    }

    public function adminPendingOrdersItem($cart_id)
    {
        $response=$this->orderService->adminPendingOrdersItem($cart_id);
        // dd($response);
        return $response;
    }
    public function adminProcessedOrders()
    {
        $processedOrder=$this->orderService->adminProcessedOrders();
        return view('pages.admin.orders.processedOrder',compact('processedOrder'));
    }

    public function vendorPendingOrders()
    {
        $pendingOrder=$this->orderService->vendorPendingOrders();
        return view('pages.vendor.orders.pendingOrder',compact('pendingOrder'));
    }
    public function vendorPendingOrdersItem($cart_id)
    {
        $response=$this->orderService->vendorPendingOrdersItem($cart_id);
        return $response;
    }
    public function vendorProcessedOrders()
    {
        $processedOrder=$this->orderService->vendorProcessedOrders();
        return view('pages.vendor.orders.processedOrder',compact('processedOrder'));
    }
}