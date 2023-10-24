<?php


return [
    [
        'icon'      => 'nav-icon fas fa-tachometer-alt',
        'route'     => 'dashboard.dashboard',
        'title'     => 'Dashboard',
        'badge'     => 'New',
        'active'    => 'dashboard.dashboard'
    ],
    [
        'icon'      => 'far fa-circle nav-icont',
        'route'     => 'dashboard.categories.index',
        'title'     => 'Categories',
        'active'    => 'dashboard.categories.*'
    ],
    [
        'icon'      => 'far fa-circle nav-icont',
        'route'     => 'dashboard.products.index',
        'title'     => 'Products',
        'active'    => 'dashboard.products.*'
    ],
    [
        'icon'      => 'far fa-circle nav-icont',
        'route'     => 'dashboard.categories.index',
        'title'     => 'Orders',
        'active'    => 'dashboard.orders.*'
    ],
];
