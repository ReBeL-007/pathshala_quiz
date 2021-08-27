<?php

namespace App\Http\Requests;

use App\Setting;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class StoreSettingRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('setting-create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;

    }

    public function rules()
    {
        return [
            'title' => [
                'required'],
        ];

    }
}