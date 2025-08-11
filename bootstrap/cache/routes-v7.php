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
            '_route' => 'generated::8F2p2Wqs1tVETuJg',
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
            '_route' => 'generated::mGbLki3FavdPNKsm',
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
      '/api/test' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::zh81uD3os2KXKmxU',
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
      '/api/ip/store' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::u9ZQdjl2DcRMn81G',
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
            '_route' => 'generated::RnL5SapsACrrn4ZT',
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
            '_route' => 'generated::rOKFTI80g3ePZi31',
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
      '/api/login/check' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::5MLJgmRuvSLdoS2T',
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
      '/api/login/try' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::E91gB2lpAMURoasD',
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
      '/api/login/store' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::y9gvv0iMCObsu0DO',
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
      '/api/token/validate' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::pUcGEhgnHmycTdFq',
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
      '/api/user' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::3sVaXvfohRgmGrYe',
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
      '/api/user/update' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::AHbq1r4uTfWNsJf9',
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
      '/api/user/password/update' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::ycw7vHzn2YaNT5OL',
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
            '_route' => 'generated::cj8oQ79AffNQPpeP',
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
      '/admin/order' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.order.index',
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
      '/admin/order/store' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.order.store',
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
      '/admin/order/update' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.order.update',
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
      '/admin/order/bulk' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.order.bulk',
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
      '/admin/order/import' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.order.import',
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
      '/admin/order/offline/create' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.order.offline.create',
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
      '/admin/order/offline' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.order.offline.search.user',
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
      '/admin/website/banner' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.website.banner.index',
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
      '/admin/website/banner/create' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.website.banner.create',
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
      '/admin/website/banner/store' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.website.banner.store',
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
      '/admin/website/banner/update' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.website.banner.update',
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
      '/admin/website/banner/bulk' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.website.banner.bulk',
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
      '/admin/website/banner/import' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.website.banner.import',
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
      '/admin/website/banner/position' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.website.banner.position',
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
      '/admin/website/newsletter/email' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.website.newsletter.email.index',
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
      '/admin/website/newsletter/email/create' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.website.newsletter.email.create',
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
      '/admin/website/newsletter/email/store' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.website.newsletter.email.store',
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
      '/admin/website/newsletter/email/update' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.website.newsletter.email.update',
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
      '/admin/website/newsletter/email/bulk' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.website.newsletter.email.bulk',
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
      '/admin/website/newsletter/email/import' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.website.newsletter.email.import',
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
      '/admin/website/newsletter/email/position' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.website.newsletter.email.position',
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
      '/admin/website/content/page' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.website.content.page.index',
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
      '/admin/website/content/page/create' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.website.content.page.create',
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
      '/admin/website/content/page/store' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.website.content.page.store',
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
      '/admin/website/content/page/update' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.website.content.page.update',
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
      '/admin/website/content/page/bulk' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.website.content.page.bulk',
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
      '/admin/website/content/page/import' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.website.content.page.import',
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
      '/admin/website/content/page/position' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.website.content.page.position',
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
      '/admin/website/social-media' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.website.social.media.index',
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
      '/admin/website/social-media/create' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.website.social.media.create',
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
      '/admin/website/social-media/store' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.website.social.media.store',
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
      '/admin/website/social-media/update' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.website.social.media.update',
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
      '/admin/website/social-media/bulk' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.website.social.media.bulk',
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
      '/admin/website/social-media/import' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.website.social.media.import',
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
      '/admin/website/social-media/position' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.website.social.media.position',
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
            '_route' => 'front.generated::OIQtOM1DxOdc7Cfu',
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
      '/order' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'front.order.index',
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
      '/wishlist' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'front.wishlist.index',
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
      '/address' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'front.address.index',
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
      '/address/update' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'front.address.update',
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
      '/wishlist/check-status' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'front.wishlist.check',
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
      '/search' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'front.search.index',
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
      '/order/store' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'front.order.store',
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
      '/order/thankyou' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'front.order.thankyou',
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
      '/faq' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'front.faq.index',
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
      '/terms-and-conditions' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'front.content.terms',
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
      '/privacy-policy' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'front.content.privacy',
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
      '/return-policy' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'front.content.return',
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
      '/refund-policy' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'front.content.refund',
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
      '/support' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'front.content.support',
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
      '/cookie-policy' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'front.content.cookie',
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
      '/shipping-info' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'front.content.shipping',
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
      '/size-guide' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'front.content.size-guide',
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
      '/contact-us' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'front.content.contact',
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
      '/about-us' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'front.content.about',
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
    ),
    2 => 
    array (
      0 => '{^(?|/_debugbar/c(?|lockwork/([^/]++)(*:39)|ache/([^/]++)(?:/([^/]++))?(*:73))|/livewire/preview\\-file/([^/]++)(*:113)|/a(?|pi/(?|ip/check/([^/]++)(*:149)|cart/(?|device\\-id/([^/]++)(*:184)|user\\-id/([^/]++)(*:209))|token/old/validate/([^/]++)(*:245)|logout/([^/]++)(*:268))|d(?|min/(?|pro(?|file/activity/delete/([^/]++)(*:323)|duct/(?|listing/(?|e(?|dit/([^/]++)(*:366)|xport/([^/]++)(*:388))|delete/([^/]++)(*:412)|variation/(?|edit/([^/]++)(*:446)|delete/([^/]++)(*:469)))|c(?|ategory/(?|e(?|dit/([^/]++)(*:510)|xport/([^/]++)(*:532))|delete/([^/]++)(*:556)|variation/(?|toggle/([^/]++)/([^/]++)(*:601)|delete/([^/]++)(*:624)))|ollection/(?|e(?|dit/([^/]++)(*:663)|xport/([^/]++)(*:685))|delete/([^/]++)(*:709)))|image/delete/([^/]++)(*:740)|pricing/(?|e(?|dit/([^/]++)(*:775)|xport/([^/]++)(*:797))|delete/([^/]++)(*:821))|feature/delete/([^/]++)(*:853)|review/(?|e(?|dit/([^/]++)(*:887)|xport/([^/]++)(*:909))|delete/([^/]++)(*:933))|variation/attribute/(?|e(?|dit/([^/]++)(*:981)|xport/([^/]++)(*:1003))|delete/([^/]++)(*:1028)|value/(?|e(?|dit/([^/]++)(*:1062)|xport/([^/]++)(*:1085))|delete/([^/]++)(*:1110)))))|application/settings/([^/]++)(?|(*:1155)|/(?|edit(*:1172)|update(*:1187)))|user/(?|e(?|dit/([^/]++)(*:1222)|xport/([^/]++)(*:1245))|delete/([^/]++)(*:1270))|order/(?|e(?|dit/([^/]++)(*:1305)|xport/([^/]++)(*:1328))|delete/([^/]++)(*:1353))|master/(?|c(?|ountry/(?|e(?|dit/([^/]++)(*:1403)|xport/([^/]++)(*:1426))|delete/([^/]++)(*:1451))|ity/(?|e(?|dit/([^/]++)(*:1484)|xport/([^/]++)(*:1507))|delete/([^/]++)(*:1532)))|state/(?|e(?|dit/([^/]++)(*:1568)|xport/([^/]++)(*:1591))|delete/([^/]++)(*:1616)))|website/(?|banner/(?|e(?|dit/([^/]++)(*:1664)|xport/([^/]++)(*:1687))|delete/([^/]++)(*:1712))|newsletter/email/(?|e(?|dit/([^/]++)(*:1758)|xport/([^/]++)(*:1781))|delete/([^/]++)(*:1806))|content/page/(?|e(?|dit/([^/]++)(*:1848)|xport/([^/]++)(*:1871))|delete/([^/]++)(*:1896))|social\\-media/(?|e(?|dit/([^/]++)(*:1939)|xport/([^/]++)(*:1962))|delete/([^/]++)(*:1987)))|d(?|eveloper/trash/(?|restore/([^/]++)(*:2036)|export/([^/]++)(*:2060))|ownload\\-sample\\-csv/([^/]++)(*:2099)))|dress/(?|delete/([^/]++)(*:2134)|edit/([^/]++)(*:2156))))|/reset\\-password/([^/]++)(*:2193)|/verify\\-email/([^/]++)/([^/]++)(*:2234)|/order/invoice/([^/]++)(*:2266)|/c(?|a(?|tegory/([^/]++)(*:2299)|rt/delete/([^/]++)(*:2326))|ollection/([^/]++)(*:2354))|/wishlist/toggle/([^/]++)(*:2389)|/((?!terms-and-conditions$|privacy-policy$|return-policy$|refund-policy$|support$|contact-us$|404$).+)(*:2500)|/storage/(.*)(*:2522))/?$}sDu',
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
            '_route' => 'generated::qeXWxqSNEGqOFmkh',
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
            '_route' => 'generated::dNQtUYY3A6gMSpby',
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
            '_route' => 'generated::9fJWrE7U1VELS1BG',
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
      245 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::xR84iwz22WTao13V',
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
      268 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::aLrCoFDp9KZR5S0L',
          ),
          1 => 
          array (
            0 => 'userId',
          ),
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      323 => 
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
      366 => 
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
      388 => 
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
      412 => 
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
      446 => 
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
      469 => 
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
      510 => 
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
      532 => 
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
      556 => 
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
      601 => 
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
      624 => 
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
      663 => 
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
      685 => 
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
      709 => 
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
      740 => 
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
      775 => 
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
      797 => 
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
      821 => 
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
      853 => 
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
      887 => 
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
      909 => 
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
      933 => 
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
      981 => 
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
      1003 => 
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
      1028 => 
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
      1062 => 
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
      1085 => 
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
      1110 => 
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
      1155 => 
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
      1172 => 
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
      1187 => 
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
      1222 => 
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
      1245 => 
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
      1270 => 
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
      1305 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.order.edit',
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
      1328 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.order.export',
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
      1353 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.order.delete',
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
      1403 => 
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
      1426 => 
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
      1451 => 
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
      1484 => 
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
      1507 => 
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
      1532 => 
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
      1568 => 
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
      1591 => 
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
      1616 => 
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
      1664 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.website.banner.edit',
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
      1687 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.website.banner.export',
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
      1712 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.website.banner.delete',
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
      1758 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.website.newsletter.email.edit',
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
      1781 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.website.newsletter.email.export',
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
      1806 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.website.newsletter.email.delete',
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
      1848 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.website.content.page.edit',
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
      1871 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.website.content.page.export',
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
      1896 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.website.content.page.delete',
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
      1939 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.website.social.media.edit',
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
      1962 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.website.social.media.export',
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
      1987 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.website.social.media.delete',
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
      2036 => 
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
      2060 => 
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
      2099 => 
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
      2134 => 
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
      2156 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'front.address.edit',
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
      2193 => 
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
      2234 => 
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
      2266 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'front.order.invoice',
          ),
          1 => 
          array (
            0 => 'orderNumber',
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
      2299 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'front.category.detail',
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
      2326 => 
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
      2354 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'front.collection.detail',
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
      2389 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'front.wishlist.toggle',
          ),
          1 => 
          array (
            0 => 'productId',
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
      2500 => 
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
      2522 => 
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
    'generated::8F2p2Wqs1tVETuJg' => 
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
        'as' => 'generated::8F2p2Wqs1tVETuJg',
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
    'generated::mGbLki3FavdPNKsm' => 
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
        'as' => 'generated::mGbLki3FavdPNKsm',
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
    'generated::zh81uD3os2KXKmxU' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'api/test',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
        ),
        'uses' => 'O:55:"Laravel\\SerializableClosure\\UnsignedSerializableClosure":1:{s:12:"serializable";O:46:"Laravel\\SerializableClosure\\Serializers\\Native":5:{s:3:"use";a:0:{}s:8:"function";s:112:"function() {
    return \\response()->json([
        \'code\' => 200,
        \'message\' => \'API success\',
    ]);
}";s:5:"scope";s:37:"Illuminate\\Routing\\RouteFileRegistrar";s:4:"this";N;s:4:"self";s:32:"000000000000085f0000000000000000";}}',
        'namespace' => NULL,
        'prefix' => 'api',
        'where' => 
        array (
        ),
        'as' => 'generated::zh81uD3os2KXKmxU',
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
    'generated::qeXWxqSNEGqOFmkh' => 
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
        'as' => 'generated::qeXWxqSNEGqOFmkh',
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
    'generated::u9ZQdjl2DcRMn81G' => 
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
        'as' => 'generated::u9ZQdjl2DcRMn81G',
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
    'generated::dNQtUYY3A6gMSpby' => 
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
        'as' => 'generated::dNQtUYY3A6gMSpby',
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
    'generated::9fJWrE7U1VELS1BG' => 
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
        'as' => 'generated::9fJWrE7U1VELS1BG',
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
    'generated::RnL5SapsACrrn4ZT' => 
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
        'as' => 'generated::RnL5SapsACrrn4ZT',
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
    'generated::rOKFTI80g3ePZi31' => 
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
        'as' => 'generated::rOKFTI80g3ePZi31',
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
    'generated::5MLJgmRuvSLdoS2T' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/login/check',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\Login\\LoginController@check',
        'controller' => 'App\\Http\\Controllers\\Api\\Login\\LoginController@check',
        'namespace' => NULL,
        'prefix' => 'api/login',
        'where' => 
        array (
        ),
        'as' => 'generated::5MLJgmRuvSLdoS2T',
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
    'generated::E91gB2lpAMURoasD' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/login/try',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\Login\\LoginController@login',
        'controller' => 'App\\Http\\Controllers\\Api\\Login\\LoginController@login',
        'namespace' => NULL,
        'prefix' => 'api/login',
        'where' => 
        array (
        ),
        'as' => 'generated::E91gB2lpAMURoasD',
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
    'generated::y9gvv0iMCObsu0DO' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/login/store',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\Login\\LoginController@store',
        'controller' => 'App\\Http\\Controllers\\Api\\Login\\LoginController@store',
        'namespace' => NULL,
        'prefix' => 'api/login',
        'where' => 
        array (
        ),
        'as' => 'generated::y9gvv0iMCObsu0DO',
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
    'generated::xR84iwz22WTao13V' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'api/token/old/validate/{userId}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\Token\\TokenController@validateOld',
        'controller' => 'App\\Http\\Controllers\\Api\\Token\\TokenController@validateOld',
        'namespace' => NULL,
        'prefix' => 'api/token/old',
        'where' => 
        array (
        ),
        'as' => 'generated::xR84iwz22WTao13V',
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
    'generated::aLrCoFDp9KZR5S0L' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/logout/{userId}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\Login\\LoginController@logout',
        'controller' => 'App\\Http\\Controllers\\Api\\Login\\LoginController@logout',
        'namespace' => NULL,
        'prefix' => 'api',
        'where' => 
        array (
        ),
        'as' => 'generated::aLrCoFDp9KZR5S0L',
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
    'generated::pUcGEhgnHmycTdFq' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'api/token/validate',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'apiAuth',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\Token\\TokenController@validate',
        'controller' => 'App\\Http\\Controllers\\Api\\Token\\TokenController@validate',
        'namespace' => NULL,
        'prefix' => 'api/token/validate',
        'where' => 
        array (
        ),
        'as' => 'generated::pUcGEhgnHmycTdFq',
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
    'generated::3sVaXvfohRgmGrYe' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'api/user',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'apiAuth',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\User\\UserController@index',
        'controller' => 'App\\Http\\Controllers\\Api\\User\\UserController@index',
        'namespace' => NULL,
        'prefix' => 'api/user',
        'where' => 
        array (
        ),
        'as' => 'generated::3sVaXvfohRgmGrYe',
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
    'generated::AHbq1r4uTfWNsJf9' => 
    array (
      'methods' => 
      array (
        0 => 'PUT',
      ),
      'uri' => 'api/user/update',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'apiAuth',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\User\\UserController@update',
        'controller' => 'App\\Http\\Controllers\\Api\\User\\UserController@update',
        'namespace' => NULL,
        'prefix' => 'api/user',
        'where' => 
        array (
        ),
        'as' => 'generated::AHbq1r4uTfWNsJf9',
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
    'generated::ycw7vHzn2YaNT5OL' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/user/password/update',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'apiAuth',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\User\\UserController@passwordUpdate',
        'controller' => 'App\\Http\\Controllers\\Api\\User\\UserController@passwordUpdate',
        'namespace' => NULL,
        'prefix' => 'api/user',
        'where' => 
        array (
        ),
        'as' => 'generated::ycw7vHzn2YaNT5OL',
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
    'generated::cj8oQ79AffNQPpeP' => 
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
                }";s:5:"scope";s:54:"Illuminate\\Foundation\\Configuration\\ApplicationBuilder";s:4:"this";N;s:4:"self";s:32:"000000000000085d0000000000000000";}}',
        'as' => 'generated::cj8oQ79AffNQPpeP',
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
    'admin.order.index' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/order',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'redirectAdminIfNotAuthenticated',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\Order\\OrderController@index',
        'controller' => 'App\\Http\\Controllers\\Admin\\Order\\OrderController@index',
        'as' => 'admin.order.index',
        'namespace' => NULL,
        'prefix' => 'admin/order',
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
    'admin.order.store' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'admin/order/store',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'redirectAdminIfNotAuthenticated',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\Order\\OrderController@store',
        'controller' => 'App\\Http\\Controllers\\Admin\\Order\\OrderController@store',
        'as' => 'admin.order.store',
        'namespace' => NULL,
        'prefix' => 'admin/order',
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
    'admin.order.edit' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/order/edit/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'redirectAdminIfNotAuthenticated',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\Order\\OrderController@edit',
        'controller' => 'App\\Http\\Controllers\\Admin\\Order\\OrderController@edit',
        'as' => 'admin.order.edit',
        'namespace' => NULL,
        'prefix' => 'admin/order',
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
    'admin.order.update' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'admin/order/update',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'redirectAdminIfNotAuthenticated',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\Order\\OrderController@update',
        'controller' => 'App\\Http\\Controllers\\Admin\\Order\\OrderController@update',
        'as' => 'admin.order.update',
        'namespace' => NULL,
        'prefix' => 'admin/order',
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
    'admin.order.delete' => 
    array (
      'methods' => 
      array (
        0 => 'DELETE',
      ),
      'uri' => 'admin/order/delete/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'redirectAdminIfNotAuthenticated',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\Order\\OrderController@delete',
        'controller' => 'App\\Http\\Controllers\\Admin\\Order\\OrderController@delete',
        'as' => 'admin.order.delete',
        'namespace' => NULL,
        'prefix' => 'admin/order',
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
    'admin.order.bulk' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'admin/order/bulk',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'redirectAdminIfNotAuthenticated',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\Order\\OrderController@bulk',
        'controller' => 'App\\Http\\Controllers\\Admin\\Order\\OrderController@bulk',
        'as' => 'admin.order.bulk',
        'namespace' => NULL,
        'prefix' => 'admin/order',
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
    'admin.order.import' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'admin/order/import',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'redirectAdminIfNotAuthenticated',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\Order\\OrderController@import',
        'controller' => 'App\\Http\\Controllers\\Admin\\Order\\OrderController@import',
        'as' => 'admin.order.import',
        'namespace' => NULL,
        'prefix' => 'admin/order',
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
    'admin.order.export' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/order/export/{type}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'redirectAdminIfNotAuthenticated',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\Order\\OrderController@export',
        'controller' => 'App\\Http\\Controllers\\Admin\\Order\\OrderController@export',
        'as' => 'admin.order.export',
        'namespace' => NULL,
        'prefix' => 'admin/order',
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
    'admin.order.offline.create' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/order/offline/create',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'redirectAdminIfNotAuthenticated',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\Order\\OfflineOrderController@create',
        'controller' => 'App\\Http\\Controllers\\Admin\\Order\\OfflineOrderController@create',
        'as' => 'admin.order.offline.create',
        'namespace' => NULL,
        'prefix' => 'admin/order/offline',
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
    'admin.order.offline.search.user' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/order/offline',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'redirectAdminIfNotAuthenticated',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\Order\\OfflineOrderController@searchUser',
        'controller' => 'App\\Http\\Controllers\\Admin\\Order\\OfflineOrderController@searchUser',
        'as' => 'admin.order.offline.search.user',
        'namespace' => NULL,
        'prefix' => 'admin/order/offline',
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
    'admin.website.banner.index' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/website/banner',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'redirectAdminIfNotAuthenticated',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\Banner\\BannerController@index',
        'controller' => 'App\\Http\\Controllers\\Admin\\Banner\\BannerController@index',
        'as' => 'admin.website.banner.index',
        'namespace' => NULL,
        'prefix' => 'admin/website/banner',
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
    'admin.website.banner.create' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/website/banner/create',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'redirectAdminIfNotAuthenticated',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\Banner\\BannerController@create',
        'controller' => 'App\\Http\\Controllers\\Admin\\Banner\\BannerController@create',
        'as' => 'admin.website.banner.create',
        'namespace' => NULL,
        'prefix' => 'admin/website/banner',
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
    'admin.website.banner.store' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'admin/website/banner/store',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'redirectAdminIfNotAuthenticated',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\Banner\\BannerController@store',
        'controller' => 'App\\Http\\Controllers\\Admin\\Banner\\BannerController@store',
        'as' => 'admin.website.banner.store',
        'namespace' => NULL,
        'prefix' => 'admin/website/banner',
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
    'admin.website.banner.edit' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/website/banner/edit/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'redirectAdminIfNotAuthenticated',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\Banner\\BannerController@edit',
        'controller' => 'App\\Http\\Controllers\\Admin\\Banner\\BannerController@edit',
        'as' => 'admin.website.banner.edit',
        'namespace' => NULL,
        'prefix' => 'admin/website/banner',
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
    'admin.website.banner.update' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'admin/website/banner/update',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'redirectAdminIfNotAuthenticated',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\Banner\\BannerController@update',
        'controller' => 'App\\Http\\Controllers\\Admin\\Banner\\BannerController@update',
        'as' => 'admin.website.banner.update',
        'namespace' => NULL,
        'prefix' => 'admin/website/banner',
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
    'admin.website.banner.delete' => 
    array (
      'methods' => 
      array (
        0 => 'DELETE',
      ),
      'uri' => 'admin/website/banner/delete/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'redirectAdminIfNotAuthenticated',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\Banner\\BannerController@delete',
        'controller' => 'App\\Http\\Controllers\\Admin\\Banner\\BannerController@delete',
        'as' => 'admin.website.banner.delete',
        'namespace' => NULL,
        'prefix' => 'admin/website/banner',
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
    'admin.website.banner.bulk' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'admin/website/banner/bulk',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'redirectAdminIfNotAuthenticated',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\Banner\\BannerController@bulk',
        'controller' => 'App\\Http\\Controllers\\Admin\\Banner\\BannerController@bulk',
        'as' => 'admin.website.banner.bulk',
        'namespace' => NULL,
        'prefix' => 'admin/website/banner',
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
    'admin.website.banner.import' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'admin/website/banner/import',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'redirectAdminIfNotAuthenticated',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\Banner\\BannerController@import',
        'controller' => 'App\\Http\\Controllers\\Admin\\Banner\\BannerController@import',
        'as' => 'admin.website.banner.import',
        'namespace' => NULL,
        'prefix' => 'admin/website/banner',
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
    'admin.website.banner.export' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/website/banner/export/{type}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'redirectAdminIfNotAuthenticated',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\Banner\\BannerController@export',
        'controller' => 'App\\Http\\Controllers\\Admin\\Banner\\BannerController@export',
        'as' => 'admin.website.banner.export',
        'namespace' => NULL,
        'prefix' => 'admin/website/banner',
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
    'admin.website.banner.position' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'admin/website/banner/position',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'redirectAdminIfNotAuthenticated',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\Banner\\BannerController@position',
        'controller' => 'App\\Http\\Controllers\\Admin\\Banner\\BannerController@position',
        'as' => 'admin.website.banner.position',
        'namespace' => NULL,
        'prefix' => 'admin/website/banner',
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
    'admin.website.newsletter.email.index' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/website/newsletter/email',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'redirectAdminIfNotAuthenticated',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\NewsletterEmail\\NewsletterEmailController@index',
        'controller' => 'App\\Http\\Controllers\\Admin\\NewsletterEmail\\NewsletterEmailController@index',
        'as' => 'admin.website.newsletter.email.index',
        'namespace' => NULL,
        'prefix' => 'admin/website/newsletter/email',
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
    'admin.website.newsletter.email.create' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/website/newsletter/email/create',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'redirectAdminIfNotAuthenticated',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\NewsletterEmail\\NewsletterEmailController@create',
        'controller' => 'App\\Http\\Controllers\\Admin\\NewsletterEmail\\NewsletterEmailController@create',
        'as' => 'admin.website.newsletter.email.create',
        'namespace' => NULL,
        'prefix' => 'admin/website/newsletter/email',
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
    'admin.website.newsletter.email.store' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'admin/website/newsletter/email/store',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'redirectAdminIfNotAuthenticated',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\NewsletterEmail\\NewsletterEmailController@store',
        'controller' => 'App\\Http\\Controllers\\Admin\\NewsletterEmail\\NewsletterEmailController@store',
        'as' => 'admin.website.newsletter.email.store',
        'namespace' => NULL,
        'prefix' => 'admin/website/newsletter/email',
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
    'admin.website.newsletter.email.edit' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/website/newsletter/email/edit/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'redirectAdminIfNotAuthenticated',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\NewsletterEmail\\NewsletterEmailController@edit',
        'controller' => 'App\\Http\\Controllers\\Admin\\NewsletterEmail\\NewsletterEmailController@edit',
        'as' => 'admin.website.newsletter.email.edit',
        'namespace' => NULL,
        'prefix' => 'admin/website/newsletter/email',
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
    'admin.website.newsletter.email.update' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'admin/website/newsletter/email/update',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'redirectAdminIfNotAuthenticated',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\NewsletterEmail\\NewsletterEmailController@update',
        'controller' => 'App\\Http\\Controllers\\Admin\\NewsletterEmail\\NewsletterEmailController@update',
        'as' => 'admin.website.newsletter.email.update',
        'namespace' => NULL,
        'prefix' => 'admin/website/newsletter/email',
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
    'admin.website.newsletter.email.delete' => 
    array (
      'methods' => 
      array (
        0 => 'DELETE',
      ),
      'uri' => 'admin/website/newsletter/email/delete/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'redirectAdminIfNotAuthenticated',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\NewsletterEmail\\NewsletterEmailController@delete',
        'controller' => 'App\\Http\\Controllers\\Admin\\NewsletterEmail\\NewsletterEmailController@delete',
        'as' => 'admin.website.newsletter.email.delete',
        'namespace' => NULL,
        'prefix' => 'admin/website/newsletter/email',
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
    'admin.website.newsletter.email.bulk' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'admin/website/newsletter/email/bulk',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'redirectAdminIfNotAuthenticated',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\NewsletterEmail\\NewsletterEmailController@bulk',
        'controller' => 'App\\Http\\Controllers\\Admin\\NewsletterEmail\\NewsletterEmailController@bulk',
        'as' => 'admin.website.newsletter.email.bulk',
        'namespace' => NULL,
        'prefix' => 'admin/website/newsletter/email',
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
    'admin.website.newsletter.email.import' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'admin/website/newsletter/email/import',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'redirectAdminIfNotAuthenticated',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\NewsletterEmail\\NewsletterEmailController@import',
        'controller' => 'App\\Http\\Controllers\\Admin\\NewsletterEmail\\NewsletterEmailController@import',
        'as' => 'admin.website.newsletter.email.import',
        'namespace' => NULL,
        'prefix' => 'admin/website/newsletter/email',
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
    'admin.website.newsletter.email.export' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/website/newsletter/email/export/{type}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'redirectAdminIfNotAuthenticated',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\NewsletterEmail\\NewsletterEmailController@export',
        'controller' => 'App\\Http\\Controllers\\Admin\\NewsletterEmail\\NewsletterEmailController@export',
        'as' => 'admin.website.newsletter.email.export',
        'namespace' => NULL,
        'prefix' => 'admin/website/newsletter/email',
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
    'admin.website.newsletter.email.position' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'admin/website/newsletter/email/position',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'redirectAdminIfNotAuthenticated',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\NewsletterEmail\\NewsletterEmailController@position',
        'controller' => 'App\\Http\\Controllers\\Admin\\NewsletterEmail\\NewsletterEmailController@position',
        'as' => 'admin.website.newsletter.email.position',
        'namespace' => NULL,
        'prefix' => 'admin/website/newsletter/email',
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
    'admin.website.content.page.index' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/website/content/page',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'redirectAdminIfNotAuthenticated',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\ContentPage\\ContentPageController@index',
        'controller' => 'App\\Http\\Controllers\\Admin\\ContentPage\\ContentPageController@index',
        'as' => 'admin.website.content.page.index',
        'namespace' => NULL,
        'prefix' => 'admin/website/content/page',
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
    'admin.website.content.page.create' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/website/content/page/create',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'redirectAdminIfNotAuthenticated',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\ContentPage\\ContentPageController@create',
        'controller' => 'App\\Http\\Controllers\\Admin\\ContentPage\\ContentPageController@create',
        'as' => 'admin.website.content.page.create',
        'namespace' => NULL,
        'prefix' => 'admin/website/content/page',
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
    'admin.website.content.page.store' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'admin/website/content/page/store',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'redirectAdminIfNotAuthenticated',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\ContentPage\\ContentPageController@store',
        'controller' => 'App\\Http\\Controllers\\Admin\\ContentPage\\ContentPageController@store',
        'as' => 'admin.website.content.page.store',
        'namespace' => NULL,
        'prefix' => 'admin/website/content/page',
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
    'admin.website.content.page.edit' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/website/content/page/edit/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'redirectAdminIfNotAuthenticated',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\ContentPage\\ContentPageController@edit',
        'controller' => 'App\\Http\\Controllers\\Admin\\ContentPage\\ContentPageController@edit',
        'as' => 'admin.website.content.page.edit',
        'namespace' => NULL,
        'prefix' => 'admin/website/content/page',
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
    'admin.website.content.page.update' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'admin/website/content/page/update',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'redirectAdminIfNotAuthenticated',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\ContentPage\\ContentPageController@update',
        'controller' => 'App\\Http\\Controllers\\Admin\\ContentPage\\ContentPageController@update',
        'as' => 'admin.website.content.page.update',
        'namespace' => NULL,
        'prefix' => 'admin/website/content/page',
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
    'admin.website.content.page.delete' => 
    array (
      'methods' => 
      array (
        0 => 'DELETE',
      ),
      'uri' => 'admin/website/content/page/delete/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'redirectAdminIfNotAuthenticated',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\ContentPage\\ContentPageController@delete',
        'controller' => 'App\\Http\\Controllers\\Admin\\ContentPage\\ContentPageController@delete',
        'as' => 'admin.website.content.page.delete',
        'namespace' => NULL,
        'prefix' => 'admin/website/content/page',
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
    'admin.website.content.page.bulk' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'admin/website/content/page/bulk',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'redirectAdminIfNotAuthenticated',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\ContentPage\\ContentPageController@bulk',
        'controller' => 'App\\Http\\Controllers\\Admin\\ContentPage\\ContentPageController@bulk',
        'as' => 'admin.website.content.page.bulk',
        'namespace' => NULL,
        'prefix' => 'admin/website/content/page',
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
    'admin.website.content.page.import' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'admin/website/content/page/import',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'redirectAdminIfNotAuthenticated',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\ContentPage\\ContentPageController@import',
        'controller' => 'App\\Http\\Controllers\\Admin\\ContentPage\\ContentPageController@import',
        'as' => 'admin.website.content.page.import',
        'namespace' => NULL,
        'prefix' => 'admin/website/content/page',
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
    'admin.website.content.page.export' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/website/content/page/export/{type}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'redirectAdminIfNotAuthenticated',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\ContentPage\\ContentPageController@export',
        'controller' => 'App\\Http\\Controllers\\Admin\\ContentPage\\ContentPageController@export',
        'as' => 'admin.website.content.page.export',
        'namespace' => NULL,
        'prefix' => 'admin/website/content/page',
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
    'admin.website.content.page.position' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'admin/website/content/page/position',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'redirectAdminIfNotAuthenticated',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\ContentPage\\ContentPageController@position',
        'controller' => 'App\\Http\\Controllers\\Admin\\ContentPage\\ContentPageController@position',
        'as' => 'admin.website.content.page.position',
        'namespace' => NULL,
        'prefix' => 'admin/website/content/page',
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
    'admin.website.social.media.index' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/website/social-media',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'redirectAdminIfNotAuthenticated',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\SocialMedia\\SocialMediaController@index',
        'controller' => 'App\\Http\\Controllers\\Admin\\SocialMedia\\SocialMediaController@index',
        'as' => 'admin.website.social.media.index',
        'namespace' => NULL,
        'prefix' => 'admin/website/social-media',
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
    'admin.website.social.media.create' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/website/social-media/create',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'redirectAdminIfNotAuthenticated',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\SocialMedia\\SocialMediaController@create',
        'controller' => 'App\\Http\\Controllers\\Admin\\SocialMedia\\SocialMediaController@create',
        'as' => 'admin.website.social.media.create',
        'namespace' => NULL,
        'prefix' => 'admin/website/social-media',
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
    'admin.website.social.media.store' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'admin/website/social-media/store',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'redirectAdminIfNotAuthenticated',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\SocialMedia\\SocialMediaController@store',
        'controller' => 'App\\Http\\Controllers\\Admin\\SocialMedia\\SocialMediaController@store',
        'as' => 'admin.website.social.media.store',
        'namespace' => NULL,
        'prefix' => 'admin/website/social-media',
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
    'admin.website.social.media.edit' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/website/social-media/edit/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'redirectAdminIfNotAuthenticated',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\SocialMedia\\SocialMediaController@edit',
        'controller' => 'App\\Http\\Controllers\\Admin\\SocialMedia\\SocialMediaController@edit',
        'as' => 'admin.website.social.media.edit',
        'namespace' => NULL,
        'prefix' => 'admin/website/social-media',
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
    'admin.website.social.media.update' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'admin/website/social-media/update',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'redirectAdminIfNotAuthenticated',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\SocialMedia\\SocialMediaController@update',
        'controller' => 'App\\Http\\Controllers\\Admin\\SocialMedia\\SocialMediaController@update',
        'as' => 'admin.website.social.media.update',
        'namespace' => NULL,
        'prefix' => 'admin/website/social-media',
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
    'admin.website.social.media.delete' => 
    array (
      'methods' => 
      array (
        0 => 'DELETE',
      ),
      'uri' => 'admin/website/social-media/delete/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'redirectAdminIfNotAuthenticated',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\SocialMedia\\SocialMediaController@delete',
        'controller' => 'App\\Http\\Controllers\\Admin\\SocialMedia\\SocialMediaController@delete',
        'as' => 'admin.website.social.media.delete',
        'namespace' => NULL,
        'prefix' => 'admin/website/social-media',
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
    'admin.website.social.media.bulk' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'admin/website/social-media/bulk',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'redirectAdminIfNotAuthenticated',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\SocialMedia\\SocialMediaController@bulk',
        'controller' => 'App\\Http\\Controllers\\Admin\\SocialMedia\\SocialMediaController@bulk',
        'as' => 'admin.website.social.media.bulk',
        'namespace' => NULL,
        'prefix' => 'admin/website/social-media',
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
    'admin.website.social.media.import' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'admin/website/social-media/import',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'redirectAdminIfNotAuthenticated',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\SocialMedia\\SocialMediaController@import',
        'controller' => 'App\\Http\\Controllers\\Admin\\SocialMedia\\SocialMediaController@import',
        'as' => 'admin.website.social.media.import',
        'namespace' => NULL,
        'prefix' => 'admin/website/social-media',
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
    'admin.website.social.media.export' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/website/social-media/export/{type}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'redirectAdminIfNotAuthenticated',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\SocialMedia\\SocialMediaController@export',
        'controller' => 'App\\Http\\Controllers\\Admin\\SocialMedia\\SocialMediaController@export',
        'as' => 'admin.website.social.media.export',
        'namespace' => NULL,
        'prefix' => 'admin/website/social-media',
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
    'admin.website.social.media.position' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'admin/website/social-media/position',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'redirectAdminIfNotAuthenticated',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\SocialMedia\\SocialMediaController@position',
        'controller' => 'App\\Http\\Controllers\\Admin\\SocialMedia\\SocialMediaController@position',
        'as' => 'admin.website.social.media.position',
        'namespace' => NULL,
        'prefix' => 'admin/website/social-media',
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
    'front.generated::OIQtOM1DxOdc7Cfu' => 
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
        'as' => 'front.generated::OIQtOM1DxOdc7Cfu',
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
    'front.order.index' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'order',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\Front\\Order\\OrderController@index',
        'controller' => 'App\\Http\\Controllers\\Front\\Order\\OrderController@index',
        'as' => 'front.order.index',
        'namespace' => NULL,
        'prefix' => '/order',
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
    'front.order.invoice' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'order/invoice/{orderNumber}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\Front\\Order\\OrderController@invoice',
        'controller' => 'App\\Http\\Controllers\\Front\\Order\\OrderController@invoice',
        'as' => 'front.order.invoice',
        'namespace' => NULL,
        'prefix' => '/order',
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
    'front.wishlist.index' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'wishlist',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\Front\\Wishlist\\WishlistController@index',
        'controller' => 'App\\Http\\Controllers\\Front\\Wishlist\\WishlistController@index',
        'as' => 'front.wishlist.index',
        'namespace' => NULL,
        'prefix' => '/wishlist',
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
    'front.address.index' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'address',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\Front\\Address\\AddressController@index',
        'controller' => 'App\\Http\\Controllers\\Front\\Address\\AddressController@index',
        'as' => 'front.address.index',
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
    'front.address.edit' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'address/edit/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\Front\\Address\\AddressController@edit',
        'controller' => 'App\\Http\\Controllers\\Front\\Address\\AddressController@edit',
        'as' => 'front.address.edit',
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
    'front.address.update' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'address/update',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\Front\\Address\\AddressController@update',
        'controller' => 'App\\Http\\Controllers\\Front\\Address\\AddressController@update',
        'as' => 'front.address.update',
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
        'prefix' => '/category',
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
    'front.category.detail' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'category/{slug}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\Front\\Category\\CategoryController@detail',
        'controller' => 'App\\Http\\Controllers\\Front\\Category\\CategoryController@detail',
        'as' => 'front.category.detail',
        'namespace' => NULL,
        'prefix' => '/category',
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
        'uses' => 'App\\Http\\Controllers\\Front\\Collection\\CollectionController@index',
        'controller' => 'App\\Http\\Controllers\\Front\\Collection\\CollectionController@index',
        'as' => 'front.collection.index',
        'namespace' => NULL,
        'prefix' => '/collection',
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
    'front.collection.detail' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'collection/{slug}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\Front\\Collection\\CollectionController@detail',
        'controller' => 'App\\Http\\Controllers\\Front\\Collection\\CollectionController@detail',
        'as' => 'front.collection.detail',
        'namespace' => NULL,
        'prefix' => '/collection',
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
    'front.wishlist.check' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'wishlist/check-status',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\Front\\Wishlist\\WishlistController@checkStatus',
        'controller' => 'App\\Http\\Controllers\\Front\\Wishlist\\WishlistController@checkStatus',
        'as' => 'front.wishlist.check',
        'namespace' => NULL,
        'prefix' => '/wishlist',
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
    'front.wishlist.toggle' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'wishlist/toggle/{productId}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\Front\\Wishlist\\WishlistController@toggle',
        'controller' => 'App\\Http\\Controllers\\Front\\Wishlist\\WishlistController@toggle',
        'as' => 'front.wishlist.toggle',
        'namespace' => NULL,
        'prefix' => '/wishlist',
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
    'front.search.index' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'search',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\Front\\Search\\SearchController@index',
        'controller' => 'App\\Http\\Controllers\\Front\\Search\\SearchController@index',
        'as' => 'front.search.index',
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
    'front.order.store' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'order/store',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\Front\\Order\\OrderController@store',
        'controller' => 'App\\Http\\Controllers\\Front\\Order\\OrderController@store',
        'as' => 'front.order.store',
        'namespace' => NULL,
        'prefix' => '/order',
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
    'front.order.thankyou' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'order/thankyou',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\Front\\Order\\OrderController@thankyou',
        'controller' => 'App\\Http\\Controllers\\Front\\Order\\OrderController@thankyou',
        'as' => 'front.order.thankyou',
        'namespace' => NULL,
        'prefix' => '/order',
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
    'front.faq.index' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'faq',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\Front\\Faq\\FaqController@index',
        'controller' => 'App\\Http\\Controllers\\Front\\Faq\\FaqController@index',
        'as' => 'front.faq.index',
        'namespace' => NULL,
        'prefix' => '/faq',
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
    'front.content.terms' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'terms-and-conditions',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\Front\\Content\\ContentPageController@showTerms',
        'controller' => 'App\\Http\\Controllers\\Front\\Content\\ContentPageController@showTerms',
        'as' => 'front.content.terms',
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
    'front.content.privacy' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'privacy-policy',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\Front\\Content\\ContentPageController@showPrivacy',
        'controller' => 'App\\Http\\Controllers\\Front\\Content\\ContentPageController@showPrivacy',
        'as' => 'front.content.privacy',
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
    'front.content.return' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'return-policy',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\Front\\Content\\ContentPageController@showReturn',
        'controller' => 'App\\Http\\Controllers\\Front\\Content\\ContentPageController@showReturn',
        'as' => 'front.content.return',
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
    'front.content.refund' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'refund-policy',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\Front\\Content\\ContentPageController@showRefund',
        'controller' => 'App\\Http\\Controllers\\Front\\Content\\ContentPageController@showRefund',
        'as' => 'front.content.refund',
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
    'front.content.support' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'support',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\Front\\Content\\ContentPageController@showSupport',
        'controller' => 'App\\Http\\Controllers\\Front\\Content\\ContentPageController@showSupport',
        'as' => 'front.content.support',
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
    'front.content.cookie' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'cookie-policy',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\Front\\Content\\ContentPageController@showCookie',
        'controller' => 'App\\Http\\Controllers\\Front\\Content\\ContentPageController@showCookie',
        'as' => 'front.content.cookie',
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
    'front.content.shipping' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'shipping-info',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\Front\\Content\\ContentPageController@showShipping',
        'controller' => 'App\\Http\\Controllers\\Front\\Content\\ContentPageController@showShipping',
        'as' => 'front.content.shipping',
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
    'front.content.size-guide' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'size-guide',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\Front\\Content\\ContentPageController@showSizeGuide',
        'controller' => 'App\\Http\\Controllers\\Front\\Content\\ContentPageController@showSizeGuide',
        'as' => 'front.content.size-guide',
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
    'front.content.contact' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'contact-us',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\Front\\Content\\ContentPageController@contactUs',
        'controller' => 'App\\Http\\Controllers\\Front\\Content\\ContentPageController@contactUs',
        'as' => 'front.content.contact',
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
    'front.content.about' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'about-us',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\Front\\Content\\ContentPageController@aboutUs',
        'controller' => 'App\\Http\\Controllers\\Front\\Content\\ContentPageController@aboutUs',
        'as' => 'front.content.about',
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
        'uses' => 'App\\Http\\Controllers\\Front\\Error\\ErrorPageController@err404',
        'controller' => 'App\\Http\\Controllers\\Front\\Error\\ErrorPageController@err404',
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
        'slug' => '^(?!terms-and-conditions$|privacy-policy$|return-policy$|refund-policy$|support$|contact-us$|404$).+',
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
                }";s:5:"scope";s:47:"Illuminate\\Filesystem\\FilesystemServiceProvider";s:4:"this";N;s:4:"self";s:32:"00000000000008680000000000000000";}}',
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
