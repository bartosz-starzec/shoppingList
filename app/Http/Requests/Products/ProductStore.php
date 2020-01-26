<?php

namespace App\Http\Requests\Products;

use App\Http\Requests\BaseRequest;

class ProductStore extends BaseRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|min:1'
        ];
    }
}
