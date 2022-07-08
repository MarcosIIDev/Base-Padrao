$(document).ready(function() {
    $.extend( $.fn.dataTable.defaults, {
        //Linguagem/Arquivo
        'language': {
            'url': 'http://localhost/projetos/padrao/assets/plugins/datatables/traducao.txt'
        },
        //Tabela Responsiva
        'responsive': true,

        //Registro por Pagina    
        'lengthMenu': [[10, 25, 50, -1], [10, 25, 50, 'Todos']]
    });
    
    //Tabela sem ordem
    $('#tgSemOrdem').DataTable ( {
        "ordering": false
    });


    //Tabela 5 Colunas
    $('#tgtab5').DataTable ( {
        "aoColumnDefs": [
            { "bSortable": false, "aTargets": [ 2 ] },
            { "bSortable": false, "aTargets": [ 3 ] },
            { "bSortable": false, "aTargets": [ 4 ] }
        ]
    });
    
    //Tabela 5 Colunas A
    $('#tgtab5a').DataTable ( {
        "aoColumnDefs": [
            { "bSortable": false, "aTargets": [ 1 ] },
            { "bSortable": false, "aTargets": [ 2 ] },
            { "bSortable": false, "aTargets": [ 3 ] },
            { "bSortable": false, "aTargets": [ 4 ] }
        ]
    });
    
    //Tabela 4 Colunas
    $('#tgtab4').DataTable ( {
        "aoColumnDefs": [
            { "bSortable": false, "aTargets": [ 2 ] },
            { "bSortable": false, "aTargets": [ 3 ] }
        ]
    });
	
	//Tabela 3 Colunas
    $('#tgtab3').DataTable ( {
        "aoColumnDefs": [
            { "bSortable": false, "aTargets": [ 2 ] }
        ]
    });
    
    $("#example1").DataTable();
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
    });
} );