<?php
/**
 * Created by PhpStorm.
 * User: SAS
 * Date: 27.05.17
 * Time: 7:19
 */

namespace reception\services\file;


class FileService
{
    /**
     * @param $uploadedFile
     * Складывает в нужную папку и возвращает имя файла, который потом надо записать в AR ...
     * @return mixed string fileName or return Exception
     */
    public function uploadFile($uploadedFile,$id){

        $postdata = fopen( $_FILES[ 'file' ][ 'tmp_name' ], "r" );
        $extension = substr( $_FILES[ 'file' ][ 'name' ], strrpos( $_FILES[ 'file' ][ 'name' ], '.' ) );
        $filename =  $id.'_'. uniqid() . $extension;
        /* Open a file for writing */
        $fp = fopen( Yii::getAlias('@imagePath') . '/'.$filename, "w" );
        /* Read the data 1 KB at a time and write to the file */
        while( $data = fread( $postdata, 1024 ) )
            fwrite( $fp, $data );
        fclose( $fp );
        fclose( $postdata );

    }

    /**
     * @param $fileName
     */
    public function deleteFile($fileName){}

}