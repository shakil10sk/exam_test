<table align="center" border="0px" style="border-collapse:collapse; margin:2px auto; padding-top: 50px" width="98%">
    <tr>
        <td style="width:1.5in; text-align:center;">
            <img height="100px" src="{{ asset('images/union_profile/'.$union->main_logo) }}" width="100px"/>
        </td>
        <td style="text-align:center;">
            <font style="font-size:25px; font-weight:bold; color:blue;">
                {{ $union->bn_name }}
            </font>
            <br/>
            <font style="font-size:16px; font-weight:bold;">
                {{ $union->union_upazila_name_bn }}, {{ $union->union_district_name_bn }}
                {{-- {{ $union->village_bn }}, {{ $union->union_upazila_name_bn }}, {{ $union->union_district_name_bn }}-{{ BanglaConverter::bn_number($union->postal_code) }} --}}
                <br>
                    ই-মেইলঃ {{ $union->email }}
                    {{-- মোবাইলঃ{{ BanglaConverter::bn_number($union->mobile) }}, ই-মেইলঃ {{ $union->email }} --}}
                    <br>
                    @if (env('APP_TYPE') == 'single')
                        ওয়েব সাইট : {{ env('WEB_URL') }}
                    @else
                        ওয়েব সাইট : {{ $url }}
                    @endif
                    <br>
                <br>
            </font>
        </td>
        <td style="width:1.2in; text-align:left;">
            @if(!empty($union->brand_logo))
            <img height="100px" src="{{ asset('images/union_profile/'.$union->brand_logo) }}" style="position:relative;right:10px;" width="100px"/>
            @endif
        </td>
    </tr>
</table>