<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Rapport de service #{{ $entretien->id }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 11px;
            margin: 40px;
        }

        .header,
        .footer {
            text-align: center;
        }

        .header h1 {
            margin: 0;
            font-size: 18px;
        }

        .section {
            margin-bottom: 15px;
        }

        .section-title {
            font-weight: bold;
            background: #eee;
            padding: 4px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 10px;
        }

        td {
            vertical-align: top;
            padding: 4px;
            border: 1px solid #ccc;
        }

        .label {
            font-weight: bold;
            width: 25%;
        }

        .signature {
            margin-top: 10px;
            border: 1px solid #ccc;
            width: 250px;
        }

        .checkbox {
    display: inline-block;
    width: 16px;
    height: 16px;
    border: 1px solid #000;
    text-align: center;
    line-height: 16px;
    font-size: 12px;
    font-weight: bold;
    font-family: DejaVu Sans, sans-serif; /* domPDF supporte cette police */
}


        .grid-2 td {
            width: 50%;
        }

        .material-table th,
        .material-table td {
            border: 1px solid #ccc;
            padding: 4px;
            text-align: left;
        }
    </style>
</head>

<body>
    <div class="header" style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 10px;">
        <div style="flex: 0 0 auto;">
            <img src="{{ public_path('storage/logo.png') }}" style="height: 60px;" alt="Logo Symtech">
        </div>
        <div style="flex: 1; text-align: center;">
            <h1>Symtech Climatisation inc.</h1>
            <p>1416, rue des Mésanges, Prévost (Québec) J0R 1T0<br>Email: info@symtechclim.com | Tél: 450 477-0080</p>
            <p><strong>Rapport de service</strong> No {{ $entretien->id }}</p>
        </div>
    </div>

    <div class="section">
        <table class="grid-2">
            <tr>
                <td><span class="label">Client :</span> {{ $building->client->name ?? '' }}</td>
                <td><span class="label">Date :</span> {{ $entretien->created_at->format('d/m/Y') }}</td>
            </tr>
            <tr>
                <td><span class="label">Adresse :</span> {{ $building->adresse ?? '' }}</td>
                <td><span class="label">Ville :</span> {{ $building->ville ?? '' }}</td>
            </tr>
            <tr>
                <td><span class="label">Endroit des travaux :</span> {{ $entretien->location ?? '' }}</td>
                <td><span class="label">Code postal :</span> {{ $building->code_postal ?? '' }}</td>
            </tr>
            <tr>
                <td><span class="label">Genre / Type :</span> {{ $entretien->type ?? '' }}</td>
                <td><span class="label">Marque :</span> {{ $entretien->marque ?? '' }}</td>
            </tr>
            <tr>
                <td><span class="label">Modèle :</span> {{ $entretien->modele ?? '' }}</td>
                <td><span class="label">No de série :</span> {{ $entretien->numero_serie ?? '' }}</td>
            </tr>
        </table>
    </div>

    <div class="section">
        <div class="section-title">Description du travail</div>
        <p>{{ $entretien->description ?? '' }}</p>
    </div>

    <div class="section">
        <div class="section-title">Vérifications effectuées</div>

        <table style="width: 100%; border: none;">
            <tr>
                {{-- Colonne gauche : Vérifications --}}
                <td style="width: 55%; vertical-align: top; padding-right: 10px;">
                    <ul style="list-style: none; padding-left: 0; margin: 0;">
                        @foreach ($labels as $key => $text)
                            <li><span class="checkbox">{{ $entretien->$key ? '✔' : '' }}</span>
                                {{ $text }}</li>
                        @endforeach
                    </ul>
                </td>

                {{-- Colonne droite : Images --}}
                <td style="width: 45%; vertical-align: top;">
                    @if ($entretien->images && $entretien->images->count())
                        @foreach ($entretien->images as $img)
                            <div style="margin-bottom: 8px;">
                                <img src="{{ public_path('storage/' . $img->image_path) }}"
                                     style="width: 100%; max-height: 160px; object-fit: cover; border: 1px solid #ccc; padding: 4px;">
                            </div>
                        @endforeach
                    @else
                        <p style="color: #999; font-size: 11px;">Aucune photo liée</p>
                    @endif
                </td>
            </tr>
        </table>
    </div>


    <div class="section">
        <div class="section-title">Matériaux</div>
        <table class="material-table">
            <thead>
                <tr>
                    <th>Qté</th>
                    <th>Matériaux</th>
                    <th>Prix</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td colspan="4" style="text-align: center; color: #999;">Aucun matériau enregistré</td>
                </tr>
            </tbody>
        </table>
    </div>

    <div class="section">
        <div class="section-title">Signature du client</div>
        @if ($entretien->image)
            <img src="{{ public_path('storage/' . $entretien->image) }}" alt="Signature" class="signature">
        @else
            <p style="color: #999;">Aucune signature enregistrée</p>
        @endif
    </div>

    <div class="section">
        <table class="grid-2">
            <tr>
                <td><span class="label">Nom du mécanicien :</span> {{ $entretien->technicien_nom ?? '' }}</td>
                <td><span class="label">Date complété :</span> {{ $entretien->created_at->format('d/m/Y') }}</td>
            </tr>
        </table>
    </div>

    <div class="footer">
        <p>CHAUFFAGE | CLIMATISATION | VENTILATION | AUTOMATISATION</p>
    </div>

</body>

</html>
