<?php

namespace App\Http\Requests\ShoppingLists;

use App\Http\Requests\BaseRequest;

class ShoppingListStore extends BaseRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|min:1|unique:shopping_lists'
        ];
    }
}
