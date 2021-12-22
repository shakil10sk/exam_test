<?php

namespace App\Http\Controllers;

use App\Models\BdLocation;
use Illuminate\Http\Request;
use App\Models\Profile;
use App\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{

    function __construct()
    {
        $this->middleware('auth');
    }

    public function list()
    {
        $users = User::select('users.*','dis.bn_name as district_bn', 'upa.bn_name as upazila_bn')

            ->join('bd_locations as dis','dis.id','users.district')
            ->leftJoin('bd_locations as upa','upa.id','users.upazila');

        if(auth()->user()->type == 1 )
        {
            $users
            ->where('users.id','!=',auth()->user()->id)
            ->whereNull('users.deleted_at');
            
        }else
        {
            $users->where('users.district',auth()->user()->district)
            ->where('users.id', '!=', auth()->user()->id)
            ->whereNull('users.deleted_at');
        }
        
        // dd($users->get());
        $data['users'] = $users->get();
        return view('user.list', $data);
    }

    
    public function profile()
    {
        return view('user.profile');
    }

    public function getProfile(int $id)
    {
        $data['upazila'] = json_encode(BdLocation::where('type', 3)->get());
        $data['user'] = User::find($id);

        return view('user.edit_profile',$data);
    }

    public function updateProfile(Request $r, int $id)
    {
        $r->validate([
            'name'      => ['required', 'string', 'max:255'],
            'username'  => ['required', 'string', 'max:255'],
            'email'     => ['email', 'max:255', 'nullable'],
            'district'  => ['required'],
            'type'      => ['required'],
            'password'  => ['string','nullable'],
            'photo'     => ['image', 'mimes:jpeg,png,jpg,svg', 'max:2048'],
        ]);

        if($r->username != User::find($id)->username)
        {
            $r->validate([
                'username'  => ['string', 'max:255','unique:users'],
            ]);
        }

        $user_data =  $r->all('name', 'username', 'type', 'district', 'upazila');

        if ($r->password) {
            $user_data['password'] = Hash::make($r->password);
        }

        User::whereId($id)->update($user_data);
        
        $profile_data = $r->all('name', 'mobile', 'email', 'bcs_batch');
        
        if ($r->hasFile('photo')) {

            $profile_data['photo'] = $r->user()->type . time() . '.' . $r->photo->extension();
            $r->file('photo')->storeAs(
                'public/images/profile',
                $profile_data['photo']
            );
        }

        Profile::where('user_id',$id)->update($profile_data);

        return redirect()->route('user.list')->withSuccess('Profile Updated.');
    }

    public function changeUserStatus(int $id, int $status)
    {
        // dd($id,$status);
        User::whereId($id)->update([ 'is_active'=>$status]);
        return redirect()->route('user.list')->withSuccess('Status Changed.');
    }

    public function deleteUser(int $id)
    {
        // dd($id);
        User::whereId($id)->update(['deleted_at' => date('Y-m-d 00:00:00')]);
        return redirect()->route('user.list')->withSuccess('User Deleted.');
    }
    
    public function profileEdit(Request $r)
    {
        // dd($r->all());

        $r->validate([
            'name' => ['string'],
            'email' => ['email','nullable']
        ]);

        $update_data = $r->all('name', 'email', 'mobile', 'bcs_batch');

        if ($r->hasFile('photo')) {

            $update_data['photo'] = $r->user()->type . time() . '.' . $r->photo->extension();
            $r->file('photo')->storeAs(
                'public/images/profile',
                $update_data['photo']
            );

        }

        // dd($update_data);
        Profile::where('user_id',auth()->user()->id)->update($update_data);
        return redirect()->route('profile')->withSuccess('Profile Updated.');

    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, int $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $id)
    {
        //
    }
}
