# thinkphp-filesystem
thinkphp6.0 filesystem,include Local Aliyun  Qiniu Qcloud

使用实例：

1# .ENV 文件设置默认驱动aliyun

[FILESYSTEM]
DRIVER=aliyun

2# filesystem.php 文件配置修改

~~~
return [
    'default' => Env::get('filesystem.driver', 'local'),
    'disks'   => [
        'local'  => [
            'type' => 'local',
            'root' => app()->getRuntimePath() . 'storage',
        ],
        'public' => [
            'type'       => 'local',
            'root'       => app()->getRootPath() . 'public/storage',
            'url'        => '/storage',
            'visibility' => 'public',
        ],
        // 更多的磁盘配置信息
        'aliyun' => [
            'type'         => 'aliyun',
            'accessId'     => '',
            'accessSecret' => '',
            'bucket'       => '',
            'endpoint'     => 'oss-cn-beijing.aliyuncs.com',
            'url'          => '',//不要斜杠结尾，此处为URL地址域名。
        ]
    ],

];

~~~

3#Thinkphp6中使用示例
~~~
$file = request()->file();
if (empty($file) || !isset($file['img']) || empty($file['img'])) {
    return json_error('请上传图片');
}
try {
    validate(['img' => 'fileSize:10485670|fileExt:jpg,gif,jpeg,png|fileMime:image/jpeg,image/gif,image/png'])
        ->check($file);
    $path = \think\facade\Filesystem::putFile('images', $file['img']);
    $path = \think\facade\Filesystem::geturl($path);
    return  $path;
} catch (\think\exception\ValidateException $e) {
    return $e->getMessage();
}
~~~
