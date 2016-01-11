/*
 * Template name: Kertas - Responsive Bootstrap 3 Admin Template
 * Version: 1.0.0
 * Author: VergoLabs
 */

/* DATATABLES */
function initDatatables() {
	/* BASIC DATATABLES */
	$('#dataTables1').dataTable();
	
        
	/* ROW DETAILS */
	var nCloneTh = document.createElement('th');
        nCloneTh.setAttribute('data-defaultsort','disabled');
        nCloneTh.setAttribute("style", "background: none");
    	var nCloneTd = document.createElement('td');
	nCloneTd.innerHTML = '<i class="fa fa-angle-down link"></i>';
	nCloneTd.className = "center";

	$('#dataTables2 thead tr').each(function(){
		this.insertBefore(nCloneTh, this.childNodes[6]);
	});

	$('#dataTables2 tbody tr').each(function(){
		this.insertBefore(nCloneTd.cloneNode(true), this.childNodes[6]);
	});
       
	function fnFormatDetails(oTable, nTr,trid) {
		var aData = oTable.fnGetData(nTr);               
		var sOut = '<table cellpadding="5" cellspacing="0" border="0" class="detail-row">';
			sOut += '<tr><td valign="top">Name</td><td valign="top">:</td><td>'+aData[1]+'</td></tr>';
			sOut += '<tr><td valign="top">Message</td><td  valign="top">:</td><td>'+aData[4]+'</td></tr>';
			sOut += '<tr><td valign="top">Email</td><td valign="top">:</td><td><pre>'+aData[5]+'</pre></td></tr>';
                          
                        sOut += '<tr><td>Date</td><td>:</td><td>'+aData[6]+'</td></tr>';                        
			sOut += '</table>';

		return sOut;
	}

	var oTable = $('#dataTables2').dataTable({
		"aoColumnDefs": [{
			//"bSortable": false,
			//"aTargets": [0]
		}],
		//"aaSorting": [[1, 'asc']]
	});



	$('#dataTables2 tbody').on('click', 'tr', function(e){
           
               var nTr = $(this);                             
               var trid = $(this).attr('id');
               mailboxread(trid);
             
              var cell = $(e.target).get(0); // This is the TD you clicked
             
         //    console.log(e.target.nodeName );
                               
                            
            if(e.target.nodeName != 'LI')  
            {              
                if(oTable.fnIsOpen(nTr)){

                //$(this).next().find('i').removeClass("fa-angle-up").addClass("fa-angle-down");
                $(this).find('i').removeClass("fa-angle-up").addClass("fa-angle-down");                    

                //$(this).removeClass("fa-angle-up").addClass("fa-angle-down");
                oTable.fnClose(nTr);

                }else{
                // $(this).next().find('i').removeClass("fa-angle-down").addClass("fa-angle-up");
                $(this).find('i').removeClass("fa-angle-down").addClass("fa-angle-up");

                //$(this).removeClass("fa-angle-down").addClass("fa-angle-up");
                oTable.fnOpen(nTr, fnFormatDetails(oTable, nTr,trid), 'details');
                }
           }
                               
              
        });
        
        
}


$(function() {
	"use strict";
	
	initDatatables();
});