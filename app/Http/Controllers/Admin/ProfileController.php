<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Profile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\Intl\Countries;
use Symfony\Component\Intl\Languages;

class ProfileController extends Controller
{
    //

public function edit()
{
    // echo phpinfo();
    // exit;
    $user=Auth::user();
    $countries=Countries::getNames();
    $locales=Languages::getNames();
    return view('admin.profile.edit',compact(['user','countries','locales']));
}


public function update(Request $request)
{
    $request->validate([
        'first_name' => ['required','string','max:255'],
        'last_name' => ['required','string','max:255'],
        'birthday' => ['nullable','date','before:today'],
        'gender' => ['in:male,female'],
        'country' => ['required','string','size:2'],
    ]);
    // dd($request->all());
    $user=$request->user();
    $user->profile->fill($request->all())->save();// fill dosnt save in db
    // $user->profile->updateOrCreate($request->all());
    return redirect()->route('admin.profile.edit')->with('success', 'Profile updated!');
    // $profile=$user->profile;
    // if($profile->first_name){
    //     $profile->update($request->all());
    // }else{
    //     // $request->merge(['userid'=>$user->id]);
    //     // Profile::create($request->all());
    //      $user->profile()->create($request->all());
    // }

}


}
