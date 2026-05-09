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
            font-family: DejaVu Sans, sans-serif;
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
            margin-bottom: 24px;
            padding-bottom: 16px;
            border-bottom: 1px solid #092F66;
        }

        .report-header h2 {
            font-size: 20px;
            color: #1B2A4A;
            font-weight: bold;
            letter-spacing: 0.5px;
        }

        .report-header .subtitle {
            font-size: 11px;
            color: #092F66;
            margin-top: 4px;
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
    </style>
</head>
<body>
    <div class="page-wrapper">

        {{-- Header --}}
        <div class="report-header">
            <div>
                <h2>Employee Directory</h2>
                <div class="subtitle">Institute of Mathematical Sciences (IMSc) — Staff Listing</div>
            </div>
            <div class="report-date">
                Generated: {{ \Carbon\Carbon::now()->format('d M Y, h:i A') }}
            </div>
        </div>

        {{-- Table --}}
        <div class="table-wrapper">
            <table>
                <thead>
                    <tr>
                        <th>ICNO</th>
                        <th>Employee Name</th>
                        <th>Group</th>
                        <th>Division</th>
                        <th>Section</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($EmpData as $EmpDataValue)
                    <tr>
                        <td>{{ $EmpDataValue->emp_no }}</td>
                        <td>{{ $EmpDataValue->emp_name_payslip }}</td>
                        <td>{{ $EmpDataValue->group ?? '—' }}</td>
                        <td>{{ $EmpDataValue->division ?? '—' }}</td>
                        <td>{{ $EmpDataValue->section ?? '—' }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="empty-cell" style="text-align:center; padding: 20px;">
                            No employee records found.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Row count --}}
        <div class="row-count">Total Records: {{ count($EmpData) }}</div>

        {{-- Footer --}}
        <div class="report-footer">
            This is a system-generated document. — IMSc Employee Directory
        </div>

    </div>
</body>
</html>
