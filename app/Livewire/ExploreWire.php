<?php

namespace App\Livewire;

use App\Enums\EventsPriceSortEnum;
use App\Models\Event;
use App\Models\EventCategory;
use Carbon\Carbon;
use Livewire\Attributes\Computed;
use Livewire\Component;

use function Symfony\Component\Clock\now;

class ExploreWire extends Component
{
    public $categories;

    public $selected_categories = [];

    public $search_query;

    public $date_filter_type;

    public $min_price;

    public $max_price;

    public $sort;

    public $sort_filters;

    public function mount()
    {
        $this->categories = EventCategory::all();
        $this->sort_filters = EventsPriceSortEnum::cases();
    }

    public function render()
    {
        return view('livewire.explore-wire');
    }

    #[Computed()]
    public function events()
    {
        $categories = $this->selected_categories;
        $date_filter = null;
        $date_filter_type = $this->date_filter_type;
        $startDate = null;
        $endDate = null;
        $max_price = $this->max_price;
        $min_price = $this->min_price;
        $sort = $this->sort;
        if ($this->date_filter_type == 'today') {
            $date_filter = Carbon::now()->startOfDay()->format('Y-m-d H:i:s');
        } else if ($this->date_filter_type == 'tomorrow') {
            $date_filter = Carbon::now()->addDay()->startOfDay()->format('Y-m-d H:i:s');
        } else if ($this->date_filter_type == 'this week') {
            $startDate = Carbon::now()->startOfWeek(Carbon::SUNDAY)->startOfDay();
            $endDate = Carbon::now()->endOfWeek(Carbon::SATURDAY)->endOfDay();
        } else if ($this->date_filter_type == 'next week') {
            $startDate = Carbon::now()->startOfWeek(Carbon::SUNDAY)->startOfDay()->addWeek();
            $endDate = Carbon::now()->endOfWeek(Carbon::SATURDAY)->endOfDay()->addWeek();
        }
        return Event::when($max_price || $min_price, function ($q) use ($min_price, $max_price) {
            $q->whereHas('tickets', function ($q) use ($max_price, $min_price) {
                $q->when(!is_null($min_price) && $min_price >= 0, function ($q) use ($min_price) {
                    $q->where('base_price', '>=', $min_price);
                })->when(!is_null($max_price) && $max_price > 0, function ($q) use ($max_price) {
                    $q->where('base_price', '<=', $max_price);
                });
            });
        })
            ->withMin('tickets', 'base_price')
            ->withMax('tickets', 'base_price')
            ->when($sort != null, function ($q) use ($sort) {
                $q->when($sort == EventsPriceSortEnum::LOWTOHIGH->value, function ($q) {
                    $q->orderBy('tickets_min_base_price');
                })->when($sort == EventsPriceSortEnum::HIGHTOLOW->value, function ($q) {
                    $q->orderByDesc('tickets_max_base_price');
                });
            })
            ->latest()->where('title', 'LIKE', '%' . $this->search_query . '%')
            ->when((!empty($categories)), function ($query) use ($categories) {
                $query->whereIn('event_category_id', $categories);
            })
            ->when($date_filter_type === 'today' || $date_filter_type === 'tomorrow', function ($query) use ($date_filter) {
                $query->where(function ($q) use ($date_filter) {
                    $q->whereDate('event_date', $date_filter)
                        ->orWhere(function ($q) use ($date_filter) {
                            $q->whereDate('event_date', '<=', $date_filter)
                                ->whereDate('end_date', '>=', $date_filter);
                        });
                });
            })->when($date_filter_type === 'this week' || $date_filter_type === 'next week', function ($query) use ($startDate, $endDate) {
                $query->where(function ($q) use ($startDate, $endDate) {
                    $q->whereBetween('event_date', [$startDate, $endDate])
                        ->orWhere(function ($q) use ($startDate, $endDate) {
                            $q->where('event_date', '<=', $endDate)
                                ->where('end_date', '>=', $startDate);
                        });
                })->get();
            })
            ->get();
    }

    public function search()
    {
        $this->events();
    }

    public function setDateFilter($type)
    {
        $this->date_filter_type = $type;
    }
}
