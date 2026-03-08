<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <title>Investment Agreement</title>
    <style>
        body {
            font-family: 'DejaVu Sans', sans-serif;
            font-size: 14px;
            color: #333;
            line-height: 1.6;
            margin: 0;
            padding: 40px;
        }
        .header {
            text-align: center;
            border-bottom: 2px solid #000;
            padding-bottom: 20px;
            margin-bottom: 30px;
        }
        .header h1 {
            color: #1a202c;
            margin: 0 0 10px 0;
        }
        .section-title {
            font-weight: bold;
            font-size: 16px;
            color: #2d3748;
            margin-top: 30px;
            text-decoration: underline;
        }
        .info-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        .info-table td {
            padding: 10px;
            border: 1px solid #e2e8f0;
        }
        .info-table td:first-child {
            font-weight: bold;
            background-color: #f7fafc;
            width: 30%;
        }
        .signature-section {
            margin-top: 60px;
            width: 100%;
        }
        .signature-box {
            width: 45%;
            float: right; /* RTL context */
            text-align: center;
        }
        .signature-box.left {
            float: left;
        }
        .signature-img {
            max-width: 250px;
            max-height: 100px;
            border-bottom: 1px solid #000;
            padding-bottom: 10px;
            margin-top: 20px;
        }
        .clear {
            clear: both;
        }
    </style>
</head>
<body>

    <div class="header">
        <h1>نموذج اتفاقية استثمار ومشاركة</h1>
        <p>تاريخ الإبرام: <strong>{{ $DATE }}</strong></p>
    </div>

    <p>تم إبرام هذه الاتفاقية بين كل من:</p>

    <div class="section-title">الطرف الأول (مدير المشروع)</div>
    <table class="info-table">
        <tr>
            <td>الشركة / المشروع:</td>
            <td>{{ $COMPANY_NAME }}</td>
        </tr>
        <tr>
            <td>الممثل القانوني:</td>
            <td>{{ $FOUNDER_NAME }}</td>
        </tr>
    </table>

    <div class="section-title">الطرف الثاني (المستثمر)</div>
    <table class="info-table">
        <tr>
            <td>اسم المستثمر:</td>
            <td>{{ $INVESTOR_NAME }}</td>
        </tr>
        <tr>
            <td>رقم الهوية / الحساب:</td>
            <td>{{ $INVESTOR_ID }}</td>
        </tr>
    </table>

    <div class="section-title">1. موضوع الاتفاقية</div>
    <p>
        يوافق المستثمر على الاستثمار في مشروع <strong>{{ $PROJECT_NAME }}</strong>، وهو نظام / منصة رقمية تعنى بـ: 
        <br>
        <em>{{ $PROJECT_DESCRIPTION }}</em>
        <br>
        ويتم تطويره وإدارته من قبل الطرف الأول.
    </p>

    <div class="section-title">2. قيمة الاستثمار وملكية الأسهم</div>
    <p>
        قام المستثمر بدفع مبلغ <strong>{{ number_format($INVESTMENT_AMOUNT, 2) }} {{ $CURRENCY }}</strong> 
        بنجاح، ومقابل ذلك يحصل على <strong>{{ $SHARES_PERCENTAGE }} %</strong> من إجمالي أسهم المشروع المذكور.
    </p>

    <div class="section-title">3. الحقوق والواجبات المتبادلة</div>
    <ul>
        <li>يمتلك المستثمر الحق الكامل في المشاركة في الأرباح التي يدرها المشروع دورياً وفق نسبة أسهمه.</li>
        <li>الاطلاع على التقارير المالية والتحليلات الخاصة بالمشروع.</li>
        <li>يتولى مدير المشروع (الطرف الأول) إدارة وتشغيل المشروع كلياً واتخاذ القرارات الاستراتيجية بما يخدم مصلحة الكيان.</li>
    </ul>

    <div class="section-title">4. توزيع الأرباح وتسييل الأسهم</div>
    <p>
        يتم توزيع الأرباح دورياً حسب نسبة الأسهم التي يمتلكها المستثمر وتضاف لمحفظته. 
        لا يمكن سحب قيمة الاستثمار الأصلي كسيولة فورية قبل انتهاء فترة الإقفال (Lock Period) وهي <strong>{{ $LOCK_PERIOD }}</strong>.
    </p>

    <div class="section-title">5. الإقرار والموافقة الإلكترونية</div>
    <p>
        يقر المستثمر باطلاعه على طبيعة المشروع وإدراكه لمخاطر الاستثمار الرقمي. ويوافق الطرفان على أن التوقيع الإلكتروني الظاهر أدناه عبر هذه المنصة هو توقيع ملزم قانونياً ولا يحتاج إلى تصديق ورقي إضافي.
    </p>

    <!-- Signatures -->
    <div class="signature-section">
        <div class="signature-box">
            <p><strong>توقيع الطرف الأول</strong><br>الشركة / مدير المشروع</p>
            <!-- Platform auto-stamp could go here -->
            <p style="margin-top: 30px; font-weight: bold; color: #4a5568">[ 🏛️ نظام iFuture المعتمد ]</p>
        </div>

        <div class="signature-box left">
            <p><strong>توقيع الطرف الثاني</strong><br>المستثمر: {{ $INVESTOR_NAME }}</p>
            @if($DIGITAL_SIGNATURE)
                <img src="{{ $DIGITAL_SIGNATURE }}" alt="Signature" class="signature-img">
            @else
                <div class="signature-img" style="height: 60px;"></div>
            @endif
        </div>
        <div class="clear"></div>
    </div>

</body>
</html>
