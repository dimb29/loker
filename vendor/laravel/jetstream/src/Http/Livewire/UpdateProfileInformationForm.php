<?php

namespace Laravel\Jetstream\Http\Livewire;

use Illuminate\Support\Facades\Auth;
use Laravel\Fortify\Contracts\UpdatesUserProfileInformation;
use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Regency;
use App\Models\District;

class UpdateProfileInformationForm extends Component
{
    use WithFileUploads;

    /**
     * The component's state.
     *
     * @var array
     */
    public $state = [];

    /**
     * The new avatar for the user.
     *
     * @var mixed
     */
    public $photo, $cities, $provinces, $city_id, $city_name, $province_id, $province_name;

    /**
     * Prepare the component.
     *
     * @return void
     */
    public function mount()
    {
        if(Auth::guard('employer')->user() != null){
            $this->state = Auth::guard('employer')->user()->withoutRelations()->toArray();
        }else{
            $this->state = Auth::user()->withoutRelations()->toArray();
            if($this->state['kota']){
                $city_id = $this->city_id = $this->state['kota'];
                $getcity = Regency::find($city_id);
                $this->city_name = $getcity->name;
            }
            if($this->state['provinsi']){
                $province_id = $this->province_id = $this->state['provinsi'];
                $getprovince = Regency::find($province_id);
                $this->province_name = $getprovince->name;
            }
        }
    }

    /**
     * Update the user's profile information.
     *
     * @param  \Laravel\Fortify\Contracts\UpdatesUserProfileInformation  $updater
     * @return void
     */
    public function updateProfileInformation(UpdatesUserProfileInformation $updater)
    {
        $this->resetErrorBag();

        if(Auth::guard('employer')->user() != null){
            $updater->update(
                Auth::guard('employer')->user(),
                $this->photo
                    ? array_merge($this->state, ['photo' => $this->photo])
                    : $this->state
            );
        }else{
            $updater->update(
                Auth::user(),
                $this->photo
                    ? array_merge($this->state, ['photo' => $this->photo])
                    : $this->state
            );
        }

        if (isset($this->photo)) {
            if(Auth::guard('employer')->user() != null){
                return redirect()->route('employer.profil');
            }else{
                return redirect()->route('profile.show');
            }
        }

        $this->emit('saved');

        $this->emit('refresh-navigation-dropdown');
    }

    /**
     * Delete user's profile photo.
     *
     * @return void
     */
    public function deleteProfilePhoto()
    {
        if(Auth::guard('employer')->user() != null){
            Auth::guard('employer')->user()->deleteProfilePhoto();
        }else{
            Auth::user()->deleteProfilePhoto();
        }

        $this->emit('refresh-navigation-dropdown');
    }

    /**
     * Get the current user of the application.
     *
     * @return mixed
     */
    public function getUserProperty()
    {
        if(Auth::guard('employer')->user() != null){
            return Auth::guard('employer')->user();
        }else{
            return Auth::user();
        }
    }

    /**
     * Render the component.
     *
     * @return \Illuminate\View\View
     */
    public function render()
    {
        return view('profile.update-profile-information-form');
    }

    public function getCity(){
        // dd($this->state['kota']);
        if($this->province_id){
            $query = $this->city_name;
            $cities = Regency::where('name', 'LIKE', '%'. $query. '%')->whereRaw('LENGTH(id) = 4')->where('province_id', $this->province_id)->get();
            $this->cities = $cities;
        }else{
            session()->flash('message_kota', 'provinsi tidak boleh kosong');
        }
        // dd($cities);

    }

    public function setCity($id,$name){
        $this->city_id = $id;
        $this->state['kota'] = $id;
        $this->city_name = $name;
    }

    public function getProvince(){
        $query = $this->province_name;
        $provinces = Regency::where('name', 'LIKE', '%'. $query. '%')->whereRaw('LENGTH(id) = 2')->get();
        $this->provinces = $provinces;

    }

    public function setProvince($id,$name){
        $this->province_id = $id;
        $this->state['provinsi'] = $id;
        $this->province_name = $name;
    }
}
