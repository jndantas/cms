<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostRequest extends FormRequest
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
                    'title' => 'required|unique:posts',
                    'description' => 'required',
                    'image' => 'required|image',
                    'content' => 'required',
                    'category' => 'required'
                ];
                break;
            }
            case 'PUT':
                return [
                    'title' => 'required',
                    'description' => 'required',
                    'content' => 'required',
                    'category' => 'required'
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
        'id.required' => 'O campo id é obrigatorio.',
        'id.numeric' => 'O campo id deve ser numerico',
        'id.exists' => 'O campo id informado não existe',
        ];
    }
}
