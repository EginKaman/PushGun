<?php

namespace App\Http\ViewComposers;

use App\SystemMessage;
use Illuminate\View\View;

class SystemMessageComposer
{
    public function compose(View $view)
    {
         $view->with('system_messages', SystemMessage::limit(5)->latest()->get());
    }
}
