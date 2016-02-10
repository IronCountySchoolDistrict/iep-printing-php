<div class="row" style="padding-left: 10px; padding-top: 10px;">
  <div class="col-xs-4">
    <div class="pull-left">
      <span>File: </span>
      <span title="All forms will be concatenated into a single PDF file">
        <input type="radio" name="fileOption" value="concat" checked="checked"> Concatenate
      </span>
      <span title="All forms will be archived into a single ZIP file (one PDF per form)">
        <input type="radio" name="fileOption" value="zip"> Zip
      </span>

      <br>
      <span>Watermark: </span>
      <span title="No watermark is added">
        <input type="radio" name="watermarkOption" value="final" checked="checked"> Final
      </span>
      <span title="Inserts a DRAFT watermark on every page of the resulting PDF(s)">
        <input type="radio" name="watermarkOption" value="draft"> Draft
      </span>
      <span title="Inserts a COPY watermark on every page of the resulting PDF(s)">
        <input type="radio" name="watermarkOption" value="copy"> Copy
      </span>
    </div>
    <div class="pull-right">
      <button id="btnPrintSelection" type="submit" class="btn btn-primary"><i class="fa fa-spinner fa-pulse fa-fw hide"></i> Print Selected</button>
    </div>
  </div>
</div>

<table class="table table-striped iep-table">
  <thead>
    <th>
      <input type="checkbox" name="master">
    </th>
    <th style="width: 1px"></th>
    <th>
      Form Name
    </th>
    <th>
      Form Description
    </th>
  </thead>
  <tbody>
    @foreach ($data as $form)
      <tr id="{{ $form->formid }}">
        <td>
          <input type="checkbox" name="response[]" value="{{ $form->responseid }}" data-form-id="{{ $form->formid }}" data-form-type="{{ $form->form_type }}" data-form-title="{{ $form->form_title }}">
        </td>
        <td data-search="{{ $form->responseid ? 'green' : 'blue' }}">
          <img src="{{ $form->responseid ? secure_asset('img/flag-green.png') : secure_asset('img/flag-blue.png') }}" title="Last Entry: {{ $form->modified_on }}" />
        </td>
        <td>
          <a href="{{ config('iep.powerschool_url') }}admin/formbuilder/students/studentform.html?formid={{ $form->formid }}&amp;type={{ $form->form_type }}&amp;responseid={{ $form->responseid }}&amp;iep={{ $iep }}&amp;frn={{ $frn }}" target="_blank">
            {{ $form->form_title }}
          </a>
        </td>
        <td>
          {{ $form->description }}
          <br>
          <span class="form-error"></span>
        </td>
      </tr>
    @endforeach
  </tbody>
</table>
