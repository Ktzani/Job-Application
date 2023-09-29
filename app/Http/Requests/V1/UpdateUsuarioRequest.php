<?php

namespace App\Http\Requests\V1;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;


class UpdateUsuarioRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {   
        $method = $this->method();
        if($method == 'PUT'){
            return [
                'nome' => ['required', 'string', 'max:255'],
                'email' => ['required', 'email','unique:usuarios,email'],
                'senha' => ['required', 'string', 'min:6'],
                'telefone' => ['required', 'string', 'min:10', 'max:12'],
            ];
        }

        else{
            return [
                'nome' => ['sometimes','required', 'string', 'max:255'],
                'email' => ['sometimes','required', 'email','unique:usuarios,email'],
                'senha' => ['sometimes','required', 'string', 'min:6'],
                'telefone' => ['sometimes','required', 'string', 'min:10', 'max:12'],
            ];
        }
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(
            response()->json($validator->errors(), 422)
        );
    }
}


