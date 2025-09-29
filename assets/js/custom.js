
var masterData = {
    isEmptyVariantName:0,
    bikeMmv: [],
    carMmv: [],
    commercialMmv: [],
    rtoData: [],
    variantList: [],
    carVariantList: [],
    commercialVariantList: [],
    carNewVariantListArr: [],
    fuelTypeData: ['Petrol','Diesel','Electric'],
    carFuelTypeData: ['Petrol','Diesel','Electric'],
    commercialFuelTypeData: ['Petrol','Diesel'],
    fuelTypeArrayLabel: {'Petrol': 'Petrol', 'Diesel': 'Diesel', 'CNG_LPG': 'CNG/LPG Company Fitted', 'ExternalCNG': 'CNG/LPG Externally Fitted','Electric':'Electric'},
    initBikeData: function (bike_mmv){//for bike
        this.bikeMmv = bike_mmv.data;
    },
    initCarData: function (carMmv){
        this.carMmv = carMmv;
    },
    initCommercialData: function (commercial_mmv){
        this.commercialMmv = commercial_mmv.data;
    },
    initRtoData: function (rtoCity_data){
        this.rtoData = rtoCity_data;
    },
    renderMakeModalList: function(makeModelFieldId){//for bike only
        
        var mmvBiKeData = this.getBikeMakeModelData();
        $('#'+makeModelFieldId).empty();
        var optionHtml = '<option value="">Select Make/Model</option>';
        $.each(mmvBiKeData,function(i,data){
            optionHtml += '<option value="' + data.model_id + '">'+data.model_name+'</option>';
        });
        $('#'+makeModelFieldId).html(optionHtml);
    },
    renderBikeVariantList: function(modelId, variantFieldId){
        
        $('#'+variantFieldId).html('');
        var optionHtml = '<option value="">Select Variant</option>';
        if(modelId!='' && modelId!=null){
            var variantBikeData = this.getBikeVariantData(modelId);
            
            $.each(variantBikeData,function(i,data){
                optionHtml += '<option value="' + data.version_id + '">'+data.version+'</option>';
            });
            
        }
        $('#'+variantFieldId).html(optionHtml);
    },
    getBikeMakeModelData: function(){
        
        var bikeMmvData = this.bikeMmv;
        var finalArr = [];
        var primModelsIdsOnly = [];
        
        $.each(bikeMmvData, function(i, val) {
            if(!($.inArray(val.model_id, primModelsIdsOnly) !== -1)){
                finalArr.push({model_name:val.model,model_id:val.model_id});
                primModelsIdsOnly.push(val.model_id);
            }
        });

        var sort_by = function(field, reverse, primer){
            var key = primer ? 
               function(x) {return primer(x[field])} : 
               function(x) {return x[field]};
           reverse = !reverse ? 1 : -1;
           return function (a, b) {
               return a = key(a), b = key(b), reverse * ((a > b) - (b > a));
             } 
        };
        finalArr.sort(sort_by('model_name', false, function(a){return a.toUpperCase()}));

        return finalArr;
    },
    getBikeVariantData: function(modelId){
        
        var bikeMmvData = this.bikeMmv;
        var finalArr = [];
        var fuelArr = [];
        var variantNames = [];

        if(typeof modelId != 'undefined' && modelId !== null && modelId !='') {
            $.each(bikeMmvData, function (i, obj) {

                if ((obj.model_id == modelId) && obj.version !== '') {
                    var isValidVersion = (obj.version).toLowerCase()+'-'+obj.cc;
                    if(!($.inArray(isValidVersion, variantNames) !== -1)){
                        finalArr.push({version:obj.version + ' (' + obj.fuel + '-' + obj.cc + 'cc)', version_id:obj.version_id, version_name:obj.version, model_id:obj.model_id, model_name:obj.model, make_id:obj.make_id, make_name:obj.make,fuel_type:obj.fuel });
                        variantNames.push(isValidVersion);
                        if($.inArray(obj.fuel, fuelArr)===-1){
                            fuelArr.push(obj.fuel);
                        }
                    }
                }
            });
            this.fuelTypeData = fuelArr;
        }

        var sort_by = function(field, reverse, primer){
            var key = primer ? 
               function(x) {return primer(x[field])} : 
               function(x) {return x[field]};
           reverse = !reverse ? 1 : -1;
           return function (a, b) {
               return a = key(a), b = key(b), reverse * ((a > b) - (b > a));
             } 
        };
        finalArr.sort(sort_by('version', false, function(a){return a.toUpperCase()}));
        
        this.variantList = finalArr;
        
        return finalArr;
    },
    getMmvInfoByVariantId: function(variantId){//for bike only
        
        var params = {};
        params.make_id = '';
        params.make_name = '';
        params.model_id = '';
        params.model_name = '';
        params.version_id = '';
        params.version_name = '';
        params.fuel_type = '';
        
        $.each( this.variantList, function( v_id, obj ){
            if(obj){
                if(obj.version_id==variantId){
                    params.make_id = obj.make_id;
                    params.make_name = obj.make_name;
                    params.model_id = obj.model_id;
                    params.model_name = obj.model_name;
                    params.version_id = obj.version_id;
                    params.version_name = obj.version_name;
                    params.fuel_type = obj.fuel_type;
                }
            }
        });
        
        return params;
    },
    getRTOCities: function(selectedRtoCity, rtoFieldId){
        
        var rto_city = this.rtoData;
        var obj = {};
        var rtoOptions = '<option value="">Select RTO City</option>';
        rto_city.sort(function(a,b) {return (a.rto_name > b.rto_name) ? 1 : ((b.rto_name > a.rto_name) ? -1 : 0);} );
        for(var i=0; i<rto_city.length; i++){
            if(rto_city[i].rto_city==selectedRtoCity){
                rtoOptions += '<option value="'+rto_city[i].rto_code+'" selected>'+rto_city[i].rto_name+'</option>';
            }else{
                rtoOptions += '<option value="'+rto_city[i].rto_code+'">'+rto_city[i].rto_name+'</option>';
            }
        }
        $('#'+rtoFieldId).html(rtoOptions);
    },
    renderFuelList: function(selectedFuelType, fuelTypeFieldId){//for bike only
        
        var fuelTypeData = this.fuelTypeData;
        
        var selected = '';
        var fuelTypeOptions = '<option value="">Select Fuel Type</option>';
        
        $.each(fuelTypeData, function (key, value) {
            selected = '';
            if (typeof value != 'undefined') {
                if (selectedFuelType == value) {
                    selected = ' selected';
                }
                fuelTypeOptions += '<option value="' + value + '" ' + selected + '>' +value + '</option>';
            }
        });
        $('#'+fuelTypeFieldId).html(fuelTypeOptions);
    },
    renderRegistrationYearList: function(years, fieldId){
        
        var selected = '';
        var yearsOptions = '<option value="">Select Registration Year</option>';
        $.each(years, function (key, value) {
            if (typeof value != 'undefined') {
                yearsOptions += '<option value="' + value + '" ' + selected + '>' +value + '</option>';
            }
        });
        
        $('#'+fieldId).html(yearsOptions);
        
    },
    //car functions
    renderCarFuelList: function(selectedFuelType, fuelTypeFieldId){
        
        var fuelTypeData = this.carFuelTypeData;
        var fuelTypeArrayLabel = this.fuelTypeArrayLabel;
        
        var selected = '';
        var fuelTypeOptions = '<option value="">Select Fuel Type</option>';
        
        $.each(fuelTypeData, function (key, value) {
            selected = '';
            if (typeof value != 'undefined' && typeof fuelTypeArrayLabel[value] != 'undefined') {
                if (value == selectedFuelType) {
                    selected = ' selected';
                }
                fuelTypeOptions += '<option value="' + value + '" ' + selected + '>' + fuelTypeArrayLabel[value] + '</option>';
            }
        });
        if ($.inArray('Petrol', fuelTypeData) !== -1) {
            var externalCngSel = '';
            if (selectedFuelType == 'ExternalCNG') {
                externalCngSel = ' selected';
            }
            fuelTypeOptions += '<option value="ExternalCNG" ' + externalCngSel + '>CNG/LPG Externally Fitted</option>';
        }
        
        $('#'+fuelTypeFieldId).html(fuelTypeOptions);
        
    },
    renderCarMakeModalList: function(makeModelFieldId){
        
        var mmvCarData = this.getCarMakeModelData();
        $('#'+makeModelFieldId).empty();
        var optionHtml = '<option value="">Select Make/Model</option>';
        $.each(mmvCarData,function(i,data){
            var finalData=data.name;
            var tempData = finalData.split('__');
            optionHtml += '<option value="' + tempData[1] + '">'+tempData[0]+'</option>';
        });
        $('#'+makeModelFieldId).html(optionHtml);
        
    },
    renderCarVariantList: function(modelId, variantFieldId, fuelTypeFieldId){
        
        $('#'+variantFieldId).html('');
        var optionHtml = '<option value="">Select Variant</option>';
        if(modelId!='' && modelId!=null){
            var variantCarData = this.getCarVariantData(modelId, fuelTypeFieldId);
            
            $.each(variantCarData,function(i,data){
                var tempData = data.split('__');
                optionHtml += '<option value="' + tempData[1] + '">'+tempData[0]+'</option>';
            });
            
        }
        $('#'+variantFieldId).html(optionHtml);
    },
    getCarMakeModelData: function(){
       
        var carMmvData = this.carMmv;
        var finalArr = [];
        var primModelsIdsOnly = [];
        $.each(carMmvData, function (i, makeModel) {
            if (makeModel.parent_id === '0') {
                var popularityRank = makeModel.popularity_rank;
                if (!($.inArray(makeModel.model_id, primModelsIdsOnly) !== -1)) {
                    finalArr.push({name: makeModel.make_model + '__' + makeModel.model_id, popularity: popularityRank});
                    primModelsIdsOnly.push(makeModel.model_id);
                }
            }
        });

        var sort_by = function (field, reverse, primer) {
            var key = primer ?
                    function (x) {
                        return primer(x[field])
                    } :
                    function (x) {
                        return x[field]
                    };
            reverse = !reverse ? 1 : -1;
            return function (a, b) {
                return a = key(a), b = key(b), reverse * ((a > b) - (b > a));
            }
        }

        var nameSortList = [];
        var popularitySortList = [];
        $.each(finalArr, function (i, data) {
            if (parseInt(data.popularity) == 0) {
                nameSortList.push(data);
            } else {
                popularitySortList.push(data);
            }
        });

        popularitySortList.sort(sort_by('popularity', false, parseInt));
        nameSortList.sort(sort_by('name', false, function (a) {
            return a.toUpperCase()
        }));

        finalArr = popularitySortList.concat(nameSortList); // Merges both arrays

        return finalArr;
                
    },
    getCarVariantData: function(modelId,fuelTypeFieldId){
        
        var carMmvData = this.carMmv;
        var finalArr = [];
        var carVariantListArr = [];
        var variantNames = []; // array contains all the variant name for uniquesness

        var fuelTypeArray = [];
        var fuelType = $('#'+fuelTypeFieldId).val();//$('#ed_fuel_type').val();

        if (typeof modelId != 'undefined' && modelId !== null && modelId != '') {
            var tempModelIds = modelId.toString().split('--');
            $.each(carMmvData, function (i, variant) {
                if (variant.status == '1' || variant.status == '2') {

                    for (var i = 0; i < tempModelIds.length; i++) {
                        if ((variant.model_id === tempModelIds[i] || variant.parent_id === tempModelIds[i]) && variant.version !== '') {
                            var isValidVersion = (variant.version).toLowerCase() + '-' + variant.cc;
                            if (!($.inArray(isValidVersion, variantNames) !== -1)) {

                                if (typeof fuelType != 'undefined' && fuelType !== null && fuelType != '') {
                                    var selectedFuelType = [];
                                    if (fuelType == 'ExternalCNG') {
                                        selectedFuelType = ['Petrol'];
                                    } else if (fuelType == 'CNG_LPG') {
                                        selectedFuelType = ['CNG', 'LPG'];
                                    } else {
                                        selectedFuelType = [fuelType];
                                    }

                                    if ($.inArray(variant.fuel, selectedFuelType) !== -1) {
                                        var fuelVariant = variant;
                                        finalArr.push(fuelVariant.version + ' (' + variant.fuel + '-' + variant.cc + 'cc)' + '__' + fuelVariant.version_id + '__' + variant.fuel);
                                        carVariantListArr.push({version:variant.version + ' (' + variant.fuel + '-' + variant.cc + 'cc)', version_id:variant.version_id, version_name:variant.version, model_id:variant.model_id, model_name:variant.model, make_id:variant.make_id, make_name:variant.make, fuel_type:variant.fuel });
                                        variantNames.push(isValidVersion);
                                    }
                                } else {
                                    finalArr.push(variant.version + ' (' + variant.fuel + '-' + variant.cc + 'cc)' + '__' + variant.version_id + '__' + variant.fuel);
                                    carVariantListArr.push({version:variant.version + ' (' + variant.fuel + '-' + variant.cc + 'cc)', version_id:variant.version_id, version_name:variant.version, model_id:variant.model_id, model_name:variant.model, make_id:variant.make_id, make_name:variant.make, fuel_type:variant.fuel });
                                    variantNames.push(isValidVersion);
                                }

                                var filterFuelType = variant.fuel;
                                if ($.inArray(filterFuelType, ['CNG', 'LPG']) !== -1) {
                                    filterFuelType = 'CNG_LPG';
                                }
                                if ($.inArray(filterFuelType, fuelTypeArray) === -1) {
                                    fuelTypeArray.push(filterFuelType);
                                }
                            }
                        }
                    }
                }
            });
        }
        
        finalArr = $.unique(finalArr); // taking unique records
        finalArr = finalArr.sort(); // performing sorting

        this.carVariantList = finalArr;
        this.carFuelTypeData = fuelTypeArray;
        this.carNewVariantListArr = carVariantListArr;//use for get mmv info
        
        return finalArr;
        
    },
    getCarMmvInfoByVariantId: function(variantId){
        
        var params = {};
        params.make_id = '';
        params.make_name = '';
        params.model_id = '';
        params.model_name = '';
        params.version_id = '';
        params.version_name = '';
        params.fuel_type = '';
        
        $.each( this.carNewVariantListArr, function( v_id, obj ){
            if(obj){
                if(obj.version_id==variantId){
                    params.make_id = obj.make_id;
                    params.make_name = obj.make_name;
                    params.model_id = obj.model_id;
                    params.model_name = obj.model_name;
                    params.version_id = obj.version_id;
                    params.version_name = obj.version_name;
                    params.fuel_type = obj.fuel_type;
                }
            }
        });
        
        return params;
    },
    //commercial
    renderCommercialMakeModalList: function(makeModelFieldId){
        
        var mmvListData = this.getCommercialMakeModelData();
        $('#'+makeModelFieldId).empty();
        var optionHtml = '<option value="">Select Make/Model</option>';
        $.each(mmvListData,function(i,data){
            optionHtml += '<option value="' + data.model_cat_id + '">'+data.model_display_name+'</option>';
        });
        $('#'+makeModelFieldId).html(optionHtml);
    },
    renderCommercialVariantList: function(modelId, variantFieldId, fuelTypeFieldId, modelCategory){
        
        $('#'+variantFieldId).html('');
        var optionHtml = '<option value="">Select Variant</option>';
        if(modelId!='' && modelId!=null){
            var variantData = this.getCommercialVariantData(modelId, fuelTypeFieldId, modelCategory);
            
            $.each(variantData,function(i,data){
                optionHtml += '<option value="' + data.version_id + '">'+data.version+'</option>';
            });
            
        }
        $('#'+variantFieldId).html(optionHtml);
    },
    renderCommercialFuelList: function(selectedFuelType, fuelTypeFieldId){
        
        var fuelTypeData = this.commercialFuelTypeData;
        var fuelTypeArrayLabel = this.fuelTypeArrayLabel;
        
        var selected = '';
        var fuelTypeOptions = '<option value="">Select Fuel Type</option>';
        
        $.each(fuelTypeData, function (key, value) {
            selected = '';
            if(value=='DIESEL'){
                value = 'Diesel';
            }else if(value=='PETROL'){
                value = 'Petrol';
            }
            
            if (typeof value != 'undefined' && typeof fuelTypeArrayLabel[value] != 'undefined') {
                if (value == selectedFuelType) {
                    selected = ' selected';
                }
                fuelTypeOptions += '<option value="' + value + '" ' + selected + '>' + fuelTypeArrayLabel[value] + '</option>';
            }
        });
        if ($.inArray('Petrol', fuelTypeData) !== -1) {
            var externalCngSel = '';
            if (selectedFuelType == 'ExternalCNG') {
                externalCngSel = ' selected';
            }
            fuelTypeOptions += '<option value="ExternalCNG" ' + externalCngSel + '>CNG/LPG Externally Fitted</option>';
        }
        
        $('#'+fuelTypeFieldId).html(fuelTypeOptions);
        
    },
    getCommercialMakeModelData: function(){
        
        var mmvData = this.commercialMmv;
        var finalArr = [];
        var primModelsIdsOnly = [];
        
        $.each(mmvData, function(i, val) {
            if(!($.inArray(val.model_id, primModelsIdsOnly) !== -1)){
                finalArr.push({model_display_name:val.make+' '+val.model,model_name:val.model,model_id:val.model_id,make_name:val.make,make_id:val.make_id,model_cat_id:val.model_id+'_'+val.category});
                primModelsIdsOnly.push(val.model_id);
            }
        });

        var sort_by = function(field, reverse, primer){
            var key = primer ? 
               function(x) {return primer(x[field])} : 
               function(x) {return x[field]};
           reverse = !reverse ? 1 : -1;
           return function (a, b) {
               return a = key(a), b = key(b), reverse * ((a > b) - (b > a));
             } 
        };
        finalArr.sort(sort_by('model_display_name', false, function(a){return a.toUpperCase()}));

        return finalArr;
    },
    getCommercialVariantData: function(modelId, fuelTypeFieldId, modelCategory){
        
        var mmvData = this.commercialMmv;
        var finalArr = [];
        var fuelArr = [];
        var otherFinalArr = [];
        var otherFuelArr = [];
        var variantNames = [];
        var fuelType = $('#'+fuelTypeFieldId).val();

        if(typeof modelId != 'undefined' && modelId !== null && modelId !='' && typeof modelCategory != 'undefined' && modelCategory !== null && modelCategory !='') {
            $.each(mmvData, function (i, obj) {
                
                if(obj.fuel=='DIESEL'){
                    obj.fuel = 'Diesel';
                }else if(obj.fuel=='PETROL'){
                    obj.fuel = 'Petrol';
                }
            

                if ((obj.model_id == modelId) && obj.version !== '' && obj.category == modelCategory) {
                    var isValidVersion = (obj.version).toLowerCase()+'-'+obj.cc;
                    if(!($.inArray(isValidVersion, variantNames) !== -1)){
                        
                        if (typeof fuelType != 'undefined' && fuelType !== null && fuelType != '') {
                            var selectedFuelType = [];
                            if (fuelType == 'ExternalCNG') {
                                selectedFuelType = ['Petrol'];
                            } else if (fuelType == 'CNG_LPG') {
                                selectedFuelType = ['CNG', 'LPG'];
                            } else {
                                selectedFuelType = [fuelType];
                            }

                            if ($.inArray(obj.fuel, selectedFuelType) !== -1) {
                                finalArr.push({version:obj.version + ' (' + obj.fuel + '-' + obj.cc + 'cc)', version_id:obj.version_id, version_name:obj.version, model_id:obj.model_id, model_name:obj.model, make_id:obj.make_id, make_name:obj.make, fuel_type:obj.fuel, category:obj.category});
                                variantNames.push(isValidVersion);
                            }
                        } else {
                            finalArr.push({version: obj.version + ' (' + obj.fuel + '-' + obj.cc + 'cc)', version_id: obj.version_id, version_name: obj.version, model_id: obj.model_id, model_name: obj.model, make_id: obj.make_id, make_name: obj.make, fuel_type:obj.fuel, category:obj.category});
                            variantNames.push(isValidVersion);
                        }
                        
                        var filterFuelType = obj.fuel;
                        if ($.inArray(filterFuelType, ['CNG', 'LPG']) !== -1) {
                            filterFuelType = 'CNG_LPG';
                        }
                        if ($.inArray(filterFuelType, fuelArr) === -1) {
                            fuelArr.push(filterFuelType);
                        }
                        
                    }
                }else if ((obj.model_id == modelId) && obj.version_id !== '' && obj.category == modelCategory) {
                    otherFinalArr.push({version: '', version_id: obj.version_id, version_name: obj.version, model_id: obj.model_id, model_name: obj.model, make_id: obj.make_id, make_name: obj.make, fuel_type:obj.fuel, category:obj.category});
                    
                    var otherFilterFuelType = obj.fuel;
                    if ($.inArray(otherFilterFuelType, ['CNG', 'LPG']) !== -1) {
                        otherFilterFuelType = 'CNG_LPG';
                    }
                    otherFuelArr.push(otherFilterFuelType);
                }
            });
            this.commercialFuelTypeData = fuelArr;
        }
        
        //check commercial empty variant
        this.isEmptyVariantName = 0;
        if(finalArr.length==0 && otherFinalArr.length==1){
            this.commercialVariantList = otherFinalArr;
            this.commercialFuelTypeData = otherFuelArr;
            this.isEmptyVariantName = 1;
            finalArr = otherFinalArr;
        }else{
        
            var sort_by = function(field, reverse, primer){
                var key = primer ? 
                   function(x) {return primer(x[field])} : 
                   function(x) {return x[field]};
               reverse = !reverse ? 1 : -1;
               return function (a, b) {
                   return a = key(a), b = key(b), reverse * ((a > b) - (b > a));
                 } 
            };
            finalArr.sort(sort_by('version', false, function(a){return a.toUpperCase()}));

            this.commercialVariantList = finalArr;
        }
        
        return finalArr;
        
    },
    getCommercialMmvInfoByVariantId: function(variantId){
        var params = {};
        params.make_id = '';
        params.make_name = '';
        params.model_id = '';
        params.model_name = '';
        params.version_id = '';
        params.version_name = '';
        params.fuel_type = '';
        params.category = '';
        
        $.each( this.commercialVariantList, function( v_id, obj ){
            if(obj){
                if(obj.version_id==variantId){
                    params.make_id = obj.make_id;
                    params.make_name = obj.make_name;
                    params.model_id = obj.model_id;
                    params.model_name = obj.model_name;
                    params.version_id = obj.version_id;
                    params.version_name = obj.version_name;
                    params.fuel_type = obj.fuel_type;
                    params.category = obj.category;
                }
            }
        });
        
        return params;
    },
    getDisableEmptyVariantData: function () {

        var params = {};
        params.isEmptyVariantName = 0;
        params.variantId = '';
        params.fuelType = '';
        if (this.isEmptyVariantName == 1) {
            params.isEmptyVariantName = 1;
            var otherFinalArr = this.commercialVariantList;
            var otherFuelArr = this.commercialFuelTypeData;
            if (otherFinalArr.length == 1 && typeof (otherFinalArr[0]['version_id']) !== 'undefined' && otherFinalArr[0]['version_id'] !== null && otherFinalArr[0]['version_id'] !== '' && typeof (otherFuelArr[0]) !== 'undefined' && otherFuelArr[0] !== null && otherFuelArr[0] !== '') {
                params.variantId = otherFinalArr[0]['version_id'];
                params.fuelType = otherFuelArr[0];
            }
        }
        
        return params;
    },
    activeAnnouncementEvent: function(isShow, params, announcementId){
        var announcementStatus = getCookie(announcementId);
        if (announcementStatus != 1 && isShow==1) {
            $('body').append(this.announcementModalHtml);
            
            var title = params.title;
            var text = params.text;
            $('#posAnnouncementModal .modal-title').html(title);
            $('#posAnnouncementModal .modal-body').html(text);
            
            $('#posAnnouncementModal').modal('show');

            $('#ok_btn').off('click').on('click', function (e) {
                $('#posAnnouncementModal').modal('hide');
                document.cookie = announcementId+"=1";
            });
        }
    },
    announcementModalHtml: function(){
        
        var modalHtml = '<div class="modal fade bs-example-modal-sm" style="z-index:99998" id="posAnnouncementModal" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false" aria-labelledby="">'+
            '<div class="modal-dialog modal-m" role="document" style="">'+
            '<div class="modal-content">'+
              '<div class="modal-header" style="padding: 5px;">'+
                '<h4 class="modal-title text-center" id="gridSystemModalLabel" style="font-size: 18px;"></h4>'+
              '</div>'+
              '<form id="upload_documents_form" autocomplete="off" action="" method="" novalidate="novalidate" enctype="multipart/form-data">'+
                '<div class="modal-body">'+
                    
                '</div>'+
              '<div class="modal-footer">'+
                '<div class="row">'+
                '<div class="col-md-12 col-xs-12">'+
                '<button type="button" class="btn login_btn" id="ok_btn"  data-dismiss="modal" style="width: 100px;float: right;height: 40px;padding: 7px 0px;">OK</button>'+
                '</div>'+
              '</div>'+
              '</div>'+
              '</form>'+
            '</div>'+
          '</div>'+
        '</div>';

        return modalHtml;
    }
    
};

(function ($, window) {
    "use strict";
    $.fn.gsp_scrollmenu = function () {
        // set Active link at center of the viewport
        this.each(function(){
            var $activeLink = $(this).find('.active');
            if($activeLink.length > 0 ){
                var offsets = $activeLink[0].getBoundingClientRect();
                var scrollLeft = offsets.left + (offsets.width/2);
                var winCenter = window.innerWidth / 2;
                $(this).scrollLeft(scrollLeft - winCenter);
            }
        });
    };
    $(function () {
        var $contianer = $('.gs_scroll_nav');
        if ($contianer.length > 0) {
            $contianer.gsp_scrollmenu();
        }
    });

})(jQuery, window);
