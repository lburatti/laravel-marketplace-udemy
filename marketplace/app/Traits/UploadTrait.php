<?php

namespace App\Traits;

trait UploadTrait
{
    private function imageUpload($images, $imageColumn = null)
    {
        $uploadedImages = [];

        // para products (photos)
        if (is_array($images)) {
            foreach ($images as $image) {
                // para cada imagem será criado um nome ('pasta onde será salvo', 'disk');
                $uploadedImages[] = [$imageColumn => $image->store('products', 'public')];
            }
        } else { // para store (logo)
            $uploadedImages = $images->store('logo', 'public');
        }

        return $uploadedImages;
    }
}
