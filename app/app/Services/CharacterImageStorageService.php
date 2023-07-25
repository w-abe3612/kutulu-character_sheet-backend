<?php
 
namespace App\Services;
 
/**
 * 
 */
class CharacterImageStorageService
{

        /**
     * 画像のアップロードとDBへの処理を行う
     *
     * @param  TaskRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function imageUpload ($base64 = '',$character_id = null,$process_flag = 'create',$image_path = '') {
        $result     = '';
        $image_name = '';

        if ( !empty( $base64 ) && !empty( $character_id ) && !empty( $image_path ) ) {

            if ( $process_flag === 'update' ) {
                self::oldImageDelete( $character_id );
            }

            // 4.img_upload_base64を保存する
            $image_name = self::addImage( $base64, 's3', $image_path );

            $result = CharacterImage::create( array(
                'character_info_id' => $character_id,
                'user_id' => Auth::id(),
                'image_name' => $image_name,
                'image_path' => $image_path,
                'current_flg' => true,
            ) );
        }
        return $image_name;
    }

    /**
     * 画像をデコードして、保存する
     *
     * @param  TaskRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    protected function oldImageDelete( $character_id ) 
    {
        $result = '';

        // 2.既存の画像が存在するか調べる
        $old_images = CharacterImage::where('user_id', Auth::id() )
            ->where('character_info_id', $character_id )
            ->select('id','current_flg','deleted_flg','deleted_at','image_name','image_path')
            ->get();
            
        // 3.存在する場合、それをs3から削除し、delete_flgをtrueにしカレントをfalseにする
        if ( !empty( $old_images ) ) {

            // todo ここに削除処理
            $old_images[0]->current_flg = false;
            $old_images[0]->deleted_flg = true;
            $old_images[0]->deleted_at = date('Y-m-d H:i:s');
            $old_images[0]->save();

            self::deleteImage($old_images[0]->image_path,$old_images[0]->image_name);
        }
        return $result;
    }

    /**
     * 画像をデコードして、保存する
     *
     * @param  TaskRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    protected function addImage($base64Context, $storage, $dir)
    {
        $result = '';

        try {
            preg_match('/data:image\/(\w+);base64,/', $base64Context, $matches);
            $extension = $matches[1];

            $img = preg_replace('/^data:image.*base64,/', '', $base64Context);
            $img = str_replace(' ', '+', $img);
            $fileData = base64_decode($img);

            $dir = rtrim($dir, '/').'/';
            $fileName = md5($img);
            $path = $dir.$fileName.'.'.$extension;

            $result = $fileName.'.'.$extension;

            Storage::disk($storage)->put($path, $fileData);

            return $result;

        } catch (Exception $e) {
            Log::error($e);
            return null;
        }
    }

    /**
     * 削除された画像を削除する
     *
     * @param  TaskRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    protected function deleteImage($file_path,$file_name) 
    {
        $result = '';
        try {
            $result = Storage::disk('s3')->delete($file_path . $file_name);
            return $result;
        } catch (Exception $e) {
            Log::error($e);
            return null;
        }
    }
}