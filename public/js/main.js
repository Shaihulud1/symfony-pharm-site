function disableSwitcher(disableSwitcher, disableOff, disableOn)
{
    var disableSwitcher = $('.' + disableSwitcher),
        disableOffObj = $('.' + disableOff),
        disableOnObj = $('.'+disableOn);
    doSwitch(disableSwitcher, disableOffObj, disableOnObj);
    disableSwitcher.change(function(){
        doSwitch(disableSwitcher, disableOffObj, disableOnObj);
    });   
}
function doSwitch(switchObj, dOff, dOnn)
{
    if (switchObj.is(':checked')) {
        dOff.prop("disabled", false);
        dOnn.prop("disabled", true);
    } else {
        dOff.prop("disabled", true);
        dOnn.prop("disabled", false);
    }    
}


disableSwitcher('disable-switcher', 'disable-false', 'disable-true');


