<?php

namespace App\Http\Livewire;

use Livewire\Component;

class ChangeEvent extends Component
{
	public $cities = [
        1 => 'Rajkot',
        2 => 'Surat',
        3 => 'Vadodara'
    ];
    public $city_id = '';
	
    public function render()
    {
        return view('livewire.view-agreement-sheet');
    }
	public function changeEvent($value)
    {
        $this->city_id = $value;
    }
}
