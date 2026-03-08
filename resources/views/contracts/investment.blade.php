<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="UTF-8">
    <title>Equity Investment Agreement</title>
    <style>
        @page {
            header: page-header;
            footer: page-footer;
            margin-top: 60px;
            margin-bottom: 60px;
            margin-left: 50px;
            margin-right: 50px;
        }
        body {
            font-family: Arial, Helvetica, sans-serif;
            font-size: 11pt;
            color: #1E1E1E;
            line-height: 1.6;
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
        .company-tagline {
            color: #C8A951;
            font-size: 11pt;
            margin-top: 5px;
            text-transform: uppercase;
            letter-spacing: 2px;
        }
        .contract-title {
            text-align: center;
            margin: 10px 0 40px 0;
        }
        .contract-title h2 {
            font-family: 'Times New Roman', Times, serif;
            margin: 0;
            font-size: 24pt;
            color: #0B0B0B;
            font-weight: normal;
            letter-spacing: 1px;
            text-transform: uppercase;
        }
        .date-section {
            text-align: left;
            font-size: 11pt;
            color: #1E1E1E;
            margin-bottom: 30px;
        }
        .party-card {
            background-color: #FAFAFA;
            border: 1px solid #EAEAEA;
            border-left: 4px solid #C8A951;
            padding: 20px;
            margin-bottom: 20px;
            border-radius: 4px;
        }
        .party-card-title {
            font-family: 'Times New Roman', Times, serif;
            font-size: 14pt;
            color: #0B0B0B;
            margin-bottom: 10px;
            font-weight: bold;
            border-bottom: 1px solid #EAEAEA;
            padding-bottom: 5px;
        }
        .party-details {
            font-size: 11pt;
            color: #1E1E1E;
        }
        .party-details strong {
            color: #0B0B0B;
        }
        .section-header {
            font-family: 'Times New Roman', Times, serif;
            font-size: 15pt;
            color: #0B0B0B;
            margin-top: 35px;
            margin-bottom: 15px;
            border-bottom: 1px solid #EAEAEA;
            padding-bottom: 5px;
            font-weight: bold;
        }
        .clause {
            font-size: 11pt;
            color: #1E1E1E;
            margin-bottom: 20px;
            text-align: justify;
        }
        .highlight-box {
            background-color: #FDFBEE;
            border: 1px solid #C8A951;
            padding: 15px;
            border-radius: 6px;
            text-align: center;
            margin: 20px 0;
            font-size: 13pt;
            color: #0B0B0B;
        }
        .highlight-box span {
            font-weight: bold;
            font-size: 15pt;
            color: #C8A951;
        }
        .list-item {
            margin-bottom: 10px;
            padding-left: 15px;
            position: relative;
        }
        .list-item::before {
            content: "•";
            color: #C8A951;
            position: absolute;
            left: 0;
            top: 0;
        }
        .signatures-area {
            margin-top: 60px;
            width: 100%;
        }
        .sig-column {
            width: 45%;
            float: left;
        }
        .sig-column.right {
            float: right;
        }
        .sig-title {
            font-family: 'Times New Roman', Times, serif;
            font-weight: bold;
            color: #0B0B0B;
            font-size: 13pt;
            margin-bottom: 20px;
            border-bottom: 1px solid #EAEAEA;
            padding-bottom: 5px;
        }
        .sig-line {
            width: 100%;
            height: 80px;
            margin-bottom: 5px;
        }
        .signature-img {
            max-width: 200px;
            max-height: 70px;
        }
        .sig-name {
            font-weight: bold;
            color: #0B0B0B;
            font-size: 11pt;
            padding-top: 5px;
            border-top: 1px solid #EAEAEA;
        }
        .stamp {
            color: #C8A951;
            font-family: 'Times New Roman', Times, serif;
            font-size: 14pt;
            font-style: italic;
            border: 2px solid #C8A951;
            display: inline-block;
            padding: 10px 20px;
            border-radius: 4px;
            transform: rotate(-5deg);
        }
        .footer {
            text-align: center;
            font-size: 9pt;
            color: #888888;
            border-top: 1px solid #EAEAEA;
            padding-top: 10px;
        }
        .clear { clear: both; }
    </style>
</head>
<body>

    <htmlpageheader name="page-header"></htmlpageheader>

    <div class="header-box">
        <h1 class="company-logo">iFuture Hub</h1>
        <p class="company-tagline">Premium Digital Investment Platform</p>
    </div>

    <div class="contract-title">
        <h2>Equity Investment Agreement</h2>
    </div>

    <div class="date-section">
        This Investment Agreement ("Agreement") is made on <strong>{{ $DATE }}</strong>, by and between:
    </div>

    <div class="party-card">
        <div class="party-card-title">Company:</div>
        <div class="party-details">
            <strong>{{ $COMPANY_NAME }}</strong><br>
            A technology company specializing in digital platforms, software solutions, and SaaS systems.<br>
            Represented by: <strong>{{ $FOUNDER_NAME }}</strong><br>
            <em>Hereinafter referred to as "the Company"</em>
        </div>
    </div>

    <div class="party-card">
        <div class="party-card-title">Investor:</div>
        <div class="party-details">
            Name: <strong>{{ $INVESTOR_NAME }}</strong><br>
            ID / Passport: <strong>{{ $INVESTOR_ID }}</strong><br>
            <em>Hereinafter referred to as "the Investor"</em>
        </div>
    </div>

    <div class="clause" style="text-align: center; font-style: italic; margin-top: 30px;">
        The Company and the Investor shall collectively be referred to as "the Parties".
    </div>

    <div class="section-header">1. Purpose of the Agreement</div>
    <div class="clause">
        The Investor agrees to invest in the following project developed and operated by the Company:<br><br>
        <strong>{{ $PROJECT_NAME }}</strong><br><br>
        The project is a digital system / platform operating in the field of: <em>{{ $PROJECT_DESCRIPTION }}</em>, and is fully owned, managed, and operated by iFuture LLC.
    </div>

    <div class="section-header">2. Investment Amount and Equity</div>
    <div class="clause">
        The Investor agrees to invest the total amount of:
        <div class="highlight-box">
            <span>{{ number_format($INVESTMENT_AMOUNT, 2) }} {{ $CURRENCY }}</span>
        </div>
        in exchange for an equity ownership of:
        <div class="highlight-box">
            <span>{{ $SHARES_PERCENTAGE }} %</span>
        </div>
        in the project specified above.
    </div>

    <div class="section-header">3. Ownership Rights</div>
    <div class="clause">
        The Investor's equity ownership grants the following rights:
        <div class="list-item">Participation in project profits proportional to the ownership percentage.</div>
        <div class="list-item">Access to periodic project performance and financial reports.</div>
        <div class="list-item">The right to transfer or sell shares subject to Company approval.</div>
        <br>
        The Investor acknowledges that ownership does not grant operational control of the project.
    </div>

    <div class="section-header">4. Project Management</div>
    <div class="clause">
        The management, development, operation, and strategic direction of the project shall remain under the full authority of iFuture LLC.<br><br>
        This includes decisions related to:
        <div class="list-item">Technology development</div>
        <div class="list-item">Marketing and sales strategies</div>
        <div class="list-item">Partnerships and integrations</div>
        <div class="list-item">Operational and business decisions</div>
    </div>

    <div class="section-header">5. Annual Profit Distribution</div>
    <div class="clause">
        The Company agrees that net profits generated by the project will be distributed annually to investors.<br><br>
        Profit distribution shall be calculated according to the Investor's ownership percentage and shall take place once per fiscal year, following the completion of financial reporting and accounting review.
    </div>

    <!-- Ensure remaining content and signature block don't break across pages ungracefully -->
    <div style="page-break-inside: avoid;">
        <div class="section-header">6. Protection, Risk, and Confidentiality</div>
        <div class="clause">
            <div class="list-item"><strong>Transparency:</strong> The Company agrees to provide annual financial reports and project performance summaries.</div>
            <div class="list-item"><strong>Investor Protection:</strong> The Investor's ownership percentage will be respected and recorded in the Company's internal equity registry.</div>
            <div class="list-item"><strong>Risk Acknowledgment:</strong> The Investor understands that investments in technology projects may involve financial risk. The Company commits to operating professionally to maximize growth.</div>
            <div class="list-item"><strong>Confidentiality:</strong> The Investor agrees not to disclose any confidential business, technical, or financial information related to the Company or the project.</div>
        </div>

        <div class="section-header">7. Electronic Signature & Compliance</div>
        <div class="clause">
            The Parties agree that electronic signatures executed through the Company's digital platform shall be legally binding and equivalent to handwritten signatures. This Agreement shall be governed by the applicable laws and regulations relevant to the jurisdiction in which iFuture LLC operates.
        </div>

        <div class="signatures-area">
            <div class="sig-column">
                <div class="sig-title">For the Company</div>
                <div class="sig-line" style="padding-top: 15px;">
                    <div class="stamp">Approved by iFuture LLC</div>
                </div>
                <div class="sig-name">
                    Authorized Digital Stamp<br>
                    <span style="font-weight: normal; font-size: 10pt; color: #888;">Date: {{ $DATE }}</span>
                </div>
            </div>

            <div class="sig-column right">
                <div class="sig-title">The Investor</div>
                <div class="sig-line">
                    @if($DIGITAL_SIGNATURE)
                        <img src="{{ $DIGITAL_SIGNATURE }}" class="signature-img" alt="Investor Signature">
                    @endif
                </div>
                <div class="sig-name">
                    {{ $INVESTOR_NAME }}<br>
                    <span style="font-weight: normal; font-size: 10pt; color: #888;">Date: {{ $DATE }}</span>
                </div>
            </div>
            <div class="clear"></div>
        </div>
    </div>

    <htmlpagefooter name="page-footer">
        <div class="footer">
            Confidential & Legally Binding Agreement | iFuture LLC | Investor Ref: {{ $INVESTOR_ID }} | Page {PAGENO} of {nbpg}
        </div>
    </htmlpagefooter>

</body>
</html>
