<?php

namespace App\Providers;

use App\User;
use Illuminate\Contracts\Events\Dispatcher;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use JeroenNoten\LaravelAdminLte\Events\BuildingMenu;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(Dispatcher $events)
    {
        $events->listen(BuildingMenu::class, function (BuildingMenu $event) {
/*

            $event->menu->add('MENU PRINCIPAL');
            $event->menu->add([
                [
                    'text' => 'Home',
                    'url' => 'panel',
                    'icon' => 'home',
                ],
            ]);


            $event->menu->add('CONTROLES');
            $event->menu->add([
                [
                    'text' => 'Usuários',
                    'icon' => 'users',
                    'role' => 'administrador',
                    'submenu' => [
                        [
                            'text' => 'Listar Usuários',
                            'route' => 'users.index',
                            'icon' => 'list-ul',
                        ],
                        [
                            'text' => 'Cadastrar Usuários',
                            'route' => 'users.create',
                            'icon' => 'plus',
                        ],
                    ],
                ],
                [
                    'text' => 'Perfis',
                    'icon' => 'user-circle',
                    'submenu' => [
                        [
                            'text' => 'Listar Perfis',
                            'route' => 'perfil.index',
                            'icon' => 'list-ul',
                        ],
                        [
                            'text' => 'Cadastrar Perfis',
                            'route' => 'perfil.create',
                            'icon' => 'plus',
                        ],
                    ],
                ],

            ]);
*/
            $event->menu->add('CONFIGURAÇÕES');
            $event->menu->add([
                'text' => 'Alterar Senha',
                'url' => route('users.edit', \Auth::user()->id),
                'icon' => 'lock',
            ]);

            
        });

        

        Schema::defaultStringLength(191);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
