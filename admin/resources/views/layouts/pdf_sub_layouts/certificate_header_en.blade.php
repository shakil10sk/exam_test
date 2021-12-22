<table border="0px" width="98%" align="center" style="border-collapse:collapse; margin:2px auto; padding-top: 50px">
    <tr>
        <td style="width:1.5in; text-align:center;"><img src="{{ asset('images/union_profile/'.$union->main_logo) }}" height="100px" width="100px" /></td>

        <td style="text-align:center;">
            <font style="font-size:25px; font-weight:bold; color:blue;">{{ $union->en_name }}</font>

            <br />

            <font style="font-size:16px; font-weight:bold;">
                {{ $union->union_upazila_name_en }}, {{ $union->union_district_name_en }}<br>
                
                {{-- {{ $union->village_en }}, {{ $union->union_upazila_name_en }}, {{ $union->union_district_name_en }}-{{ $union->postal_code }}<br>

                Mobile:{{ $union->mobile }}, Email: {{ $union->email }} <br> --}}
                
                Email: {{ $union->email }} <br>

                Website: {{ $url }}
            </font>

        </td>

        <td style="width:1.2in; text-align:left;">

            <img src="{{ asset('images/union_profile/'.$union->brand_logo) }}" height="100px" width="100px" style="position:relative;right:10px;" />

        </td>

    </tr>
</table>