<?php

$message = $this->session->flashdata('item');
echo (!empty($message) ? '<div class="alert alert-' . $message['class'] . ' alert-dismissable" role="alert" id="infoMessage"><button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>' . $message['message'] . '</div>' : '');