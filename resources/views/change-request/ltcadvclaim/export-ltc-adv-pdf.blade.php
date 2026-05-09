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
                <!-- <div class="subtitle">(An Autonomous Institution, Under Dept. of Atomic Energy,Govt. of India)</div>
                <div class="subtitle2">4<sup>th</sup> Cross Road, CIT Campus Taramani, Chennai - 600113</div> -->
            </div>
            <!-- <div class="report-date">
                Generated: {{ \Carbon\Carbon::now()->format('d M Y, h:i A') }}
            </div> -->
        </div>
        <div class="report-header">
            <h3>Application Form for Grant LTC Advance</h3>
        </div>
        
        <div class="row smclearrow"></div>
        <div class="div2 label">1. Name of the Staff:</div> 
        
        <div class="row smclearrow"></div>
        <div class="div2 label">2. Designation:</div> 
        <div class="row smclearrow"></div>
        <div class="div2 label">3. Date of entering the services:</div> 
        <div class="row smclearrow"></div>
        <div class="div2 label">4. Pay Band :</div> 
        <div class="row smclearrow"></div>
        <div class="div2 label">5. Present Basic Pay + Grade Pay:</div> 
        <div class="row smclearrow"></div>
        <div class="div2 label">6. Whether wife/husband is employed and if so whether entitled to LTC :</div> 
        <div class="row smclearrow"></div>
        <div class="div2 label">7. Home Town as recorded in the Service Book:</div> 
        <div class="row smclearrow"></div>
        <div class="div2 label">8. Whether wife/husband is employed and if so whether entitled to Ltc:</div>
        <div class="row smclearrow"></div>
        <div class="div2 label">9. whether the concession is to be availed for visiting home town and if so, block for which LTC is to be availed:</div> 
        <div class="row smclearrow"></div>
        <div class="div2 label">10.(a) If the concession is to visit "Anywhere in India" the place to visited:</div> 
        <div class="row smclearrow"></div>
        <div class="div2 label">10.(b) Block for which to be availed:</div> 
        <div class="row smclearrow"></div>
        <div class="div2 label">11. Single rail/bus/air fare from the Headquarters to Hometown to visit by shortest route:</div> 
        <div class="row smclearrow"></div>
        <div class="div2 label">12.Probable date of journey:</div> 
        <div class="row smclearrow"></div>
        <div class="div2 label">13. Probable/Actual Leave Period & Nature of Leave:</div> 
         <div class="row smclearrow"></div>
        <div class="div2 label">14. Persons in respect of whom LTC is proposed to be availed</div>
        <div class="row smclearrow"></div>
        <div class="table-wrapper">
            <table>
                <thead>
                    <tr>
                        <th>SI. No.</th>
                        <th>Name & Age</th>
                        <th>Date of Birth</th>
                        <th>Relationship to the staff Member</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                  
                  
                </tbody>
            </table>
        </div>
       
        {{-- Footer --}}
        <div class="report-footer">
            This is a system-generated document. — IMSc Employee Directory
        </div>

    </div>
</body>
</html>
