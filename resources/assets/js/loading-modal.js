var loadingModal;
loadingModal = loadingModal || (function() {
  var loadingDiv = $('#loadingDialog');
  return {
    show: function() {
      loadingDiv.modal('show');
    },
    hide: function() {
      loadingDiv.modal('hide');
    }
  }
})();
