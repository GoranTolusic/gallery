<?php

namespace App\Services;

use App\Models\Picture;
use Ramsey\Uuid\Uuid;
use Intervention\Image\ImageManager;

class PictureService
{
    public function filter($request, $picture)
    {
        $query = $picture;
        if ($request->keyword) {
            $search = $request->keyword;
            $query = $query->where(function ($q) use ($search) {
                $q->where('title', 'LIKE', '%' . $search . '%')
                    ->orWhere('description', 'LIKE', '%' . $search . '%');
            });
        }
        $result = $query->orderBy('order', 'ASC')->paginate(9);
        $result = $this->appendPictureParams($result);
        return $result;
    }

    public function appendPictureParams($pictureCollection, $param_array = ['keyword', 'title'])
    {
        foreach ($param_array as $param) {
            if (isset($_GET[$param])) {
                $pictureCollection->appends([$param => $_GET[$param]]);
            }
        }
        return $pictureCollection;
    }

    public function getOne($id)
    {
        return Picture::find($id);
    }

    public function deletePictureFile($id)
    {
        $picture = Picture::where('id', $id)->first();
        $file_path = public_path('images/' . $picture->url_path);
        if (file_exists($file_path)) {
            unlink($file_path);
        }
        $thumbnail_path = public_path('thumbnails/' . $picture->url_path);
        if (file_exists($thumbnail_path)) {
            unlink($thumbnail_path);
        }
        return $picture;
    }

    public function storePictureFile($imagePicture)
    {
        $fileName = $imagePicture->getClientOriginalName();
        $file_path = public_path('images/' . $fileName);
        if (file_exists($file_path)) {
            $fileName = Uuid::uuid4() . $imagePicture->getClientOriginalName();
        }
        $imagePicture->move(public_path('images'), $fileName);
        return $fileName;
    }

    public function handleThumbnail($validated)
    {
        $manager = new ImageManager(
            new \Intervention\Image\Drivers\Gd\Driver()
        );
        $image = $manager->read('images/' . $validated['url_path']);
        $image->scale(400);
        $image->save('thumbnails/' . $validated['url_path']);
    }
}
