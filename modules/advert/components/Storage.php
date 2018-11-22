<?php

namespace app\modules\advert\components;

use Yii;
use yii\base\Component;
use yii\web\UploadedFile;
use yii\helpers\FileHelper;


class Storage extends Component implements StorageInterface
{

    private $fileName;

    /**
     * Save given UploadedFile instance to disk
     * @param UploadedFile $file
     * @return string|null
     */
    public function saveUploadedFile(UploadedFile $file)
    {
        $path = $this->preparePath($file);

        if ($path && $file->saveAs($path)) {
            return $this->fileName;
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
    public function deleteFile(string $filename)
    {
        $dirnames = explode('/', $filename, 3);
        array_pop($dirnames );

        $file = $this->getStoragePath().$filename;

        if (file_exists($file)) {
            // Если файл существует, удаляем
            unlink($file);
            rmdir( $this->getStoragePath().$dirnames[0].'/'.$dirnames[1]);
            rmdir( $this->getStoragePath().$dirnames[0]);
        }

        // Файла нет - хорошо. И удалять не нужно
        return true;
    }

}