<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator as ValidationValidator;
use Illuminate\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rule;

class UserRequest extends FormRequest
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
        $userId = $this->route('user');
        return [
            'nome' => 'sometimes|required|string|max:255',
            'email' => [
                'sometimes',
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique('users')->ignore($userId),
            ],            
            'cpf' => [
                'nullable',
                'integer',
                Rule::unique('users')->ignore($userId),
            ],
            'cadastro' => [
                'nullable', 
                'integer',
                Rule::unique('users')->ignore($userId),
            ],
            'password' => 'sometimes|required|integer|min:4|confirmed',
            
        ];
    }

    public function messages(): array
    {
        return [
            'nome.required' => 'O campo nome é obrigatório',
            'email.required' => 'O campo email é obrigatório',
            'email.unique' => 'Esse email já foi cadastrado',
            'cpf.required' => 'O campo cpf é obrigatório',
            'cpf.unique' => 'Esse cpf já foi cadastrado',
            'cadastro.required' => 'O campo cadastro é obrigatório',
            'cadastro.unique' => 'Esse cadastro já foi cadastrado',
            'password.min' => 'A senha mínima é de 4 digitos',
            'password.required' => 'O campo senha é obrigatório',
            'password.confirmed' => 'As senhas não correspondem',
        ];
    }

    protected function failedValidation(ValidationValidator $validator)
    {
        throw new HttpResponseException(response()->json([
            'STATUS' => 'Erro de validação',
            'Erros' => $validator->errors()
        ], 422));
    }
}
