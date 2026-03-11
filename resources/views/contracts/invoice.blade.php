<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="UTF-8">
    <title>Purchase Invoice</title>
    <style>
        @page {
            header: page-header;
            footer: page-footer;
            margin-top: 55px;
            margin-bottom: 50px;
            margin-left: 45px;
            margin-right: 45px;
        }
        body {
            font-family: Arial, Helvetica, sans-serif;
            font-size: 10.5pt;
            color: #1E1E1E;
            line-height: 1.5;
            margin: 0;
            padding: 0;
            background-color: #FFFFFF;
        }
        .header-box {
            text-align: center;
            margin-bottom: 40px;
            border-bottom: 2px solid #C8A951;
            padding-bottom: 20px;
        }
        .company-logo {
            font-family: 'Times New Roman', Times, serif;
            font-size: 28pt;
            font-weight: 700;
            color: #0B0B0B;
            margin: 0;
            letter-spacing: -1px;
        }
        .invoice-title {
            text-align: center;
            margin: 10px 0 40px 0;
        }
        .invoice-title h2 {
            font-family: 'Times New Roman', Times, serif;
            margin: 0;
            font-size: 24pt;
            color: #0B0B0B;
            font-weight: normal;
            letter-spacing: 1px;
            text-transform: uppercase;
        }
        .invoice-details {
            width: 100%;
            margin-bottom: 40px;
            border-collapse: collapse;
        }
        .invoice-details td {
            vertical-align: top;
            width: 50%;
        }
        .info-box {
            background-color: #FAFAFA;
            border: 1px solid #EAEAEA;
            padding: 15px;
            border-radius: 4px;
        }
        .info-title {
            font-family: 'Times New Roman', Times, serif;
            font-size: 12pt;
            color: #C8A951;
            margin-bottom: 5px;
            font-weight: bold;
            border-bottom: 1px solid #EAEAEA;
            padding-bottom: 5px;
        }
        .items-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 30px;
        }
        .items-table th {
            background-color: #0B0B0B;
            color: #FFFFFF;
            padding: 12px;
            text-align: left;
            font-family: 'Times New Roman', Times, serif;
            font-size: 11pt;
            text-transform: uppercase;
        }
        .items-table th.center { text-align: center; }
        .items-table th.right { text-align: right; }
        .items-table td {
            padding: 15px 12px;
            border-bottom: 1px solid #EAEAEA;
            color: #1E1E1E;
        }
        .items-table td.center { text-align: center; }
        .items-table td.right { text-align: right; font-weight: bold; }
        
        .total-section {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        .total-section td {
            padding: 10px;
        }
        .total-label {
            text-align: right;
            font-weight: bold;
            font-size: 12pt;
            width: 70%;
        }
        .total-value {
            text-align: right;
            font-size: 14pt;
            font-weight: bold;
            color: #C8A951;
            width: 30%;
        }
        .footer {
            text-align: center;
            font-size: 9pt;
            color: #888888;
            border-top: 1px solid #EAEAEA;
            padding-top: 10px;
        }
        .paid-stamp {
            text-align: center;
            margin-top: 50px;
        }
        .stamp-text {
            color: #27ae60;
            font-family: 'Times New Roman', Times, serif;
            font-size: 24pt;
            font-weight: bold;
            text-transform: uppercase;
            border: 4px solid #27ae60;
            display: inline-block;
            padding: 10px 30px;
            border-radius: 8px;
            transform: rotate(-5deg);
        }
    </style>
</head>
<body>

    <htmlpageheader name="page-header"></htmlpageheader>
    <htmlpagefooter name="page-footer">
        <div class="footer">
            Official Invoice | iFuture LLC | Generated automatically on {{ $DATE }}
        </div>
    </htmlpagefooter>

    <div class="header-box">
        <h1 class="company-logo">iFuture LLC</h1>
    </div>

    <div class="invoice-title">
        <h2>Purchase Invoice</h2>
    </div>

    <table class="invoice-details">
        <tr>
            <td style="padding-right: 15px;">
                <div class="info-box">
                    <div class="info-title">Billed To:</div>
                    <strong>{{ $INVESTOR_NAME }}</strong><br>
                    ID/Passport: {{ $INVESTOR_ID }}<br>
                    Email: {{ $INVESTOR_EMAIL }}
                </div>
            </td>
            <td style="padding-left: 15px;">
                <div class="info-box">
                    <div class="info-title">Invoice Details:</div>
                    Invoice No: <strong>#INV-{{ $INVOICE_NUMBER }}</strong><br>
                    Date: <strong>{{ $DATE }}</strong><br>
                    Payment Method: <strong>{{ ucfirst($GATEWAY) }}</strong><br>
                    Transaction ID: <span style="font-size: 9pt; color:#555;">{{ $TRANSACTION_ID }}</span>
                </div>
            </td>
        </tr>
    </table>

    <table class="items-table">
        <thead>
            <tr>
                <th>Item Description</th>
                <th class="center">Shares</th>
                <th class="right">Total Price</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>
                    <strong style="font-size: 12pt;">{{ $PROJECT_NAME }}</strong><br>
                    <span style="color: #666; font-size: 9pt;">Equity Investment Shares</span>
                </td>
                <td class="center">{{ $SHARES }}%</td>
                <td class="right">${{ number_format($AMOUNT, 2) }}</td>
            </tr>
        </tbody>
    </table>

    <table class="total-section">
        <tr>
            <td class="total-label">Subtotal:</td>
            <td class="total-value">${{ number_format($AMOUNT, 2) }}</td>
        </tr>
        <tr>
            <td class="total-label" style="font-size: 16pt; color: #0B0B0B;">Total Paid:</td>
            <td class="total-value" style="font-size: 18pt;">${{ number_format($AMOUNT, 2) }}</td>
        </tr>
    </table>

    <div class="paid-stamp">
        <div class="stamp-text">PAID IN FULL</div>
    </div>

</body>
</html>
