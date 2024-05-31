<?php

namespace App\Livewire\Forms;

use App\Interfaces\Imaginable;
use App\Models\Photo;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\Validate;
use Livewire\Form;
use Ramsey\Uuid\Uuid;

class Gallery extends Form
{
    public array $photos;

    public array $deletedPhotos;

    #[Validate('image|max:10000')]
    public $uploadPhoto;

    public function setImagable(Imaginable $model)
    {
        $this->photos = $model->orderPhotos()->get()->toArray();
    }

    public function updatedUploadPhoto()
    {
        $this->validateOnly('uploadPhoto');
        $this->photos[] = [
            'id' => Uuid::uuid4()->toString(),
            'url' => $this->uploadPhoto->temporaryUrl(),
            'isTemporary' => true,
            'temporaryPhoto' => $this->uploadPhoto
        ];
    }

    public function deletePhoto($id)
    {
        $deletePhoto = collect($this->photos)->first(function ($item) use ($id) {
            return $item['id'] == $id;
        });
        $this->deletedPhotos[] = $deletePhoto;
        $index = array_search($deletePhoto, $this->photos);
        unset($this->photos[$index]);
        $this->photos = array_values($this->photos);
    }

    public function save(Imaginable $model)
    {
        foreach($this->deletedPhotos as $deletedPhoto)
        {
            if(!isset($deletedPhoto['isTemporary']))
            {
                try {
                    Photo::destroy($deletedPhoto['id']);
                    Storage::delete($deletedPhoto['url']);
                } catch (\Exception $ex) {
                    Log::error($ex->getMessage());
                }
            }
        }

        for ($i = 0; $i < count($this->photos); $i++)
        {
            $priority = $i + 1;
            $photo = $this->photos[$i];
            $photo['priority'] = $priority;

            if(isset($this->photos[$i]['isTemporary']))
            {
                $url = Storage::url($photo['temporaryPhoto']->store('public/photos'));

                $model->photo()->create([
                    'url' => $url,
                    'priority' => $priority,
                ]);
            }
            else {
                Photo::where('id', $photo['id'])->update([
                    'priority' => $priority,
                ]);
            }
        }

//        dd($this->photos);
//        foreach($this->temporaryPhotos as $temporaryPhoto)
//        {
//            dd($temporaryPhoto);
//            $url = Storage::url($temporaryPhoto->store('public/photos'));
//
//            $model->photo()->create([
//                'url' => $url
//            ]);
//        }
    }
}
