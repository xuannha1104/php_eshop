<?php

namespace App\Ultities;

use Illuminate\Support\Str;

class Common
{
    public static function uploadFile($file,$path)
    {
        $file_name_original= $file->getClientOriginalName();
        $extension = $file->getClientOriginalExtension();
        $file_name_without_extension = Str::replaceLast('.'.$extension,'',$file_name_original);

        $str_time_now = now()->format('ymd_his');
        $file_name = Str::slug($file_name_without_extension . '_' . uniqid() . '_' . $str_time_now) . '.' . $extension;
        $file->move($path,$file_name);

        return $file_name;
    }
    public static function getRandomFileName($fileName)
    {
        $extension = pathinfo($fileName, PATHINFO_EXTENSION);
        $file_name_without_extension = Str::replaceLast('.'.$extension,'',$fileName);
        $str_time_now = now()->format('ymd_his');
        return Str::slug($file_name_without_extension . '_' . uniqid() . '_' . $str_time_now) . '.' . $extension;

    }
}
