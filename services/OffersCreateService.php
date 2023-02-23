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

    private function serviceDeleteFile($file){
        $filepath = Yii::getAlias('@webroot') . $file;
        if (file_exists($filepath)) {
            return unlink($filepath);
        }
        return false;
    }

    public function saveUploadFile($file)
    {
        return $this->serviceUploadFile($file);
    }

    public function deleteFile($file)
    {
        return $this->serviceDeleteFile($file);
    }

    public static function deletePublicationCategories($publicationId) :void
    {
        Yii::$app->db->createCommand()->delete('publications_categories', ['publication_id' => $publicationId])->query();
    }

    public function create($offerForm, $filePath)
    {
        $publication = new Publications();
        $publication->creation_time = date("Y-m-d H:i:s");
        $publication->title = $offerForm->title;
        $publication->description = $offerForm->description;
        $publication->creator_id = Yii::$app->user->id;
        $publication->price =  $offerForm->price;
        $publication->is_sell = $offerForm->is_sell;
        $publication->save();
        foreach ($offerForm->publication_categories as $category) {
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