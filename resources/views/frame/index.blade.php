<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title></title>

    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/iCheck/1.0.1/skins/flat/blue.css" charset="utf-8">
    <link rel="stylesheet" href="//cdn.datatables.net/1.10.10/css/dataTables.bootstrap.min.css" charset="utf-8">
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.1/css/bootstrap-datepicker.min.css">

    <link rel="stylesheet" href="/css/styles.css" charset="utf-8">
  </head>
  <body>
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <div class="panel panel-default iep-panel">
            <div class="panel-heading">
              <strong>IEP</strong>
            </div>
            <div class="panel-body panel-no-padding">
              <div class="iep-container row no-gutter">
                <div class="col-xs-5 col-sm-4 col-md-3 no-padding">
                  <div class="iep-sidebar">
                    <div class="iep-list scroll-pane has-scrollbar">
                      <div class="scroll-content">
                        @foreach($ieps as $iep)
                          @include('frame.iep-snippet')
                        @endforeach
                      </div>
                    </div>

                    <div class="iep-options clearfix">
                      <button class="pull-left btn btn-success" data-toggle="modal" data-target=".new-iep-modal">New</button>
                      <div class="pull-right">
                        <button class="btn btn-default btn-danger" data-toggle="modal" data-target=".delete-iep-modal">
                          <i class="fa fa-trash-o"></i>
                        </button>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="col-xs-7 col-sm-8 col-md-9 no-padding">
                  <div class="iep scroll-pane has-scrollbar"></div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    @include('frame.modal.loading')
    @include('frame.modal.new')
    @include('frame.modal.delete')

    <script type="text/javascript">
      var user = {!! json_encode($user) !!};
      var student = {!! json_encode($student) !!}
      var frn = "{{ $frn }}";
    </script>
    <script src="//code.jquery.com/jquery-1.12.0.min.js"></script>
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
    <script type="text/javascript" src="//cdn.datatables.net/1.10.10/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="//cdn.datatables.net/1.10.10/js/dataTables.bootstrap.min.js"></script>
    <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.1/js/bootstrap-datepicker.min.js"></script>
    <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/iCheck/1.0.1/icheck.min.js"></script>

    <script type="text/javascript" src="/js/all.js"></script>
  </body>
</html>
