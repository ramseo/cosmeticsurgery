<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Str;

class GenerateMenus
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     *
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        \Menu::make('admin_sidebar', function ($menu) {
            // Dashboard

            $menu->add('<i class="cil-speedometer c-sidebar-nav-icon"></i> Dashboard', [
                'route' => 'backend.dashboard',
                'class' => 'c-sidebar-nav-item',
            ])
                ->data([
                    'order' => 1,
                    'activematches' => 'admin/dashboard*',
                ])
                ->link->attr([
                    'class' => 'c-sidebar-nav-link',
                ]);


            $menu->add('<i class="c-sidebar-nav-icon fas fa-file"></i> Menus', [
                'route' => 'backend.menutype.index',
                'class' => 'c-sidebar-nav-item',
            ])
                ->data([
                    'order' => 99,
                    'activematches' => 'admin/menutype*',
                    'permission' => [],
                ])
                ->link->attr([
                    'class' => 'c-sidebar-nav-link',
                ]);

            $menu->add('<i class="c-sidebar-nav-icon fa fa-user-md"></i> Surgeons', [
                'route' => 'backend.customer.index',
                'class' => 'c-sidebar-nav-item',
            ])
                ->data([
                    'order' => 99,
                    'activematches' => 'admin/customer*',
                    'permission' => [],
                ])
                ->link->attr([
                    'class' => 'c-sidebar-nav-link',
                ]);

            // export
            // $menu->add('<i class="c-sidebar-nav-icon fas fa-file-export"></i>Vendor Export', [
            //     'route' => 'backend.importExportView',
            //     'class' => 'c-sidebar-nav-item',
            // ])
            //     ->data([
            //         'order' => 101,
            //         'activematches' => 'admin/importExportView*',
            //         'permission' => [],
            //     ])
            //     ->link->attr([
            //         'class' => 'c-sidebar-nav-link',
            //     ]);
            // export

            // reviews
            $menu->add('<i class="c-sidebar-nav-icon fas fa-star"></i>Reviews', [
                'route' => 'backend.review.index',
                'class' => 'c-sidebar-nav-item',
            ])
                ->data([
                    'order' => 102,
                    'activematches' => 'admin/review*',
                    'permission' => [],
                ])
                ->link->attr([
                    'class' => 'c-sidebar-nav-link',
                ]);
            // reviews

            // $menu->add('<i class="c-sidebar-nav-icon fas fa-user"></i> Travel', [
            //     'route' => 'backend.travel.index',
            //     'class' => 'c-sidebar-nav-item',
            // ])
            //     ->data([
            //         'order' => 101,
            //         'activematches' => 'admin/travel*',
            //         'permission' => [],
            //     ])
            //     ->link->attr([
            //         'class' => 'c-sidebar-nav-link',
            //     ]);

            // $accessControl = $menu->add('<i class="c-sidebar-nav-icon cil-applications-settings"></i> Vendor ', [
            //     'class' => 'c-sidebar-nav-dropdown',
            // ])
            //     ->data([
            //         'order' => 100,
            //         'activematches' => [
            //             'admin/vendor*',
            //             'admin/type*',
            //         ],
            //         'permission' => [],
            //     ]);
            // $accessControl->link->attr([
            //     'class' => 'c-sidebar-nav-dropdown-toggle',
            //     'href' => '#',
            // ]);


            // Submenu: vendor
            // $accessControl->add('<i class="c-sidebar-nav-icon cil-people"></i> Vendor List', [
            //     'route' => 'backend.vendor.index',
            //     'class' => 'nav-item',
            // ])
            //     ->data([
            //         'order' => 101,
            //         'activematches' => 'admin/vendor*',
            //         'permission' => ['view_roles'],
            //     ])
            //     ->link->attr([
            //         'class' => 'c-sidebar-nav-link',
            //     ]);

            // // Submenu: category
            // $accessControl->add('<i class="c-sidebar-nav-icon cil-list"></i> Vendor Type', [
            //     'route' => 'backend.type.index',
            //     'class' => 'nav-item',
            // ])
            //     ->data([
            //         'order' => 102,
            //         'activematches' => 'admin/type*',
            //         'permission' => [],
            //     ])
            //     ->link->attr([
            //         'class' => 'c-sidebar-nav-link',
            //     ]);

            // // Submenu: Users
            // $accessControl->add('<i class="c-sidebar-nav-icon cil-note-add"></i> Contents', [
            //     'route' => 'backend.content.index',
            //     'class' => 'nav-item',
            // ])
            //     ->data([
            //         'order' => 103,
            //         'activematches' => 'admin/content*',
            //         'permission' => [],
            //     ])
            //     ->link->attr([
            //         'class' => 'c-sidebar-nav-link',
            //     ]);


            $menu->add('<i class="c-sidebar-nav-icon fas fa-city"></i> Cities', [
                'route' => 'backend.city.index',
                'class' => 'c-sidebar-nav-item',
            ])
                ->data([
                    'order' => 99,
                    'activematches' => 'admin/city*',
                    'permission' => [],
                ])
                ->link->attr([
                    'class' => 'c-sidebar-nav-link',
                ]);

            // $menu->add('<i class="c-sidebar-nav-icon fas fa-envelope"></i> Newsletter', [
            //     'route' => 'backend.newsletter.index',
            //     'class' => 'c-sidebar-nav-item',
            // ])
            //     ->data([
            //         'order' => 99,
            //         'activematches' => 'admin/newsletter*',
            //         'permission' => [],
            //     ])
            //     ->link->attr([
            //         'class' => 'c-sidebar-nav-link',
            //     ]);


            // $menu->add('<i class="c-sidebar-nav-icon fas fa-mobile"></i>Phone Inquiry', [
            //     'route' => 'backend.inquiry.index',
            //     'class' => 'c-sidebar-nav-item',
            // ])
            //     ->data([
            //         'order' => 100,
            //         'activematches' => 'admin/inquiry*',
            //         'permission' => [],
            //     ])
            //     ->link->attr([
            //         'class' => 'c-sidebar-nav-link',
            //     ]);

            // Notifications

            //                        $menu->add('<i class="c-sidebar-nav-icon fas fa-bell"></i> Notifications', [
            //                            'route' => 'backend.notifications.index',
            //                            'class' => 'c-sidebar-nav-item',
            //                        ])
            //                        ->data([
            //                            'order'         => 99,
            //                            'activematches' => 'admin/notifications*',
            //                            'permission'    => [],
            //                        ])
            //                        ->link->attr([
            //                            'class' => 'c-sidebar-nav-link',
            //                        ]);

            // Separator: Access Management
            //            $menu->add('Management', [
            //                'class' => 'c-sidebar-nav-title',
            //            ])
            //            ->data([
            //                'order'         => 101,
            //                'permission'    => ['edit_settings', 'view_backups', 'view_users', 'view_roles', 'view_logs'],
            //            ]);

            // Settings
            $menu->add('<i class="c-sidebar-nav-icon fas fa-cogs"></i> Settings', [
                'route' => 'backend.settings',
                'class' => 'c-sidebar-nav-item',
            ])
                ->data([
                    'order' => 102,
                    'activematches' => 'admin/settings*',
                    'permission' => ['edit_settings'],
                ])
                ->link->attr([
                    'class' => 'c-sidebar-nav-link',
                ]);

            // Backup
            //                        $menu->add('<i class="c-sidebar-nav-icon fas fa-archive"></i> Backups', [
            //                            'route' => 'backend.backups.index',
            //                            'class' => 'nav-item',
            //                        ])
            //                        ->data([
            //                            'order'         => 103,
            //                            'activematches' => 'admin/backups*',
            //                            'permission'    => ['view_backups'],
            //                        ])
            //                        ->link->attr([
            //                            'class' => 'c-sidebar-nav-link',
            //                        ]);

            // Access Control Dropdown
            //           $accessControl = $menu->add('<i class="c-sidebar-nav-icon cil-shield-alt"></i> Access Control', [
            //               'class' => 'c-sidebar-nav-dropdown',
            //           ])
            //               ->data([
            //                   'order' => 104,
            //                   'activematches' => [
            //                       'admin/users*',
            //                       'admin/roles*',
            //                   ],
            //                   'permission' => ['view_users', 'view_roles'],
            //               ]);
            //           $accessControl->link->attr([
            //               'class' => 'c-sidebar-nav-dropdown-toggle',
            //               'href' => '#',
            //           ]);
            //
            //           // Submenu: Users
            //           $accessControl->add('<i class="c-sidebar-nav-icon cil-people"></i> Users', [
            //               'route' => 'backend.users.index',
            //               'class' => 'nav-item',
            //           ])
            //               ->data([
            //                   'order' => 105,
            //                   'activematches' => 'admin/users*',
            //                   'permission' => ['view_users'],
            //               ])
            //               ->link->attr([
            //                   'class' => 'c-sidebar-nav-link',
            //               ]);
            //
            //           // Submenu: Roles
            //           $accessControl->add('<i class="c-sidebar-nav-icon cil-people"></i> Roles', [
            //               'route' => 'backend.roles.index',
            //               'class' => 'nav-item',
            //           ])
            //               ->data([
            //                   'order' => 106,
            //                   'activematches' => 'admin/roles*',
            //                   'permission' => ['view_roles'],
            //               ])
            //               ->link->attr([
            //                   'class' => 'c-sidebar-nav-link',
            //               ]);

            // Log Viewer
            // Log Viewer Dropdown

            //            $accessControl = $menu->add('<i class="c-sidebar-nav-icon cil-list-rich"></i> Log Viewer', [
            //                'class' => 'c-sidebar-nav-dropdown',
            //            ])
            //            ->data([
            //                'order'         => 107,
            //                'activematches' => [
            //                    'log-viewer*',
            //                ],
            //                'permission'    => ['view_logs'],
            //            ]);
            //            $accessControl->link->attr([
            //                'class' => 'c-sidebar-nav-dropdown-toggle',
            //                'href'  => '#',
            //            ]);

            // Submenu: Log Viewer Dashboard

            //            $accessControl->add('<i class="c-sidebar-nav-icon cil-list"></i> Dashboard', [
            //                'route' => 'log-viewer::dashboard',
            //                'class' => 'nav-item',
            //            ])
            //            ->data([
            //                'order'         => 108,
            //                'activematches' => 'admin/log-viewer',
            //            ])
            //            ->link->attr([
            //                'class' => 'c-sidebar-nav-link',
            //            ]);
            //
            //            // Submenu: Log Viewer Logs by Days
            //            $accessControl->add('<i class="c-sidebar-nav-icon cil-list-numbered"></i> Logs by Days', [
            //                'route' => 'log-viewer::logs.list',
            //                'class' => 'nav-item',
            //            ])
            //            ->data([
            //                'order'         => 109,
            //                'activematches' => 'admin/log-viewer/logs*',
            //            ])
            //            ->link->attr([
            //                'class' => 'c-sidebar-nav-link',
            //            ]);

            // Access Permission Check
            //            $menu->filter(function ($item) {
            //                if ($item->data('permission')) {
            //                    if (auth()->check()) {
            //                        if (auth()->user()->hasRole('super admin')) {
            //                            return true;
            //                        } elseif (auth()->user()->hasAnyPermission($item->data('permission'))) {
            //                            return true;
            //                        }
            //                    }
            //
            //                    return false;
            //                } else {
            //                    return true;
            //                }
            //            });

            // Set Active Menu
            $menu->filter(function ($item) {
                if ($item->activematches) {
                    $matches = is_array($item->activematches) ? $item->activematches : [$item->activematches];

                    foreach ($matches as $pattern) {
                        if (Str::is($pattern, \Request::path())) {
                            $item->activate();
                            $item->active();
                            if ($item->hasParent()) {
                                $item->parent()->activate();
                                $item->parent()->active();
                            }
                            // dd($pattern);
                        }
                    }
                }

                return true;
            });
        })->sortBy('order');

        \Menu::make('vedor_sidebar', function ($menu) {
            // Dashboard
            $menu->add('<i class="cil-speedometer c-sidebar-nav-icon"></i> Dashboard', ['route' => 'vendor.dashboard', 'class' => 'c-sidebar-nav-item',])->data(['order' => 1, 'activematches' => 'vendor/dashboard*',])->link->attr(['class' => 'c-sidebar-nav-link',]);
            // Profile
            $menu->add('<i class="c-sidebar-nav-icon fas fa-user"></i> Profile', ['route' => 'vendor.profile', 'class' => 'c-sidebar-nav-item',])->data(['order' => 99, 'activematches' => 'vendor/profile*', 'permission' => [],])->link->attr(['class' => 'c-sidebar-nav-link',]);
            // Price & Services
            $menu->add('<i class="c-sidebar-nav-icon fas fa-amazon-pay"></i> Price & Services', ['route' => 'vendor.price.index', 'class' => 'c-sidebar-nav-item',])->data(['order' => 100, 'activematches' => 'vendor/price*', 'permission' => [],])->link->attr(['class' => 'c-sidebar-nav-link',]);
            // Album
            $menu->add('<i class="c-sidebar-nav-icon fas fa-images"></i> Album', ['route' => 'vendor.album.index', 'class' => 'c-sidebar-nav-item',])->data(['order' => 101, 'activematches' => 'vendor/album*', 'permission' => [],])->link->attr(['class' => 'c-sidebar-nav-link',]);
            // Album
            $menu->add('<i class="c-sidebar-nav-icon fas fa-video"></i> Video', ['route' => 'vendor.video.index', 'class' => 'c-sidebar-nav-item',])->data(['order' => 102, 'activematches' => 'vendor/video*', 'permission' => [],])->link->attr(['class' => 'c-sidebar-nav-link',]);
            // qutation
            $menu->add('<i class="c-sidebar-nav-icon fas fa-quote-right"></i> Quotation', ['route' => 'vendor.quotation.index', 'class' => 'c-sidebar-nav-item',])->data(['order' => 102, 'activematches' => 'vendor/quotation*', 'permission' => [],])->link->attr(['class' => 'c-sidebar-nav-link',]);

            // Set Active Menu
            $menu->filter(function ($item) {
                if ($item->activematches) {
                    $matches = is_array($item->activematches) ? $item->activematches : [$item->activematches];

                    foreach ($matches as $pattern) {
                        if (Str::is($pattern, \Request::path())) {
                            $item->activate();
                            $item->active();
                            if ($item->hasParent()) {
                                $item->parent()->activate();
                                $item->parent()->active();
                            }
                        }
                    }
                }

                return true;
            });
        })->sortBy('order');

        return $next($request);
    }
}
