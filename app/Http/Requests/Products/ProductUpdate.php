<?php

namespace App\Http\Requests\Products;

use App\Http\Requests\BaseRequest;

class ProductUpdate extends BaseRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'id' => 'integer|exists:products,id',
            'name' => 'min:1'
        ];
    }
}
