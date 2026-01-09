<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\ClientPolicies;
use App\Models\Client;
use App\Models\ThankyouLetter as ThankyouLetterModel;
use App\Models\PensionThankyouLetter as PensionThankyouLetterModel;
use App\Models\MortgageThankyouLetter as MortgageThankyouLetterModel;
use App\Models\PersonalAccThankyouLetter as PersonalAccThankyouLetterModel;

class PdfThankyouController extends Controller
{
    public function generate(Request $request)
    {
        $policyId = $request->input('policy_id');

        $clientPolicy = ClientPolicies::find($policyId);
        $client = $clientPolicy ? Client::find($clientPolicy->client_id) : null;

        switch ($clientPolicy->policy_type) {
            case 'peracc_policy':
                $lastLetter = PersonalAccThankyouLetterModel::latest()->first();
                $thankyouLetter = $lastLetter?->thanks_letter ?? '';
                break;

            case 'mortgage_policy':
                $lastLetter = MortgageThankyouLetterModel::latest()->first();
                $thankyouLetter = $lastLetter?->thanks_letter ?? '';
                break;

            case 'pension_policy':
                $lastLetter = PensionThankyouLetterModel::latest()->first();
                $thankyouLetter = $lastLetter?->thanks_letter ?? '';
                break;

            default:
                $lastLetter = ThankyouLetterModel::latest()->first();
                $thankyouLetter = $lastLetter?->thanks_letter ?? '';
        }

        $data = [
            'policy_id' => $policyId,
            'policy' => $clientPolicy?->getPolicy(),
            'client' => $client,
            'thankyou_letter' => $thankyouLetter,
        ];

        $pdf = Pdf::loadView('pdfs.thankyou-letter', $data);

        return $pdf->stream('thankou-letter.pdf');
    }

}
