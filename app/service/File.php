<?php

namespace app\service;

use Exception;
use webman\Http\UploadFile;

class File
{
    private UploadFile $uploadFile;

    /**
     * @return string
     */
    private function createRandFileName(): string
    {
        $nowDate = date("Ymd");
        $microTime = md5(intval(microtime(true) * 1000));
        return "$nowDate-$microTime" . mt_rand(0, 9999);
    }

    /**
     * @param string $fileName
     * @return string
     * @throws Exception
     */
    private function getFolder(string $fileName): string
    {
        $r = explode("-", $fileName);
        if (count($r) < 1) {
            throw new Exception("getFolder：传入的文件名有误", 0);
        }
        return $r[0];
    }

    /**
     * @param string $fileName
     * @return string
     * @throws Exception
     */
    private function getFolderPath(string $fileName): string
    {
        return public_path() . "/files/" . $this->getFolder($fileName);
    }

    /**
     * 将文件写入磁盘
     * @return string
     * @throws Exception
     */
    public function write(): string
    {
        if (!isset($this->uploadFile)) {
            throw new Exception("未设置uploadFile", 0);
        }
        $fileName = $this->createRandFileName() . "." . $this->uploadFile->getUploadExtension();
        $folderPath = $this->getFolderPath($fileName);
        $this->uploadFile->move($folderPath . "/" . $fileName);
        return $fileName;
    }

    /**
     * @param UploadFile $uploadFile
     */
    public function setUploadFile(UploadFile $uploadFile): void
    {
        $this->uploadFile = $uploadFile;
    }

    /**
     * @param string $fileName
     * @return bool
     * @throws Exception
     */
    public function removeFile(string $fileName): bool
    {
        $folderPath = $this->getFolderPath($fileName);
        $filePath = $folderPath . "/" . $fileName;
        if (file_exists($filePath)) {
            return unlink($filePath);
        }
        return true;
    }
}