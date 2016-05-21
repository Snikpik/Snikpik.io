<?php

namespace Snikpik\Http\Requests\API\v1;

use Snikpik\Http\Requests\Request;

/**
 * Class SnikpikForm
 * @package Snikpik\Http\Requests\API\v1
 */
class SnikpikForm extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'url' => 'required|url'
        ];
    }
}
