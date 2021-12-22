<style type="text/css" media="all">

    body {
        font-family: 'bangla', sans-serif !important;
        font-size: 14px;
    }

    @media print {
        * {
            -webkit-print-color-adjust: exact;
        }
    }

    @page {
        header: page-header;
        footer: page-footer;
        margin: 0px;
        padding: 0px;

    }


    @media print {
        body {
            font-size: 14px !important;
            font-family: 'bangla', sans-serif !important;
        }

    }

    @php


        $border_image = "";
        $CertificatHeaderMargin = (!empty($type))? "50px":"3px";

        if(!empty($type)){

            switch ($type){
                case 1 :
                    $border_image = "nagorik_border_pdf.png";
                    break;
               /* case 5 :
                    $border_image = "prottyon_border_pdf.png";
                    break; */
                case 7 :
                    $border_image = "prottyon_border_pdf.png";
                    break;
               default:
                    $border_image = "boder_pdf.png";
            }
        }

        @endphp

    .page-border {
        padding-top: 15px;
        padding-right: 10px;
        margin-right: 10px;

      @if(! $print_setting->pad_print  )

        background-image: url("{{asset('images/'.$border_image)}}");
        background-repeat: no-repeat;
        background-size: 100%;
        height: 1400px;
    @endif



    }


    #certificate_header{
        margin-top: {{$CertificatHeaderMargin}};
    }
</style>
