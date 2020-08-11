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

        $rules = [
            'phone' => 'required',
            'email' => 'required',
            'address_ar'=> 'required',
            'address_tr'=> 'required',
            'address_en'=> 'required',
            'footer_ar' => 'required',
            'footer_en' => 'required',
            'footer_tr' => 'required',
            'facebook' => 'required',
            'twitter' => 'required',
            'youtube' => 'required',
            'instagram' => 'required',
            'main_video' => 'required',
            'about_us_video' => 'required',
            'our_object_ar' => 'required',
            'our_mission_ar' => 'required',
            'our_active_ar' => 'required',
           // 'who_are_we_ar' => 'required',
            'our_vision_tilte_ar' => 'required',
            'our_vision_quotes_ar' => 'required',
            'our_vision_content_ar' => 'required',
            'our_object_en' => 'required',
            'our_mission_en' => 'required',
            'our_active_en' => 'required',
           // 'who_are_we_en' => 'required',
            'our_vision_tilte_en' => 'required',
            'our_vision_quotes_en' => 'required',
            'our_vision_content_en' => 'required',
            'our_object_tr' => 'required',
            'our_mission_tr' => 'required',
            'our_active_tr' => 'required',
          //  'who_are_we_tr' => 'required',
            'our_vision_tilte_tr' => 'required',
            'our_vision_quotes_tr' => 'required',
            'our_vision_content_tr' => 'required',
        ];
        if (request()->about_us_img)
            $rules['about_us_img'] = 'required|mimes:jpeg,png,jpg,gif,svg|max:6448';
        if (request()->about_us_img2)
            $rules['about_us_img2'] = 'required|mimes:jpeg,png,jpg,gif,svg|max:6448';
        if (request()->media_img)
            $rules['media_img'] = 'required|mimes:jpeg,png,jpg,gif,svg|max:6448';
        if (request()->our_vision_img)
            $rules['our_vision_img'] = 'required|mimes:jpeg,png,jpg,gif,svg|max:6448';
        if (request()->icon_img)
            $rules['icon_img'] = 'required|mimes:jpeg,png,jpg,gif,svg|max:6448';

        if (request()->page_img)
            $rules['page_img'] = 'required|mimes:jpeg,png,jpg,gif,svg|max:6448';
        if (request()->main_img)
            $rules['main_img'] = 'required|mimes:jpeg,png,jpg,gif,svg|max:6448';
        if (request()->donate_img)
            $rules['donate_img'] = 'required|mimes:jpeg,png,jpg,gif,svg|max:6448';
        /* $file = Input::file('video');
        $mime = $file->getMimeType();

        if ($mime == "video/x-flv" || $mime == "video/mp4" || $mime == "application/x-mpegURL" || $mime == "video/MP2T" || $mime == "video/3gpp" || $mime == "video/quicktime" || $mime == "video/x-msvideo" || $mime == "video/x-ms-wmv") {
            // process upload
        }*/

        return $rules;


    }
}
