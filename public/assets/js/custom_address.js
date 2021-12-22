
var app_url = $('meta[name = url]').attr("content");

function locationCopy(from, to){
    var txt = $("#"+from).val();

    $("#"+to).val(txt);
}

// present district
$(function () {
    $("#present_district_txt").autocomplete({
        autoFocus: true,
        minLength: 0,
        source: function(req, response){
            $("#present_district").val('');
            $("#present_district_id").val('');

            $("#present_upazila").val('');
            $("#present_upazila_txt").val('');
            $("#present_upazila_id").val('');

            $("#present_postoffice").val('');
            $("#present_postoffice_txt").val('');
            $("#present_postoffice_id").val('');

            $.ajax({
                url: app_url + "/geo/searchLocation",
                dataType: "JSON",
                type: "GET",
                data: {term: req.term, type: 2, parent_id: null},
                success: function(data){
                    response($.map(data, function(item){
                        var dropdown = new Object();

                        dropdown.label = item.bn_name;
                        dropdown.value = item.bn_name;

                        dropdown.id = item.id;

                        return dropdown;
                    }));
                }
            });
        },
        select: function(event, ui){
            $("#present_district").val(ui.item.label);
            $("#present_district_id").val(ui.item.id);
        }
    });
});

// present upazila
$(function () {
    $("#present_upazila_txt").autocomplete({
        autoFocus: true,
        minLength: 0,
        source: function(req, response){
            $("#present_upazila").val('');
            $("#present_upazila_id").val('');

            $("#present_postoffice").val('');
            $("#present_postoffice_txt").val('');
            $("#present_postoffice_id").val('');

            var parent_id = $("#present_district_id").val();

            if(parent_id){
                $.ajax({
                    url: app_url + "/geo/searchLocation",
                    dataType: "JSON",
                    type: "GET",
                    data: {term: req.term, type: 3, parent_id: parent_id},
                    success: function(data){
                        response($.map(data, function(item){
                            var dropdown = new Object();

                            dropdown.label = item.bn_name;
                            dropdown.value = item.bn_name;

                            dropdown.id = item.id;

                            return dropdown;
                        }));
                    }
                });
            }
        },
        select: function(event, ui){
            $("#present_upazila").val(ui.item.label);
            $("#present_upazila_id").val(ui.item.id);
        }
    });
});

// present postoffice
$(function () {
    $("#present_postoffice_txt").autocomplete({
        autoFocus: true,
        minLength: 0,
        source: function(req, response){
            $("#present_postoffice").val('');
            $("#present_postoffice_id").val('');

            var parent_id = $("#present_upazila_id").val();

            if(parent_id){
                $.ajax({
                    url: app_url + "/geo/searchLocation",
                    dataType: "JSON",
                    type: "GET",
                    data: {term: req.term, type: 6, parent_id: parent_id},
                    success: function(data){
                        response($.map(data, function(item){
                            var dropdown = new Object();

                            dropdown.label = item.bn_name;
                            dropdown.value = item.bn_name;

                            dropdown.id = item.id;

                            return dropdown;
                        }));
                    }
                });
            }
        },
        select: function(event, ui){
            $("#present_postoffice").val(ui.item.label);
            $("#present_postoffice_id").val(ui.item.id);
        }
    });
});

// permanent district
$(function () {
    $("#permanent_district_txt").autocomplete({
        autoFocus: true,
        minLength: 0,
        source: function(req, response){
            $("#permanent_district").val('');
            $("#permanent_district_id").val('');

            $("#permanent_upazila").val('');
            $("#permanent_upazila_txt").val('');
            $("#permanent_upazila_id").val('');

            $("#permanent_postoffice").val('');
            $("#permanent_postoffice_txt").val('');
            $("#permanent_postoffice_id").val('');

            $.ajax({
                url: app_url + "/geo/searchLocation",
                dataType: "JSON",
                type: "GET",
                data: {term: req.term, type: 2, parent_id: null},
                success: function(data){
                    response($.map(data, function(item){
                        var dropdown = new Object();

                        dropdown.label = item.bn_name;
                        dropdown.value = item.bn_name;

                        dropdown.id = item.id;

                        return dropdown;
                    }));
                }
            });
        },
        select: function(event, ui){
            $("#permanent_district").val(ui.item.label);
            $("#permanent_district_id").val(ui.item.id);
        }
    });
});

