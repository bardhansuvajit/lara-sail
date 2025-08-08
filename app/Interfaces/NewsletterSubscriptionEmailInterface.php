<?php

namespace App\Interfaces;

interface NewsletterSubscriptionEmailInterface
{
    public function list(?String $keyword, Array $filters = [], String $perPage, String $sortBy, String $sortOrder);
    public function subscribe(Array $array);
    // public function unsubscribe(Array $array);
}
