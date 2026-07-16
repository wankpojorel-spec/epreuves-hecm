<?php

namespace App\Services;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Str;

class EpreuveUploadService
{
    public function storePdf(UploadedFile $file): array
    {
        $nomOriginal = $file->getClientOriginalName();
        $nomStocke = Str::uuid() . '.pdf';

        // Stocke le fichier dans storage/app/public/epreuves
        $chemin = $file->storeAs('epreuves', $nomStocke, 'public');

        return [
            'chemin_fichier' => $chemin,
            'nom_original' => $nomOriginal,
        ];
    }
}

