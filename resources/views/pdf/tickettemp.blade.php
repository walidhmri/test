<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>@lang('messages.document_title') #{{ $ticket->id }}</title>
    <style>
        @page {
            margin: 1.5cm;
        }
        body {
            font-family: 'Times New Roman', Georgia, serif;
            background-color: #ffffff;
            margin: 0;
            padding: 0;
            font-size: 12pt;
            line-height: 1.5;
            color: #000000;
        }
        .document {
            position: relative;
            width: 100%;
        }
        .government-header {
            text-align: center;
            border-bottom: 3px double #002664;
            padding-bottom: 20px;
            margin-bottom: 25px;
        }
        .national-emblem {
            width: 80px;
            margin: 10px auto;
        }
        .document-title {
            font-size: 22pt;
            font-weight: bold;
            color: #002664;
            margin: 15px 0;
            text-transform: uppercase;
        }
        .reference-number {
            text-align: center;
            margin: 15px 0;
            font-size: 11pt;
            color: #666;
        }
        .section {
            margin: 20px 0;
            padding: 15px;
            border-left: 4px solid #002664;
            background: #f8f9fa;
        }
        .section-title {
            font-size: 14pt;
            color: #b31942;
            margin-bottom: 15px;
            font-weight: bold;
        }
        .info-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }
        .info-table td {
            padding: 8px 12px;
            border-bottom: 1px solid #dee2e6;
        }
        .label {
            font-weight: bold;
            width: 180px;
            color: #002664;
        }
        .official-seal {
            position: absolute;
            right: 50px;
            bottom: 100px;
            opacity: 0.9;
            z-index: -1;
        }
        .watermark {
            position: fixed;
            top: 40%;
            left: 25%;
            font-size: 120px;
            color: rgba(0,38,100,0.1);
            transform: rotate(-30deg);
            z-index: -1000;
        }
        .footer {
            text-align: center;
            font-size: 9pt;
            color: #666;
            margin-top: 30px;
            padding-top: 15px;
            border-top: 1px solid #002664;
        }
        .status-stamp {
            color: #b31942;
            font-weight: bold;
            border: 2px solid #b31942;
            padding: 3px 15px;
            border-radius: 3px;
            display: inline-block;
        }
    </style>
</head>
<body>
    <div class="government-header">
        <svg class="national-emblem" viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg">
            <rect width="100" height="100" fill="#002664"/>
            <circle cx="50" cy="50" r="40" fill="#fff"/>
            <path d="M30 40 L50 20 L70 40 L60 50 L40 50 Z" fill="#b31942"/>
        </svg>
        <div class="document-title">@lang('messages.document_title')</div>
        <div class="reference-number">@lang('messages.reference_number', ['id' => $ticket->id, 'year' => date('Y')])</div>
    </div>

    <div class="section">
        <div class="section-title">@lang('messages.request_details')</div>
        <table class="info-table">
            <tr>
                <td class="label">@lang('messages.service_type')</td>
                <td>{{ $ticket->title }}</td>
            </tr>
            <tr>
                <td class="label">@lang('messages.current_status')</td>
                <td>
                    <span class="status-stamp">
                        @if($ticket->status == 'closed')
                            @lang('messages.closed')
                        @elseif($ticket->status == 'solved')
                            @lang('messages.solved')
                        @elseif($ticket->status == 'pending')
                            @lang('messages.pending')
                        @else
                            {{ $ticket->status }}
                        @endif
                    </span>
                </td>
            </tr>
            <tr>
                <td class="label">@lang('messages.submission_date')</td>
                <td>{{ $ticket->created_at->format('m/d/Y') }}</td>
            </tr>
        </table>
    </div>

    <div class="section">
        <div class="section-title">@lang('messages.applicant_information')</div>
        <table class="info-table">
            <tr>
                <td class="label">@lang('messages.full_name')</td>
                <td>{{ $employee->name }}</td>
            </tr>
            <tr>
                <td class="label">@lang('messages.assigned_department')</td>
                <td>{{ $ticket->department->name ?? __('messages.pending_assignment') }}</td>
            </tr>
        </table>
    </div>

    <div class="official-seal">
        <svg width="180" height="180" viewBox="0 0 180 180" xmlns="http://www.w3.org/2000/svg">
            <circle cx="90" cy="90" r="85" fill="none" stroke="#b31942" stroke-width="3"/>
            <path d="M50 90 L90 50 L130 90 L90 130 Z" fill="none" stroke="#002664" stroke-width="2"/>
            <text x="90" y="70" font-size="16" text-anchor="middle" fill="#002664">@lang('messages.official_seal')</text>
            <text x="90" y="110" font-size="14" text-anchor="middle" fill="#b31942">@lang('messages.government')</text>
            <text x="90" y="130" font-size="12" text-anchor="middle" fill="#b31942">{{ date('Y') }}</text>
        </svg>
    </div>

    <div class="footer">
        @lang('messages.footer_line1')
        <br>@lang('messages.footer_line2', ['year' => date('Y')])
    </div>

    @if($ticket->status == 'closed')
    <div class="watermark">@lang('messages.closed')</div>
    @elseif($ticket->status == 'solved')
    <div class="watermark">@lang('messages.solved')</div>
    @elseif($ticket->status == 'pending')
    <div class="watermark">@lang('messages.pending')</div>
    @endif
</body>
</html>
