$(document).ready(function () {
    $('input[type="text"], textarea').on({
        keypress: function () {
            $(this).parent('div').removeClass('has-error');
        }
    });
    $('select').on({
        change: function () {
            $(this).removeClass('has-error');
        }
    });
    
    $('.tablas tbody').on('click', 'td.details-control', function () {
        $(this).toggleClass('details-control-close');
    });
    $('input[type=text],textarea').val(function () {
        return this.value.toUpperCase();
    });
            
    $.fn.dataTableExt.oApi.fnResetAllFilters = function (oSettings, bDraw/*default true*/) {
        for (iCol = 0; iCol < oSettings.aoPreSearchCols.length; iCol++) {
            oSettings.aoPreSearchCols[ iCol ].sSearch = '';
        }
        oSettings.oPreviousSearch.sSearch = '';

        if (typeof bDraw === 'undefined')
            bDraw = true;
        if (bDraw)
            this.fnDraw();
    };
});