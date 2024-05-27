<?php

namespace App\Livewire\Forms;

use App\Interfaces\Imaginable;
use App\Models\Photo;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\Validate;
use Livewire\Form;
use Ramsey\Uuid\Uuid;

class SingleImage extends Form
{
    public $photo;

    #[Validate('image|max:2048')]
    public $uploadPhoto;

    public $oldPhoto;

    public function setImaginable(Imaginable $model)
    {
        $this->photo = $model->photo()->first();
        $this->oldPhoto = $this->photo;
    }

    public function updatedUploadPhoto()
    {
        $this->validateOnly('uploadPhoto');
        $this->photo = new Photo();
        $this->photo->url = $this->uploadPhoto->temporaryUrl();
    }

    public function deletePhoto()
    {
        unset($this->photo);
        unset($this->uploadPhoto);
    }

    public function save(Imaginable $model)
    {
        if(isset($this->uploadPhoto))
        {
            $model->photo()->delete();
            try {
                Storage::delete($this->oldPhoto->url);
            } catch (\Exception $ex) {
                Log::error($ex->getMessage());
            }

            $url = Storage::url($this->uploadPhoto->store('public/photos'));

            $model->photo()->create([
                'url' => $url,
            ]);
        }
        elseif(!isset($this->uploadPhoto) && !isset($this->photo))
        {
            $model->photo()->delete();
            try {
                Storage::delete($this->oldPhoto->url);
            } catch (\Exception $ex) {
                Log::error($ex->getMessage());
            }
        }
    }
}
