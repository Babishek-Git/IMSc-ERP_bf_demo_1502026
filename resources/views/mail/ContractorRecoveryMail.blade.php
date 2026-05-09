<!DOCTYPE html>
<html>
<head>
    <title>Bill Recovery Statment</title>
    <style>
        .SpanBox {
            border: 1px solid #000;
            padding: 4px 8px;
            border-radius: 8px;
            margin: 2px;
            display: inline-block;
        }
        .SpanBoxTag {
            background-color: #CD066C;
            padding: 2px 5px;
            border-radius: 8px;
            color: #fff;
        }
    </style>
</head>
<body>
    <h2>Bill Recovery Statment</h2>
    <table>
        <tr>
            <td width='200px'>Name Of Work:</td>
            <td>{{ $WorkName }}</td>
        </tr>
        <tr>
            <td width='200px'>RAB No.:</td>
            <td>{{ $rbn }}</td>
        </tr>
        <tr>
            <td width='200px'>Contractor Name:</td>
            <td>{{ $ConTractorName }}</td>
        </tr>
        <tr>
            <td width='200px'>Bill Amount:</td>
            <td><span class="rupee">&#8377;</span> {{ \Helper::IndianRupeesFormat($BillValue) }}</td>
        </tr>
    </table>
    <h3>RECOVERIES</h3>
    <table>
        @php 
        $mergedArray = json_decode($mergedArray, true);
        $ThisBillRecDataArr = json_decode($ThisBillRecDataArr, true);
        $RecPercArr = json_decode($RecPercArr, true);
        @endphp
        @foreach ($mergedArray as $Key => $Value)
            @php
                $ThisAmount = $ThisBillRecDataArr[$Key] ?? 0;
            @endphp
            <tr>
                <td width='200px'>{{ $Value }} @if(isset($RecPercArr[$Key])) @ {{ $RecPercArr[$Key] }}% @endif</td>
                <td><span class="rupee">&#8377;</span> {{ \Helper::IndianRupeesFormat($ThisAmount) }}</td>
            </tr>
        @endforeach
    </table>
    <h4>NET PAYABLE:&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&nbsp;&nbsp;&nbsp;<span class="rupee">&#8377;</span> {{ \Helper::IndianRupeesFormat($NetPayable) }}</h4>
</body>
</html>
