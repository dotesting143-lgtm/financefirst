<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Product Notes</title>
    <link href="{{ public_path('css/pdf.css') }}" rel="stylesheet">
</head>
<body class="text-xs">
    <div class="header text-center mb-8">
        <img src="{{ public_path('images/logo.png') }}" width="178" height="24" alt="Logo">
    </div>
    <div class="content">
        <div class="header-top text-center w-full mb-8">
            <div class="bg-oxford-blue text-white p-3 rounded-t-lg w-full box-border border border-solid border-oxford-blue">
                <h2 class="text-xl">{{ $policy->getPolicyLabel() }} Notes - <span style="text-transform: capitalize;">{{ $client->title ?? '' }} {{ $client->first_name ?? '' }} {{ $client->last_name ?? '' }} ({{ $policy->id }})</span></h2>
                <p>Date Created: {{ date('d/m/Y') }}</p>
            </div>
            <div style="text-align: left;" class="notice border border-solid border-oxford-blue p-3 font-bold rounded-b-lg w-full text-oxford-blue box-border bg-white text-xs">
                {!! nl2br(e($productnote)) !!}
            </div>
        </div>
    </div>
</body>
</html>