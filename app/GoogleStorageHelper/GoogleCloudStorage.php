<?php

namespace App\GoogleStorageHelper;

use Google\Cloud\Storage\StorageClient;
use Illuminate\Http\UploadedFile;

class GoogleCloudStorage 
{
    public static function uploadFile(UploadedFile $file, string $bucketFolder): string
    {
        $googleConfigJson = env('GOOGLE_CLOUD_CONFIG');

        $storage = new StorageClient([
            'keyFile' => json_decode(file_get_contents($googleConfigJson), true)
        ]);
       /*  $storage = new StorageClient([
            'keyFile' => json_decode($googleConfigJson, true)
        ]); */
        $storageBucketName = config('googlecloud.storage_bucket');
        $bucket = $storage->bucket($storageBucketName);

        $filePath = $file->getRealPath();
        $path = uniqid() . '-' . time() . '.' . $file->extension();
        $fileSource = fopen($filePath, 'r');
        $googleCloudStoragePath = $bucketFolder . "/" . $path;
        $bucket->upload($fileSource, [
            'name' => $googleCloudStoragePath
        ]);

        return $googleCloudStoragePath;
    }


    public static function deleteFile(string $filePath): bool
    {
        $googleConfigJson = env('GOOGLE_CLOUD_CONFIG');

        $storage = new StorageClient([
            'keyFile' => json_decode(file_get_contents($googleConfigJson), true)
        ]);
        
        $storageBucketName = config('googlecloud.storage_bucket');
        $bucket = $storage->bucket($storageBucketName);

        $object = $bucket->object($filePath);
        $object->delete();

        return true;
    }
}
