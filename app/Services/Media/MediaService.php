<?php
namespace App\Services\Media;

use App\Models\Media;
use App\Models\User;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class MediaService
{
    /** Upload a file and create a Media record. */
    public function upload(
        UploadedFile $file,
        User $uploader,
        string $disk = 'public',
        ?string $altText = null,
        ?string $modelType = null,
        ?int $modelId = null
    ): Media {
        $path = $file->storeAs(
            'uploads/' . now()->format('Y/m'),
            Str::uuid() . '.' . $file->getClientOriginalExtension(),
            $disk
        );

        return Media::create([
            'user_id'     => $uploader->id,
            'file_path'   => $path,
            'file_name'   => $file->getClientOriginalName(),
            'file_type'   => $file->getMimeType(),
            'file_size_kb'=> (int)($file->getSize() / 1024),
            'alt_text'    => $altText,
            'model_type'  => $modelType,
            'model_id'    => $modelId,
        ]);
    }

    /** Delete a media record and its file from storage. */
    public function delete(Media $media, string $disk = 'public'): void
    {
        Storage::disk($disk)->delete($media->file_path);
        $media->delete();
    }

    /** Return the public URL for a media record. */
    public function url(Media $media, string $disk = 'public'): string
    {
        return Storage::disk($disk)->url($media->file_path);
    }
}
