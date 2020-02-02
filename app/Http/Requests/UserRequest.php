<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
        switch($this->method())
        {
            case 'GET':
                break;
            case 'DELETE':
                break;
            case 'POST':
            {
                return [
                    'name' => 'required',
                    'email' => 'required|email'
                ];
                break;
            }
            case 'PUT':
                return [
                ];
                break;
            case 'PATCH':
                break;
            default:
            break;
        }
    }

    public function messages(){
        return [
        'name.required' => 'Escolha um nome para categoria',
        'email.required' => 'Coloque um e-mail válido',
        'id.required' => 'O campo id é obrigatorio.',
        'id.numeric' => 'O campo id deve ser numerico',
        'id.exists' => 'O campo id informado não existe',
        ];
    }
}
