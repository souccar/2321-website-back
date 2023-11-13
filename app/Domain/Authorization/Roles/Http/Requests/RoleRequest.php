<?php

namespace App\Domain\Authorization\Roles\Http\Requests;

use App\Helpers\AhcResponse;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\ValidationException;

class RoleRequest extends FormRequest
{
     /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    protected function failedValidation(Validator $validator)
    {
        if ($this->is('api/*')) {
            $response = AhcResponse::sendResponse([], false, $validator->messages()->all());
            throw new ValidationException($validator, $response);
        }
    }


    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|min:2',
            'displayName' => ['required', 'string','min:2']
        ];
    }
}
