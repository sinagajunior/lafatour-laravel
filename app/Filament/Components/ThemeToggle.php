<?php

namespace App\Filament\Components;

use Livewire\Component;

class ThemeToggle extends Component
{
    public $isDark = false;

    public function mount()
    {
        $this->isDark = session('theme') === 'dark';
    }

    public function toggleTheme()
    {
        $this->isDark = !$this->isDark;
        session(['theme' => $this->isDark ? 'dark' : 'light']);
        $this->dispatch('theme-changed', theme: $this->isDark ? 'dark' : 'light');
    }

    public function render()
    {
        return view('filament.theme-toggle');
    }
}
