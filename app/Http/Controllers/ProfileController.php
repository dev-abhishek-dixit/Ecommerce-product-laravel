<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use App\Models\ArProduct;
use Illuminate\Contracts\Validation\Rule;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }

    public function upload(Request $request):Response
    {
        $validator  =   Validator::make($request->all(), [
            'modal' => 'required',
            'audio' => 'required|mimes:mp3,wav|max:10240',
            'name' => 'required|unique:ar_products,product_name',
        ]);

        if ($validator->fails()) return response()->json(['msg' =>$validator->errors()->first(),'status'=>false]);
        try {
            $imageName = '';
            $audioName = '';
            $data =[
                'product_name'=>$request->name
            ];

            if ($request->hasFile('modal')) {
                $file = $request->file('modal');
                $imageName = time() . "_modal." . $file->getClientOriginalExtension();
                $up_modal = Storage::disk('s3')->put('modal/' . $imageName, file_get_contents($file));
                if($up_modal) $data['modal_name']= $imageName; 
                // $url = Storage::disk('s3')->url('images/' . $imageName);
                // if($up_final) return response()->json(['url' => $url]);
                // else return response()->json(['msg' => "unable to upload"]);
            }

            if ($request->hasFile('audio')) {
                $audio = $request->file('audio');
                $audioName = time() . "_audio." . $audio->getClientOriginalExtension();
                $up_audio = Storage::disk('s3')->put('audio/' . $audioName, file_get_contents($audio));
                if($up_audio) $data['audio_name']= $audioName; 
            }
           $store_ar= ArProduct::create($data);
           if($store_ar){
              return response()->json(['msg' => "file uploded successfully",'status'=>true,'exp_url'=>route('ar.details', ['name' => $store_ar->product_name])]);
           }else{
            return response()->json(['msg' => "unable to upload file",'status'=>false]);
           }

        } catch (\Exception $e) {
            return response()->json(['msg' => 'upload failed: ' . $e->getMessage()]);
        }
        
    }

    public function details($name):Response
    {

        try {

                $data = ArProduct::where('product_name', 'like', '%' . $name . '%')->first();
                if(!empty($data)){
                    $audio_url = Storage::disk('s3')->url('audio/' . $data->audio_name);
                    $modal_url = Storage::disk('s3')->url('modal/' . $data->modal_name);
                    return response()->json(['audio_url' =>$audio_url,'modal_url' =>$modal_url,'status'=>true]);
                }else{
                    return response()->json(['msg' => 'no data fond','status'=>false]);
                }


        } catch (\Exception $e) {
            return response()->json(['msg' => $e->getMessage(),'status'=>false]);
        }
        
    }
}
