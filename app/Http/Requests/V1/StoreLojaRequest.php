<?php

namespace App\Http\Requests\V1;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;

class StoreLojaRequest extends FormRequest
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
        return [
            'nome' => ['required','string','max:255'],
            'url' => ['required','string','url'],
            'logoUrl' => ['required','string','url'],
            'endereco' => ['required','string','max:255'],
            'numero' => ['required','integer', 'min:0'],
            'bairro' => ['required','string','max:255'],
            'cidade' => ['required','string','max:255'],
            'uf' => ['required','string','max:255'],
            'cep' => ['required','integer','digits:8'],
            'usuarioId' => ['required','exists:usuarios,id'],
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(
            response()->json($validator->errors(), 422)
        );
    }

    protected function prepareForValidation(){
        $this->merge([
            'logo_url' => $this->logoUrl,
            'usuario_id' => $this->usuarioId
        ]);
    }
}
