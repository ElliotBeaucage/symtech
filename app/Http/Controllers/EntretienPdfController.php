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
            ],
        ])->download('entretien_' . $entretien->id . '.pdf');
    }
}

