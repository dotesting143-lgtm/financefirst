<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\ClientPolicies;
use App\Models\Client;
use App\Models\SuitabilityLetter as SuitabilityLetterModel;
use App\Models\PensionLetter as PensionLetterModel;
use App\Models\MortgageSuitabilityLetter as MortgageSuitabilityLetterModel;
use App\Models\PersonalAccSuitabilityLetter as PersonalAccSuitabilityLetterModel;

class PdfLetterController extends Controller
{
    public function generate(Request $request)
    {
        $policyId = $request->input('policy_id');

        $clientPolicy = ClientPolicies::find($policyId);
        $client = $clientPolicy ? Client::find($clientPolicy->client_id) : null;

        switch ($clientPolicy->policy_type) {
            case 'peracc_policy':
                $lastLetter = PersonalAccSuitabilityLetterModel::latest()->first();
                $suitLetter = $lastLetter?->persaccsuit_letter ?? '';
                break;

            case 'mortgage_policy':
                $lastLetter = MortgageSuitabilityLetterModel::latest()->first();
                $suitLetter = $lastLetter?->mortsuit_letter ?? '';
                break;

            case 'pension_policy':
                $lastLetter = PensionLetterModel::latest()->first();
                $suitLetter = $lastLetter?->pens_letter ?? '';
                break;

            default:
                $lastLetter = SuitabilityLetterModel::latest()->first();
                $suitLetter = $lastLetter?->suit_letter ?? '';
        }

        $data = [
            'policy_id' => $policyId,
            'policy' => $clientPolicy?->getPolicy(),
            'client' => $client,
            'suit_letter' => $suitLetter,
        ];

        $pdf = Pdf::loadView('pdfs.formal-letter', $data);

        return $pdf->stream('formal-letter.pdf');
    }

}
