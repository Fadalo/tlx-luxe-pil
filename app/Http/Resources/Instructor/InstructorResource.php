<?php

namespace App\Http\Resources\Instructor;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\UserResource;
use App\Models\User;

class InstructorResource extends JsonResource
{

    protected function form(){

        $form = [];
        $form = [
            
            ['type'=>'text','name' => 'txtName', 'value'  => 'user.id','default' => ''],
            ['type'=>'text','name' => 'txtName', 'value'  => 'user.id','default' => ''],
            ['type'=>'text','name' => 'txtName', 'value'  => 'user.id','default' => ''],
        ];   

        return $form;
    }

    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
       return parent::toArray($request);
    }
}
