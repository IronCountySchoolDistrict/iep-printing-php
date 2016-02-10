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

var iepContent = {};

function status(response) {
  if (response.status >= 200 && response.status < 300) {
    return Promise.resolve(response);
  } else {
    return Promise.reject(new Error(response.statusText));
  }
}

function json(response) {
  return response.json();
}

function html(response) {
  return response.text();
}

function resizeContent() {
  var windowHeight = $(window).height();
  var SPACE_ABOVE_CONTENT = 71;
  var iepHeight = windowHeight - SPACE_ABOVE_CONTENT;
  var iepListHeight = iepHeight - 55;
  $('.iep').css('height', iepHeight + 'px');
  $('.iep-list').css('height', iepListHeight + 'px');
}

function iepSnippetClickHandler(event) {
  iepSnippet = $(event.target);
  if (!iepSnippet.hasClass('iep-snippet')) {
    iepSnippet = iepSnippet.parents('.iep-snippet');
  }

  if (iepSnippet.hasClass('active')) {
    return;
  }

  loadingModal.show();

  $('.iep-snippet.active .case-manager').replaceWith(function() {
    return $('<span class="'+$(this).prop('class')+'">' + this.innerHTML + '</span>');
  });
  $('.iep-snippet.active .start-date').replaceWith(function() {
    return $('<span class="'+$(this).prop('class')+'">' + this.innerHTML + '</span>');
  });

  $('.iep-snippet.active').removeClass('active');
  iepSnippet.addClass('active');

  loadIep();
}

function loadIep() {
  $('.iep').empty();
  var iepid = $('.iep-snippet.active').prop('id');
  if (typeof iepContent[iepid] === "undefined") {
    var params = [
      'iep=' + iepid,
      'frn=' + frn
    ];
    window.fetch('/iep?' + params.join('&'))
      .then(status)
      .then(html)
      .then(function(html) {
        $('.iep').append(html);
        iepContent[iepid] = html;
        styleIep();
      });
  } else {
    $('.iep').append(iepContent[iepid]);
    styleIep();
  }
}

function styleIep() {
  $('.iep-table').dataTable({
    "paging": false,
    "ordering": false,
    "bInfo": false
  });

  $('.iep-table input[type=checkbox], .iep input[type=radio]').iCheck({
    checkboxClass: 'icheckbox_flat-blue',
    radioClass: 'iradio_flat-blue'
  });

  $('.iep-table input[type=checkbox]').on('ifChanged', checkboxWatcher);
  $('#btnPrintSelection').on('click', printForms);

  var caseManagerHref = $('.iep-table a:contains("IEP: SpEd 51")').prop('href') + '&case_manager';
  $('.iep-snippet.active .case-manager').replaceWith(function() {
    return $('<a target="_blank" href="'+caseManagerHref+'" class="'+$(this).prop('class')+'">' + this.innerHTML + '</a>');
  });

  var startDateHref = $('.iep-table a:contains("IEP: SpEd 6a1")').prop('href') + '&start_date';
  $('.iep-snippet.active .start-date').replaceWith(function() {
    return $('<a target="_blank" href="'+startDateHref+'" class="'+$(this).prop('class')+'">' + this.innerHTML + '</a>');
  });

  loadingModal.hide();
}

function checkboxWatcher(event) {
  var RESPONSE_CHECKS = '.iep-table input[name="response[]"]';

  var checkboxCount = $(RESPONSE_CHECKS).length;
  var checkedBoxCount = $(RESPONSE_CHECKS + ':checked').length;

  if (event.target.name === 'master') {
    if (event.target.checked) {
      $(RESPONSE_CHECKS).iCheck('check');
    } else {
      if (checkboxCount == checkedBoxCount) {
        $(RESPONSE_CHECKS).iCheck('uncheck');
      }
    }
  } else {
    if (checkboxCount == checkedBoxCount) {
      $('.iep-table input[name=master]').iCheck('check');
    } else {
      $('.iep-table input[name=master]').iCheck('uncheck');
    }
  }
}

function createIep() {
  var inputElement = $('.new-iep-modal input[name="start-date"]');
  var dateRegex = /^(0[1-9]|1[0-2])\/(0[1-9]|1\d|2\d|3[01])\/(19|20)\d{2}$/;

  if (!dateRegex.test(inputElement.val())) {
    $('.new-iep-modal .form-group').addClass('has-warning');
    $('.new-iep-modal .help-block').text('Sorry, the date must math the MM/DD/YYYY format');

    return;
  }

  $('.new-iep-modal .btn').prop('disabled', true);
  $('.new-iep-modal .btn-success > i').removeClass('hide');

  window.fetch('/iep', {
    method: 'POST',
    body: JSON.stringify({
      start_date: inputElement.val(),
      user: user,
      student: student
    })
  }).then(status)
    .then(html)
    .then(function(data) {
      $('.iep-list .scroll-content').prepend(data);
      $('.iep-list .iep-snippet').first().find('#activate-iep').on('click', activateIep);
      $('.new-iep-modal').modal('hide');
      $('.new-iep-modal input').val('');
      $('.new-iep-modal .btn').prop('disabled', false);
      $('.new-iep-modal .btn-success > i').addClass('hide');
      $('.iep-list .iep-snippet').first().on('click', iepSnippetClickHandler);
      $('.iep-list .iep-snippet').first().click();
    });
}

