<?php

namespace App\Livewire;

use Livewire\Component;

class ToggleStatus extends Component
{
    public $model;
    public $modelId;
    public $status;

    public function mount($model, $modelId)
    {
        $modelClass = "\\App\\Models\\$this->model";
        $data = $modelClass::find($this->modelId);
        $this->status = $data ? $data->status : 0;
    }

    public function toggle()
    {
        $modelClass = "\\App\\Models\\$this->model";
        $data = $modelClass::find($this->modelId);

        if(!empty($data)) {
            $data->status = ($data->status == 0) ? 1 : 0;
            $data->save();

            // session()->flash('success', $data->title . ' is ' . (($data->status == 0) ? 'disabled' : 'active'));

            // dd(\Session::get("success"));

            if ($this->model === 'ProductReview') {
                $this->updateProductRating($data->product_id);
            }

            $this->dispatch('notificationSend', [
                'variant' => 'success',
                'title' => 'Status updated',
                'message' => $data->title . ' is ' . (($data->status == 0) ? 'disabled' : 'active')
            ]);
        }
    }

    protected function updateProductRating($productId)
    {
        $product = \App\Models\Product::find($productId);

        if ($product) {
            $reviews = \App\Models\ProductReview::where('product_id', $productId)
                ->where('status', 1) // only active reviews
                ->get();

            $totalReviews = $reviews->count();
            $sumRatings = $reviews->sum('rating');

            $averageRating = $totalReviews > 0 ? $sumRatings / $totalReviews : 0;

            // Update the product
            $product->update([
                'average_rating' => round($averageRating, 1),
                'review_count' => $totalReviews
            ]);
        }
    }

    public function render()
    {
        return view('livewire.toggle-status');
    }
}
