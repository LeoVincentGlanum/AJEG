<?php

namespace App\Http\Livewire\MyAccount;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Validation\Rules;
class Edit extends Component
{
    use WithFileUploads;

    public $name;
    public $email;
    public $photo;
    public $oldPassword;
    public $password;
    public $confirmPassword;
    public Model $user;

    public function mount($id){
        $this->id = $id;
        $this->user = User::query()->where('id',$id)->first();

        $this->name =  $this->user->name;
        $this->email = $this->user->email;
    }

    protected function rules()
    {
        $user = $this->user;

        return [
            'name' => 'required|string|max:20|unique:users,name,'.$user->id,
            'email' => 'required|string|email|max:150|unique:users,email,'.$user->id,
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ];
    }
    protected $messages = [
        'name.required' => 'Le nom est requis.',
        'name.max' => 'Le nom doit comprendre moins de 20 caractères.',
        'name.unique' => 'Ce nom est déjà utilisé.',
        'email.email' => 'Ceci n\'est pas un email.',
        'email.required' => 'L\'e-mail est requis.',
        'email.max' => 'L\'e-mail est trop long.',
        'email.unique' => 'Cet e-mail est déjà utilisé.',
    ];

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function saveContact()
    {
        try {
            $validatedData = $this->validate();
            $this->user->update($validatedData);

            $this->dispatchBrowserEvent('toast', ['message' => 'Votre profil a bien été modifié', 'type' => 'success']);
        } catch (\Exception $e) {
            $this->dispatchBrowserEvent('toast', ['message' => $e->getMessage(), 'type' => 'error']);
        }
    }
    public function updatePassword()
    {
        if(!Hash::check($this->oldPassword, $this->user->getAuthPassword()))
        {
            $this->dispatchBrowserEvent('toast', ['message' => "old password incorrect", 'type' => 'error']);
         return;
        }
        if($this->password !== $this->confirmPassword)
        {
            $this->dispatchBrowserEvent('toast', ['message' => "password confirmation different du new password", 'type' => 'error']);
            return;
        }
            $this->user->forceFill([
                'password' => Hash::make($this->password),
                'remember_token' => Str::random(60),
            ])->save();
            $this->oldPassword = "";
            $this->password = "";
            $this->confirmPassword = "";
            $this->dispatchBrowserEvent('toast', ['message' => 'Votre password a bien été modifié', 'type' => 'success']);
    }
    public function savePicture()
    {
        $this->validate([
            'photo' => 'image|max:1024', // 1MB Max
        ]);

        try {
            $namePhoto = $this->photo->store('public/photos');

            $this->user->photo = str_replace("public/photos/","", $namePhoto);
            $this->user->save();

            $this->dispatchBrowserEvent('toast', ['message' => 'Votre avatar a bien été modifié', 'type' => 'success']);

            $this->photo = null;
        } catch (\Exception $e) {
            $this->dispatchBrowserEvent('toast', ['message' => $e->getMessage(), 'type' => 'error']);
        }

    }

    public function render()
    {
        return view('livewire.my-account.edit');
    }
}
