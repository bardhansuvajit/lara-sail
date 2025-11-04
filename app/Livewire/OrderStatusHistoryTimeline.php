<?php

namespace App\Livewire;

use Livewire\Component;
use App\Interfaces\OrderStatusHistoryInterface;
use Livewire\Attributes\On;

class OrderStatusHistoryTimeline extends Component
{
    public $order;
    public $timeline = [];
    private OrderStatusHistoryInterface $orderStatusHistoryRepository;

    public function mount($order)
    {
        $this->order = $order;
        $this->orderStatusHistoryRepository = app(OrderStatusHistoryInterface::class);
        $this->loadStatusHistories();
    }

    public function loadStatusHistories()
    {
        $this->timeline = $this->order->statusHistories;
    }

    public function toggle($id)
    {
        $orderStatusHistoryRepository = app(OrderStatusHistoryInterface::class);
        $response = $orderStatusHistoryRepository->updateFrontendStat($id);

        if ($response['code'] == 200) {
            $this->dispatch('notificationSend', [
                'variant' => 'success',
                'title' => 'Frontend visibility updated',
            ]);

            $this->loadStatusHistories(); // refresh timeline
        } else {
            $this->dispatch('notificationSend', [
                'variant' => 'warning',
                'title' => $response['message'],
            ]);
        }
    }


    #[On('updateorderStatusTimeline')]
    public function updateTimelineOrder(array $ids)
    {
        $ids = array_reverse($ids);

        $orderStatusHistoryRepository = app(OrderStatusHistoryInterface::class);
        $positionResp = $orderStatusHistoryRepository->position($ids);

        if ($positionResp['code'] == 200) {
            $this->dispatch('notificationSend', [
                'variant' => 'success',
                'title' => 'Position updated',
            ]);
            $this->loadStatusHistories();
        } else {
            $this->dispatch('notificationSend', [
                'variant' => 'warning',
                'title' => $positionResp['message'],
            ]);
        }
    }


    public function render()
    {
        return view('livewire.order-status-history-timeline');
    }
}
