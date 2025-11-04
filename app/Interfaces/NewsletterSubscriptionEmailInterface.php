<?php

namespace App\Interfaces;
use Illuminate\Http\UploadedFile;

interface NewsletterSubscriptionEmailInterface
{
    public function list(?String $keyword, array $filters = [], String $perPage, String $sortBy, String $sortOrder);
    public function subscribe(array $array);
    public function getById(int $id);
    public function update(array $array);
    public function delete(int $id);
    public function bulkAction(array $array);
    public function import(UploadedFile $file);
    public function export(?String $keyword, array $filters = [], String $perPage, String $sortBy, String $sortOrder, String $type);
    // public function unsubscribe(array $array);
}
