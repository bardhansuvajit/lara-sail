<?php

app('router')->setCompiledRoutes(
    array (
  'compiled' => 
  array (
    0 => false,
    1 => 
    array (
      '/_debugbar/open' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'debugbar.openhandler',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/_debugbar/assets/stylesheets' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'debugbar.assets.css',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/_debugbar/assets/javascript' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'debugbar.assets.js',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/_debugbar/queries/explain' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'debugbar.queries.explain',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/sanctum/csrf-cookie' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'sanctum.csrf-cookie',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/livewire/update' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'livewire.update',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/livewire/livewire.js' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::bbk3IjVViB32oHWt',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/livewire/livewire.min.js.map' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::JuRZon2JgC3sWAZw',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/livewire/upload-file' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'livewire.upload-file',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/ip/store' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::3q8RpKdcbWPt2kYl',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/variation/store' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::6g62GmY8QH5Osuij',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/variation/check' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::CDvMuXQF9blqJlom',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/up' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::nuko9mnwkrJBZ8Na',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/register' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'front.register',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'front.',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/login' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'front.login',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'front.login.store',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/forgot-password' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'front.password.request',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'front.password.email',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/reset-password' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'front.password.store',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/verify-email' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'front.verification.notice',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/email/verification-notification' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'front.verification.send',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/confirm-password' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'front.password.confirm',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'front.generated::6ztw0qXghRhqA4ms',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/password' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'front.password.update',
          ),
          1 => NULL,
          2 => 
          array (
            'PUT' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/logout' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'front.logout',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/account' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'front.account.index',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/account/edit' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'front.account.edit',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/account/update' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'front.account.update',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/account/update/optional' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'front.account.update.optional',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/address/store' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'front.address.store',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'front.home.index',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/category' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'front.category.index',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/collection' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'front.collection.index',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/cart' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'front.cart.index',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/cart/fetch' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'front.cart.fetch',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/cart/store' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'front.cart.store',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/cart/qty/update' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'front.cart.qty.update',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/cart/update' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'front.cart.update',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/checkout' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'front.checkout.index',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/404' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'front.error.404',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/login' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.login',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/login/check' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.login.check',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/logout' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.logout',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/dashboard' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.dashboard.index',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/profile' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.profile.index',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/profile/edit' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.profile.edit',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/profile/update' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.profile.update',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/profile/password/edit' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.profile.password.edit',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/profile/password/update' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.profile.password.update',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/profile/activity' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.profile.activity.log',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/user' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.user.index',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/user/create' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.user.create',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/user/store' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.user.store',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/user/update' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.user.update',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/user/bulk' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.user.bulk',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/user/import' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.user.import',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/product/listing' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.product.listing.index',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/product/listing/create' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.product.listing.create',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/product/listing/store' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.product.listing.store',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/product/listing/update' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.product.listing.update',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/product/listing/bulk' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.product.listing.bulk',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/product/listing/bulk/edit' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.product.listing.bulk.edit',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/product/listing/bulk/update' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.product.listing.bulk.update',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/product/listing/import' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.product.listing.import',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/product/listing/variation/update' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.product.listing.variation.update',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/product/category' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.product.category.index',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/product/category/create' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.product.category.create',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/product/category/store' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.product.category.store',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/product/category/update' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.product.category.update',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/product/category/bulk' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.product.category.bulk',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/product/category/import' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.product.category.import',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/product/collection' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.product.collection.index',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/product/collection/create' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.product.collection.create',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/product/collection/store' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.product.collection.store',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/product/collection/update' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.product.collection.update',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/product/collection/bulk' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.product.collection.bulk',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/product/collection/import' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.product.collection.import',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/product/collection/position' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.product.collection.position',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/product/pricing' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.product.pricing.index',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/product/pricing/create' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.product.pricing.create',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/product/pricing/store' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.product.pricing.store',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/product/pricing/update' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.product.pricing.update',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/product/pricing/bulk' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.product.pricing.bulk',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/product/pricing/import' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.product.pricing.import',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/product/feature' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.product.feature.index',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/product/review' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.product.review.index',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/product/review/create' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.product.review.create',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/product/review/store' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.product.review.store',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/product/review/update' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.product.review.update',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/product/review/bulk' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.product.review.bulk',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/product/review/import' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.product.review.import',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/product/variation/attribute' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.product.variation.attribute.index',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/product/variation/attribute/create' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.product.variation.attribute.create',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/product/variation/attribute/store' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.product.variation.attribute.store',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/product/variation/attribute/update' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.product.variation.attribute.update',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/product/variation/attribute/bulk' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.product.variation.attribute.bulk',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/product/variation/attribute/import' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.product.variation.attribute.import',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/product/variation/attribute/position' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.product.variation.attribute.position',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/product/variation/attribute/value' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.product.variation.attribute.value.index',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/product/variation/attribute/value/create' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.product.variation.attribute.value.create',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/product/variation/attribute/value/store' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.product.variation.attribute.value.store',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/product/variation/attribute/value/update' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.product.variation.attribute.value.update',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/product/variation/attribute/value/bulk' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.product.variation.attribute.value.bulk',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/product/variation/attribute/value/import' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.product.variation.attribute.value.import',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/product/variation/attribute/value/position' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.product.variation.attribute.value.position',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/master/country' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.master.country.index',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/master/country/create' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.master.country.create',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/master/country/store' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.master.country.store',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/master/country/update' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.master.country.update',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/master/country/bulk' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.master.country.bulk',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/master/country/import' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.master.country.import',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/master/state' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.master.state.index',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/master/state/create' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.master.state.create',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/master/state/store' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.master.state.store',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/master/state/update' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.master.state.update',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/master/state/bulk' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.master.state.bulk',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/master/state/import' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.master.state.import',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/master/city' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.master.city.index',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/master/city/create' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.master.city.create',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/master/city/store' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.master.city.store',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/master/city/update' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.master.city.update',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/master/city/bulk' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.master.city.bulk',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/master/city/import' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.master.city.import',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/developer/trash' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.developer.trash.index',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/developer/trash/update' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.developer.trash.update',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
    ),
    2 => 
    array (
      0 => '{^(?|/_debugbar/c(?|lockwork/([^/]++)(*:39)|ache/([^/]++)(?:/([^/]++))?(*:73))|/livewire/preview\\-file/([^/]++)(*:113)|/a(?|pi/(?|ip/check/([^/]++)(*:149)|cart/(?|device\\-id/([^/]++)(*:184)|user\\-id/([^/]++)(*:209)))|ddress/delete/([^/]++)(*:241))|/reset\\-password/([^/]++)(*:275)|/verify\\-email/([^/]++)/([^/]++)(*:315)|/cart/delete/([^/]++)(*:344)|/([^/]++)(*:361)|/admin/(?|pro(?|file/activity/delete/([^/]++)(*:414)|duct/(?|listing/(?|e(?|dit/([^/]++)(*:457)|xport/([^/]++)(*:479))|delete/([^/]++)(*:503)|variation/(?|edit/([^/]++)(*:537)|delete/([^/]++)(*:560)))|c(?|ategory/(?|e(?|dit/([^/]++)(*:601)|xport/([^/]++)(*:623))|delete/([^/]++)(*:647)|variation/(?|toggle/([^/]++)/([^/]++)(*:692)|delete/([^/]++)(*:715)))|ollection/(?|e(?|dit/([^/]++)(*:754)|xport/([^/]++)(*:776))|delete/([^/]++)(*:800)))|image/delete/([^/]++)(*:831)|pricing/(?|e(?|dit/([^/]++)(*:866)|xport/([^/]++)(*:888))|delete/([^/]++)(*:912))|feature/delete/([^/]++)(*:944)|review/(?|e(?|dit/([^/]++)(*:978)|xport/([^/]++)(*:1000))|delete/([^/]++)(*:1025))|variation/attribute/(?|e(?|dit/([^/]++)(*:1074)|xport/([^/]++)(*:1097))|delete/([^/]++)(*:1122)|value/(?|e(?|dit/([^/]++)(*:1156)|xport/([^/]++)(*:1179))|delete/([^/]++)(*:1204)))))|application/settings/([^/]++)(?|(*:1249)|/(?|edit(*:1266)|update(*:1281)))|user/(?|e(?|dit/([^/]++)(*:1316)|xport/([^/]++)(*:1339))|delete/([^/]++)(*:1364))|master/(?|c(?|ountry/(?|e(?|dit/([^/]++)(*:1414)|xport/([^/]++)(*:1437))|delete/([^/]++)(*:1462))|ity/(?|e(?|dit/([^/]++)(*:1495)|xport/([^/]++)(*:1518))|delete/([^/]++)(*:1543)))|state/(?|e(?|dit/([^/]++)(*:1579)|xport/([^/]++)(*:1602))|delete/([^/]++)(*:1627)))|d(?|eveloper/trash/(?|restore/([^/]++)(*:1676)|export/([^/]++)(*:1700))|ownload\\-sample\\-csv/([^/]++)(*:1739)))|/storage/(.*)(*:1763))/?$}sDu',
    ),
    3 => 
    array (
      39 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'debugbar.clockwork',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      73 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'debugbar.cache.delete',
            'tags' => NULL,
          ),
          1 => 
          array (
            0 => 'key',
            1 => 'tags',
          ),
          2 => 
          array (
            'DELETE' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      113 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'livewire.preview-file',
          ),
          1 => 
          array (
            0 => 'filename',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      149 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::t1pcnRajMnEVPdmO',
          ),
          1 => 
          array (
            0 => 'ip',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      184 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::11K9WtTB4rCHiNPC',
          ),
          1 => 
          array (
            0 => 'deviceId',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      209 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::hlGxZFUcQIkDjthT',
          ),
          1 => 
          array (
            0 => 'userId',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      241 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'front.address.delete',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'DELETE' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      275 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'front.password.reset',
          ),
          1 => 
          array (
            0 => 'token',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      315 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'front.verification.verify',
          ),
          1 => 
          array (
            0 => 'id',
            1 => 'hash',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      344 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'front.cart.delete',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'DELETE' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      361 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'front.product.detail',
          ),
          1 => 
          array (
            0 => 'slug',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      414 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.profile.activity.delete',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'DELETE' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      457 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.product.listing.edit',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      479 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.product.listing.export',
          ),
          1 => 
          array (
            0 => 'type',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      503 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.product.listing.delete',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'DELETE' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      537 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.product.listing.variation.edit',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      560 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.product.listing.variation.delete',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'DELETE' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      601 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.product.category.edit',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      623 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.product.category.export',
          ),
          1 => 
          array (
            0 => 'type',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      647 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.product.category.delete',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'DELETE' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      692 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.product.category.variation.toggle',
          ),
          1 => 
          array (
            0 => 'categoryId',
            1 => 'attrValueId',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      715 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.product.category.variation.delete',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'DELETE' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      754 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.product.collection.edit',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      776 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.product.collection.export',
          ),
          1 => 
          array (
            0 => 'type',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      800 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.product.collection.delete',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'DELETE' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      831 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.product.image.delete',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'DELETE' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      866 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.product.pricing.edit',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      888 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.product.pricing.export',
          ),
          1 => 
          array (
            0 => 'type',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      912 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.product.pricing.delete',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'DELETE' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      944 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.product.feature.delete',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'DELETE' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      978 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.product.review.edit',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      1000 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.product.review.export',
          ),
          1 => 
          array (
            0 => 'type',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      1025 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.product.review.delete',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'DELETE' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      1074 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.product.variation.attribute.edit',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      1097 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.product.variation.attribute.export',
          ),
          1 => 
          array (
            0 => 'type',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      1122 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.product.variation.attribute.delete',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'DELETE' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      1156 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.product.variation.attribute.value.edit',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      1179 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.product.variation.attribute.value.export',
          ),
          1 => 
          array (
            0 => 'type',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      1204 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.product.variation.attribute.value.delete',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'DELETE' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      1249 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.application.settings.index',
          ),
          1 => 
          array (
            0 => 'model',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      1266 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.application.settings.edit',
          ),
          1 => 
          array (
            0 => 'model',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      1281 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.application.settings.update',
          ),
          1 => 
          array (
            0 => 'model',
          ),
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      1316 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.user.edit',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      1339 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.user.export',
          ),
          1 => 
          array (
            0 => 'type',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      1364 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.user.delete',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'DELETE' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      1414 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.master.country.edit',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      1437 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.master.country.export',
          ),
          1 => 
          array (
            0 => 'type',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      1462 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.master.country.delete',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'DELETE' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      1495 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.master.city.edit',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      1518 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.master.city.export',
          ),
          1 => 
          array (
            0 => 'type',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      1543 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.master.city.delete',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'DELETE' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      1579 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.master.state.edit',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      1602 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.master.state.export',
          ),
          1 => 
          array (
            0 => 'type',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      1627 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.master.state.delete',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'DELETE' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      1676 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.developer.trash.restore',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      1700 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.developer.trash.export',
          ),
          1 => 
          array (
            0 => 'type',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      1739 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.csv-template.download',
          ),
          1 => 
          array (
            0 => 'model',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      1763 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'storage.local',
          ),
          1 => 
          array (
            0 => 'path',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
        1 => 
        array (
          0 => NULL,
          1 => NULL,
          2 => NULL,
          3 => NULL,
          4 => false,
          5 => false,
          6 => 0,
        ),
      ),
    ),
    4 => NULL,
  ),
  'attributes' => 
  array (
    'debugbar.openhandler' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => '_debugbar/open',
      'action' => 
      array (
        'domain' => NULL,
        'middleware' => 
        array (
          0 => 'Barryvdh\\Debugbar\\Middleware\\DebugbarEnabled',
        ),
        'uses' => 'Barryvdh\\Debugbar\\Controllers\\OpenHandlerController@handle',
        'as' => 'debugbar.openhandler',
        'controller' => 'Barryvdh\\Debugbar\\Controllers\\OpenHandlerController@handle',
        'namespace' => 'Barryvdh\\Debugbar\\Controllers',
        'prefix' => '_debugbar',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'debugbar.clockwork' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => '_debugbar/clockwork/{id}',
      'action' => 
      array (
        'domain' => NULL,
        'middleware' => 
        array (
          0 => 'Barryvdh\\Debugbar\\Middleware\\DebugbarEnabled',
        ),
        'uses' => 'Barryvdh\\Debugbar\\Controllers\\OpenHandlerController@clockwork',
        'as' => 'debugbar.clockwork',
        'controller' => 'Barryvdh\\Debugbar\\Controllers\\OpenHandlerController@clockwork',
        'namespace' => 'Barryvdh\\Debugbar\\Controllers',
        'prefix' => '_debugbar',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'debugbar.assets.css' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => '_debugbar/assets/stylesheets',
      'action' => 
      array (
        'domain' => NULL,
        'middleware' => 
        array (
          0 => 'Barryvdh\\Debugbar\\Middleware\\DebugbarEnabled',
        ),
        'uses' => 'Barryvdh\\Debugbar\\Controllers\\AssetController@css',
        'as' => 'debugbar.assets.css',
        'controller' => 'Barryvdh\\Debugbar\\Controllers\\AssetController@css',
        'namespace' => 'Barryvdh\\Debugbar\\Controllers',
        'prefix' => '_debugbar',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'debugbar.assets.js' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => '_debugbar/assets/javascript',
      'action' => 
      array (
        'domain' => NULL,
        'middleware' => 
        array (
          0 => 'Barryvdh\\Debugbar\\Middleware\\DebugbarEnabled',
        ),
        'uses' => 'Barryvdh\\Debugbar\\Controllers\\AssetController@js',
        'as' => 'debugbar.assets.js',
        'controller' => 'Barryvdh\\Debugbar\\Controllers\\AssetController@js',
        'namespace' => 'Barryvdh\\Debugbar\\Controllers',
        'prefix' => '_debugbar',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'debugbar.cache.delete' => 
    array (
      'methods' => 
      array (
        0 => 'DELETE',
      ),
      'uri' => '_debugbar/cache/{key}/{tags?}',
      'action' => 
      array (
        'domain' => NULL,
        'middleware' => 
        array (
          0 => 'Barryvdh\\Debugbar\\Middleware\\DebugbarEnabled',
        ),
        'uses' => 'Barryvdh\\Debugbar\\Controllers\\CacheController@delete',
        'as' => 'debugbar.cache.delete',
        'controller' => 'Barryvdh\\Debugbar\\Controllers\\CacheController@delete',
        'namespace' => 'Barryvdh\\Debugbar\\Controllers',
        'prefix' => '_debugbar',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'debugbar.queries.explain' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => '_debugbar/queries/explain',
      'action' => 
      array (
        'domain' => NULL,
        'middleware' => 
        array (
          0 => 'Barryvdh\\Debugbar\\Middleware\\DebugbarEnabled',
        ),
        'uses' => 'Barryvdh\\Debugbar\\Controllers\\QueriesController@explain',
        'as' => 'debugbar.queries.explain',
        'controller' => 'Barryvdh\\Debugbar\\Controllers\\QueriesController@explain',
        'namespace' => 'Barryvdh\\Debugbar\\Controllers',
        'prefix' => '_debugbar',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'sanctum.csrf-cookie' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'sanctum/csrf-cookie',
      'action' => 
      array (
        'uses' => 'Laravel\\Sanctum\\Http\\Controllers\\CsrfCookieController@show',
        'controller' => 'Laravel\\Sanctum\\Http\\Controllers\\CsrfCookieController@show',
        'namespace' => NULL,
        'prefix' => 'sanctum',
        'where' => 
        array (
        ),
        'middleware' => 
        array (
          0 => 'web',
        ),
        'as' => 'sanctum.csrf-cookie',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'livewire.update' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'livewire/update',
      'action' => 
      array (
        'uses' => 'Livewire\\Mechanisms\\HandleRequests\\HandleRequests@handleUpdate',
        'controller' => 'Livewire\\Mechanisms\\HandleRequests\\HandleRequests@handleUpdate',
        'middleware' => 
        array (
          0 => 'web',
        ),
        'as' => 'livewire.update',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::bbk3IjVViB32oHWt' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'livewire/livewire.js',
      'action' => 
      array (
        'uses' => 'Livewire\\Mechanisms\\FrontendAssets\\FrontendAssets@returnJavaScriptAsFile',
        'controller' => 'Livewire\\Mechanisms\\FrontendAssets\\FrontendAssets@returnJavaScriptAsFile',
        'as' => 'generated::bbk3IjVViB32oHWt',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::JuRZon2JgC3sWAZw' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'livewire/livewire.min.js.map',
      'action' => 
      array (
        'uses' => 'Livewire\\Mechanisms\\FrontendAssets\\FrontendAssets@maps',
        'controller' => 'Livewire\\Mechanisms\\FrontendAssets\\FrontendAssets@maps',
        'as' => 'generated::JuRZon2JgC3sWAZw',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'livewire.upload-file' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'livewire/upload-file',
      'action' => 
      array (
        'uses' => 'Livewire\\Features\\SupportFileUploads\\FileUploadController@handle',
        'controller' => 'Livewire\\Features\\SupportFileUploads\\FileUploadController@handle',
        'as' => 'livewire.upload-file',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'livewire.preview-file' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'livewire/preview-file/{filename}',
      'action' => 
      array (
        'uses' => 'Livewire\\Features\\SupportFileUploads\\FilePreviewController@handle',
        'controller' => 'Livewire\\Features\\SupportFileUploads\\FilePreviewController@handle',
        'as' => 'livewire.preview-file',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::t1pcnRajMnEVPdmO' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'api/ip/check/{ip}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\Ip\\IpController@check',
        'controller' => 'App\\Http\\Controllers\\Api\\Ip\\IpController@check',
        'namespace' => NULL,
        'prefix' => 'api/ip',
        'where' => 
        array (
        ),
        'as' => 'generated::t1pcnRajMnEVPdmO',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::3q8RpKdcbWPt2kYl' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/ip/store',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\Ip\\IpController@store',
        'controller' => 'App\\Http\\Controllers\\Api\\Ip\\IpController@store',
        'namespace' => NULL,
        'prefix' => 'api/ip',
        'where' => 
        array (
        ),
        'as' => 'generated::3q8RpKdcbWPt2kYl',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::11K9WtTB4rCHiNPC' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'api/cart/device-id/{deviceId}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\Cart\\CartController@indexDeviceId',
        'controller' => 'App\\Http\\Controllers\\Api\\Cart\\CartController@indexDeviceId',
        'namespace' => NULL,
        'prefix' => 'api/cart',
        'where' => 
        array (
        ),
        'as' => 'generated::11K9WtTB4rCHiNPC',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::hlGxZFUcQIkDjthT' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'api/cart/user-id/{userId}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\Cart\\CartController@indexUserId',
        'controller' => 'App\\Http\\Controllers\\Api\\Cart\\CartController@indexUserId',
        'namespace' => NULL,
        'prefix' => 'api/cart',
        'where' => 
        array (
        ),
        'as' => 'generated::hlGxZFUcQIkDjthT',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::6g62GmY8QH5Osuij' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/variation/store',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\Product\\Variation\\ProductVariationController@store',
        'controller' => 'App\\Http\\Controllers\\Api\\Product\\Variation\\ProductVariationController@store',
        'namespace' => NULL,
        'prefix' => 'api/variation',
        'where' => 
        array (
        ),
        'as' => 'generated::6g62GmY8QH5Osuij',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::CDvMuXQF9blqJlom' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/variation/check',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\Product\\Variation\\ProductVariationCombinationController@check',
        'controller' => 'App\\Http\\Controllers\\Api\\Product\\Variation\\ProductVariationCombinationController@check',
        'namespace' => NULL,
        'prefix' => 'api/variation',
        'where' => 
        array (
        ),
        'as' => 'generated::CDvMuXQF9blqJlom',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::nuko9mnwkrJBZ8Na' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'up',
      'action' => 
      array (
        'uses' => 'O:55:"Laravel\\SerializableClosure\\UnsignedSerializableClosure":1:{s:12:"serializable";O:46:"Laravel\\SerializableClosure\\Serializers\\Native":5:{s:3:"use";a:0:{}s:8:"function";s:807:"function () {
                    $exception = null;

                    try {
                        \\Illuminate\\Support\\Facades\\Event::dispatch(new \\Illuminate\\Foundation\\Events\\DiagnosingHealth);
                    } catch (\\Throwable $e) {
                        if (app()->hasDebugModeEnabled()) {
                            throw $e;
                        }

                        report($e);

                        $exception = $e->getMessage();
                    }

                    return response(\\Illuminate\\Support\\Facades\\View::file(\'/var/www/html/vendor/laravel/framework/src/Illuminate/Foundation/Configuration\'.\'/../resources/health-up.blade.php\', [
                        \'exception\' => $exception,
                    ]), status: $exception ? 500 : 200);
                }";s:5:"scope";s:54:"Illuminate\\Foundation\\Configuration\\ApplicationBuilder";s:4:"this";N;s:4:"self";s:32:"00000000000007fb0000000000000000";}}',
        'as' => 'generated::nuko9mnwkrJBZ8Na',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'front.register' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'register',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'guest',
        ),
        'uses' => 'App\\Http\\Controllers\\Front\\Auth\\RegisteredUserController@create',
        'controller' => 'App\\Http\\Controllers\\Front\\Auth\\RegisteredUserController@create',
        'as' => 'front.register',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'front.' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'register',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'guest',
        ),
        'uses' => 'App\\Http\\Controllers\\Front\\Auth\\RegisteredUserController@store',
        'controller' => 'App\\Http\\Controllers\\Front\\Auth\\RegisteredUserController@store',
        'as' => 'front.',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'front.login' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'login',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'guest',
        ),
        'uses' => 'App\\Http\\Controllers\\Front\\Auth\\AuthenticatedSessionController@create',
        'controller' => 'App\\Http\\Controllers\\Front\\Auth\\AuthenticatedSessionController@create',
        'as' => 'front.login',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'front.login.store' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'login',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'guest',
        ),
        'uses' => 'App\\Http\\Controllers\\Front\\Auth\\AuthenticatedSessionController@store',
        'controller' => 'App\\Http\\Controllers\\Front\\Auth\\AuthenticatedSessionController@store',
        'as' => 'front.login.store',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'front.password.request' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'forgot-password',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'guest',
        ),
        'uses' => 'App\\Http\\Controllers\\Front\\Auth\\PasswordResetLinkController@create',
        'controller' => 'App\\Http\\Controllers\\Front\\Auth\\PasswordResetLinkController@create',
        'as' => 'front.password.request',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'front.password.email' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'forgot-password',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'guest',
        ),
        'uses' => 'App\\Http\\Controllers\\Front\\Auth\\PasswordResetLinkController@store',
        'controller' => 'App\\Http\\Controllers\\Front\\Auth\\PasswordResetLinkController@store',
        'as' => 'front.password.email',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'front.password.reset' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'reset-password/{token}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'guest',
        ),
        'uses' => 'App\\Http\\Controllers\\Front\\Auth\\NewPasswordController@create',
        'controller' => 'App\\Http\\Controllers\\Front\\Auth\\NewPasswordController@create',
        'as' => 'front.password.reset',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'front.password.store' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'reset-password',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'guest',
        ),
        'uses' => 'App\\Http\\Controllers\\Front\\Auth\\NewPasswordController@store',
        'controller' => 'App\\Http\\Controllers\\Front\\Auth\\NewPasswordController@store',
        'as' => 'front.password.store',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'front.verification.notice' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'verify-email',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\Front\\Auth\\EmailVerificationPromptController@__invoke',
        'controller' => 'App\\Http\\Controllers\\Front\\Auth\\EmailVerificationPromptController',
        'as' => 'front.verification.notice',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'front.verification.verify' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'verify-email/{id}/{hash}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'signed',
          3 => 'throttle:6,1',
        ),
        'uses' => 'App\\Http\\Controllers\\Front\\Auth\\VerifyEmailController@__invoke',
        'controller' => 'App\\Http\\Controllers\\Front\\Auth\\VerifyEmailController',
        'as' => 'front.verification.verify',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'front.verification.send' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'email/verification-notification',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'throttle:6,1',
        ),
        'uses' => 'App\\Http\\Controllers\\Front\\Auth\\EmailVerificationNotificationController@store',
        'controller' => 'App\\Http\\Controllers\\Front\\Auth\\EmailVerificationNotificationController@store',
        'as' => 'front.verification.send',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'front.password.confirm' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'confirm-password',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\Front\\Auth\\ConfirmablePasswordController@show',
        'controller' => 'App\\Http\\Controllers\\Front\\Auth\\ConfirmablePasswordController@show',
        'as' => 'front.password.confirm',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'front.generated::6ztw0qXghRhqA4ms' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'confirm-password',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\Front\\Auth\\ConfirmablePasswordController@store',
        'controller' => 'App\\Http\\Controllers\\Front\\Auth\\ConfirmablePasswordController@store',
        'as' => 'front.generated::6ztw0qXghRhqA4ms',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'front.password.update' => 
    array (
      'methods' => 
      array (
        0 => 'PUT',
      ),
      'uri' => 'password',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\Front\\Auth\\PasswordController@update',
        'controller' => 'App\\Http\\Controllers\\Front\\Auth\\PasswordController@update',
        'as' => 'front.password.update',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'front.logout' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'logout',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\Front\\Auth\\AuthenticatedSessionController@destroy',
        'controller' => 'App\\Http\\Controllers\\Front\\Auth\\AuthenticatedSessionController@destroy',
        'as' => 'front.logout',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'front.account.index' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'account',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\Front\\Account\\AccountController@index',
        'controller' => 'App\\Http\\Controllers\\Front\\Account\\AccountController@index',
        'as' => 'front.account.index',
        'namespace' => NULL,
        'prefix' => '/account',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'front.account.edit' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'account/edit',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\Front\\Account\\AccountController@edit',
        'controller' => 'App\\Http\\Controllers\\Front\\Account\\AccountController@edit',
        'as' => 'front.account.edit',
        'namespace' => NULL,
        'prefix' => '/account',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'front.account.update' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'account/update',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\Front\\Account\\AccountController@update',
        'controller' => 'App\\Http\\Controllers\\Front\\Account\\AccountController@update',
        'as' => 'front.account.update',
        'namespace' => NULL,
        'prefix' => '/account',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'front.account.update.optional' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'account/update/optional',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\Front\\Account\\AccountController@updateOptional',
        'controller' => 'App\\Http\\Controllers\\Front\\Account\\AccountController@updateOptional',
        'as' => 'front.account.update.optional',
        'namespace' => NULL,
        'prefix' => '/account',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'front.address.store' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'address/store',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\Front\\Address\\AddressController@store',
        'controller' => 'App\\Http\\Controllers\\Front\\Address\\AddressController@store',
        'as' => 'front.address.store',
        'namespace' => NULL,
        'prefix' => '/address',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'front.address.delete' => 
    array (
      'methods' => 
      array (
        0 => 'DELETE',
      ),
      'uri' => 'address/delete/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\Front\\Address\\AddressController@delete',
        'controller' => 'App\\Http\\Controllers\\Front\\Address\\AddressController@delete',
        'as' => 'front.address.delete',
        'namespace' => NULL,
        'prefix' => '/address',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'front.home.index' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => '/',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\Front\\Home\\IndexController@index',
        'controller' => 'App\\Http\\Controllers\\Front\\Home\\IndexController@index',
        'as' => 'front.home.index',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'front.category.index' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'category',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\Front\\Category\\CategoryController@index',
        'controller' => 'App\\Http\\Controllers\\Front\\Category\\CategoryController@index',
        'as' => 'front.category.index',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'front.collection.index' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'collection',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\Front\\Category\\CategoryController@index',
        'controller' => 'App\\Http\\Controllers\\Front\\Category\\CategoryController@index',
        'as' => 'front.collection.index',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'front.cart.index' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'cart',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\Front\\Cart\\CartController@index',
        'controller' => 'App\\Http\\Controllers\\Front\\Cart\\CartController@index',
        'as' => 'front.cart.index',
        'namespace' => NULL,
        'prefix' => '/cart',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'front.cart.fetch' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'cart/fetch',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\Front\\Cart\\CartController@fetch',
        'controller' => 'App\\Http\\Controllers\\Front\\Cart\\CartController@fetch',
        'as' => 'front.cart.fetch',
        'namespace' => NULL,
        'prefix' => '/cart',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'front.cart.store' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'cart/store',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\Front\\Cart\\CartController@store',
        'controller' => 'App\\Http\\Controllers\\Front\\Cart\\CartController@store',
        'as' => 'front.cart.store',
        'namespace' => NULL,
        'prefix' => '/cart',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'front.cart.qty.update' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'cart/qty/update',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\Front\\Cart\\CartController@qtyUpdate',
        'controller' => 'App\\Http\\Controllers\\Front\\Cart\\CartController@qtyUpdate',
        'as' => 'front.cart.qty.update',
        'namespace' => NULL,
        'prefix' => '/cart',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'front.cart.update' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'cart/update',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\Front\\Cart\\CartController@update',
        'controller' => 'App\\Http\\Controllers\\Front\\Cart\\CartController@update',
        'as' => 'front.cart.update',
        'namespace' => NULL,
        'prefix' => '/cart',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'front.cart.delete' => 
    array (
      'methods' => 
      array (
        0 => 'DELETE',
      ),
      'uri' => 'cart/delete/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\Front\\Cart\\CartController@delete',
        'controller' => 'App\\Http\\Controllers\\Front\\Cart\\CartController@delete',
        'as' => 'front.cart.delete',
        'namespace' => NULL,
        'prefix' => '/cart',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'front.checkout.index' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'checkout',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\Front\\Checkout\\CheckoutController@index',
        'controller' => 'App\\Http\\Controllers\\Front\\Checkout\\CheckoutController@index',
        'as' => 'front.checkout.index',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'front.error.404' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => '404',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'ErrorPageController@index',
        'controller' => 'ErrorPageController@index',
        'as' => 'front.error.404',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'front.product.detail' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => '{slug}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\Front\\Product\\ProductController@detail',
        'controller' => 'App\\Http\\Controllers\\Front\\Product\\ProductController@detail',
        'as' => 'front.product.detail',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.login' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/login',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'redirectAdminIfAuthenticated',
          2 => 'guest:admin',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\Auth\\LoginController@showLoginForm',
        'controller' => 'App\\Http\\Controllers\\Admin\\Auth\\LoginController@showLoginForm',
        'as' => 'admin.login',
        'namespace' => NULL,
        'prefix' => '/admin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.login.check' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'admin/login/check',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'redirectAdminIfAuthenticated',
          2 => 'guest:admin',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\Auth\\LoginController@loginCheck',
        'controller' => 'App\\Http\\Controllers\\Admin\\Auth\\LoginController@loginCheck',
        'as' => 'admin.login.check',
        'namespace' => NULL,
        'prefix' => '/admin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.logout' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'admin/logout',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'redirectAdminIfNotAuthenticated',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\Auth\\LoginController@destroy',
        'controller' => 'App\\Http\\Controllers\\Admin\\Auth\\LoginController@destroy',
        'as' => 'admin.logout',
        'namespace' => NULL,
        'prefix' => '/admin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.dashboard.index' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/dashboard',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'redirectAdminIfNotAuthenticated',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\Dashboard\\DashboardController@index',
        'controller' => 'App\\Http\\Controllers\\Admin\\Dashboard\\DashboardController@index',
        'as' => 'admin.dashboard.index',
        'namespace' => NULL,
        'prefix' => 'admin/dashboard',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.profile.index' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/profile',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'redirectAdminIfNotAuthenticated',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\Profile\\ProfileController@index',
        'controller' => 'App\\Http\\Controllers\\Admin\\Profile\\ProfileController@index',
        'as' => 'admin.profile.index',
        'namespace' => NULL,
        'prefix' => 'admin/profile',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.profile.edit' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/profile/edit',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'redirectAdminIfNotAuthenticated',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\Profile\\ProfileController@edit',
        'controller' => 'App\\Http\\Controllers\\Admin\\Profile\\ProfileController@edit',
        'as' => 'admin.profile.edit',
        'namespace' => NULL,
        'prefix' => 'admin/profile',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.profile.update' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'admin/profile/update',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'redirectAdminIfNotAuthenticated',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\Profile\\ProfileController@update',
        'controller' => 'App\\Http\\Controllers\\Admin\\Profile\\ProfileController@update',
        'as' => 'admin.profile.update',
        'namespace' => NULL,
        'prefix' => 'admin/profile',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.profile.password.edit' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/profile/password/edit',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'redirectAdminIfNotAuthenticated',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\Password\\PasswordController@edit',
        'controller' => 'App\\Http\\Controllers\\Admin\\Password\\PasswordController@edit',
        'as' => 'admin.profile.password.edit',
        'namespace' => NULL,
        'prefix' => 'admin/profile/password',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.profile.password.update' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'admin/profile/password/update',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'redirectAdminIfNotAuthenticated',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\Password\\PasswordController@update',
        'controller' => 'App\\Http\\Controllers\\Admin\\Password\\PasswordController@update',
        'as' => 'admin.profile.password.update',
        'namespace' => NULL,
        'prefix' => 'admin/profile/password',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.profile.activity.log' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/profile/activity',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'redirectAdminIfNotAuthenticated',
        ),
        'uses' => 'ActivityController@index',
        'controller' => 'ActivityController@index',
        'as' => 'admin.profile.activity.log',
        'namespace' => NULL,
        'prefix' => 'admin/profile/activity',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.profile.activity.delete' => 
    array (
      'methods' => 
      array (
        0 => 'DELETE',
      ),
      'uri' => 'admin/profile/activity/delete/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'redirectAdminIfNotAuthenticated',
        ),
        'uses' => 'ActivityController@delete',
        'controller' => 'ActivityController@delete',
        'as' => 'admin.profile.activity.delete',
        'namespace' => NULL,
        'prefix' => 'admin/profile/activity',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.application.settings.index' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/application/settings/{model}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'redirectAdminIfNotAuthenticated',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\Application\\ApplicationSettingsController@index',
        'controller' => 'App\\Http\\Controllers\\Admin\\Application\\ApplicationSettingsController@index',
        'as' => 'admin.application.settings.index',
        'namespace' => NULL,
        'prefix' => 'admin/application/settings',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.application.settings.edit' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/application/settings/{model}/edit',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'redirectAdminIfNotAuthenticated',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\Application\\ApplicationSettingsController@edit',
        'controller' => 'App\\Http\\Controllers\\Admin\\Application\\ApplicationSettingsController@edit',
        'as' => 'admin.application.settings.edit',
        'namespace' => NULL,
        'prefix' => 'admin/application/settings',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.application.settings.update' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'admin/application/settings/{model}/update',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'redirectAdminIfNotAuthenticated',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\Application\\ApplicationSettingsController@update',
        'controller' => 'App\\Http\\Controllers\\Admin\\Application\\ApplicationSettingsController@update',
        'as' => 'admin.application.settings.update',
        'namespace' => NULL,
        'prefix' => 'admin/application/settings',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.user.index' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/user',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'redirectAdminIfNotAuthenticated',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\User\\UserController@index',
        'controller' => 'App\\Http\\Controllers\\Admin\\User\\UserController@index',
        'as' => 'admin.user.index',
        'namespace' => NULL,
        'prefix' => 'admin/user',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.user.create' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/user/create',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'redirectAdminIfNotAuthenticated',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\User\\UserController@create',
        'controller' => 'App\\Http\\Controllers\\Admin\\User\\UserController@create',
        'as' => 'admin.user.create',
        'namespace' => NULL,
        'prefix' => 'admin/user',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.user.store' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'admin/user/store',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'redirectAdminIfNotAuthenticated',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\User\\UserController@store',
        'controller' => 'App\\Http\\Controllers\\Admin\\User\\UserController@store',
        'as' => 'admin.user.store',
        'namespace' => NULL,
        'prefix' => 'admin/user',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.user.edit' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/user/edit/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'redirectAdminIfNotAuthenticated',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\User\\UserController@edit',
        'controller' => 'App\\Http\\Controllers\\Admin\\User\\UserController@edit',
        'as' => 'admin.user.edit',
        'namespace' => NULL,
        'prefix' => 'admin/user',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.user.update' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'admin/user/update',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'redirectAdminIfNotAuthenticated',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\User\\UserController@update',
        'controller' => 'App\\Http\\Controllers\\Admin\\User\\UserController@update',
        'as' => 'admin.user.update',
        'namespace' => NULL,
        'prefix' => 'admin/user',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.user.delete' => 
    array (
      'methods' => 
      array (
        0 => 'DELETE',
      ),
      'uri' => 'admin/user/delete/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'redirectAdminIfNotAuthenticated',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\User\\UserController@delete',
        'controller' => 'App\\Http\\Controllers\\Admin\\User\\UserController@delete',
        'as' => 'admin.user.delete',
        'namespace' => NULL,
        'prefix' => 'admin/user',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.user.bulk' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'admin/user/bulk',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'redirectAdminIfNotAuthenticated',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\User\\UserController@bulk',
        'controller' => 'App\\Http\\Controllers\\Admin\\User\\UserController@bulk',
        'as' => 'admin.user.bulk',
        'namespace' => NULL,
        'prefix' => 'admin/user',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.user.import' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'admin/user/import',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'redirectAdminIfNotAuthenticated',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\User\\UserController@import',
        'controller' => 'App\\Http\\Controllers\\Admin\\User\\UserController@import',
        'as' => 'admin.user.import',
        'namespace' => NULL,
        'prefix' => 'admin/user',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.user.export' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/user/export/{type}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'redirectAdminIfNotAuthenticated',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\User\\UserController@export',
        'controller' => 'App\\Http\\Controllers\\Admin\\User\\UserController@export',
        'as' => 'admin.user.export',
        'namespace' => NULL,
        'prefix' => 'admin/user',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.product.listing.index' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/product/listing',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'redirectAdminIfNotAuthenticated',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\Product\\Listing\\ProductListingController@index',
        'controller' => 'App\\Http\\Controllers\\Admin\\Product\\Listing\\ProductListingController@index',
        'as' => 'admin.product.listing.index',
        'namespace' => NULL,
        'prefix' => 'admin/product/listing',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.product.listing.create' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/product/listing/create',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'redirectAdminIfNotAuthenticated',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\Product\\Listing\\ProductListingController@create',
        'controller' => 'App\\Http\\Controllers\\Admin\\Product\\Listing\\ProductListingController@create',
        'as' => 'admin.product.listing.create',
        'namespace' => NULL,
        'prefix' => 'admin/product/listing',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.product.listing.store' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'admin/product/listing/store',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'redirectAdminIfNotAuthenticated',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\Product\\Listing\\ProductListingController@store',
        'controller' => 'App\\Http\\Controllers\\Admin\\Product\\Listing\\ProductListingController@store',
        'as' => 'admin.product.listing.store',
        'namespace' => NULL,
        'prefix' => 'admin/product/listing',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.product.listing.edit' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/product/listing/edit/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'redirectAdminIfNotAuthenticated',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\Product\\Listing\\ProductListingController@edit',
        'controller' => 'App\\Http\\Controllers\\Admin\\Product\\Listing\\ProductListingController@edit',
        'as' => 'admin.product.listing.edit',
        'namespace' => NULL,
        'prefix' => 'admin/product/listing',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.product.listing.update' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'admin/product/listing/update',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'redirectAdminIfNotAuthenticated',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\Product\\Listing\\ProductListingController@update',
        'controller' => 'App\\Http\\Controllers\\Admin\\Product\\Listing\\ProductListingController@update',
        'as' => 'admin.product.listing.update',
        'namespace' => NULL,
        'prefix' => 'admin/product/listing',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.product.listing.delete' => 
    array (
      'methods' => 
      array (
        0 => 'DELETE',
      ),
      'uri' => 'admin/product/listing/delete/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'redirectAdminIfNotAuthenticated',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\Product\\Listing\\ProductListingController@delete',
        'controller' => 'App\\Http\\Controllers\\Admin\\Product\\Listing\\ProductListingController@delete',
        'as' => 'admin.product.listing.delete',
        'namespace' => NULL,
        'prefix' => 'admin/product/listing',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.product.listing.bulk' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'admin/product/listing/bulk',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'redirectAdminIfNotAuthenticated',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\Product\\Listing\\ProductListingController@bulk',
        'controller' => 'App\\Http\\Controllers\\Admin\\Product\\Listing\\ProductListingController@bulk',
        'as' => 'admin.product.listing.bulk',
        'namespace' => NULL,
        'prefix' => 'admin/product/listing',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.product.listing.bulk.edit' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/product/listing/bulk/edit',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'redirectAdminIfNotAuthenticated',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\Product\\Listing\\ProductListingController@bulkEdit',
        'controller' => 'App\\Http\\Controllers\\Admin\\Product\\Listing\\ProductListingController@bulkEdit',
        'as' => 'admin.product.listing.bulk.edit',
        'namespace' => NULL,
        'prefix' => 'admin/product/listing',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.product.listing.bulk.update' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'admin/product/listing/bulk/update',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'redirectAdminIfNotAuthenticated',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\Product\\Listing\\ProductListingController@bulkUpdate',
        'controller' => 'App\\Http\\Controllers\\Admin\\Product\\Listing\\ProductListingController@bulkUpdate',
        'as' => 'admin.product.listing.bulk.update',
        'namespace' => NULL,
        'prefix' => 'admin/product/listing',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.product.listing.import' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'admin/product/listing/import',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'redirectAdminIfNotAuthenticated',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\Product\\Listing\\ProductListingController@import',
        'controller' => 'App\\Http\\Controllers\\Admin\\Product\\Listing\\ProductListingController@import',
        'as' => 'admin.product.listing.import',
        'namespace' => NULL,
        'prefix' => 'admin/product/listing',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.product.listing.export' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/product/listing/export/{type}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'redirectAdminIfNotAuthenticated',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\Product\\Listing\\ProductListingController@export',
        'controller' => 'App\\Http\\Controllers\\Admin\\Product\\Listing\\ProductListingController@export',
        'as' => 'admin.product.listing.export',
        'namespace' => NULL,
        'prefix' => 'admin/product/listing',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.product.listing.variation.edit' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/product/listing/variation/edit/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'redirectAdminIfNotAuthenticated',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\Product\\Variation\\ProductVariationController@edit',
        'controller' => 'App\\Http\\Controllers\\Admin\\Product\\Variation\\ProductVariationController@edit',
        'as' => 'admin.product.listing.variation.edit',
        'namespace' => NULL,
        'prefix' => 'admin/product/listing/variation',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.product.listing.variation.update' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'admin/product/listing/variation/update',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'redirectAdminIfNotAuthenticated',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\Product\\Variation\\ProductVariationController@update',
        'controller' => 'App\\Http\\Controllers\\Admin\\Product\\Variation\\ProductVariationController@update',
        'as' => 'admin.product.listing.variation.update',
        'namespace' => NULL,
        'prefix' => 'admin/product/listing/variation',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.product.listing.variation.delete' => 
    array (
      'methods' => 
      array (
        0 => 'DELETE',
      ),
      'uri' => 'admin/product/listing/variation/delete/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'redirectAdminIfNotAuthenticated',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\Product\\Variation\\ProductVariationController@delete',
        'controller' => 'App\\Http\\Controllers\\Admin\\Product\\Variation\\ProductVariationController@delete',
        'as' => 'admin.product.listing.variation.delete',
        'namespace' => NULL,
        'prefix' => 'admin/product/listing/variation',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.product.category.index' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/product/category',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'redirectAdminIfNotAuthenticated',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\Product\\Category\\ProductCategoryController@index',
        'controller' => 'App\\Http\\Controllers\\Admin\\Product\\Category\\ProductCategoryController@index',
        'as' => 'admin.product.category.index',
        'namespace' => NULL,
        'prefix' => 'admin/product/category',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.product.category.create' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/product/category/create',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'redirectAdminIfNotAuthenticated',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\Product\\Category\\ProductCategoryController@create',
        'controller' => 'App\\Http\\Controllers\\Admin\\Product\\Category\\ProductCategoryController@create',
        'as' => 'admin.product.category.create',
        'namespace' => NULL,
        'prefix' => 'admin/product/category',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.product.category.store' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'admin/product/category/store',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'redirectAdminIfNotAuthenticated',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\Product\\Category\\ProductCategoryController@store',
        'controller' => 'App\\Http\\Controllers\\Admin\\Product\\Category\\ProductCategoryController@store',
        'as' => 'admin.product.category.store',
        'namespace' => NULL,
        'prefix' => 'admin/product/category',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.product.category.edit' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/product/category/edit/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'redirectAdminIfNotAuthenticated',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\Product\\Category\\ProductCategoryController@edit',
        'controller' => 'App\\Http\\Controllers\\Admin\\Product\\Category\\ProductCategoryController@edit',
        'as' => 'admin.product.category.edit',
        'namespace' => NULL,
        'prefix' => 'admin/product/category',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.product.category.update' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'admin/product/category/update',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'redirectAdminIfNotAuthenticated',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\Product\\Category\\ProductCategoryController@update',
        'controller' => 'App\\Http\\Controllers\\Admin\\Product\\Category\\ProductCategoryController@update',
        'as' => 'admin.product.category.update',
        'namespace' => NULL,
        'prefix' => 'admin/product/category',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.product.category.delete' => 
    array (
      'methods' => 
      array (
        0 => 'DELETE',
      ),
      'uri' => 'admin/product/category/delete/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'redirectAdminIfNotAuthenticated',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\Product\\Category\\ProductCategoryController@delete',
        'controller' => 'App\\Http\\Controllers\\Admin\\Product\\Category\\ProductCategoryController@delete',
        'as' => 'admin.product.category.delete',
        'namespace' => NULL,
        'prefix' => 'admin/product/category',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.product.category.bulk' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'admin/product/category/bulk',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'redirectAdminIfNotAuthenticated',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\Product\\Category\\ProductCategoryController@bulk',
        'controller' => 'App\\Http\\Controllers\\Admin\\Product\\Category\\ProductCategoryController@bulk',
        'as' => 'admin.product.category.bulk',
        'namespace' => NULL,
        'prefix' => 'admin/product/category',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.product.category.import' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'admin/product/category/import',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'redirectAdminIfNotAuthenticated',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\Product\\Category\\ProductCategoryController@import',
        'controller' => 'App\\Http\\Controllers\\Admin\\Product\\Category\\ProductCategoryController@import',
        'as' => 'admin.product.category.import',
        'namespace' => NULL,
        'prefix' => 'admin/product/category',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.product.category.export' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/product/category/export/{type}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'redirectAdminIfNotAuthenticated',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\Product\\Category\\ProductCategoryController@export',
        'controller' => 'App\\Http\\Controllers\\Admin\\Product\\Category\\ProductCategoryController@export',
        'as' => 'admin.product.category.export',
        'namespace' => NULL,
        'prefix' => 'admin/product/category',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.product.category.variation.toggle' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/product/category/variation/toggle/{categoryId}/{attrValueId}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'redirectAdminIfNotAuthenticated',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\Product\\Category\\Variation\\ProductCategoryVariationAttributeController@toggle',
        'controller' => 'App\\Http\\Controllers\\Admin\\Product\\Category\\Variation\\ProductCategoryVariationAttributeController@toggle',
        'as' => 'admin.product.category.variation.toggle',
        'namespace' => NULL,
        'prefix' => 'admin/product/category/variation',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.product.category.variation.delete' => 
    array (
      'methods' => 
      array (
        0 => 'DELETE',
      ),
      'uri' => 'admin/product/category/variation/delete/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'redirectAdminIfNotAuthenticated',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\Product\\Category\\Variation\\ProductCategoryVariationAttributeController@delete',
        'controller' => 'App\\Http\\Controllers\\Admin\\Product\\Category\\Variation\\ProductCategoryVariationAttributeController@delete',
        'as' => 'admin.product.category.variation.delete',
        'namespace' => NULL,
        'prefix' => 'admin/product/category/variation',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.product.collection.index' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/product/collection',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'redirectAdminIfNotAuthenticated',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\Product\\Collection\\ProductCollectionController@index',
        'controller' => 'App\\Http\\Controllers\\Admin\\Product\\Collection\\ProductCollectionController@index',
        'as' => 'admin.product.collection.index',
        'namespace' => NULL,
        'prefix' => 'admin/product/collection',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.product.collection.create' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/product/collection/create',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'redirectAdminIfNotAuthenticated',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\Product\\Collection\\ProductCollectionController@create',
        'controller' => 'App\\Http\\Controllers\\Admin\\Product\\Collection\\ProductCollectionController@create',
        'as' => 'admin.product.collection.create',
        'namespace' => NULL,
        'prefix' => 'admin/product/collection',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.product.collection.store' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'admin/product/collection/store',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'redirectAdminIfNotAuthenticated',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\Product\\Collection\\ProductCollectionController@store',
        'controller' => 'App\\Http\\Controllers\\Admin\\Product\\Collection\\ProductCollectionController@store',
        'as' => 'admin.product.collection.store',
        'namespace' => NULL,
        'prefix' => 'admin/product/collection',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.product.collection.edit' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/product/collection/edit/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'redirectAdminIfNotAuthenticated',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\Product\\Collection\\ProductCollectionController@edit',
        'controller' => 'App\\Http\\Controllers\\Admin\\Product\\Collection\\ProductCollectionController@edit',
        'as' => 'admin.product.collection.edit',
        'namespace' => NULL,
        'prefix' => 'admin/product/collection',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.product.collection.update' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'admin/product/collection/update',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'redirectAdminIfNotAuthenticated',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\Product\\Collection\\ProductCollectionController@update',
        'controller' => 'App\\Http\\Controllers\\Admin\\Product\\Collection\\ProductCollectionController@update',
        'as' => 'admin.product.collection.update',
        'namespace' => NULL,
        'prefix' => 'admin/product/collection',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.product.collection.delete' => 
    array (
      'methods' => 
      array (
        0 => 'DELETE',
      ),
      'uri' => 'admin/product/collection/delete/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'redirectAdminIfNotAuthenticated',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\Product\\Collection\\ProductCollectionController@delete',
        'controller' => 'App\\Http\\Controllers\\Admin\\Product\\Collection\\ProductCollectionController@delete',
        'as' => 'admin.product.collection.delete',
        'namespace' => NULL,
        'prefix' => 'admin/product/collection',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.product.collection.bulk' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'admin/product/collection/bulk',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'redirectAdminIfNotAuthenticated',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\Product\\Collection\\ProductCollectionController@bulk',
        'controller' => 'App\\Http\\Controllers\\Admin\\Product\\Collection\\ProductCollectionController@bulk',
        'as' => 'admin.product.collection.bulk',
        'namespace' => NULL,
        'prefix' => 'admin/product/collection',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.product.collection.import' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'admin/product/collection/import',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'redirectAdminIfNotAuthenticated',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\Product\\Collection\\ProductCollectionController@import',
        'controller' => 'App\\Http\\Controllers\\Admin\\Product\\Collection\\ProductCollectionController@import',
        'as' => 'admin.product.collection.import',
        'namespace' => NULL,
        'prefix' => 'admin/product/collection',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.product.collection.export' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/product/collection/export/{type}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'redirectAdminIfNotAuthenticated',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\Product\\Collection\\ProductCollectionController@export',
        'controller' => 'App\\Http\\Controllers\\Admin\\Product\\Collection\\ProductCollectionController@export',
        'as' => 'admin.product.collection.export',
        'namespace' => NULL,
        'prefix' => 'admin/product/collection',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.product.collection.position' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'admin/product/collection/position',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'redirectAdminIfNotAuthenticated',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\Product\\Collection\\ProductCollectionController@position',
        'controller' => 'App\\Http\\Controllers\\Admin\\Product\\Collection\\ProductCollectionController@position',
        'as' => 'admin.product.collection.position',
        'namespace' => NULL,
        'prefix' => 'admin/product/collection',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.product.image.delete' => 
    array (
      'methods' => 
      array (
        0 => 'DELETE',
      ),
      'uri' => 'admin/product/image/delete/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'redirectAdminIfNotAuthenticated',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\Product\\Image\\ProductImageController@delete',
        'controller' => 'App\\Http\\Controllers\\Admin\\Product\\Image\\ProductImageController@delete',
        'as' => 'admin.product.image.delete',
        'namespace' => NULL,
        'prefix' => 'admin/product/image',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.product.pricing.index' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/product/pricing',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'redirectAdminIfNotAuthenticated',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\Product\\Pricing\\ProductPricingController@index',
        'controller' => 'App\\Http\\Controllers\\Admin\\Product\\Pricing\\ProductPricingController@index',
        'as' => 'admin.product.pricing.index',
        'namespace' => NULL,
        'prefix' => 'admin/product/pricing',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.product.pricing.create' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/product/pricing/create',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'redirectAdminIfNotAuthenticated',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\Product\\Pricing\\ProductPricingController@create',
        'controller' => 'App\\Http\\Controllers\\Admin\\Product\\Pricing\\ProductPricingController@create',
        'as' => 'admin.product.pricing.create',
        'namespace' => NULL,
        'prefix' => 'admin/product/pricing',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.product.pricing.store' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'admin/product/pricing/store',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'redirectAdminIfNotAuthenticated',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\Product\\Pricing\\ProductPricingController@store',
        'controller' => 'App\\Http\\Controllers\\Admin\\Product\\Pricing\\ProductPricingController@store',
        'as' => 'admin.product.pricing.store',
        'namespace' => NULL,
        'prefix' => 'admin/product/pricing',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.product.pricing.edit' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/product/pricing/edit/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'redirectAdminIfNotAuthenticated',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\Product\\Pricing\\ProductPricingController@edit',
        'controller' => 'App\\Http\\Controllers\\Admin\\Product\\Pricing\\ProductPricingController@edit',
        'as' => 'admin.product.pricing.edit',
        'namespace' => NULL,
        'prefix' => 'admin/product/pricing',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.product.pricing.update' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'admin/product/pricing/update',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'redirectAdminIfNotAuthenticated',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\Product\\Pricing\\ProductPricingController@update',
        'controller' => 'App\\Http\\Controllers\\Admin\\Product\\Pricing\\ProductPricingController@update',
        'as' => 'admin.product.pricing.update',
        'namespace' => NULL,
        'prefix' => 'admin/product/pricing',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.product.pricing.delete' => 
    array (
      'methods' => 
      array (
        0 => 'DELETE',
      ),
      'uri' => 'admin/product/pricing/delete/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'redirectAdminIfNotAuthenticated',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\Product\\Pricing\\ProductPricingController@delete',
        'controller' => 'App\\Http\\Controllers\\Admin\\Product\\Pricing\\ProductPricingController@delete',
        'as' => 'admin.product.pricing.delete',
        'namespace' => NULL,
        'prefix' => 'admin/product/pricing',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.product.pricing.bulk' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'admin/product/pricing/bulk',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'redirectAdminIfNotAuthenticated',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\Product\\Pricing\\ProductPricingController@bulk',
        'controller' => 'App\\Http\\Controllers\\Admin\\Product\\Pricing\\ProductPricingController@bulk',
        'as' => 'admin.product.pricing.bulk',
        'namespace' => NULL,
        'prefix' => 'admin/product/pricing',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.product.pricing.import' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'admin/product/pricing/import',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'redirectAdminIfNotAuthenticated',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\Product\\Pricing\\ProductPricingController@import',
        'controller' => 'App\\Http\\Controllers\\Admin\\Product\\Pricing\\ProductPricingController@import',
        'as' => 'admin.product.pricing.import',
        'namespace' => NULL,
        'prefix' => 'admin/product/pricing',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.product.pricing.export' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/product/pricing/export/{type}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'redirectAdminIfNotAuthenticated',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\Product\\Pricing\\ProductPricingController@export',
        'controller' => 'App\\Http\\Controllers\\Admin\\Product\\Pricing\\ProductPricingController@export',
        'as' => 'admin.product.pricing.export',
        'namespace' => NULL,
        'prefix' => 'admin/product/pricing',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.product.feature.index' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/product/feature',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'redirectAdminIfNotAuthenticated',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\Product\\Feature\\ProductFeatureController@index',
        'controller' => 'App\\Http\\Controllers\\Admin\\Product\\Feature\\ProductFeatureController@index',
        'as' => 'admin.product.feature.index',
        'namespace' => NULL,
        'prefix' => 'admin/product/feature',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.product.feature.delete' => 
    array (
      'methods' => 
      array (
        0 => 'DELETE',
      ),
      'uri' => 'admin/product/feature/delete/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'redirectAdminIfNotAuthenticated',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\Product\\Feature\\ProductFeatureController@delete',
        'controller' => 'App\\Http\\Controllers\\Admin\\Product\\Feature\\ProductFeatureController@delete',
        'as' => 'admin.product.feature.delete',
        'namespace' => NULL,
        'prefix' => 'admin/product/feature',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.product.review.index' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/product/review',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'redirectAdminIfNotAuthenticated',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\Product\\Review\\ProductReviewController@index',
        'controller' => 'App\\Http\\Controllers\\Admin\\Product\\Review\\ProductReviewController@index',
        'as' => 'admin.product.review.index',
        'namespace' => NULL,
        'prefix' => 'admin/product/review',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.product.review.create' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/product/review/create',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'redirectAdminIfNotAuthenticated',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\Product\\Review\\ProductReviewController@create',
        'controller' => 'App\\Http\\Controllers\\Admin\\Product\\Review\\ProductReviewController@create',
        'as' => 'admin.product.review.create',
        'namespace' => NULL,
        'prefix' => 'admin/product/review',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.product.review.store' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'admin/product/review/store',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'redirectAdminIfNotAuthenticated',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\Product\\Review\\ProductReviewController@store',
        'controller' => 'App\\Http\\Controllers\\Admin\\Product\\Review\\ProductReviewController@store',
        'as' => 'admin.product.review.store',
        'namespace' => NULL,
        'prefix' => 'admin/product/review',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.product.review.edit' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/product/review/edit/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'redirectAdminIfNotAuthenticated',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\Product\\Review\\ProductReviewController@edit',
        'controller' => 'App\\Http\\Controllers\\Admin\\Product\\Review\\ProductReviewController@edit',
        'as' => 'admin.product.review.edit',
        'namespace' => NULL,
        'prefix' => 'admin/product/review',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.product.review.update' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'admin/product/review/update',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'redirectAdminIfNotAuthenticated',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\Product\\Review\\ProductReviewController@update',
        'controller' => 'App\\Http\\Controllers\\Admin\\Product\\Review\\ProductReviewController@update',
        'as' => 'admin.product.review.update',
        'namespace' => NULL,
        'prefix' => 'admin/product/review',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.product.review.delete' => 
    array (
      'methods' => 
      array (
        0 => 'DELETE',
      ),
      'uri' => 'admin/product/review/delete/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'redirectAdminIfNotAuthenticated',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\Product\\Review\\ProductReviewController@delete',
        'controller' => 'App\\Http\\Controllers\\Admin\\Product\\Review\\ProductReviewController@delete',
        'as' => 'admin.product.review.delete',
        'namespace' => NULL,
        'prefix' => 'admin/product/review',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.product.review.bulk' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'admin/product/review/bulk',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'redirectAdminIfNotAuthenticated',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\Product\\Review\\ProductReviewController@bulk',
        'controller' => 'App\\Http\\Controllers\\Admin\\Product\\Review\\ProductReviewController@bulk',
        'as' => 'admin.product.review.bulk',
        'namespace' => NULL,
        'prefix' => 'admin/product/review',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.product.review.import' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'admin/product/review/import',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'redirectAdminIfNotAuthenticated',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\Product\\Review\\ProductReviewController@import',
        'controller' => 'App\\Http\\Controllers\\Admin\\Product\\Review\\ProductReviewController@import',
        'as' => 'admin.product.review.import',
        'namespace' => NULL,
        'prefix' => 'admin/product/review',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.product.review.export' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/product/review/export/{type}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'redirectAdminIfNotAuthenticated',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\Product\\Review\\ProductReviewController@export',
        'controller' => 'App\\Http\\Controllers\\Admin\\Product\\Review\\ProductReviewController@export',
        'as' => 'admin.product.review.export',
        'namespace' => NULL,
        'prefix' => 'admin/product/review',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.product.variation.attribute.index' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/product/variation/attribute',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'redirectAdminIfNotAuthenticated',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\Product\\Variation\\ProductVariationAttributeController@index',
        'controller' => 'App\\Http\\Controllers\\Admin\\Product\\Variation\\ProductVariationAttributeController@index',
        'as' => 'admin.product.variation.attribute.index',
        'namespace' => NULL,
        'prefix' => 'admin/product/variation/attribute',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.product.variation.attribute.create' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/product/variation/attribute/create',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'redirectAdminIfNotAuthenticated',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\Product\\Variation\\ProductVariationAttributeController@create',
        'controller' => 'App\\Http\\Controllers\\Admin\\Product\\Variation\\ProductVariationAttributeController@create',
        'as' => 'admin.product.variation.attribute.create',
        'namespace' => NULL,
        'prefix' => 'admin/product/variation/attribute',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.product.variation.attribute.store' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'admin/product/variation/attribute/store',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'redirectAdminIfNotAuthenticated',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\Product\\Variation\\ProductVariationAttributeController@store',
        'controller' => 'App\\Http\\Controllers\\Admin\\Product\\Variation\\ProductVariationAttributeController@store',
        'as' => 'admin.product.variation.attribute.store',
        'namespace' => NULL,
        'prefix' => 'admin/product/variation/attribute',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.product.variation.attribute.edit' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/product/variation/attribute/edit/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'redirectAdminIfNotAuthenticated',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\Product\\Variation\\ProductVariationAttributeController@edit',
        'controller' => 'App\\Http\\Controllers\\Admin\\Product\\Variation\\ProductVariationAttributeController@edit',
        'as' => 'admin.product.variation.attribute.edit',
        'namespace' => NULL,
        'prefix' => 'admin/product/variation/attribute',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.product.variation.attribute.update' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'admin/product/variation/attribute/update',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'redirectAdminIfNotAuthenticated',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\Product\\Variation\\ProductVariationAttributeController@update',
        'controller' => 'App\\Http\\Controllers\\Admin\\Product\\Variation\\ProductVariationAttributeController@update',
        'as' => 'admin.product.variation.attribute.update',
        'namespace' => NULL,
        'prefix' => 'admin/product/variation/attribute',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.product.variation.attribute.delete' => 
    array (
      'methods' => 
      array (
        0 => 'DELETE',
      ),
      'uri' => 'admin/product/variation/attribute/delete/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'redirectAdminIfNotAuthenticated',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\Product\\Variation\\ProductVariationAttributeController@delete',
        'controller' => 'App\\Http\\Controllers\\Admin\\Product\\Variation\\ProductVariationAttributeController@delete',
        'as' => 'admin.product.variation.attribute.delete',
        'namespace' => NULL,
        'prefix' => 'admin/product/variation/attribute',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.product.variation.attribute.bulk' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'admin/product/variation/attribute/bulk',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'redirectAdminIfNotAuthenticated',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\Product\\Variation\\ProductVariationAttributeController@bulk',
        'controller' => 'App\\Http\\Controllers\\Admin\\Product\\Variation\\ProductVariationAttributeController@bulk',
        'as' => 'admin.product.variation.attribute.bulk',
        'namespace' => NULL,
        'prefix' => 'admin/product/variation/attribute',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.product.variation.attribute.import' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'admin/product/variation/attribute/import',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'redirectAdminIfNotAuthenticated',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\Product\\Variation\\ProductVariationAttributeController@import',
        'controller' => 'App\\Http\\Controllers\\Admin\\Product\\Variation\\ProductVariationAttributeController@import',
        'as' => 'admin.product.variation.attribute.import',
        'namespace' => NULL,
        'prefix' => 'admin/product/variation/attribute',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.product.variation.attribute.export' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/product/variation/attribute/export/{type}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'redirectAdminIfNotAuthenticated',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\Product\\Variation\\ProductVariationAttributeController@export',
        'controller' => 'App\\Http\\Controllers\\Admin\\Product\\Variation\\ProductVariationAttributeController@export',
        'as' => 'admin.product.variation.attribute.export',
        'namespace' => NULL,
        'prefix' => 'admin/product/variation/attribute',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.product.variation.attribute.position' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'admin/product/variation/attribute/position',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'redirectAdminIfNotAuthenticated',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\Product\\Variation\\ProductVariationAttributeController@position',
        'controller' => 'App\\Http\\Controllers\\Admin\\Product\\Variation\\ProductVariationAttributeController@position',
        'as' => 'admin.product.variation.attribute.position',
        'namespace' => NULL,
        'prefix' => 'admin/product/variation/attribute',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.product.variation.attribute.value.index' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/product/variation/attribute/value',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'redirectAdminIfNotAuthenticated',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\Product\\Variation\\ProductVariationAttributeValueController@index',
        'controller' => 'App\\Http\\Controllers\\Admin\\Product\\Variation\\ProductVariationAttributeValueController@index',
        'as' => 'admin.product.variation.attribute.value.index',
        'namespace' => NULL,
        'prefix' => 'admin/product/variation/attribute/value',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.product.variation.attribute.value.create' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/product/variation/attribute/value/create',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'redirectAdminIfNotAuthenticated',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\Product\\Variation\\ProductVariationAttributeValueController@create',
        'controller' => 'App\\Http\\Controllers\\Admin\\Product\\Variation\\ProductVariationAttributeValueController@create',
        'as' => 'admin.product.variation.attribute.value.create',
        'namespace' => NULL,
        'prefix' => 'admin/product/variation/attribute/value',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.product.variation.attribute.value.store' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'admin/product/variation/attribute/value/store',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'redirectAdminIfNotAuthenticated',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\Product\\Variation\\ProductVariationAttributeValueController@store',
        'controller' => 'App\\Http\\Controllers\\Admin\\Product\\Variation\\ProductVariationAttributeValueController@store',
        'as' => 'admin.product.variation.attribute.value.store',
        'namespace' => NULL,
        'prefix' => 'admin/product/variation/attribute/value',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.product.variation.attribute.value.edit' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/product/variation/attribute/value/edit/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'redirectAdminIfNotAuthenticated',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\Product\\Variation\\ProductVariationAttributeValueController@edit',
        'controller' => 'App\\Http\\Controllers\\Admin\\Product\\Variation\\ProductVariationAttributeValueController@edit',
        'as' => 'admin.product.variation.attribute.value.edit',
        'namespace' => NULL,
        'prefix' => 'admin/product/variation/attribute/value',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.product.variation.attribute.value.update' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'admin/product/variation/attribute/value/update',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'redirectAdminIfNotAuthenticated',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\Product\\Variation\\ProductVariationAttributeValueController@update',
        'controller' => 'App\\Http\\Controllers\\Admin\\Product\\Variation\\ProductVariationAttributeValueController@update',
        'as' => 'admin.product.variation.attribute.value.update',
        'namespace' => NULL,
        'prefix' => 'admin/product/variation/attribute/value',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.product.variation.attribute.value.delete' => 
    array (
      'methods' => 
      array (
        0 => 'DELETE',
      ),
      'uri' => 'admin/product/variation/attribute/value/delete/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'redirectAdminIfNotAuthenticated',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\Product\\Variation\\ProductVariationAttributeValueController@delete',
        'controller' => 'App\\Http\\Controllers\\Admin\\Product\\Variation\\ProductVariationAttributeValueController@delete',
        'as' => 'admin.product.variation.attribute.value.delete',
        'namespace' => NULL,
        'prefix' => 'admin/product/variation/attribute/value',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.product.variation.attribute.value.bulk' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'admin/product/variation/attribute/value/bulk',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'redirectAdminIfNotAuthenticated',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\Product\\Variation\\ProductVariationAttributeValueController@bulk',
        'controller' => 'App\\Http\\Controllers\\Admin\\Product\\Variation\\ProductVariationAttributeValueController@bulk',
        'as' => 'admin.product.variation.attribute.value.bulk',
        'namespace' => NULL,
        'prefix' => 'admin/product/variation/attribute/value',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.product.variation.attribute.value.import' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'admin/product/variation/attribute/value/import',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'redirectAdminIfNotAuthenticated',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\Product\\Variation\\ProductVariationAttributeValueController@import',
        'controller' => 'App\\Http\\Controllers\\Admin\\Product\\Variation\\ProductVariationAttributeValueController@import',
        'as' => 'admin.product.variation.attribute.value.import',
        'namespace' => NULL,
        'prefix' => 'admin/product/variation/attribute/value',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.product.variation.attribute.value.export' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/product/variation/attribute/value/export/{type}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'redirectAdminIfNotAuthenticated',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\Product\\Variation\\ProductVariationAttributeValueController@export',
        'controller' => 'App\\Http\\Controllers\\Admin\\Product\\Variation\\ProductVariationAttributeValueController@export',
        'as' => 'admin.product.variation.attribute.value.export',
        'namespace' => NULL,
        'prefix' => 'admin/product/variation/attribute/value',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.product.variation.attribute.value.position' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'admin/product/variation/attribute/value/position',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'redirectAdminIfNotAuthenticated',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\Product\\Variation\\ProductVariationAttributeValueController@position',
        'controller' => 'App\\Http\\Controllers\\Admin\\Product\\Variation\\ProductVariationAttributeValueController@position',
        'as' => 'admin.product.variation.attribute.value.position',
        'namespace' => NULL,
        'prefix' => 'admin/product/variation/attribute/value',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.master.country.index' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/master/country',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'redirectAdminIfNotAuthenticated',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\Country\\CountryController@index',
        'controller' => 'App\\Http\\Controllers\\Admin\\Country\\CountryController@index',
        'as' => 'admin.master.country.index',
        'namespace' => NULL,
        'prefix' => 'admin/master/country',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.master.country.create' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/master/country/create',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'redirectAdminIfNotAuthenticated',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\Country\\CountryController@create',
        'controller' => 'App\\Http\\Controllers\\Admin\\Country\\CountryController@create',
        'as' => 'admin.master.country.create',
        'namespace' => NULL,
        'prefix' => 'admin/master/country',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.master.country.store' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'admin/master/country/store',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'redirectAdminIfNotAuthenticated',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\Country\\CountryController@store',
        'controller' => 'App\\Http\\Controllers\\Admin\\Country\\CountryController@store',
        'as' => 'admin.master.country.store',
        'namespace' => NULL,
        'prefix' => 'admin/master/country',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.master.country.edit' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/master/country/edit/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'redirectAdminIfNotAuthenticated',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\Country\\CountryController@edit',
        'controller' => 'App\\Http\\Controllers\\Admin\\Country\\CountryController@edit',
        'as' => 'admin.master.country.edit',
        'namespace' => NULL,
        'prefix' => 'admin/master/country',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.master.country.update' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'admin/master/country/update',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'redirectAdminIfNotAuthenticated',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\Country\\CountryController@update',
        'controller' => 'App\\Http\\Controllers\\Admin\\Country\\CountryController@update',
        'as' => 'admin.master.country.update',
        'namespace' => NULL,
        'prefix' => 'admin/master/country',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.master.country.delete' => 
    array (
      'methods' => 
      array (
        0 => 'DELETE',
      ),
      'uri' => 'admin/master/country/delete/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'redirectAdminIfNotAuthenticated',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\Country\\CountryController@delete',
        'controller' => 'App\\Http\\Controllers\\Admin\\Country\\CountryController@delete',
        'as' => 'admin.master.country.delete',
        'namespace' => NULL,
        'prefix' => 'admin/master/country',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.master.country.bulk' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'admin/master/country/bulk',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'redirectAdminIfNotAuthenticated',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\Country\\CountryController@bulk',
        'controller' => 'App\\Http\\Controllers\\Admin\\Country\\CountryController@bulk',
        'as' => 'admin.master.country.bulk',
        'namespace' => NULL,
        'prefix' => 'admin/master/country',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.master.country.import' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'admin/master/country/import',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'redirectAdminIfNotAuthenticated',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\Country\\CountryController@import',
        'controller' => 'App\\Http\\Controllers\\Admin\\Country\\CountryController@import',
        'as' => 'admin.master.country.import',
        'namespace' => NULL,
        'prefix' => 'admin/master/country',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.master.country.export' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/master/country/export/{type}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'redirectAdminIfNotAuthenticated',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\Country\\CountryController@export',
        'controller' => 'App\\Http\\Controllers\\Admin\\Country\\CountryController@export',
        'as' => 'admin.master.country.export',
        'namespace' => NULL,
        'prefix' => 'admin/master/country',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.master.state.index' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/master/state',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'redirectAdminIfNotAuthenticated',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\State\\StateController@index',
        'controller' => 'App\\Http\\Controllers\\Admin\\State\\StateController@index',
        'as' => 'admin.master.state.index',
        'namespace' => NULL,
        'prefix' => 'admin/master/state',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.master.state.create' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/master/state/create',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'redirectAdminIfNotAuthenticated',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\State\\StateController@create',
        'controller' => 'App\\Http\\Controllers\\Admin\\State\\StateController@create',
        'as' => 'admin.master.state.create',
        'namespace' => NULL,
        'prefix' => 'admin/master/state',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.master.state.store' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'admin/master/state/store',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'redirectAdminIfNotAuthenticated',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\State\\StateController@store',
        'controller' => 'App\\Http\\Controllers\\Admin\\State\\StateController@store',
        'as' => 'admin.master.state.store',
        'namespace' => NULL,
        'prefix' => 'admin/master/state',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.master.state.edit' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/master/state/edit/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'redirectAdminIfNotAuthenticated',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\State\\StateController@edit',
        'controller' => 'App\\Http\\Controllers\\Admin\\State\\StateController@edit',
        'as' => 'admin.master.state.edit',
        'namespace' => NULL,
        'prefix' => 'admin/master/state',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.master.state.update' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'admin/master/state/update',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'redirectAdminIfNotAuthenticated',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\State\\StateController@update',
        'controller' => 'App\\Http\\Controllers\\Admin\\State\\StateController@update',
        'as' => 'admin.master.state.update',
        'namespace' => NULL,
        'prefix' => 'admin/master/state',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.master.state.delete' => 
    array (
      'methods' => 
      array (
        0 => 'DELETE',
      ),
      'uri' => 'admin/master/state/delete/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'redirectAdminIfNotAuthenticated',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\State\\StateController@delete',
        'controller' => 'App\\Http\\Controllers\\Admin\\State\\StateController@delete',
        'as' => 'admin.master.state.delete',
        'namespace' => NULL,
        'prefix' => 'admin/master/state',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.master.state.bulk' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'admin/master/state/bulk',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'redirectAdminIfNotAuthenticated',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\State\\StateController@bulk',
        'controller' => 'App\\Http\\Controllers\\Admin\\State\\StateController@bulk',
        'as' => 'admin.master.state.bulk',
        'namespace' => NULL,
        'prefix' => 'admin/master/state',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.master.state.import' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'admin/master/state/import',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'redirectAdminIfNotAuthenticated',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\State\\StateController@import',
        'controller' => 'App\\Http\\Controllers\\Admin\\State\\StateController@import',
        'as' => 'admin.master.state.import',
        'namespace' => NULL,
        'prefix' => 'admin/master/state',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.master.state.export' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/master/state/export/{type}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'redirectAdminIfNotAuthenticated',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\State\\StateController@export',
        'controller' => 'App\\Http\\Controllers\\Admin\\State\\StateController@export',
        'as' => 'admin.master.state.export',
        'namespace' => NULL,
        'prefix' => 'admin/master/state',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.master.city.index' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/master/city',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'redirectAdminIfNotAuthenticated',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\City\\CityController@index',
        'controller' => 'App\\Http\\Controllers\\Admin\\City\\CityController@index',
        'as' => 'admin.master.city.index',
        'namespace' => NULL,
        'prefix' => 'admin/master/city',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.master.city.create' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/master/city/create',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'redirectAdminIfNotAuthenticated',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\City\\CityController@create',
        'controller' => 'App\\Http\\Controllers\\Admin\\City\\CityController@create',
        'as' => 'admin.master.city.create',
        'namespace' => NULL,
        'prefix' => 'admin/master/city',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.master.city.store' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'admin/master/city/store',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'redirectAdminIfNotAuthenticated',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\City\\CityController@store',
        'controller' => 'App\\Http\\Controllers\\Admin\\City\\CityController@store',
        'as' => 'admin.master.city.store',
        'namespace' => NULL,
        'prefix' => 'admin/master/city',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.master.city.edit' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/master/city/edit/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'redirectAdminIfNotAuthenticated',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\City\\CityController@edit',
        'controller' => 'App\\Http\\Controllers\\Admin\\City\\CityController@edit',
        'as' => 'admin.master.city.edit',
        'namespace' => NULL,
        'prefix' => 'admin/master/city',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.master.city.update' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'admin/master/city/update',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'redirectAdminIfNotAuthenticated',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\City\\CityController@update',
        'controller' => 'App\\Http\\Controllers\\Admin\\City\\CityController@update',
        'as' => 'admin.master.city.update',
        'namespace' => NULL,
        'prefix' => 'admin/master/city',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.master.city.delete' => 
    array (
      'methods' => 
      array (
        0 => 'DELETE',
      ),
      'uri' => 'admin/master/city/delete/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'redirectAdminIfNotAuthenticated',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\City\\CityController@delete',
        'controller' => 'App\\Http\\Controllers\\Admin\\City\\CityController@delete',
        'as' => 'admin.master.city.delete',
        'namespace' => NULL,
        'prefix' => 'admin/master/city',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.master.city.bulk' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'admin/master/city/bulk',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'redirectAdminIfNotAuthenticated',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\City\\CityController@bulk',
        'controller' => 'App\\Http\\Controllers\\Admin\\City\\CityController@bulk',
        'as' => 'admin.master.city.bulk',
        'namespace' => NULL,
        'prefix' => 'admin/master/city',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.master.city.import' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'admin/master/city/import',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'redirectAdminIfNotAuthenticated',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\City\\CityController@import',
        'controller' => 'App\\Http\\Controllers\\Admin\\City\\CityController@import',
        'as' => 'admin.master.city.import',
        'namespace' => NULL,
        'prefix' => 'admin/master/city',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.master.city.export' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/master/city/export/{type}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'redirectAdminIfNotAuthenticated',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\City\\CityController@export',
        'controller' => 'App\\Http\\Controllers\\Admin\\City\\CityController@export',
        'as' => 'admin.master.city.export',
        'namespace' => NULL,
        'prefix' => 'admin/master/city',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.developer.trash.index' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/developer/trash',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'redirectAdminIfNotAuthenticated',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\Trash\\TrashController@index',
        'controller' => 'App\\Http\\Controllers\\Admin\\Trash\\TrashController@index',
        'as' => 'admin.developer.trash.index',
        'namespace' => NULL,
        'prefix' => 'admin/developer/trash',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.developer.trash.update' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'admin/developer/trash/update',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'redirectAdminIfNotAuthenticated',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\Trash\\TrashController@update',
        'controller' => 'App\\Http\\Controllers\\Admin\\Trash\\TrashController@update',
        'as' => 'admin.developer.trash.update',
        'namespace' => NULL,
        'prefix' => 'admin/developer/trash',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.developer.trash.restore' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/developer/trash/restore/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'redirectAdminIfNotAuthenticated',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\Trash\\TrashController@restore',
        'controller' => 'App\\Http\\Controllers\\Admin\\Trash\\TrashController@restore',
        'as' => 'admin.developer.trash.restore',
        'namespace' => NULL,
        'prefix' => 'admin/developer/trash',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.developer.trash.export' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/developer/trash/export/{type}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'redirectAdminIfNotAuthenticated',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\Trash\\TrashController@export',
        'controller' => 'App\\Http\\Controllers\\Admin\\Trash\\TrashController@export',
        'as' => 'admin.developer.trash.export',
        'namespace' => NULL,
        'prefix' => 'admin/developer/trash',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.csv-template.download' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/download-sample-csv/{model}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'redirectAdminIfNotAuthenticated',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\CsvTemplate\\CsvTemplateController@download',
        'controller' => 'App\\Http\\Controllers\\Admin\\CsvTemplate\\CsvTemplateController@download',
        'as' => 'admin.csv-template.download',
        'namespace' => NULL,
        'prefix' => '/admin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'storage.local' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'storage/{path}',
      'action' => 
      array (
        'uses' => 'O:55:"Laravel\\SerializableClosure\\UnsignedSerializableClosure":1:{s:12:"serializable";O:46:"Laravel\\SerializableClosure\\Serializers\\Native":5:{s:3:"use";a:3:{s:4:"disk";s:5:"local";s:6:"config";a:4:{s:6:"driver";s:5:"local";s:4:"root";s:33:"/var/www/html/storage/app/private";s:5:"serve";b:1;s:5:"throw";b:0;}s:12:"isProduction";b:0;}s:8:"function";s:323:"function (\\Illuminate\\Http\\Request $request, string $path) use ($disk, $config, $isProduction) {
                    return (new \\Illuminate\\Filesystem\\ServeFile(
                        $disk,
                        $config,
                        $isProduction
                    ))($request, $path);
                }";s:5:"scope";s:47:"Illuminate\\Filesystem\\FilesystemServiceProvider";s:4:"this";N;s:4:"self";s:32:"00000000000007fe0000000000000000";}}',
        'as' => 'storage.local',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
        'path' => '.*',
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
  ),
)
);
