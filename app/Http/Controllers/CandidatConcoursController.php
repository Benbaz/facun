<?php

namespace App\Http\Controllers;

use App\Exports\CandidatConcoursExport;
use App\Models\CandidatConcours;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade as PDF;
use Barryvdh\DomPDF\Facade\Pdf as FacadePdf;

class CandidatConcoursController extends Controller
{


    public function index()
    {
        $candidats = \App\Models\CandidatConcours::whereHas('payment', function ($query) {
            $query->where('status', 'pending');
        })->with('payment')->get();
    
        return view('candidat_concours.index', compact('candidats'));
    }

    public function filtre(Request $request)
    {
        $candidats = CandidatConcours::with('payment')->whereHas('payment', function ($query) use ($request) {
            if ($request->has('anne_entree')) {
                $query->where('anne_entree', $request->input('anne_entree'));
            }
            if ($request->has('centre_examen')) {
                $query->where('centre_examen', $request->input('centre_examen'));
            }
            $query->where('status', 'pending');
        })->select(['id', 'nom', 'prenom', 'telephone', 'date_naissance', 'lieu_naissance', 'anne_entree', 'centre_examen', 'numero_mobile_money', 'status']);

        return DataTables::eloquent($candidats)
            ->addIndexColumn()
            ->addColumn('action', function ($candidat) {
                return '<a href="' . route('candidat.show', $candidat->id) . '">View</a>';
            })
            ->addColumn('payment_status', function ($candidat) {
                return ucfirst($candidat->payment->status);
            })
            ->filterColumn('payment_status', function ($query, $keyword) {
                $query->where('status', ucfirst($keyword));
            })
            ->make(true);

        return view('candidat_concours.index', compact('candidats'));
    }

    public function exportExcel()
    {
        return Excel::download(new CandidatConcoursExport, 'candidats.xlsx');
    }

    public function exportPdf()
    {
        $candidats = CandidatConcours::join('payments', 'candidat_concours.id', '=', 'payments.candidat_concours_id')
        ->where('payments.status', 'pending')
        ->select('candidat_concours.id', 'candidat_concours.nom', 'candidat_concours.prenom', 'candidat_concours.telephone', 'candidat_concours.date_naissance', 'candidat_concours.lieu_naissance', 'candidat_concours.anne_entree', 'candidat_concours.centre_examen', 'payments.numero_mobile_money as numero_mobile_money', 'payments.status as payment_status')
        ->get();
        $pdf = FacadePdf::loadView('candidat_concours.index', compact('candidats'))->setPaper('a4', 'landscape');
        return $pdf->download('candidats.pdf');
    }
   
}
