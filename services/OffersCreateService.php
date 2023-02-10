<?php
namespace app\services;

use yii;
use app\models\Publications;
use app\models\PublicationsFiles;
use app\models\PublicationsCategories;

class OffersCreateService
{
    private $path = 'uploads/offers';

    private function serviceUploadFile($file)
    {
        $fileName = $file->name;
        $fileServerName = uniqid($file->baseName). '.' . $file->extension;

        if (!is_dir($this->path)) {
            mkdir($this->path,0777,true);
        }

        $file->saveAs($this->path . '/' . $fileServerName);

        $uploadFile = ['name' => $fileName, 'path' => '/' . $this->path . '/' .  $fileServerName];


        return $uploadFile;
    }

    public function saveUploadFile($file)
    {
        return $this->serviceUploadFile($file);
    }

    public function create($offerForm, $filePath)
    {
        $publication = new Publications();
        $publication->creation_time = date("Y-m-d H:i:s");
        $publication->title = $offerForm->title;
        $publication->description = $offerForm->description;
        $publication->creator_id = Yii::$app->user->id;
        $publication->price =  $offerForm->price;
        if($offerForm->is_sell === 'КУПЛЮ'){
            $offerForm->is_sell = 1;
        }
        else{
            $offerForm->is_sell = 0;
        }
        $publication->is_sell = $offerForm->is_sell;
        $publication->save();


        foreach ($offerForm->publication_categories as $category)
        {
            $publicationCategories = new PublicationsCategories();
            $publicationCategories->category_id = $category;
            $publicationCategories->publication_id = $publication->id;
            $publicationCategories->save();
        }

        $publicationFile = new PublicationsFiles();
        $publicationFile->creation_time = date("Y-m-d H:i:s");
        $publicationFile->publication_id = $publication->id;
        $publicationFile->name = $filePath['name'];
        $publicationFile->path = $filePath['path'];
        $publicationFile->save();

        return;
    }
}