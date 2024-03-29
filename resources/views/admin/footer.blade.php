<!-- Javascript -->

<script src="{{ asset('assets/plugins/popper.min.js') }}"></script>
<script src="{{ asset('assets/plugins/bootstrap/js/bootstrap.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/datatable/pdfmake.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/datatable/vfs_fonts.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/datatable/datatables.min.js') }}"></script>
<script src="{{ asset('web-assets/assets/libs/toastr/build/toastr.min.js') }}"></script>
<!-- Page Specific JS -->
<script src="{{ asset('assets/js/app.js') }}"></script>
<script type="text/javascript" src="{{ asset('app.js') }}"></script>

<script type="text/javascript">
  // This function is called from the pop-up menus to transfer to
  // a different page. Ignore if the value returned is a null string:
  function goPage(newURL) {

    // if url is empty, skip the menu dividers and reset the menu selection to default
    if (newURL != "") {

      // if url is "-", it is this page -- reset the menu:
      if (newURL == "-") {
        resetMenu();
      }
      // else, send page to designated URL            
      else {
        document.location.href = newURL;
      }
    }
  }

  // resets the menu selection upon entry to this page:
  function resetMenu() {
    document.gomenu.selector.selectedIndex = 2;
  }
</script>
</body>

</html>