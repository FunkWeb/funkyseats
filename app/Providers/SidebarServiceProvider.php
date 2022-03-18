<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\Room;

class SidebarServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer('includes.sidebar', function ($view) {
            $rooms = Room::orderBy('name')->get();

            $bookingRooms = [];
            $displayRooms = [];
            $adminRooms = [];

            foreach ($rooms as $room) {
                $tmpBooking = [[
                    'icon' => 'fa fa-th-large',
                    'title' => $room->name,
                    'url' => '/room/' . $room->id,
                ]];
                $bookingRooms = array_merge($bookingRooms, $tmpBooking);

                //   $tmpDisplay = [[
                //       'icon' => 'fa fa-th-large',
                //       'title' => $room->name,
                //       'url' => '/display/' . $room->id,
                //   ]];
                //   $displayRooms = array_merge($displayRooms, $tmpDisplay);

                $tmpAdmin = [[
                    'icon' => 'fa fa-th-large',
                    'title' => $room->name,
                    'url' => '/room/' . $room->id . '/seats/edit',
                ]];
                $adminRooms = array_merge($adminRooms, $tmpAdmin);
            }

            $homeMenu = [
                [
                    'icon' => 'fa fa-th-large',
                    'title' => 'Hjem',
                    'url' => '/',
                    'route-name' => 'home'
                ],
                [
                    //'icon' => 'fa fa-th-large',
                    'icon' => 'fa fa-question',
                    'title' => 'Hjelp',
                    'url' => '/faq',
                ]
            ];

            $normalRoomsMenu = [
                'icon' => 'fa fa-align-left',
                'title' => 'Book sete i rom:',
                'url' => 'javascript:;',
                'caret' => true,
                'sub_menu' => $bookingRooms
            ];

            // $displayRoomsMenu = [
            //     'icon' => 'fa fa-align-left',
            //     'title' => 'Display room:',
            //     'url' => 'javascript:;',
            //     'caret' => true,
            //     'sub_menu' => $displayRooms
            // ];

            if (auth()->check() && auth()->user()->hasRole('admin')) {
                $adminRoomsMenu = [
                    'icon' => 'fa fa-align-left',
                    'title' => 'Admin:',
                    'url' => 'javascript:;',
                    'caret' => true,
                    'sub_menu' => [
                        [
                            'url' => '/rooms/edit',
                            'title' => 'Rediger rom',
                        ],
                        [
                            'title' => 'Rediger seter:',
                            'url' => 'javascript:;',
                            'sub_menu' => $adminRooms
                        ],
                        [
                            'url' => '/admin/edit_seat_types',
                            'title' => 'Rediger setetyper',
                        ],                        [
                            'url' => '/profiles',
                            'title' => 'Brukerprofiler',
                        ],
                    ]
                ];
            } else {
                $adminRoomsMenu = [];
            }
            if ($adminRoomsMenu) {
                $combinedMenu = [
                    $normalRoomsMenu,
                    $adminRoomsMenu
                ];
            } else {
                $combinedMenu = [
                    $normalRoomsMenu,
                ];
            }

            $completeMenu = array_merge($homeMenu, $combinedMenu);
            $view->with('menuProvider', $completeMenu);
        });
    }
}
