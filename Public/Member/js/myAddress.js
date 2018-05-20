/**
 * Created by ouHai on 2017/5/18.
 */

var select_province = $('select[name="province"]');//省份select框
var select_city     = $('select[name="city"]');    //城市select框
var select_county   = $('select[name="county"]');  //区域select框

//点击省份选择市
select_province.on('change',function(){
    var this_ = $(this);
    var city_str   = '<option value="0">&nbsp;&nbsp;&nbsp;&nbsp;请选择城市</option>';
    var county_str = '<option value="0">&nbsp;&nbsp;&nbsp;&nbsp;请选择地区</option>';
    select_city.children().remove()
    select_city.append(city_str);
    select_county.children().remove()
    select_county.append(county_str);
    if(this_.val()==0){
        return false;
    }
    $.post(selectAddressUrl,{'pid':this_.val()},function(data){
        if(data.status==1){
            var html_ = city_str;
            var area = data.area;
            if(area!='' && area.length>0){
                for(var i=0;i<area.length;i++){
                    html_  += '<option value="'+area[i].id+'">&nbsp;&nbsp;&nbsp;&nbsp;'+area[i].name+'</option>';
                }
                select_city.children().remove()
                select_city.append(html_);
            }
            return false;
        }
    },'json');
});

//点击择市选区域
select_city.on('change',function(){
    var this_ = $(this);
    var county_str = '<option value="0">&nbsp;&nbsp;&nbsp;&nbsp;请选择地区</option>';
    select_county.children().remove()
    select_county.append(county_str);
    if(this_.val()==0){
        return;
    }
    $.post(selectAddressUrl,{'pid':this_.val()},function(data){
        if(data.status==1){
            var html_ = county_str;
            var area = data.area;
            if(area!='' && area.length>0){
                for(var i=0;i<area.length;i++){
                    html_  += '<option value="'+area[i].id+'">&nbsp;&nbsp;&nbsp;&nbsp;'+area[i].name+'</option>';
                }
                select_county.children().remove()
                select_county.append(html_);
            }
            return false;
        }
    },'json');
});

