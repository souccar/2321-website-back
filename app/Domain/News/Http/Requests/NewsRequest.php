<?php

namespace App\Domain\News\Http\Requests;

use App\Helpers\AhcResponse;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\ValidationException;

class NewsRequest extends FormRequest
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
            'title' => 'required|string|min:2',
            'description' => ['required', 'string','min:2'],
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg',
            'displayInHome' => 'required|boolean'
        ];
    }
}
