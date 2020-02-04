<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SettingRequest extends FormRequest
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
                    'site_name' => 'required',
                    'contact_number' => 'required',
                    'contact_email' => 'required',
                    'address' => 'required',
                    'logo' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                ];
                break;
            }
            case 'PUT':
                return [
                    'site_name' => 'required',
                    'contact_number' => 'required',
                    'contact_email' => 'required',
                    'address' => 'required',
                    'logo' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
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

        ];
    }
}
