<?php

namespace App\Http\Requests;

use Auth;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class AlbumRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        $album = $this->route()->album;

        if ($album) {
            return $album->user_id === Auth::id();
        }
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        $id = $this->route()->album;


        $ret = [
            'album_name' => ['required'],

            'description' => 'required',

            //'user_id'
        ];
        if ($id) {
            $ret['album_name'][] = Rule::unique('albums', 'album_name')->ignore($id);
        } else {
            $ret['album_thumb'] = 'required|image';
            $ret['album_name'][] = Rule::unique('albums');
        }

        return $ret;
    }

    public function messages(): array
    {
        return [
            'album_name.required' => 'Il campo album name  è obbligatorio',
            'album_name.unique' => 'Il campo album name  esiste già',
            'description.required' => 'Il campo Descrizione è obbligatorio',
            'name.required' => 'Il campo Nome è obbligatorio',
            'album_thumb.required' => 'Il campo Immagine è obbligatorio'

        ];
    }
}