function printForms() {
  if ($('.iep-table input[name="response[]"]:checked').length < 1) {
    alert('There are no forms selected.');
    return;
  }

  togglePrintBtn('disable');

  var selected = [];
  $('.iep-table input[name="response[]"]:checked').each(function(index, element) {
    selected.push({
      formid: $(element).attr('data-form-id'),
      title: $(element).attr('data-form-title'),
      responseid: $(element).val()
    });
  });

  window.fetch('/iep/print', {
    method: 'POST',
    body: JSON.stringify({
      selected: selected,
      student: student,
      fileOption: $('input[name=fileOption]').val(),
      watermarkOption: $('input[name=watermarkOption]').val()
    })
  }).then(status)
    .then(json)
    .then(function(data) {
      if (data.file.length > 0) {
        var win = window.open('/' + data.file, '_blank');
        if (win) {
          win.focus();
        } else {
          alert('ERROR: Please allow popups for this page.'); // TODO: better way to alert/inform?
        }
      }

      $('input[name="response[]"]:checked').each(function(index, element) {
        var parentElement = $(element).parents('tr');
        if (parentElement.hasClass('error')) {
          $(element).parents('tr').removeClass('error');
          $(element).parents('tr').find('.form-error').text('');
        }
      });

      for (var key in data.error) {
        var row = $('.iep-table #' + key);
        row.addClass('error');
        row.find('.form-error').text(data.error[key]);
      }

      togglePrintBtn('enable');
    });
}

function togglePrintBtn(action) {
  if (action === 'disable') {
    $('#btnPrintSelection').prop('disabled', true);
    $('#btnPrintSelection > i').removeClass('hide');
  } else {
    $('#btnPrintSelection').prop('disabled', false);
    $('#btnPrintSelection > i').addClass('hide');
  }
}

function deleteIep() {
  var inputElement = $('.delete-iep-modal input[name="confirm-delete"]');

  if (inputElement.val() !== 'DELETE') {
    inputElement.val('');
    inputElement.parent().addClass('has-warning');
    inputElement.siblings('.help-block').text('Sorry, please enter the text exactly as displayed to confirm.');
    inputElement.focus();

    return;
  }

  $('.delete-iep-modal .btn-danger').prop('disabled', true);
  $('.delete-iep-modal .btn-danger > i').removeClass('hide');

  inputElement.parent().removeClass('has-warning');
  inputElement.siblings('.help-block').text('');

  var iepid = $('.iep-snippet.active').prop('id');

  window.fetch('/iep/response-count?iep=' + iepid)
    .then(status)
    .then(json)
    .then(function(count) {
      if (count < 1) {
        window.fetch('/iep/delete', {
          method: 'POST',
          body: JSON.stringify({
            iep: iepid
          })
        }).then(status)
          .then(json)
          .then(function(response) {
            if (response) {
              $('.delete-iep-modal').modal('hide');
              $('.iep-snippet.active').remove();
              $('.iep').empty();
              inputElement.parent().removeClass('has-warning');
              inputElement.siblings('.help-block').text('');
            } else {
              inputElement.parent().addClass('has-warning');
              inputElement.siblings('.help-block').text('Sorry, unable to delete this IEP right now. Try again later.');
            }

            inputElement.val('');
            $('.delete-iep-modal .btn-danger').prop('disabled', false);
            $('.delete-iep-modal .btn-danger > i').addClass('hide');
          });
      } else {
        inputElement.val('');
        inputElement.parent().addClass('has-warning');
        inputElement.siblings('.help-block').text('Sorry, only IEPs with no responses can be deleted.');
        $('.delete-iep-modal .btn-danger').prop('disabled', false);
        $('.delete-iep-modal .btn-danger > i').addClass('hide');
      }


    });
}

function activateIep(event) {
  event.stopPropagation();
  event.preventDefault();

  if (confirm('Activating this IEP will cause the currently active IEP (if any) to become inactive and read-only. Are you sure you want to activate this IEP?')) {
    var iepid = $(event.target).parents('.iep-snippet').prop('id');

    window.fetch('/iep/activate', {
      method: 'POST',
      body: JSON.stringify({
        iep: iepid,
        student: student
      })
    }).then(status)
      .then(json)
      .then(function(response) {
        if (response) {
          $('.iep-status.label-primary')
            .text('Inactive')
            .removeClass('label-primary')
            .addClass('label-warning');
          $(event.target).parents('.iep-snippet').find('.iep-status')
            .text('Active')
            .removeClass('label-warning')
            .addClass('label-primary');
          $(event.target).parent().remove();
        }
      });
  }
}

$(document).ready(function() {
  resizeContent();
  loadIep();

  $(window).on('resize', resizeContent);
  $('.new-iep-modal input[type=text]').datepicker({
    format: "mm/dd/yyyy",
    autoclose: true,
    todayHighlight: true,
    startDate: "0d",
    endDate: "+1y"
  });
  $('.new-iep-modal .btn-success').on('click', createIep);
  $('.delete-iep-modal .btn-danger').on('click', deleteIep);
  $('.iep-snippet').on('click', iepSnippetClickHandler);
  $('#activate-iep').on('click', activateIep);
});

//# sourceMappingURL=all.js.map
