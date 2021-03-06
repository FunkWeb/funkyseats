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
            $adminRooms = [];

            foreach ($rooms as $room) {
                $tmpBooking = [[
                    'icon' => 'fa fa-th-large',
                    'title' => $room->name,
                    'url' => '/room/' . $room->id,
                ]];
                $bookingRooms = array_merge($bookingRooms, $tmpBooking);

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
                    'title' => 'Home',
                    'url' => '/',
                    'route-name' => 'home'
                ],
                [
                    'icon' => 'fa fa-question',
                    'title' => 'FAQ',
                    'url' => '/faq',
                ]
            ];

            $normalRoomsMenu = [
                'icon' => 'fa fa-align-left',
                'title' => 'Book seat in room:',
                'url' => 'javascript:;',
                'caret' => true,
                'sub_menu' => $bookingRooms
            ];

            if (auth()->check() && auth()->user()->hasRole('admin')) {
                $adminRoomsMenu = [
                    'icon' => 'fa fa-align-left',
                    'title' => 'Admin:',
                    'url' => 'javascript:;',
                    'caret' => true,
                    'sub_menu' => [
                        [
                            'url' => '/rooms/edit',
                            'title' => 'Edit Rooms',
                        ],
                        [
                            'title' => 'Edit seats in room:',
                            'url' => 'javascript:;',
                            'sub_menu' => $adminRooms
                        ],
                        [
                            'url' => '/admin/edit_seat_types',
                            'title' => 'Edit seat types',
                        ],
                        [
                            'url' => '/profiles',
                            'title' => 'User profiles',
                        ],
                        [
                            'url' => '/admin/stats',
                            'title' => 'Booking statistics',
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
