<?php

namespace app\controller;

use app\service\File as FileService;
use app\service\Res;

use Exception;

use support\Request;
use support\Response;

class File
{
    /**
     * @param Request $request
     * @return Response
     */
    public function store(Request $request): Response
    {
        $res = [];
        foreach ($request->file() as $key => $spl_file) {
            $fileService = new FileService();
            try {
                $fileService->setUploadFile($spl_file);
                $fileName = $fileService->write();
                $res[$key] = new Res(0, "store success", [
                    "filename" => $fileName
                ]);
            } catch (Exception $e) {
                $res[$key] = new Res(-1, $e->getMessage());
                continue;
            }
        }
        return json(new Res(0, "success", $res));
    }

    public function destroy(Request $request, string $fileName): Response
    {
        $fileService = new FileService();
        try {
            $r = $fileService->removeFile($fileName);
        } catch (Exception $e) {
            return json(new Res(-1,$e->getMessage()));
        }
        return json(new Res(0,"success"));
    }
}