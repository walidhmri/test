<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Support Ticket #{{ $ticket->id }}</title>
    <style>
        @page {
            margin: 0.8cm;
        }
        body {
            font-family: 'DejaVu Sans', 'Helvetica', Arial, sans-serif;
            background-color: #ffffff;
            margin: 0;
            padding: 0;
            font-size: 11pt;
            line-height: 1.6;
            color: #333333;
        }
        .document {
            position: relative;
            width: 100%;
        }
        .ticket-header {
            position: relative;
            border-bottom: 3px solid #2563eb;
            margin-bottom: 15px;
            padding-bottom: 15px;
        }
        .company-details {
            position: absolute;
            right: 0;
            top: 0;
            text-align: right;
        }
        .company-name {
            font-size: 14pt;
            font-weight: bold;
            color: #1e40af;
        }
        .company-info {
            font-size: 9pt;
            color: #64748b;
        }
        .ticket-title {
            font-size: 22pt;
            font-weight: bold;
            color: #1e3a8a;
            margin: 10px 0 5px 0;
            padding: 0;
        }
        .ticket-id {
            font-size: 12pt;
            color: #64748b;
            margin: 0 0 5px 0;
        }
        .section {
            margin-bottom: 20px;
            padding: 15px;
            border-radius: 6px;
            background-color: #ffffff;
            border: 1px solid #e2e8f0;
        }
        .section-title {
            font-size: 12pt;
            font-weight: bold;
            color: #1e3a8a;
            margin-bottom: 10px;
            padding-bottom: 5px;
            border-bottom: 1px solid #e2e8f0;
        }
        .info-table {
            width: 100%;
            border-collapse: collapse;
        }
        .info-table td {
            padding: 6px 10px;
            border-bottom: 1px solid #f1f5f9;
        }
        .info-table tr:last-child td {
            border-bottom: none;
        }
        .label {
            font-weight: bold;
            width: 130px;
            color: #334155;
            vertical-align: top;
        }
        .badge {
            padding: 3px 10px;
            border-radius: 15px;
            color: white;
            display: inline-block;
            font-size: 9pt;
            text-transform: uppercase;
            font-weight: bold;
            letter-spacing: 0.5px;
        }
        .status-pending { background: #f59e0b; }
        .status-solved { background: #10b981; }
        .status-in-progress { background: #3b82f6; }
        .status-other { background: #6b7280; }

        .priority-low { background: #10b981; }
        .priority-medium { background: #f59e0b; }
        .priority-high { background: #f97316; }
        .priority-urgent { background: #ef4444; }

        .description-box {
            background: #f8fafc;
            padding: 15px;
            border-radius: 5px;
            border: 1px solid #e2e8f0;
            line-height: 1.6;
            white-space: pre-line;
            color: #334155;
        }
        .image-section {
            margin-top: 20px;
        }
        .image-container {
            text-align: center;
            margin-top: 15px;
            padding: 10px;
            background: #f8fafc;
            border: 1px solid #e2e8f0;
            border-radius: 5px;
        }
        .image-container img {
            max-width: 100%;
            max-height: 350px;
            border-radius: 3px;
        }
        .footer {
            font-size: 9pt;
            color: #64748b;
            text-align: center;
            margin-top: 20px;
            padding-top: 10px;
            border-top: 1px solid #e2e8f0;
        }
        .watermark {
            position: fixed;
            top: 35%;
            width: 100%;
            text-align: center;
            font-size: 100px;
            color: rgba(225, 225, 225, 0.3);
            transform: rotate(-45deg);
            z-index: -1000;
        }
    </style>
</head>
<body>
    <!-- Watermark for draft/copy status if needed -->
    @if($ticket->status != 'solved')
    <div class="watermark">{{ strtoupper($ticket->status) }}</div>
    @endif

    <div class="document">
        <div class="ticket-header">
            <div class="company-details">
                <div class="company-name">Support System</div>
                <div class="company-info">Generated: {{ date('F j, Y g:i a') }}</div>
            </div>
            <div class="ticket-title">Support Ticket</div>
            <div class="ticket-id">Reference #{{ $ticket->id }}</div>
        </div>

        <div class="section">
            <div class="section-title">Ticket Information</div>
            <table class="info-table">
                <tr>
                    <td class="label">Title:</td>
                    <td><strong>{{ $ticket->title }}</strong></td>
                </tr>
                <tr>
                    <td class="label">Status:</td>
                    <td>
                        <span class="badge 
                            @if($ticket->status == 'pending') status-pending 
                            @elseif($ticket->status == 'in-progress') status-in-progress
                            @elseif($ticket->status == 'solved') status-solved 
                            @else status-other @endif">
                            {{ ucfirst($ticket->status) }}
                        </span>
                    </td>
                </tr>
                <tr>
                    <td class="label">Priority:</td>
                    <td>
                        <span class="badge 
                            @if($ticket->priority == 'low') priority-low 
                            @elseif($ticket->priority == 'medium') priority-medium 
                            @elseif($ticket->priority == 'high') priority-high 
                            @elseif($ticket->priority == 'urgent') priority-urgent 
                            @else status-other @endif">
                            {{ ucfirst($ticket->priority) }}
                        </span>
                    </td>
                </tr>
                <tr>
                    <td class="label">Created:</td>
                    <td>{{ $ticket->created_at->format('F j, Y, g:i a') }}</td>
                </tr>
                <tr>
                    <td class="label">Last Updated:</td>
                    <td>{{ $ticket->updated_at->format('F j, Y, g:i a') }}</td>
                </tr>
            </table>
        </div>

        <div class="section">
            <div class="section-title">Personnel</div>
            <table class="info-table">
                <tr>
                    <td class="label">Reported By:</td>
                    <td>{{ $employee->name }}</td>
                </tr>
                <tr>
                    <td class="label">Assigned To:</td>
                    <td>{{ $ticket->assigned_to ?? 'Pending Assignment' }}</td>
                </tr>
            </table>
        </div>

        <div class="section">
            <div class="section-title">Description</div>
            <div class="description-box">{{ $ticket->description }}</div>
        </div>

        @if(!empty($ticket->file))
        <div class="section image-section">
            <div class="section-title">Attachments</div>
            <div class="image-container">
                <img src="{{ public_path('storage/' . $ticket->file) }}" alt="Ticket Image">
            </div>
        </div>
        @endif

        <div class="footer">
            This document is automatically generated and is valid without a signature.
            <br>Reference: TICKET-{{ $ticket->id }}-{{ date('Ymd') }}
        </div>
    </div>
</body>
</html>