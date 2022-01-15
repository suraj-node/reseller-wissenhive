'use strict';

/* ===== Enable Bootstrap Popover (on element  ====== */

var popoverTriggerList = [].slice.call(document.querySelectorAll('[data-toggle="popover"]'))
var popoverList = popoverTriggerList.map(function (popoverTriggerEl) {
  return new bootstrap.Popover(popoverTriggerEl)
})

/* ==== Enable Bootstrap Alert ====== */
var alertList = document.querySelectorAll('.alert')
alertList.forEach(function (alert) {
  new bootstrap.Alert(alert)
});


/* ===== Responsive Sidepanel ====== */
const sidePanelToggler = document.getElementById('sidepanel-toggler'); 
const sidePanel = document.getElementById('app-sidepanel');  
const sidePanelDrop = document.getElementById('sidepanel-drop'); 
const sidePanelClose = document.getElementById('sidepanel-close'); 

window.addEventListener('load', function(){
	responsiveSidePanel(); 
});

window.addEventListener('resize', function(){
	responsiveSidePanel(); 
});


function responsiveSidePanel() {
    let w = window.innerWidth;
	if(w >= 1200) {
	    // if larger 
	    //console.log('larger');
		sidePanel.classList.remove('sidepanel-hidden');
		sidePanel.classList.add('sidepanel-visible');
		
	} else {
	    // if smaller
	    //console.log('smaller');
	    sidePanel.classList.remove('sidepanel-visible');
		sidePanel.classList.add('sidepanel-hidden');
	}
};

sidePanelToggler.addEventListener('click', () => {
	if (sidePanel.classList.contains('sidepanel-visible')) {
		console.log('visible');
		sidePanel.classList.remove('sidepanel-visible');
		sidePanel.classList.add('sidepanel-hidden');
		
	} else {
		console.log('hidden');
		sidePanel.classList.remove('sidepanel-hidden');
		sidePanel.classList.add('sidepanel-visible');
	}
});



sidePanelClose.addEventListener('click', (e) => {
	e.preventDefault();
	sidePanelToggler.click();
});

sidePanelDrop.addEventListener('click', (e) => {
	sidePanelToggler.click();
});



/* ====== Mobile search ======= */
// const searchMobileTrigger = document.querySelector('.search-mobile-trigger');
// const searchBox = document.querySelector('.app-search-box');

// searchMobileTrigger.addEventListener('click', () => {

// 	searchBox.classList.toggle('is-visible');
	
// 	let searchMobileTriggerIcon = document.querySelector('.search-mobile-trigger-icon');
	
// 	if(searchMobileTriggerIcon.classList.contains('fa-search')) {
// 		searchMobileTriggerIcon.classList.remove('fa-search');
// 		searchMobileTriggerIcon.classList.add('fa-times');
// 	} else {
// 		searchMobileTriggerIcon.classList.remove('fa-times');
// 		searchMobileTriggerIcon.classList.add('fa-search');
// 	}
	
		
	
// });


$(document).ready(function(){
	$(".app-menu li").on('click', function(){
	  $(this).siblings().removeClass('active');
	  $(this).addClass('active')
	})
  })

//   $(function () {
// 	$('#navbarNav a').click(function () {
// 		$('#navbarNav a').removeClass('active');
// 		$(this).addClass('active');
// 	});
// });


  $(document).ready(function() {
	var table = $('#example').DataTable( {
		lengthChange: false,
		// responsive: true,
		// processing: true,
		// "scrollX": true,
		text: 'Export',
		// "aLengthMenu": [[25, 50, 75, -1], [25, 50, 75, "All"]],
		// "iDisplayLength": 10,
		buttons: [
			{
				extend: 'excelHtml5',
				title: 'Data export',

			},
			{
				extend: 'pdfHtml5',
				title: 'Data export'
			},
			{

			   extend: 'colvis',
			}
		],
		initComplete: function () {
		var btns = $('.dt-button');
		btns.addClass('btn btn-success btn-sm');
		btns.removeClass('dt-button');

	}
	} );
 
	table.buttons().container()
		.appendTo( '#example_wrapper .col-md-6:eq(0)' );
} );

function toasterClosebtn() {
	document.getElementById("toaster").style.display = "none";
  }


  // active class add
jQuery(document).ready(function(){

    var url = window.location;

    // $('ul.app-menu a[href="'+ url +'"]').addClass('active');
    // $('ul.app-menu a[href="'+ url +'"]').closest('.drop_class').addClass('open');
    // $('ul.app-menu a[href="'+ url +'"]').parent().closest('.sub-menu').css('display','block');
    $('ul.app-menu a').filter(function() {
         return this.href == url;
    }).addClass('active');

    //var uristring =url.pathname.split('/')[2];

    //console.log(jQuery('.nav-item a[href="'+uristring+'"]').attr('class'));

    //var hrefeme = jQuery('.nav-item a[href="'+uristring+'"]').parent().addClass('active');

    //var checkExist = jQuery('.nav-item a[href="'+uristring+'"]').parent('.nav-item').closest('.openActiveDrp').addClass('active');

     //checkExist.addClass('active');

     //checkExist.toggle();

    //console.log(checkExist);



});