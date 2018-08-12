var $=jQuery.noConflict();
function get_category_id(wrapper_id){
    var cat_input=$(wrapper_id).find('.category_name');
    if(cat_input.length>0){
        var _name=cat_input.last().attr('name');
        return get_cat_id_from_name(_name);
    }else{
        return 0;
    }
}

function get_category_count(wrapper_id){
    var cat_input=$(wrapper_id).find('.category_name');
    if(cat_input.length>0){
        return cat_input.length;
    }else{
        return 0;
    }
}

function get_cat_id_from_name(name_string){
    var match = name_string.match(/category\[(.*?)\]\[name\]/);
    if(null==match){
        return null
    }else{
        return match[1];
    }
}

function get_service_id_for_add_service_link(add_service_ele){
    var category_row=get_category_row_from_add_remove_service_link(add_service_ele);//add_service_ele.parent().parent().parent();
    var service_name_input=category_row.find('.service-price-length-rows-wrapper .service_name');
    if(service_name_input.length>0){
        var _name=service_name_input.last().attr('name');
        return get_service_id_from_name(_name);
    }else{
        return null;
    }
}

function get_service_id_from_name(name_string){
    var match = name_string.match(/category\[(\d+)\]\[(\d+)\]\[service_name\]/);
    if(null==match){
        return null
    }else{
        return match[2];
    }
}

function generate_category_data(cat_id){
    var result={
        name :  'category[' + cat_id + '][name]',
        id :  'category_'+ cat_id +'_name',
        label :  'Category Name(' + cat_id + ')'
    };

    return result;
}

function generate_service_data(cat_id,service_id){
    var result={
        service_name:{
            name :  'category[' + cat_id + '][' + service_id + '][service_name]',
            id :  'category_' + cat_id + '_' + service_id + '_service_name',
            label :  'Service Name(' + service_id + ')'
        },
        service_price:{
            name :  'category[' + cat_id + '][' + service_id + '][service_price]',
            id :  'category_' + cat_id + '_' + service_id + '_service_price',
            label :  'Service Price(' + service_id + ')'
        },
        service_desc:{
            name :  'category[' + cat_id + '][' + service_id + '][service_desc]',
            id :  'category_' + cat_id + '_' + service_id + '_service_desc',
            label :  'Service Description/Length(' + service_id + ')'
        },
		   service_url:{
            name :  'category[' + cat_id + '][' + service_id + '][service_url]',
            id :  'category_' + cat_id + '_' + service_id + '_service_url',
            label :  'Service URL(' + service_id + ')'
        }
    };

    return result;
}

function update_category_row_html(cat_wrapper,cat_id,service_id){
    var _cat_data=generate_category_data(cat_id);
    //replace
    var cat_name_row = cat_wrapper.find('.category-name-row:first');
    var _label=cat_name_row.find('label');
    _label.attr('for',_cat_data.id);
    _label.html(_cat_data.label);

	var cat_des_row = cat_wrapper.find('.category-description-row:first');
    var _label1=cat_des_row.find('label');
	//console.log(cat_id);
    _label1.attr('for','category_'+cat_id+'_description');
    _label1.html('Category Description('+cat_id+')');

	
    var _input=cat_name_row.find('input.category_name');
    _input.attr('name',_cat_data.name);
    _input.attr('id',_cat_data.id);
	
	var _textarea=cat_des_row.find('textarea.category_description');
    _textarea.attr('name','category['+cat_id+'][description]');
    _textarea.attr('id','category_'+cat_id+'_description');

    update_service_rows_html(cat_wrapper.find('.service-price-length-rows-wrapper:last'),cat_id,service_id);

    return cat_wrapper.find('.category-row').html();
}

function update_service_rows_html(service_rows_wrapper,cat_id,service_id){
    //replace
	console.log(service_rows_wrapper);
    var service_rows = service_rows_wrapper.find('.service-price-length');
    var _service_data= generate_service_data(cat_id,service_id);
	console.log(_service_data);
    //service name row
    var _service_name_row=$(service_rows[0]);

    var _label=_service_name_row.find('label');
    _label.attr('for',_service_data.service_name.id);
    _label.html(_service_data.service_name.label);

    var _input=_service_name_row.find('input.service_name');
    _input.attr('name',_service_data.service_name.name);
    _input.attr('id',_service_data.service_name.id);

    //service price row
    var _service_price_row=$(service_rows[1]);

    var _label=_service_price_row.find('label');
    _label.attr('for',_service_data.service_price.id);
    _label.html(_service_data.service_price.label);

    var _input=_service_price_row.find('input.service_price');
    _input.attr('name',_service_data.service_price.name);
    _input.attr('id',_service_data.service_price.id);

    //service desc row
    var _service_desc_row=$(service_rows[2]);

    var _label=_service_desc_row.find('label');
    _label.attr('for',_service_data.service_desc.id);
    _label.html(_service_data.service_desc.label);

    var _input=_service_desc_row.find('input.service_desc');
    _input.attr('name',_service_data.service_desc.name);
    _input.attr('id',_service_data.service_desc.id);

	
    //service desc url
    var _service_url_row=$(service_rows[3]);

    var _label=_service_url_row.find('label');
    _label.attr('for',_service_data.service_url.id);
    _label.html(_service_data.service_url.label);

    var _input=_service_url_row.find('input.service_url');
    _input.attr('name',_service_data.service_url.name);
    _input.attr('id',_service_data.service_url.id);

    return service_rows_wrapper.html();
}

function get_cat_id_service_id_from_add_service_link(add_service_ele){
    var category_row=get_category_row_from_add_remove_service_link(add_service_ele);//add_service_ele.parent().parent().parent();
    var _cat_id=get_category_id(category_row);
    var _service_id=get_service_id_for_add_service_link(add_service_ele);

    return {
        service_id:_service_id,
        cat_id:_cat_id
    }
}

function get_category_row_from_add_remove_service_link(add_service_ele){
    var category_row=add_service_ele.parent().parent().parent().parent();
    return category_row;
}

function get_service_rows_from_add_remove_service_link(remove_service_ele){
    var category_row=remove_service_ele.parent().parent().parent();
    return category_row;
}

