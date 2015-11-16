$(document).ready(function () {
    var TFallas = $('#tabla_desincorporar').dataTable({
        "iDisplayLength": 5,
        "iDisplayStart": 0,
        "sPaginationType": "full_numbers",
        "aLengthMenu": [5, 10, 20, 30, 40, 50],
        "oLanguage": {"sUrl": "../../librerias/js/es.txt"},
        "order": [[1, "desc"]],
        "aoColumns": [
            {"sClass": "center", "sWidth": "20%"},
            {"sClass": "center", "sWidth": "20%"},
            {"sClass": "center", "sWidth": "20%"},
            {"sClass": "center", "sWidth": "20%"},
            {"sClass": "center", "sWidth": "20%"},
            {"sWidth": "8%", "bSortable": false, "sClass": "center sorting_false", "bSearchable": false}
        ]
    });
    
    
    
    
    
    $('table#tabla_desincorporar').on('click', 'input:checkbox[name="desincorporar[]"]', function() {
        var marcado = $('input:checkbox[name="desincorporar[]"]:checked').length
        if(marcado > 0){
            $('#div_desincorporar').fadeIn(1000)
        }else{
            $('#div_desincorporar').fadeOut(1000)
        }
        
    });

    $('#guardar').click(function(){
        var url = '../../vista/reportes/desincorporar.php';
        window.open(url)
    });
});