<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class MenuServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     **/
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     **/
    public function boot(): void
    {
        $verticalMenuJson = file_get_contents(base_path('resources/menu/verticalMenu.json'));
//        $verticalMenuData = json_decode($verticalMenuJson);

        // Translate the menu items
        $verticalMenuData = json_decode($verticalMenuJson, true);
        $verticalMenuData = $this->translateMenu($verticalMenuData);

        // Share all menuData to all the views
        \View::share('menuData', [$verticalMenuData]);
    }

    /**
     * Translate menu items.
     *
     * @param array $menuData
     * @return array
     */
    protected function translateMenu(array $menuData): array
    {
        foreach ($menuData['menu'] as &$item) {
            if (isset($item['name'])) {
                $item['name'] = "verticalMenu.".__($item['name']); // Translate menu name
            }
            if (isset($item['submenu'])) {
                foreach ($item['submenu'] as &$submenuItem) {
                    if (isset($submenuItem['name'])) {
                        $submenuItem['name'] = "verticalMenu.".__($submenuItem['name']); // Translate submenu names
                    }
                }
            }
        }

        return $menuData;
    }
}
