<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\ClientPolicies;
use App\Models\Client;
use App\Models\ProductNotes as ProductNotesModel;

class PdfNotesController extends Controller
{
    public function generate(Request $request)
    {
        $policyId = $request->input('policy_id');

        $clientPolicy = ClientPolicies::find($policyId);
        if($clientPolicy) {
        	$client = Client::find($clientPolicy->client_id);
        }

        /*$productnote = ProductNotesModel::where('policy_id', $policyId)
            ->orderByDesc('id')
            ->pluck('text')
            ->implode("\n\n");
*/
        $productnote = ProductNotesModel::where('policy_id', $policyId)
            ->orderByDesc('id')
            ->value('text');

        if (!$productnote) {
            $productnote = '--';
        }
    
        if(!$productnote) {
        	$productnote = '--';
        }

        $data = [
            'policy_id' => $policyId,
            'policy' => $clientPolicy->getPolicy(),
            'client' => $client,
            'productnote' => $productnote
        ];

        $pdf = Pdf::loadView('pdfs.notes', $data);

        return $pdf->stream('formal-notes.pdf');
    }
}
