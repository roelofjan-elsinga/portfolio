<?php

namespace Main\Http\Requests;

use GuzzleHttp\Client;
use Illuminate\Foundation\Http\FormRequest;

class ContactRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return $this->isHuman() || app()->environment('testing');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required',
            'email' => 'required',
            'message' => 'required'
        ];
    }

    private function isHuman(): bool
    {
        if (!$this->has('h-captcha-response')) {
            return false;
        }

        $client = new Client();

        $response = $client->post('https://hcaptcha.com/siteverify', [
            'form_params' => [
                'secret' => config('services.hcaptcha.secret'),
                'response' => $this->get('h-captcha-response')
            ]
        ]);

        $response_data = json_decode($response->getBody()->getContents());

        return $response_data->success;
    }
}
