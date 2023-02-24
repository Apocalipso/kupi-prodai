<?php
namespace app\services;

use yii;
use app\models\Publications;
use app\models\PublicationsFiles;
use app\models\PublicationsCategories;

class OffersCreateService
{
    private $path = 'uploads/offers';

    /** Метод сохраняет файл
     * @param object $file
     * @return array
     */
    private function serviceUploadFile($file): array
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

    /** Метод удаляет файл
     * @param string $file
     * @return bool
     */
    private function serviceDeleteFile($file): bool
    {
        $filepath = Yii::getAlias('@webroot') . $file;
        if (file_exists($filepath)) {
            return unlink($filepath);
        }
        return false;
    }

    /** Метод возвращает массив параметров сохранненого файла
     * @param object $file
     * @return array
     */
    public function saveUploadFile($file): array
    {
        return $this->serviceUploadFile($file);
    }

    /** Метод отправляет файл в приватный метод
     * @param string $file
     * @return bool
     */
    public function deleteFile($file): bool
    {
        return $this->serviceDeleteFile($file);
    }

    /** Метод удаляет категории публикации
     * @param int $publicationId
     */
    public static function deletePublicationCategories($publicationId) :void
    {
        Yii::$app->db->createCommand()->delete('publications_categories', ['publication_id' => $publicationId])->query();
    }

    /** Метод сохраняет публикацию и файл публикации
     * @param object $offerForm
     * @param array $filePath
     */
    public function create($offerForm, $filePath): bool
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