// permanent upazila
$(function () {
    $("#permanent_upazila_txt").autocomplete({
        autoFocus: true,
        minLength: 0,
        source: function(req, response){
            $("#permanent_upazila").val('');
            $("#permanent_upazila_id").val('');

            $("#permanent_postoffice").val('');
            $("#permanent_postoffice_txt").val('');
            $("#permanent_postoffice_id").val('');

            var parent_id = $("#permanent_district_id").val();

            if(parent_id){
                $.ajax({
                    url: app_url + "/geo/searchLocation",
                    dataType: "JSON",
                    type: "GET",
                    data: {term: req.term, type: 3, parent_id: parent_id},
                    success: function(data){
                        response($.map(data, function(item){
                            var dropdown = new Object();

                            dropdown.label = item.bn_name;
                            dropdown.value = item.bn_name;

                            dropdown.id = item.id;

                            return dropdown;
                        }));
                    }
                });
            }
        },
        select: function(event, ui){
            $("#permanent_upazila").val(ui.item.label);
            $("#permanent_upazila_id").val(ui.item.id);
        }
    });
});

// permanent postoffice
$(function () {
    $("#permanent_postoffice_txt").autocomplete({
        autoFocus: true,
        minLength: 0,
        source: function(req, response){
            $("#permanent_postoffice").val('');
            $("#permanent_postoffice_id").val('');

            var parent_id = $("#permanent_upazila_id").val();

            if(parent_id){
                $.ajax({
                    url: app_url + "/geo/searchLocation",
                    dataType: "JSON",
                    type: "GET",
                    data: {term: req.term, type: 6, parent_id: parent_id},
                    success: function(data){
                        response($.map(data, function(item){
                            var dropdown = new Object();

                            dropdown.label = item.bn_name;
                            dropdown.value = item.bn_name;

                            dropdown.id = item.id;

                            return dropdown;
                        }));
                    }
                });
            }
        },
        select: function(event, ui){
            $("#permanent_postoffice").val(ui.item.label);
            $("#permanent_postoffice_id").val(ui.item.id);
        }
    });
});


