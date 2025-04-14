<?php

namespace App\Http\Controllers;

use App\Models\Entretien;
use Barryvdh\DomPDF\Facade\Pdf;

class EntretienPdfController extends Controller
{
    public function generate($id)
    {
        $entretien = Entretien::findOrFail($id);

        $labels = [
            'f1' => 'Fourniture et remplacement des filtres',
            'v1' => 'Vérification, ajustement et remplacement des courroies',
            'v2' => 'Vérification des poulies d’entraînement',
            'v3' => 'Vérification des contrôles de protection du système',
            'v4' => 'Vérification et lubrification des moteurs et roulements à billes',
            'v5' => 'Nettoyage de la panne et du drain de condensation',
            'v6' =>
            'La mise en opération de l"umidificateur à l"automne et à l"arret de celle-ci au printemps (Selon température).',
        'v7' => 'Vérification des serpentins sur les unités de condensation et d"évaporation.',
        'v8' => 'Vérification du bon fonctionnement du système',
        ];

        return Pdf::loadView('pdf.entretien', [
            'entretien' => $entretien,
            'building' => $entretien->building,
            'labels' => [ // à adapter selon tes champs
                'f1' => 'Fourniture et remplacement des filtres',
                'v1' => 'Vérification, ajustement et remplacement des courroies',
                'v2' => 'Vérification des poulies d’entraînement',
                'v3' => 'Vérification des contrôles de protection du système',
                'v4' => 'Vérification et lubrification des moteurs et roulements à billes',
                'v5' => 'Nettoyage de la panne et du drain de condensation',
                'v6' =>
                'La mise en opération de l"umidificateur à l"automne et à l"arret de celle-ci au printemps (Selon température).',
            'v7' => 'Vérification des serpentins sur les unités de condensation et d"évaporation.',
            'v8' => 'Vérification du bon fonctionnement du système',
            ],
        ])->download('entretien_' . $entretien->id . '.pdf');
    }
}

