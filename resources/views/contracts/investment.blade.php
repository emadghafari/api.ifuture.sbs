<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <title>Investment Agreement</title>
    <style>
        @page {
            header: page-header;
            footer: page-footer;
            margin-top: 50px;
            margin-bottom: 50px;
            margin-left: 40px;
            margin-right: 40px;
        }
        body {
            font-family: Arial, Helvetica, sans-serif;
            font-size: 13pt;
            color: #1f2937;
            line-height: 1.8;
            margin: 0;
            padding: 0;
        }
        .header-logo {
            text-align: center;
            margin-bottom: 20px;
        }
        .header-logo h1 {
            color: #047857;
            font-size: 26pt;
            font-weight: 900;
            margin: 0;
            letter-spacing: -1px;
        }
        .header-logo p {
            color: #6b7280;
            font-size: 10pt;
            margin-top: 5px;
        }
        .contract-title {
            text-align: center;
            background-color: #f3f4f6;
            padding: 15px;
            margin: 25px 0;
            border-radius: 6px;
            border-bottom: 3px solid #059669;
        }
        .contract-title h2 {
            margin: 0;
            font-size: 20pt;
            color: #111827;
        }
        .date-badge {
            text-align: left;
            font-size: 11pt;
            color: #4b5563;
            margin-bottom: 25px;
        }
        .preamble {
            text-align: justify;
            margin-bottom: 30px;
            font-size: 13pt;
            background-color: #ffffff;
            border-right: 4px solid #059669;
            padding-right: 15px;
        }
        .parties-box {
            border: 2px solid #e5e7eb;
            border-radius: 8px;
            padding: 15px;
            margin-bottom: 25px;
        }
        .party-title {
            font-weight: bold;
            color: #374151;
            background-color: #f9fafb;
            padding: 10px;
            border-bottom: 1px solid #e5e7eb;
            margin: -15px -15px 15px -15px;
            border-radius: 8px 8px 0 0;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        td {
            padding: 6px 0;
            vertical-align: top;
        }
        td.label {
            width: 120px;
            font-weight: bold;
            color: #6b7280;
            font-size: 12pt;
        }
        td.value {
            font-weight: bold;
            color: #111827;
        }
        .section-header {
            font-size: 15pt;
            font-weight: bold;
            color: #111827;
            border-bottom: 2px solid #10b981;
            padding-bottom: 5px;
            margin-top: 30px;
            margin-bottom: 15px;
            display: inline-block;
        }
        .clause {
            margin-bottom: 15px;
            text-align: justify;
        }
        .highlight {
            background-color: #ecfdf5;
            color: #065f46;
            padding: 2px 6px;
            border-radius: 4px;
            font-weight: bold;
        }
        .signatures {
            margin-top: 40px;
            width: 100%;
        }
        .sig-block {
            width: 45%;
            float: right;
            border: 2px dashed #d1d5db;
            padding: 15px;
            text-align: center;
            border-radius: 8px;
            background-color: #ffffff;
            min-height: 140px;
        }
        .sig-block.left {
            float: left;
        }
        .sig-title {
            font-weight: bold;
            color: #374151;
            margin-bottom: 10px;
            border-bottom: 1px solid #e5e7eb;
            padding-bottom: 10px;
        }
        .stamp {
            color: #10b981;
            font-weight: bold;
            font-size: 13pt;
            margin-top: 20px;
            border: 2px solid #10b981;
            display: inline-block;
            padding: 5px 15px;
            border-radius: 4px;
            transform: rotate(-3deg);
        }
        .signature-img {
            max-width: 180px;
            max-height: 70px;
            margin-top: 10px;
        }
        .footer {
            text-align: center;
            color: #9ca3af;
            font-size: 9pt;
            border-top: 1px solid #e5e7eb;
            padding-top: 10px;
        }
        .clear { clear: both; }
    </style>
</head>
<body>

    <htmlpageheader name="page-header">
    </htmlpageheader>

    <div class="header-logo">
        <h1>iFuture Hub</h1>
        <p>المنصة الرائدة للاستثمار في المشاريع الرقمية والتقنية</p>
    </div>

    <div class="contract-title">
        <h2>وثيقة اتفاقية استثمار وشراكة إلكترونية</h2>
    </div>

    <div class="date-badge">
        <strong>تاريخ ومُعرف الإبرام:</strong> {{ $DATE }}
    </div>

    <div class="preamble">
        بعون الله وتوفيقه، تم إبرام هذه الاتفاقية الاستثمارية المُلزمة بين الطرفين المذكورين أدناه، وفقاً للأنظمة واللوائح المنظمة للشراكات والمحافظ الرقمية:
    </div>

    <div class="parties-box">
        <div class="party-title">الطرف الأول (مدير المشروع والمنصة)</div>
        <table>
            <tr>
                <td class="label">الكيان / المنصة:</td>
                <td class="value">{{ $COMPANY_NAME }}</td>
            </tr>
            <tr>
                <td class="label">الممثل القانوني:</td>
                <td class="value">{{ $FOUNDER_NAME }}</td>
            </tr>
        </table>
    </div>

    <div class="parties-box">
        <div class="party-title">الطرف الثاني (المستثمر / الشريك المالي)</div>
        <table>
            <tr>
                <td class="label">الاسم الكامل:</td>
                <td class="value">{{ $INVESTOR_NAME }}</td>
            </tr>
            <tr>
                <td class="label">رقم المستثمر:</td>
                <td class="value"><span dir="ltr">{{ $INVESTOR_ID }}</span></td>
            </tr>
        </table>
    </div>

    <div class="section-header">البند الأول: موضوع الشراكة</div>
    <div class="clause">
        يقر الطرف الثاني (المستثمر) الموافقة التامة على الاستثمار ودخول الشراكة في مشروع <strong>"{{ $PROJECT_NAME }}"</strong>، وهو كيان يهدف إلى:
        <br>
        <div style="color: #4b5563; font-style: italic; margin-top: 10px;">{{ $PROJECT_DESCRIPTION }}</div>
        <br>
        ويكون هذا المشروع تحت الإدارة والتشغيل التقني والمالي الحصري للطرف الأول.
    </div>

    <div class="section-header">البند الثاني: الحصة المالية والنسبة المُستحقة</div>
    <div class="clause">
        قام الطرف الثاني بنجاح بتمويل حصته المقدرة بقيمة <span class="highlight">{{ number_format($INVESTMENT_AMOUNT, 2) }} {{ $CURRENCY }}</span> في ميزانية المشروع. 
        بموجب هذا التمويل، يستحق الطرف الثاني ملكية نسبة تبلغ <span class="highlight">{{ $SHARES_PERCENTAGE }} %</span> من إجمالي أسهم وعوائد المشروع طيلة فترة الشراكة المعتمدة.
    </div>

    <div class="section-header">البند الثالث: الصلاحيات وتوزيع العوائد</div>
    <div class="clause">
        <ul style="margin-top: 5px;">
            <li style="margin-bottom: 8px;"><strong>العوائد المالية:</strong> يتم توزيع وتخصيص الأرباح الناتجة عن المشروع دورياً للمستثمر بما يعادل نسبة ملكيته، وتُضاف كرصيد قابل للسحب في محفظته بالمنصة.</li>
            <li style="margin-bottom: 8px;"><strong>فترة الإقفال (Lock-in):</strong> لا يحق للمستثمر المطالبة بتصفية أو استرداد أصل رأس المال المُستثمر قبل انقضاء فترة تعادل <strong>{{ $LOCK_PERIOD }}</strong> من تاريخ توقيع هذا العقد.</li>
            <li style="margin-bottom: 8px;"><strong>الإدارة الفنية:</strong> يحتفظ الطرف الأول بحق الإدارة، التطوير، تعديل الخطط الاستراتيجية، وإقرار الميزانيات بما يضمن تحقيق مصالح جميع الشركاء.</li>
        </ul>
    </div>

    <div class="section-header">البند الرابع: التوقيع والإلزام القانوني</div>
    <div class="clause">
        تمت قراءة هذا العقد والموافقة عليه إلكترونياً من قبل الطرفين. ويُعد هذا العقد الممهور بالتوقيع الإلكتروني مُعتمداً، ونسخة منه محفوظة آلياً ومشفّرة بقاعدة بيانات المنصة، وتُعتد بها كوثيقة قانونية تامة الإثبات.
    </div>

    <div class="signatures">
        <div class="sig-block">
            <div class="sig-title">الطرف الأول (اعتماد المنصة)</div>
            <div class="stamp">✅ مُعتمَد رسمياً</div>
            <p style="margin-top: 15px; font-size: 10pt; color: #6b7280; font-weight: bold;">إدارة منصة iFuture Hub</p>
        </div>

        <div class="sig-block left">
            <div class="sig-title">الطرف الثاني (إمضاء المستثمر)</div>
            @if($DIGITAL_SIGNATURE)
                <img src="{{ $DIGITAL_SIGNATURE }}" class="signature-img" alt="توقيع المستثمر">
                <p style="margin-top: 5px; font-size: 9pt; color: #10b981; font-weight: bold;">تمت المطابقة والمُصادقة</p>
            @else
                <div style="height: 80px; line-height: 80px; color: #9ca3af; font-size: 10pt;">(بدون توقيع)</div>
            @endif
            <p style="margin-top: 5px; font-size: 11pt; font-weight: bold; color: #111827;">{{ $INVESTOR_NAME }}</p>
        </div>
        <div class="clear"></div>
    </div>

    <htmlpagefooter name="page-footer">
        <div class="footer">
            وثيقة إلكترونية سرية - iFuture Hub - وثيقة تامة الإثبات - المعرف: {{ $INVESTOR_ID }} - الصفحة {PAGENO} من {nbpg}
        </div>
    </htmlpagefooter>

</body>
</html>