function trade_address(key_index){

    console.log(key_index);

    for(var i = 0; i <= key_index; i++){

        var j = i;

        // present district
        $("#present_district_txt_" + i).autocomplete({
            autoFocus: true,
            minLength: 0,
            source: function(req, response){
                $("#present_district_" + j).val('');
                $("#present_district_id_" + j).val('');

                $("#present_upazila_" + j).val('');
                $("#present_upazila_txt_" + j).val('');
                $("#present_upazila_id_" + j).val('');

                $("#present_postoffice_" + j).val('');
                $("#present_postoffice_txt_" + j).val('');
                $("#present_postoffice_id_" + j).val('');

                $.ajax({
                    url: app_url + "/geo/searchLocation",
                    dataType: "JSON",
                    type: "GET",
                    data: {term: req.term, type: 2, parent_id: null},
                    success: function(data){
                        response($.map(data, function(item){
                            var dropdown = new Object();

                            dropdown.label = item.bn_name;
                            dropdown.value = item.bn_name;

                            dropdown.id = item.id;

                            return dropdown;
                        }));
                    }
                });
            },
            select: function(event, ui){
                $("#present_district_" + j).val(ui.item.label);
                $("#present_district_id_" + j).val(ui.item.id);
            }
        });

        // present upazila
        $("#present_upazila_txt_" + i).autocomplete({
            autoFocus: true,
            minLength: 0,
            source: function(req, response){
                $("#present_upazila_" + j).val('');
                $("#present_upazila_id_" + j).val('');

                $("#present_postoffice_" + j).val('');
                $("#present_postoffice_txt_" + j).val('');
                $("#present_postoffice_id_" + j).val('');

                var parent_id = $("#present_district_id_" + j).val();

                if(parent_id){
                    $.ajax({
                        url: app_url + "/geo/searchLocation",
                        dataType: "JSON",
                        type: "GET",
                        data: {term: req.term, type: 3, parent_id: parent_id},
                        success: function(data){
                            response($.map(data, function(item){
                                var dropdown = new Object();

                                dropdown.label = item.bn_name;
                                dropdown.value = item.bn_name;

                                dropdown.id = item.id;

                                return dropdown;
                            }));
                        }
                    });
                }
            },
            select: function(event, ui){
                $("#present_upazila_" + j).val(ui.item.label);
                $("#present_upazila_id_" + j).val(ui.item.id);
            }
        });

        // present postoffice
        $("#present_postoffice_txt_" + i).autocomplete({
            autoFocus: true,
            minLength: 0,
            source: function(req, response){
                $("#present_postoffice_" + j).val('');
                $("#present_postoffice_id_" + j).val('');

                var parent_id = $("#present_upazila_id_" + j).val();

                if(parent_id){
                    $.ajax({
                        url: app_url + "/geo/searchLocation",
                        dataType: "JSON",
                        type: "GET",
                        data: {term: req.term, type: 6, parent_id: parent_id},
                        success: function(data){
                            response($.map(data, function(item){
                                var dropdown = new Object();

                                dropdown.label = item.bn_name;
                                dropdown.value = item.bn_name;

                                dropdown.id = item.id;

                                return dropdown;
                            }));
                        }
                    });
                }
            },
            select: function(event, ui){
                $("#present_postoffice_" + j).val(ui.item.label);
                $("#present_postoffice_id_" + j).val(ui.item.id);
            }
        });

        // permanent district
        $("#permanent_district_txt_" + i).autocomplete({
            autoFocus: true,
            minLength: 0,
            source: function(req, response){
                $("#permanent_district_" + j).val('');
                $("#permanent_district_id_" + j).val('');

                $("#permanent_upazila_" + j).val('');
                $("#permanent_upazila_txt_" + j).val('');
                $("#permanent_upazila_id_" + j).val('');

                $("#permanent_postoffice_" + j).val('');
                $("#permanent_postoffice_txt_" + j).val('');
                $("#permanent_postoffice_id_" + j).val('');

                $.ajax({
                    url: app_url + "/geo/searchLocation",
                    dataType: "JSON",
                    type: "GET",
                    data: {term: req.term, type: 2, parent_id: null},
                    success: function(data){
                        response($.map(data, function(item){
                            var dropdown = new Object();

                            dropdown.label = item.bn_name;
                            dropdown.value = item.bn_name;

                            dropdown.id = item.id;

                            return dropdown;
                        }));
                    }
                });
            },
            select: function(event, ui){
                $("#permanent_district_" + j).val(ui.item.label);
                $("#permanent_district_id_" + j).val(ui.item.id);
            }
        });

        // permanent upazila
        $("#permanent_upazila_txt_" + i).autocomplete({
            autoFocus: true,
            minLength: 0,
            source: function(req, response){
                $("#permanent_upazila_" + j).val('');
                $("#permanent_upazila_id_" + j).val('');

                $("#permanent_postoffice_" + j).val('');
                $("#permanent_postoffice_txt_" + j).val('');
                $("#permanent_postoffice_id_" + j).val('');

                var parent_id = $("#permanent_district_id_" + j).val();

                if(parent_id){
                    $.ajax({
                        url: app_url + "/geo/searchLocation",
                        dataType: "JSON",
                        type: "GET",
                        data: {term: req.term, type: 3, parent_id: parent_id},
                        success: function(data){
                            response($.map(data, function(item){
                                var dropdown = new Object();

                                dropdown.label = item.bn_name;
                                dropdown.value = item.bn_name;

                                dropdown.id = item.id;

                                return dropdown;
                            }));
                        }
                    });
                }
            },
            select: function(event, ui){
                $("#permanent_upazila_" + j).val(ui.item.label);
                $("#permanent_upazila_id_" + j).val(ui.item.id);
            }
        });

        // permanent postoffice
        $("#permanent_postoffice_txt_" + i).autocomplete({
            autoFocus: true,
            minLength: 0,
            source: function(req, response){
                $("#permanent_postoffice_" + j).val('');
                $("#permanent_postoffice_id_" + j).val('');

                var parent_id = $("#permanent_upazila_id_" + j).val();

                if(parent_id){
                    $.ajax({
                        url: app_url + "/geo/searchLocation",
                        dataType: "JSON",
                        type: "GET",
                        data: {term: req.term, type: 6, parent_id: parent_id},
                        success: function(data){
                            response($.map(data, function(item){
                                var dropdown = new Object();

                                dropdown.label = item.bn_name;
                                dropdown.value = item.bn_name;

                                dropdown.id = item.id;

                                return dropdown;
                            }));
                        }
                    });
                }
            },
            select: function(event, ui){
                $("#permanent_postoffice_" + j).val(ui.item.label);
                $("#permanent_postoffice_id_" + j).val(ui.item.id);
            }
        });
    }

    // trade district
    $("#trade_district_txt").autocomplete({
        autoFocus: true,
        minLength: 0,
        source: function(req, response){
            $("#trade_district").val('');
            $("#trade_district_id").val('');

            $("#trade_upazila").val('');
            $("#trade_upazila_txt").val('');
            $("#trade_upazila_id").val('');

            $("#trade_postoffice").val('');
            $("#trade_postoffice_txt").val('');
            $("#trade_postoffice_id").val('');

            $.ajax({
                url: app_url + "/geo/searchLocation",
                dataType: "JSON",
                type: "GET",
                data: {term: req.term, type: 2, parent_id: null},
                success: function(data){
                    response($.map(data, function(item){
                        var dropdown = new Object();

                        dropdown.label = item.bn_name;
                        dropdown.value = item.bn_name;

                        dropdown.id = item.id;

                        return dropdown;
                    }));
                }
            });
        },
        select: function(event, ui){
            $("#trade_district").val(ui.item.label);
            $("#trade_district_id").val(ui.item.id);
        }
    });

    // trade upazila
    $("#trade_upazila_txt").autocomplete({
        autoFocus: true,
        minLength: 0,
        source: function(req, response){
            $("#trade_upazila").val('');
            $("#trade_upazila_id").val('');

            $("#trade_postoffice").val('');
            $("#trade_postoffice_txt").val('');
            $("#trade_postoffice_id").val('');

            var parent_id = $("#trade_district_id").val();

            if(parent_id){
                $.ajax({
                    url: app_url + "/geo/searchLocation",
                    dataType: "JSON",
                    type: "GET",
                    data: {term: req.term, type: 3, parent_id: parent_id},
                    success: function(data){
                        response($.map(data, function(item){
                            var dropdown = new Object();

                            dropdown.label = item.bn_name;
                            dropdown.value = item.bn_name;

                            dropdown.id = item.id;

                            return dropdown;
                        }));
                    }
                });
            }
        },
        select: function(event, ui){
            $("#trade_upazila").val(ui.item.label);
            $("#trade_upazila_id").val(ui.item.id);
        }
    });

    // trade postoffice
    $("#trade_postoffice_txt").autocomplete({
        autoFocus: true,
        minLength: 0,
        source: function(req, response){
            $("#trade_postoffice").val('');
            $("#trade_postoffice_id").val('');

            var parent_id = $("#trade_upazila_id").val();

            if(parent_id){
                $.ajax({
                    url: app_url + "/geo/searchLocation",
                    dataType: "JSON",
                    type: "GET",
                    data: {term: req.term, type: 6, parent_id: parent_id},
                    success: function(data){
                        response($.map(data, function(item){
                            var dropdown = new Object();

                            dropdown.label = item.bn_name;
                            dropdown.value = item.bn_name;

                            dropdown.id = item.id;

                            return dropdown;
                        }));
                    }
                });
            }
        },
        select: function(event, ui){
            $("#trade_postoffice").val(ui.item.label);
            $("#trade_postoffice_id").val(ui.item.id);
        }
    });
}


