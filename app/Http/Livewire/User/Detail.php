<?php

namespace App\Http\Livewire\User;

use App\Http\Livewire\Traits\HasToast;
use App\Models\User;
use Illuminate\Support\Facades\Log;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;

class Detail extends Component
{
    use WithFileUploads, HasToast;

    public User $user;

    public string $name;

    public string $email;

    public $photo;

    protected function rules(): array
    {
        $user = $this->user;

        return [
            'name' => 'required|string|max:20|unique:users,name,'.$user->id,
            'email' => 'required|string|email|max:150|unique:users,email,'.$user->id,
        ];
    }

    protected array $messages = [
        'name.required' => 'Le nom est requis.',
        'name.max' => 'Le nom doit comprendre moins de 20 caractères.',
        'name.unique' => 'Ce nom est déjà utilisé.',
        'email.email' => 'Ceci n\'est pas un email.',
        'email.required' => 'L\'e-mail est requis.',
        'email.max' => 'L\'e-mail est trop long.',
        'email.unique' => 'Cet e-mail est déjà utilisé.',
    ];

    public function mount(User $user){
        $this->user = $user;
        $this->name =  $this->user->name;
        $this->email = $this->user->email;
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function saveContact()
    {
        try {
            $validatedData = $this->validate();
            $this->user->update($validatedData);

            $this->successToast(__('Your profile has been modified'));
        } catch (\Throwable $e) {
            report($e);
            $this->errorToast(__('An error occurred while updating your profile'));
        }
    }

    public function savePicture()
    {
        $this->validate([
            'photo' => 'image|max:1024', // 1MB Max
        ]);

        try {
            Storage::disk('img_profil')->put('/', $this->photo);
            $namePhoto = $this->photo->store('public/photos');

            $this->user->photo = str_replace("public/photos/","", $namePhoto);
            $this->user->save();

            $this->photo = null;
            $this->successToast(__('Your avatar has been modified'));
        } catch (\Throwable $e) {
            report($e);
            $this->errorToast(__('An error occurred while updating your avatar'));
        }

    }

    public function render()
    {
        return view('livewire.user.detail');
    }
}
