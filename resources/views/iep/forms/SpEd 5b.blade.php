@include('iep.forms.SpEd 5e')

<?php

if (!empty($responses->get('all-requirements'))) {
  $pdf->setField('all-requirements', 'Yes');
}

?>
