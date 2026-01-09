<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Thank You Letter</title>
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
        	{!! nl2br(e($thankyou_letter)) !!}
        </div>
    </div>
</body>
</html>