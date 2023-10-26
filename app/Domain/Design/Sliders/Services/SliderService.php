<?php

namespace App\Domain\Design\Sliders\Services;

use App\Domain\Design\Sliders\Models\Slider;
use App\Domain\Design\Sliders\Services\ISliderService;

class SliderService implements ISliderService
{
    public function GetAll(){
        return Slider::get();
    }

    public function Create($entity){
        $result = Slider::create($entity);
        return $result;
    }

    public function Update($entity,$id){
        $original = Slider::find($id);
        $original->update($entity);
        $original->save();
        return $original;
    }

    public function Delete($id){
        $original = Slider::find($id);
        return $original->delete();
    }
}
