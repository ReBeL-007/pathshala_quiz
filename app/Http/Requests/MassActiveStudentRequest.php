<?php

namespace App\Http\Requests;

use App\Admin;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassActiveStudentRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('student-edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;

    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:users,id',
        ];

    }
}