<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            /* font-family: DejaVu Sans, sans-serif; */
            font-family: "Liberation Serif", "Times New Roman", Times, serif;
            font-size: 12px;
            color: #092F66;
            padding: 30px;
            background-color: #fff;
        }

        .page-wrapper {
            background: #ffffff;
            padding: 30px;
            border-radius: 8px;
        }

        /* ── Header ── */
        .report-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 3px;
            padding-bottom: 8px;
            /* border-bottom: 1px solid #092F66; */
            text-align: center;
           
        }

        .report-header h2 {
            font-size: 18px;
            color: #1B2A4A;
            font-weight: bold;
            letter-spacing: 0.7px;
            text-align: center;
        }

        .report-header h3 {
            font-size: 14px;
            color: #1B2A4A;
            font-weight: bold;
            letter-spacing: 0.7px;
            text-align: center;
            border-bottom: 1px solid #092F66;
            display: inline-block;

            
        }

        .report-header .subtitle {
            font-size: 13px;
            color: #1B2A4A;
            margin-top: 4px;
            text-align: center;
            font-weight: bold;

        }
        .report-header .subtitle2{
            font-size: 13px;
            color: #1B2A4A;
            margin-top: 4px;
            text-align: center;
        }       

        .report-date {
            font-size: 10px;
            color: #888;
            text-align: right;
        }

        /* ── Table ── */
        table {
            width: 100%;
            border-collapse: collapse;
        }

        thead tr {
            background-color: #063780;
            color: #ffffff;
        }

        thead th {
            padding: 11px 14px;
            text-align: left;
            font-size: 11px;
            font-weight: bold;
            letter-spacing: 0.1px;
            text-transform: uppercase;
            border: none;
        }

        thead th:first-child {
            border-left: 1px solid #063780;
            text-align: center;
        }

        tbody tr:nth-child(even) {
            background-color: #F2F4F5;
        }

        tbody tr:nth-child(odd) {
            background-color: #ffffff;
        }

        tbody tr {
            border-bottom: 1px solid #D2D3D6;
            transition: background 0.2s;
        }

        tbody td {
            padding: 6px 12px;
            font-size: 11px;
            color: #1B2A4A;
            border-right: 1px solid #dce8ea;
        }

        tbody td:last-child {
            border-right: none;
        }

        /* ── ICNO column highlight ── */
        tbody td:first-child {
            background-color: #EDEFF2;
            color: #092F66;
            font-weight: bold;
            text-align: center;
        }

        /* ── Outer table border ── */
        .table-wrapper {
            border: 1px solid #063780;
            border-radius: 6px;
            overflow: hidden;
        }

        /* ── Empty cell placeholder ── */
        .empty-cell {
            color: #aaa;
            font-style: italic;
        }

        /* ── Footer ── */
        .report-footer {
            margin-top: 20px;
            padding-top: 12px;
            border-top: 1px solid #B0D4DA;
            font-size: 10px;
            color: #888;
            text-align: center;
            font-style: italic;
        }

        /* ── Row count badge ── */
        .row-count {
            font-size: 10px;
            color: #0000CD;
            margin-top: 10px;
            text-align: right;
        }
        .smclearrow {
           padding : 5px;
        }
        .label {
            padding: 5px 10px;
            font-size: 14px;
            color: #1B2A4A;
            border-right: 1px solid #dce8ea;
            white-space: pre;
        }
    </style>
</head>
<body>
    <div class="page-wrapper">

        {{-- Header --}}
        <div class="report-header">
            <div>
                <h2>THE INSTITUTE OF MATHEMATICAL SCIENCES</h2>
                <div class="subtitle">(An Autonomous Institution, Under Dept. of Atomic Energy,Govt. of India)</div>
                <div class="subtitle2">4<sup>th</sup> Cross Road, CIT Campus Taramani, Chennai - 600113</div>
            </div>
            <!-- <div class="report-date">
                Generated: {{ \Carbon\Carbon::now()->format('d M Y, h:i A') }}
            </div> -->
        </div>
        <div class="report-header">
            <h3>APPLICATION FOR NEW IDENTITY CARD</h3>
        </div>
        
        <div class="row smclearrow"></div>
        <div class="div2 label">01. Employee / Academician Code No. :</div> 
        
        <div class="row smclearrow"></div>
        <div class="div2 label">02. Name (In BLOCK LETTERS) :</div> 
        <div class="row smclearrow"></div>
        <div class="div2 label">03. Date of Birth :</div> 
        <div class="row smclearrow"></div>
        <div class="div2 label">04. Email Id & Mobile Number:</div> 
        <div class="row smclearrow"></div>
        <div class="div2 label">05. Date of Appoinment/ Admission/ Commencement of Visit:</div> 
        <div class="row smclearrow"></div>
        <div class="div2 label">06. Regular Position/ Visiting Position :</div> 
        <div class="row smclearrow"></div>
        <div class="div2 label">07. Designation/Position</br>(in case in case of regular position):</div> 
        <div class="row smclearrow"></div>
        <div class="div2 label">08. In Case it is Visiting position indicate category of visit:</div>
        <div class="row smclearrow"></div>
        <div class="div2 label">09. Subject / Discipline:</div> 
        <div class="row smclearrow"></div>
        <div class="div2 label">10. Please Indicate period of approved visit in case of visiting position :     From :     To:</div> 
        <div class="row smclearrow"></div>
        <div class="div2 label">11. Name of the faculty guide/ Host Faculty:</div> 
        <div class="row smclearrow"></div>
        <div class="div2 label">12. Blood Group:</div> 
        <div class="row smclearrow"></div>
        <div class="div2 label">13. Identification Marks:</div> 
         <div class="row smclearrow"></div>
        <div class="div2 label">14. Purpose:</div>
        <div class="row smclearrow"></div>
        <div class="div2 label">15. Purpose:</div> 
        <div class="row smclearrow"></div>
        <div class="div2 label">16. Purpose:</div>
        <div class="row smclearrow"></div>
        <div class="div2 label">17. Purpose:</div> 
   
        {{-- Footer --}}
        <div class="report-footer">
            This is a system-generated document. — IMSc Employee Directory
        </div>

    </div>
</body>
</html>
