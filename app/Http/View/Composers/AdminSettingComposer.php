<?php

namespace App\Http\View\Composers;

use App\Setting;
use Illuminate\View\View;

class AdminSettingComposer
{
    private $setting;

    public function __construct()
    {
            $this->setting = Setting::first();
    }

    public function compose(View $view)
    {
        $view->with('setting', $this->setting);
    }
}
