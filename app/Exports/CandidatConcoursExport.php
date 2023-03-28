<?php
namespace App\Exports;

use App\Models\CandidatConcours;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class CandidatConcoursExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return CandidatConcours::join('payments', 'candidat_concours.id', '=', 'payments.candidat_concours_id')
        ->where('payments.status', 'pending')
        ->select('candidat_concours.id', 'candidat_concours.nom', 'candidat_concours.prenom', 'candidat_concours.telephone', 'candidat_concours.date_naissance', 'candidat_concours.lieu_naissance', 'candidat_concours.anne_entree', 'candidat_concours.centre_examen', 'candidat_concours.numero_mobile_money', 'payments.status as payment_status')
        ->get();
    }


    public function headings(): array
    {
        return [
            '#',
            'Nom',
            'Prénom',
            'Téléphone',
            'Date de naissance',
            'Lieu de naissance',
            'Année d\'entrée',
            'Centre d\'examen',
            'Numéro mobile money',
            'Statut de paiement',
        ];
    }
}

