<?php
namespace App\Helpers;
class CacheHelper
{
    /**
     * Store content in a cache file.
     *
     * @param string $filePath The path to the file where content will be stored.
     * @param string $content The content to be stored in the file.
     */
public static function putCache($_filePath, $content)
    {
        $pathDatas = explode('.', $_filePath);
        //append .balde.php to last element if not exists
        if (count($pathDatas) > 0) {
            $lastElement = $pathDatas[count($pathDatas) - 1];
            $pathDatas[count($pathDatas) - 1] .= '.blade.php';
        }

        $filePath = implode('/', $pathDatas);


        $filePath = resource_path("views/front/cache/" . $filePath);
        // Extract the directory path from the file path
        $directoryPath = dirname($filePath);

        // Ensure the directory exists, if not create it
        if (!is_dir($directoryPath)) {
            mkdir($directoryPath, 0755, true);
        }

        // Put the content to the file path
        file_put_contents($filePath, $content);
    }
}