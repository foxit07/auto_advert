<?php
/**
 * Created by PhpStorm.
 * User: David Arakelyan
 * Email: rotokan2@gmail.com
 * Date: 30.11.2018
 * Time: 17:19
 */

namespace app\modules\advert\components;

use yii\web\UploadedFile;
use yii\helpers\FileHelper;
use yii\base\Behavior;
use Yii;
use yii\db\ActiveRecord;
use Imagine\Image\Box;
use Imagine\Image\Point;
use yii\imagine\Image;

class StorageBehavior extends Behavior
{

    public $fileName;
    public $path;
    public $height = 540;
    public $width = 720;
    public $fileImages = 'images';
    /**
     * Save given UploadedFile instance to disk
     * @param UploadedFile $file
     * @return string|null
     */
    public function saveUploadedFile($event)
    {
        $files = UploadedFile::getInstances($this->owner, $this->fileImages);
        if (empty($files)){
            return;
        }else{
          $this->deleteFile($event);
        }

        foreach ($files as $file ){
        $image = new Image();

            $path = $this->preparePath($file);
            if ($path && $file->saveAs($path) && $image->resize($path, $this->width, $this->height)
                    ->save($path)) {
                $this->path[] = $this->fileName;
            }

        }
    }
    /**
     * Prepare path to save uploaded file
     * @param UploadedFile $file
     * @return string|null
     */
    protected function preparePath(UploadedFile $file)
    {
        $this->fileName = $this->getFileName($file);
        //     0c/a9/277f91e40054767f69afeb0426711ca0fddd.jpg
        $path = $this->getStoragePath() . $this->fileName;
        //     /var/www/project/frontend/web/uploads/0c/a9/277f91e40054767f69afeb0426711ca0fddd.jpg
        $path = FileHelper::normalizePath($path);
        if (FileHelper::createDirectory(dirname($path))) {
            return $path;
        }
    }
    /**
     * @param UploadedFile $file
     * @return string
     */
    protected function getFilename(UploadedFile $file)
    {
        // $file->tempname   -   /tmp/qio93kf
        if (!$file->tempName){
            $file->tempName = '/tmp/' . uniqid();
        }
        $hash = sha1_file($file->tempName); // 0ca9277f91e40054767f69afeb0426711ca0fddd
        $name = substr_replace($hash, '/', 2, 0);
        $name = substr_replace($name, '/', 5, 0);  // 0c/a9/277f91e40054767f69afeb0426711ca0fddd
        return $name . '.' . $file->extension;  // 0c/a9/277f91e40054767f69afeb0426711ca0fddd.jpg
    }
    /**
     * @return string
     */
    protected function getStoragePath()
    {
        return Yii::getAlias(Yii::$app->params['storagePath']);
    }
    /**
     *
     * @param string $filename
     * @return string
     */
    public function getFile(string $filename)
    {
        return Yii::$app->params['storageUri'].$filename;
    }
    /**
     * @param string $filename
     * @return boolean
     */
    public function deleteFile($event)
    {
        foreach ($this->owner->getImages() as $image){
        $filename = $image->path;
        $dirnames = explode('/', $filename, 3);
        array_pop($dirnames );
        $file = $this->getStoragePath().$filename;
        if (file_exists($file)) {
            // Если файл существует, удаляем
            unlink($file);
            rmdir( $this->getStoragePath().$dirnames[0].'/'.$dirnames[1]);
            rmdir( $this->getStoragePath().$dirnames[0]);
        }
        }
        // Файла нет - хорошо. И удалять не нужно
        return true;
    }

    public function events()
    {
        return [
            ActiveRecord::EVENT_BEFORE_VALIDATE => 'saveUploadedFile',
            ActiveRecord::EVENT_BEFORE_DELETE => 'deleteFile'
        ];
    }
}