
{{-- pre select district and upazila and post office --}}
<script>

    var dis_id = +"{{auth()->user()->relationBetweenUnion->district_id}}";
    var upa_id = +"{{auth()->user()->relationBetweenUnion->upazila_id}}";
    var post_id = +"{{auth()->user()->relationBetweenUnion->postal_id}}";

    $(document).ready(function() {
        if( !(+"{{auth()->user()->relationBetweenUnion->pre_select}}") )
        {
            return;
        }
        
        /* // district */
        setTimeout(function() {
            
            let par_dis = $("#permanent_district_id");
            let per_dis_opts = $(par_dis).find('option');

            for (let index = 0; index < per_dis_opts.length; index++) {
                const el = per_dis_opts[index];
                if (+($(el).val()) == dis_id) {
                    $(el).attr('selected', 'selected');
                }
            }
            

            $('#present_district_id option').each(function(i, el) {
                if ($(el).val() == dis_id) {
                    $(el).attr('selected', "selected");
                }
            });

            /* // select 2 initialize */
            $("#permanent_district_id").select2();
            $("#present_district_id").select2();

        }, 1500);

        /* // upazila */
        getLocation(dis_id, 'permanent_district', 'permanent_upazila_append', 'permanent_upazila_id',
            'permanent_upazila', 3);
        getLocation(dis_id, 'present_district', 'present_upazila_append', 'present_upazila_id', 'present_upazila',
            3);

        setTimeout(function() {

            $('#present_upazila_id option').each(function(i, el) {
                if ($(el).val() == upa_id) {
                    $(el).attr('selected', "selected");
                    getLocation(upa_id, 'present_upazila', 'present_post_office_append',
                        'present_postoffice_id', 'present_postoffice', 6);
                }
            });

            $('#permanent_upazila_id option').each(function(i, el) {
                if ($(el).val() == upa_id) {
                    $(el).attr('selected', "selected");
                    getLocation(upa_id, 'permanent_upazila', 'permanent_post_office_append',
                        'permanent_postoffice_id', 'permanent_postoffice', 6);
                }
            });

            /* // post office */
            setTimeout(() => {
                $('#present_postoffice_id option').each(function(i, el) {
                    if ($(el).val() == post_id) {
                        $(el).attr('selected', "selected");
                        getLocation(post_id, 'present_postoffice');
                    }
                });

                $('#permanent_postoffice_id option').each(function(i, el) {
                    
                    if ($(el).val() == post_id) {
                        $(el).attr('selected', "selected");
                        getLocation(post_id, 'permanent_postoffice');
                    }
                });
            }, 700);

        }, 1500);
    });

</script>
