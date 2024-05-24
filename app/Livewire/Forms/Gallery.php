<?php

namespace App\Livewire\Forms;

use App\Models\Photo;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\Validate;
use Livewire\Form;
use Ramsey\Uuid\Uuid;

class Gallery extends Form
{
    public array $photos;

    public array $temporaryPhotos;

    public array $deletedPhotos;

    public $uploadPhoto;

    public function setImagable($model)
    {
        $this->photos = $model->photos()->orderBy('priority')->get()->toArray();
    }

    public function updatedUploadPhoto()
    {
        $this->temporaryPhotos[] = $this->uploadPhoto;

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
    }

    public function save($model)
    {
        foreach($this->deletedPhotos as $deletedPhoto)
        {
            if(!isset($deletedPhoto['isTemporary']))
            {
                Photo::destroy($deletedPhoto['id']);
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
                Photo::updateOrCreate([
                    'id' => $photo['id']
                ],
                [
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
