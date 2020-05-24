<?php

namespace App\Http\View\Composers\Admin;

use App\Order;
use App\Transaction;
use Illuminate\View\View;

class SidebarComposer
{
    protected $order_count;
    public $menu;

    public function __construct()
    {
        $this->menu = [
            [
                'icon' => 'fa fa-tachometer',
                'style' => 'simple',
                'name' => 'Dashboard',
                'route' => 'home',
            ],
            [
                'style' => 'title',
                'name' => 'BASE',
            ],
            [
                'icon' => 'fa fa-gg',
                'style' => 'simple',
                'name' => 'Admins',
                'route' => 'admin.admins.index',
            ],
            [
                'icon' => 'fa fa-users',
                'style' => 'simple',
                'name' => 'Resellers',
                'route' => 'admin.resellers.index',
            ],
            [
                'icon' => 'fa fa-columns',
                'style' => 'simple',
                'name' => 'Categories',
                'route' => 'admin.categories.index',
            ],
            [
                'icon' => 'fa fa-server',
                'style' => 'dropdown',
                'name' => 'Products',
                'items' => [
                    [
                        'name' => 'All',
                        'route' => 'admin.products.index',
                    ],
                    [
                        'name' => 'Create',
                        'route' => 'admin.products.create',
                    ],
                ],
            ],
            [
                'icon' => 'fa fa-bars',
                'style' => 'simple',
                'name' => 'Menus',
                'url' => 'admin/menus',
            ],
            [
                'icon' => 'fa fa-file-text',
                'style' => 'dropdown',
                'name' => 'Pages',
                'items' => [
                    [
                        'name' => 'All',
                        'route' => 'admin.pages.index',
                    ],
                    [
                        'name' => 'Create',
                        'route' => 'admin.pages.create',
                    ],
                ],
            ],
            [
                'icon' => 'fa fa-image',
                'style' => 'simple',
                'name' => 'Images',
                'route' => 'admin.images.index',
            ],
            [
                'icon' => 'fa fa-th-list',
                'style' => 'dropdown',
                'name' => 'Orders',
                'items' => [
                    [
                        'name' => 'Pending',
                        'route' => 'admin.order.index',
                        'param' => 'status=pending',
                    ],
                    [
                        'name' => 'Accepted',
                        'route' => 'admin.order.index',
                        'param' => 'status=accepted',
                    ],
                    [
                        'name' => 'Processing',
                        'route' => 'admin.order.index',
                        'param' => 'status=processing',
                    ],
                    [
                        'name' => 'Transporting',
                        'route' => 'admin.order.index',
                        'param' => 'status=transporting',
                    ],
                    [
                        'name' => 'Completed',
                        'route' => 'admin.order.index',
                        'param' => 'status=completed',
                    ],
                ],
            ],
            [
                'icon' => 'fa fa-money',
                'style' => 'dropdown',
                'name' => 'Transactions',
                'items' => [
                    [
                        'name' => 'Pay',
                        'route' => 'admin.transactions.pay',
                    ],
                    [
                        'name' => 'History',
                        'route' => 'admin.transactions.index',
                    ],
                    [
                        'name' => 'Requests',
                        'route' => 'admin.transactions.requests',
                    ],
                ],
            ],
            [
                'icon' => 'fa fa-question',
                'style' => 'dropdown',
                'name' => 'FAQs',
                'items' => [
                    [
                        'name' => 'All',
                        'route' => 'admin.faqs.index',
                    ],
                    [
                        'name' => 'Add New',
                        'route' => 'admin.faqs.create',
                    ],
                ],
            ],
        ];
    }

    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $view->with('menu', $this->menu);
        $view->with('provider', 'web');
    }
}