<?php
declare (strict_types=1);

namespace app\traits;

use app\service\ImageHashService;
use think\facade\SnowFlake;
use think\annotation\Route;

/**
 * 文件上传公共方法
 * Trait UploadTrait
 * @package app\traits
 */
trait UploadTrait
{

    /**
     * 上传图片
     * @Route("upimg", method="POST")
     */
    public function upimg()
    {
        $file = request()->file('img');
        if (empty($file)) {
            return json_error(10010);
        }
        try {
            validate(['img' => 'fileSize:10485670|fileExt:jpg,gif,jpeg,png|fileMime:image/jpeg,image/gif,image/png'])->check(request()->file());
            //hash查重
            $hash = $file->hash('sha1');
            $img  = ImageHashService::getInfoByName($hash);
            if ($img) {
                return json_ok(['path' => $img['image']]);
            }

            //上传文件
            $savename = \think\facade\Filesystem::putFile('images', $file);
            $path     = config('filesystem.disks.aliyun.url') . DIRECTORY_SEPARATOR . $savename;
            //保存数据库
            $res = ImageHashService::save([
                'hash'  => $hash,
                'image' => $path,
                'id'    => SnowFlake::generate(),
            ]);
            if (!$res) {
                return json_error(10012);
            }
            return json_ok(['path' => $path]);
        } catch (\think\exception\ValidateException $e) {
            return json_error($e->getMessage());
        }
    }

    /**
     * 上传多图
     * @Route("upimgs", method="POST")
     */
    public function upimgs()
    {
        $files = request()->file('imgs');
        if (empty($file)) {
            return json_error(10010);
        }

        try {
            validate(['imgs' => 'fileSize:10485670|fileExt:jpg,gif,jpeg,png|fileMime:image/jpeg,image/gif,image/png'])->check(request()->file());
            $savename = [];
            foreach ($files as $file) {

                //hash查重
                $hash = $file->hash('sha1');
                $img  = ImageHashService::getInfoByName($hash);
                if ($img) {
                    $path = $img['image'];
                } else {
                    $temp = \think\facade\Filesystem::putFile('images', $file);
                    $path = config('filesystem.disks.aliyun.url') . DIRECTORY_SEPARATOR . $savename;
                    //保存数据库
                    $res = ImageHashService::save([
                        'hash'  => $hash,
                        'image' => $path,
                        'id'    => SnowFlake::generate(),
                    ]);
                    if (!$res) {
                        return json_error(10012);
                    }
                }
                $savename[] = $path;
            }
            return json_ok(['path' => $savename]);
        } catch (\think\exception\ValidateException $e) {
            return json_error($e->getMessage());
        }
    }

    /**
     * 上传视频
     * @Route("upvedio", method="POST")
     */
    public function upvedio()
    {
        $file = request()->file('vedio');
        if (empty($file)) {
            return json_error(10011);
        }
        try {
            validate(['vedio' => 'fileSize:104856700|fileExt:mp4,flv,webm,ogv|fileMime:video/mp4,application/octet-stream,video/webm,video/ogg'])->check(request()->file());
            $savename = \think\facade\Filesystem::putFile('vedios', $file);
            $path     = config('filesystem.disks.aliyun.url') . DIRECTORY_SEPARATOR . $savename;
            return json_ok(['path' => $path]);
        } catch (\think\exception\ValidateException $e) {
            return json_error($e->getMessage());
        }
    }

    /**
     * 上传文件
     * @Route("upfile", method="POST")
     */
    public function upfile()
    {
        $file = request()->file('file');
        if (empty($file)) {
            return json_error(10011);
        }
        try {
            validate(['file' => 'fileSize:10485670|fileExt:pdf|fileMime:application/pdf'])->check(request()->file());
            $savename = \think\facade\Filesystem::putFile('files', $file['file']);
            $path     = config('filesystem.disks.aliyun.url') . DIRECTORY_SEPARATOR . $savename;
            return json_ok(['path' => $path]);
        } catch (\think\exception\ValidateException $e) {
            return json_error($e->getMessage());
        }
    }


}