// on add new owner
function newOwner(row_index){
    // present district
    $("#present_district_txt_" + row_index).autocomplete({
        autoFocus: true,
        minLength: 0,
        source: function(req, response){
            $("#present_district_" + row_index).val('');
            $("#present_district_id_" + row_index).val('');

            $("#present_upazila_" + row_index).val('');
            $("#present_upazila_txt_" + row_index).val('');
            $("#present_upazila_id_" + row_index).val('');

            $("#present_postoffice_" + row_index).val('');
            $("#present_postoffice_txt_" + row_index).val('');
            $("#present_postoffice_id_" + row_index).val('');

            $.ajax({
                url: app_url + "/geo/searchLocation",
                dataType: "JSON",
                type: "GET",
                data: {term: req.term, type: 2, parent_id: null},
                success: function(data){
                    response($.map(data, function(item){
                        var dropdown = new Object();

                        dropdown.label = item.bn_name;
                        dropdown.value = item.bn_name;

                        dropdown.id = item.id;

                        return dropdown;
                    }));
                }
            });
        },
        select: function(event, ui){
            $("#present_district_" + row_index).val(ui.item.label);
            $("#present_district_id_" + row_index).val(ui.item.id);
        }
    });

    // present upazila
    $("#present_upazila_txt_" + row_index).autocomplete({
        autoFocus: true,
        minLength: 0,
        source: function(req, response){
            $("#present_upazila_" + row_index).val('');
            $("#present_upazila_id_" + row_index).val('');

            $("#present_postoffice_" + row_index).val('');
            $("#present_postoffice_txt_" + row_index).val('');
            $("#present_postoffice_id_" + row_index).val('');

            var parent_id = $("#present_district_id_" + row_index).val();

            if(parent_id){
                $.ajax({
                    url: app_url + "/geo/searchLocation",
                    dataType: "JSON",
                    type: "GET",
                    data: {term: req.term, type: 3, parent_id: parent_id},
                    success: function(data){
                        response($.map(data, function(item){
                            var dropdown = new Object();

                            dropdown.label = item.bn_name;
                            dropdown.value = item.bn_name;

                            dropdown.id = item.id;

                            return dropdown;
                        }));
                    }
                });
            }
        },
        select: function(event, ui){
            $("#present_upazila_" + row_index).val(ui.item.label);
            $("#present_upazila_id_" + row_index).val(ui.item.id);
        }
    });

    // present postoffice
    $("#present_postoffice_txt_" + row_index).autocomplete({
        autoFocus: true,
        minLength: 0,
        source: function(req, response){
            $("#present_postoffice_" + row_index).val('');
            $("#present_postoffice_id_" + row_index).val('');

            var parent_id = $("#present_upazila_id_" + row_index).val();

            if(parent_id){
                $.ajax({
                    url: app_url + "/geo/searchLocation",
                    dataType: "JSON",
                    type: "GET",
                    data: {term: req.term, type: 6, parent_id: parent_id},
                    success: function(data){
                        response($.map(data, function(item){
                            var dropdown = new Object();

                            dropdown.label = item.bn_name;
                            dropdown.value = item.bn_name;

                            dropdown.id = item.id;

                            return dropdown;
                        }));
                    }
                });
            }
        },
        select: function(event, ui){
            $("#present_postoffice_" + row_index).val(ui.item.label);
            $("#present_postoffice_id_" + row_index).val(ui.item.id);
        }
    });

    // permanent district
    $("#permanent_district_txt_" + row_index).autocomplete({
        autoFocus: true,
        minLength: 0,
        source: function(req, response){
            $("#permanent_district_" + row_index).val('');
            $("#permanent_district_id_" + row_index).val('');

            $("#permanent_upazila_" + row_index).val('');
            $("#permanent_upazila_txt_" + row_index).val('');
            $("#permanent_upazila_id_" + row_index).val('');

            $("#permanent_postoffice_" + row_index).val('');
            $("#permanent_postoffice_txt_" + row_index).val('');
            $("#permanent_postoffice_id_" + row_index).val('');

            $.ajax({
                url: app_url + "/geo/searchLocation",
                dataType: "JSON",
                type: "GET",
                data: {term: req.term, type: 2, parent_id: null},
                success: function(data){
                    response($.map(data, function(item){
                        var dropdown = new Object();

                        dropdown.label = item.bn_name;
                        dropdown.value = item.bn_name;

                        dropdown.id = item.id;

                        return dropdown;
                    }));
                }
            });
        },
        select: function(event, ui){
            $("#permanent_district_" + row_index).val(ui.item.label);
            $("#permanent_district_id_" + row_index).val(ui.item.id);
        }
    });

    // permanent upazila
    $("#permanent_upazila_txt_" + row_index).autocomplete({
        autoFocus: true,
        minLength: 0,
        source: function(req, response){
            $("#permanent_upazila_" + row_index).val('');
            $("#permanent_upazila_id_" + row_index).val('');

            $("#permanent_postoffice_" + row_index).val('');
            $("#permanent_postoffice_txt_" + row_index).val('');
            $("#permanent_postoffice_id_" + row_index).val('');

            var parent_id = $("#permanent_district_id_" + row_index).val();

            if(parent_id){
                $.ajax({
                    url: app_url + "/geo/searchLocation",
                    dataType: "JSON",
                    type: "GET",
                    data: {term: req.term, type: 3, parent_id: parent_id},
                    success: function(data){
                        response($.map(data, function(item){
                            var dropdown = new Object();

                            dropdown.label = item.bn_name;
                            dropdown.value = item.bn_name;

                            dropdown.id = item.id;

                            return dropdown;
                        }));
                    }
                });
            }
        },
        select: function(event, ui){
            $("#permanent_upazila_" + row_index).val(ui.item.label);
            $("#permanent_upazila_id_" + row_index).val(ui.item.id);
        }
    });

    // permanent postoffice
    $("#permanent_postoffice_txt_" + row_index).autocomplete({
        autoFocus: true,
        minLength: 0,
        source: function(req, response){
            $("#permanent_postoffice_" + row_index).val('');
            $("#permanent_postoffice_id_" + row_index).val('');

            var parent_id = $("#permanent_upazila_id_" + row_index).val();

            if(parent_id){
                $.ajax({
                    url: app_url + "/geo/searchLocation",
                    dataType: "JSON",
                    type: "GET",
                    data: {term: req.term, type: 6, parent_id: parent_id},
                    success: function(data){
                        response($.map(data, function(item){
                            var dropdown = new Object();

                            dropdown.label = item.bn_name;
                            dropdown.value = item.bn_name;

                            dropdown.id = item.id;

                            return dropdown;
                        }));
                    }
                });
            }
        },
        select: function(event, ui){
            $("#permanent_postoffice_" + row_index).val(ui.item.label);
            $("#permanent_postoffice_id_" + row_index).val(ui.item.id);
        }
    });
}
