<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Suitability Letter</title>
    <link href="{{ public_path('css/pdf.css') }}" rel="stylesheet">
</head>
<body class="text-xs">
    <div class="content">
        <div class="w-full mb-8 mt-8">&nbsp;</div>
        <div class="w-full mb-8 mt-8">&nbsp;</div>
        <div class="w-full mb-8 mt-8">&nbsp;</div>
        <div class="w-full mb-8 mt-8">&nbsp;</div>
        <div class="top-details mb-8 mt-8">
            <table class="w-full">
                <tbody>
                    <tr>
                        <td class="align-top">
                        <p class="text-xs font-bold m-0">Private & Confidential: To be opened by the addressee only</p>
                        <p>{{ $client->title ?? '' }} {{ $client->first_name ?? '' }} {{ $client->last_name ?? '' }}<br>
                        @if ($client->sec_title && $client->sec_first_name)
                        & {{ $client->sec_title ?? '' }} {{ $client->sec_first_name ?? '' }} {{ $client->sec_last_name ?? '' }}<br>
                        @endif

                        @if ($client->address)
                        {{ $client->address ?? '' }}<br>
                        @endif

                        @php
                            $parts = array_filter([
                                $client->address2 ?? null,
                                $client->postcode ?? null,
                                $client->eircode ?? null,
                            ]);
                        @endphp

                        @if (!empty($parts))
                            {{ implode(', ', $parts) }}<br>
                        @endif
                        </p>
                        </td>
                        <td class="align-top text-right">
                            <p>Policy Type: {{ $policy->type }}</p>
                            <p class="mb-3">Policy Number: ({{ $policy->id }})</p>
                            <p>Correspondence Date: {{ date('d/m/Y') }}</p>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="content-area">
        	{!! nl2br(e($suit_letter)) !!}
        </div>
        <!-- Page Break -->
        <div style="page-break-before: always;"></div>     
        <div class="header-top text-center w-full mb-8">
            <div class="bg-oxford-blue text-white p-3 rounded-t-lg w-full box-border border border-solid border-oxford-blue">
                <h2 class="text-xl">Finance First Suitability Report - <span style="text-transform: capitalize;">{{ $client->title ?? '' }} {{ $client->first_name ?? '' }} {{ $client->last_name ?? '' }}</span></h2>
                <p>Date Created: {{ date('d/m/Y') }}</p>
            </div>
            <div class="notice border border-solid border-oxford-blue p-3 font-bold rounded-b-lg w-full text-oxford-blue box-border bg-white text-xs">
                IMPORTANT NOTICE - Statement of Suitability. This is an important document which sets out the reasons why the product(s) or service(s) offered or recommended is/are considered suitable, or the most suitable, for your particular needs, objectives and circumstances.
            </div>
        </div>
        <div class="content-area-2 w-full">
            <div class="content-item mb-5 w-full">
                <div class="content-item-title bg-oxford-blue text-white p-3 w-full mb-1">Needs and Objectives:</div>
                <div class="content-item w-full">
                    <p>{!! nl2br(e($policy->needs_obj_text)) !!}</p>
                </div>
            </div>
            <div class="content-item mb-5 w-full">
                <div class="content-item-title bg-oxford-blue text-white p-3 w-full mb-1">Personal Circumstances:</div>
                <div class="content-item w-full"><p>{!! nl2br(e($policy->per_circ_text)) !!}</p></div>
            </div>
            <div class="content-item mb-5 w-full">
                <div class="content-item-title bg-oxford-blue text-white p-3 w-full mb-1">Financial Situation:</div>
                <div class="content-item w-full"><p>{!! nl2br(e($policy->fin_sit_text)) !!}</p></div>
            </div>
            <div class="content-item mb-5 w-full">
                <div class="content-item-title bg-oxford-blue text-white p-3 w-full mb-1">Risk Profile:</div>
                <div class="content-item w-full"><p>{!! nl2br(e($policy->risk_profile_text)) !!}</p></div>
            </div>
            <div class="content-item mb-5 w-full">
                <div class="content-item-title bg-oxford-blue text-white p-3 w-full mb-1">Recommendations:</div>
                <div class="content-item w-full"><p>{!! nl2br(e($policy->recommend_text)) !!}</p></div>
            </div>
        </div>
    </div>
</body>
</html>