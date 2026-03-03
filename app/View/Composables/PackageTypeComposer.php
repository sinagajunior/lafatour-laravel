<?php

namespace App\View\Composables;

use App\Models\PackageType;
use Illuminate\View\View;

class PackageTypeComposer
{
    protected $packageTypes;

    public function __construct()
    {
        $this->packageTypes = PackageType::orderBy('name')->get();
    }

    public function compose(View $view)
    {
        $view->with('packageTypes', $this->packageTypes);
    }
}
