<?php

namespace App\Livewire\Admin;

use App\Models\Category;
use App\Models\Order;
use App\Models\Product;
use App\Models\Reservation;
use Carbon\Carbon;
use Livewire\Component;

class Dashboard extends Component
{
    public $period = '7'; // Default to last 7 days
    
    // Stats
    public $totalOrders;
    public $totalRevenue;
    public $totalProducts;
    public $totalReservations;
    public $pendingOrders;
    public $pendingReservations;
    
    // Growth percentages
    public $ordersGrowth;
    public $revenueGrowth;
    
    // Chart data
    public $revenueChartData = [];
    public $ordersChartData = [];
    
    // Recent items
    public $recentOrders = [];
    public $upcomingReservations = [];
    public $topProducts = [];
    public $ordersByType = [];
    public $ordersByStatus = [];

    public function mount()
    {
        $this->loadStats();
    }

    public function updatedPeriod()
    {
        $this->loadStats();
    }

    public function loadStats()
    {
        $days = (int) $this->period;
        $startDate = Carbon::now()->subDays($days);
        $previousStartDate = Carbon::now()->subDays($days * 2);
        
        // Current period stats
        $this->totalOrders = Order::where('created_at', '>=', $startDate)->count();
        $this->totalRevenue = Order::where('created_at', '>=', $startDate)->sum('total');
        $this->totalProducts = Product::where('is_active', true)->count();
        $this->totalReservations = Reservation::where('created_at', '>=', $startDate)->count();
        $this->pendingOrders = Order::where('status', 'pending')->count();
        $this->pendingReservations = Reservation::where('status', 'pending')->count();
        
        // Previous period stats for growth calculation
        $previousOrders = Order::whereBetween('created_at', [$previousStartDate, $startDate])->count();
        $previousRevenue = Order::whereBetween('created_at', [$previousStartDate, $startDate])->sum('total');
        
        // Calculate growth percentages
        $this->ordersGrowth = $previousOrders > 0 
            ? round((($this->totalOrders - $previousOrders) / $previousOrders) * 100, 1) 
            : ($this->totalOrders > 0 ? 100 : 0);
        
        $this->revenueGrowth = $previousRevenue > 0 
            ? round((($this->totalRevenue - $previousRevenue) / $previousRevenue) * 100, 1) 
            : ($this->totalRevenue > 0 ? 100 : 0);
        
        // Chart data - Revenue by day
        $this->revenueChartData = [];
        $this->ordersChartData = [];
        
        for ($i = $days - 1; $i >= 0; $i--) {
            $date = Carbon::now()->subDays($i);
            $dayRevenue = Order::whereDate('created_at', $date)->sum('total');
            $dayOrders = Order::whereDate('created_at', $date)->count();
            
            $this->revenueChartData[] = [
                'date' => $date->format('M d'),
                'value' => (float) $dayRevenue
            ];
            
            $this->ordersChartData[] = [
                'date' => $date->format('M d'),
                'value' => $dayOrders
            ];
        }
        
        // Recent orders
        $this->recentOrders = Order::with('items.product')
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();
        
        // Upcoming reservations
        $this->upcomingReservations = Reservation::where('date', '>=', Carbon::today())
            ->where('status', '!=', 'cancelled')
            ->orderBy('date')
            ->orderBy('time')
            ->take(5)
            ->get();
        
        // Top selling products
        $this->topProducts = Product::withCount(['category'])
            ->with('category')
            ->where('is_active', true)
            ->take(5)
            ->get();
        
        // Orders by type
        $this->ordersByType = Order::where('created_at', '>=', $startDate)
            ->selectRaw('type, count(*) as count')
            ->groupBy('type')
            ->pluck('count', 'type')
            ->toArray();
        
        // Orders by status
        $this->ordersByStatus = Order::where('created_at', '>=', $startDate)
            ->selectRaw('status, count(*) as count')
            ->groupBy('status')
            ->pluck('count', 'status')
            ->toArray();
    }

    public function render()
    {
        return view('livewire.admin.dashboard')
            ->layout('layouts.admin', ['title' => __('all.Dashboard')]);
    }
}
