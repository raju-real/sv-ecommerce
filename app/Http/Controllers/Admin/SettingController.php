<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function siteSettings()
    {
        return view('admin.settings.site_settings');
    }

    public function updateSiteSettings(Request $request)
    {
        $this->validate($request,[
            'company_name' => 'required|string|max:100',
            'company_email' => 'nullable|sometimes|email|max:20',
            'company_mobile' => 'nullable|sometimes|string|max:15',
            'company_phone' => 'nullable|sometimes|string|max:20',
            'logo' => 'nullable|sometimes|mimes:jpg,jpeg,png|max:1024',
            'address' => 'nullable|sometimes|string|max:500',
            'slogan' => 'nullable|sometimes|string|max:255',
            'footer_text' => 'nullable|sometimes|string|max:1000',
            'website_url' => 'nullable|sometimes|url|max:255',
            'facebook_url' => 'nullable|sometimes|url|max:255',
            'linkedin_url' => 'nullable|sometimes|url|max:255',
            'youtube_url' => 'nullable|sometimes|url|max:255',
            'google_map_url' => 'nullable|sometimes|url|max:1000',
            'support_policy' => 'nullable|sometimes|string|max:5000',
            'return_policy' => 'nullable|sometimes|string|max:5000',
            'about_us' => 'nullable|sometimes|string|max:5000',
            'mission_and_vision' => 'nullable|sometimes|string|max:5000',
        ]);

        $setting_data['company_name'] = $request->company_name ?? '';
        $setting_data['company_email'] = $request->company_email ?? '';
        $setting_data['company_mobile'] = $request->company_mobile ?? '';
        $setting_data['company_phone'] = $request->company_phone ?? '';
        if ($request->file('logo')) {
            $setting_data['logo'] = uploadImage($request->file('logo'), 'settings');
        } elseif(isset(siteSettings()['logo'])) {
            $setting_data['logo'] = siteSettings()['logo'];
        }
        $setting_data['address'] = $request->address ?? '';
        $setting_data['slogan'] = $request->slogan ?? '';
        $setting_data['footer_text'] = $request->footer_text ?? '';
        $setting_data['website_url'] = $request->website_url ?? '';
        $setting_data['facebook_url'] = $request->facebook_url ?? '';
        $setting_data['linkedin_url'] = $request->linkedin_url ?? '';
        $setting_data['youtube_url'] = $request->youtube_url ?? '';
        $setting_data['google_map_url'] = $request->google_map_url ?? '';
        $setting_data['support_policy'] = $request->support_policy ?? '';
        $setting_data['return_policy'] = $request->return_policy ?? '';
        $setting_data['about_us'] = $request->about_us ?? '';
        $setting_data['mission_and_vision'] = $request->mission_and_vision ?? '';

        $newJsonString = json_encode($setting_data, JSON_PRETTY_PRINT);
        file_put_contents(base_path('assets/common/json/site_setting.json'), $newJsonString);
        return redirect()->route('admin.site-settings')->with(infoMessage());
    }
}
